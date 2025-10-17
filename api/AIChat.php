<?php
if (session_status() === PHP_SESSION_NONE) {session_start();}
header('Content-Type: application/json; charset=utf-8');

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

class AgenticOllama {
    private $url   = "http://localhost:11434/api/chat";
    private $model = "llama3.2:latest";
    private $dbcon = null;

    public function connect() {
        if ($this->dbcon) return $this->dbcon;
        $db = new mysqli("localhost", "root", "", "aurocar");
        $db->set_charset("utf8mb4");
        $this->dbcon = $db;
        return $this->dbcon;
    }

    public function getCars () {
         $sql = "SELECT * FROM Cars";
         $query = $this->Connect()->query($sql);
         $html = "";
         foreach ($query as  $key => $row) {
             $key = $key + 1;
             $html .= "{$key} | ชื่อรถ {$row['car_brand']} ราคาเช่าต่อวัน {$row['price_per_day']} สถานะ {$row['car_status']} (1 = ว่าง, 0 =  ไม่ว่าง) \n";
         }
         return $html;
     }

    public function agentic(string $question): array {
        $data_from_db = $this->getCars();

        $prompt = "
        คุณคือผู้ช่วยจัดการข้อมูลรถยนต์สำหรับลูกค้า **ที่สุภาพ ให้ข้อมูลตรงประเด็น และยึดตามข้อมูลจากฐานข้อมูลที่ให้มาเท่านั้น**

         หลักเกณฑ์การตอบ (ยึดตาม {$data_from_db} เท่านั้น):
         1. **เน้นความสุภาพ** ในทุกการตอบ และใช้ครับ/ค่ะ
         2. **ถ้าข้อมูลเป็นรายการรถยนต์ (Inventory/Stock):** ให้ระบุยี่ห้อและจำนวนรถที่ว่างในรูปแบบสรุป
         3. **ถ้าข้อมูลเป็นราคาซื้อ/ข้อมูลจำเพาะอื่น ๆ:** ให้สรุปเป็นข้อความ
         4. **การตอบสถานะและราคาเช่า (Rental Focus):**
            - ถ้า **สถานะ = 0** (ไม่ว่าง): ให้ตอบว่ารถไม่ว่าง
            - ถ้า **สถานะ = 1** (ว่าง): ให้แจ้ง **'ว่าง'** และ **ราคาเช่าต่อวัน** เท่านั้น
            - **เน้น:** ตอบเฉพาะสถานะรถว่างและราคา **สั้นๆ และตรงประเด็น**
         5. **การกรองข้อมูล (Strict Filtering):** ตอบเฉพาะข้อมูลรถยนต์ที่ลูกค้าถามถึงเท่านั้น **ห้าม** แสดงข้อมูลรถรุ่นอื่นหรือข้อมูลที่ไม่เกี่ยวข้อง
         6. **กรณีไม่มีข้อมูลในฐานข้อมูลที่ให้มา:** ถ้าไม่พบข้อมูลใด ๆ ที่เกี่ยวข้องกับคำถามในฐานข้อมูล (ที่ {$data_from_db}) ให้ตอบกลับไปว่า `ไม่มีข้อมูลที่ท่านค้นหา กรุณาถามใหม่ ที่เกี่ยวกับรถเท่านั้นครับ`

         ---
        
         คำถามจากลูกค้า: {$question}
         ข้อมูลจากฐานข้อมูล:
         {$data_from_db}

         ---
        
         คำตอบ (ตามหลักเกณฑ์ที่เคร่งครัดและยึดข้อมูลจากฐานข้อมูลเท่านั้น):
";

        $payload = [
            "model"    => $this->model,
            "messages" => [
                ["role" => "system", "content" => "You are a helpful assistant."],
                ["role" => "user",   "content" => $prompt]
            ],
            "stream" => false
        ];

        // เรียก Ollama
        $ch = curl_init($this->url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER     => ["Content-Type: application/json"],
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => json_encode($payload, JSON_UNESCAPED_UNICODE),
            CURLOPT_CONNECTTIMEOUT => 3,
            CURLOPT_TIMEOUT        => 15,
        ]);

        $raw = curl_exec($ch);
        if ($raw === false) {
            $err = curl_error($ch);
            curl_close($ch);
            throw new RuntimeException("cURL error: {$err}");
        }
        $http = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($http < 200 || $http >= 300) {
            throw new RuntimeException("Upstream HTTP {$http}: " . substr($raw, 0, 200));
        }

        $result = json_decode($raw, true);
        if (!is_array($result)) {
            throw new RuntimeException("Invalid JSON from model");
        }

        // รองรับหลายรูปแบบของ Ollama/LM
        $answer = $result['message']['content']
            ?? $result['choices'][0]['message']['content']
            ?? $result['content']
            ?? null;

        if ($answer === null) {
            // ส่งคืนทั้งผลดิบเพื่อ debug (แต่ยังอยู่ใน JSON เดียว)
            return [
                "status_code" => 502,
                "status"      => "upstream_bad_payload",
                "question"    => $question,
                "answer"      => "",
                "raw"         => $result,
            ];
        }

        return [
            "status_code" => 200,
            "status"      => "success",
            "question"    => $question,
            "answer"      => $answer,
        ];
    }
}

try {
    $question = isset($_POST['question']) ? trim((string)$_POST['question']) : '';
    if ($question === '') {
        http_response_code(400);
        echo json_encode([
            "status_code" => 400,
            "status"      => "bad_request",
            "message"     => "question is required"
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }

    $svc = new AgenticOllama();
    $resp = $svc->agentic($question);

    http_response_code($resp['status_code'] ?? 200);
    echo json_encode($resp, JSON_UNESCAPED_UNICODE);
    exit;

} catch (Throwable $e) {
    http_response_code(500);
    return [
        "status_code" => 502,
        "status"      => "upstream_bad_payload",
        "question"    => $question,
        "answer"      => "เกิดข้อิดพลาดไม่สามารถตอบคำถามได้",
        "raw"         => $result,
    ];
    exit;
}
