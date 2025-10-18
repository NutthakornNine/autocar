<?php
if (isset($_GET['datetime'])) {
    $strDate = explode(" - ", $_GET['datetime']);
    $startDate = $strDate[0];
    $endDate = $strDate[1];
} else {
    $startDate = date("Y-m-d");
    $endDate = date("Y-m-d");
}
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>AutoHub — ตัวกลางบริการรถเช่า</title>
    <style>
        .sriracha-regular {
            font-family: "Sriracha", cursive;

        }

        .hero {
            position: relative;
        }

        .hero-img {
            width: 100%;
            height: 360px;
            object-fit: cover;
            filter: contrast(1.02) saturate(1.05);
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #fff;
            background: linear-gradient(180deg, rgba(0, 0, 0, .0), rgba(0, 0, 0, .35));
            text-align: center;
            padding: 16px;
        }

        .hero-title {
            font-size: 60px;
            text-shadow: 0 4px 16px rgba(0, 0, 0, .35);
            border-right: .12em solid #f0eaeaff;

        }

        @keyframes blink {
            50% {
                border-color: transparent;
            }

        }

        @keyframes reveal {
            to {
                background-size: 100% 100%;
            }
        }

        @keyframes typing {
            to {
                width: var(--chars)ch;
            }
        }

        @keyframes blink {
            50% {
                border-color: transparent;
            }
        }

        .hero-sub {
            opacity: .95;
            margin-top: 6px;
            font-size: 20px;
            text-shadow: 0 4px 16px rgba(0, 0, 0, .35);
        }

        .card {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .card img {
            border-radius: 20px;
            transition: transform 0.5s ease;
        }

        .card img:hover {
            transform: scale(1.03);
        }
    </style>
    <?php include 'header.php' ?>

</head>

<body>
    <?php include 'menu.php'; ?>
    <section class="hero">
        <img src="assets/banner.png" class="hero-img" alt="Autocar Banner" />
        <div class="hero-overlay">
            <h1 class="hero-title" id="typing"></h1>
            <p class="hero-sub">ดีลพิเศษจากผู้ให้บริการทั่วไทย </p>
        </div>
    </section>

    <section style="background:#f4f8ff;border-bottom:1px solid #e3eefb;padding:80px 0;">
        <div style="max-width:1400px;margin:0 auto;padding:0 16px;">
            <div class="card shadow rounded-4 p-4">
                <form method="get" id="form-search">
                    <div class="row">
                        <div class="col-12 col-md-4 col-lg-4">
                            <div class="form-group">
                                <label for="booking-ref">เลือกจังหวัดที่ต้องการจอง</label>
                                <select id="booking-ref" name="province" class="form-control form-select shadow-4" data-placeholder="กรุณาเลือก" required>
                                    <option value="" disabled selected>กรุณาเลือก</option>
                                    <?php foreach (getProvince() as $p): ?>
                                        <option value="<?= $p['id'] ?>"><?= $p['name_th'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="start-date">วันที่ต้องการเช่า</label>
                                <input type="text" id="datetime" name="datetime">
                            </div>
                        </div>
                        <div class="col-12 col-md-2 col-lg-2" style="margin-top: 35px;">
                            <button type="submit" class="submit-btn w-100 mb-3">ค้นหา</button>
                        </div>

                    </div>
            </div>
            </form>
    </section>
    <div class="container ">
        <h3><b>โปรโมชั่นพิเศษ</b></h3>
        <hr>
        <div class="card text-bg-dark border-0 shadow-lg rounded-4 overflow-hidden">
            <div id="autoCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2500" >
                <div class="carousel-inner">

                    <!-- รูปที่ 1 -->
                    <div class="carousel-item active">
                        <img src="assets/promotion1.png" class="d-block w-100" alt="รูป 1" style=" object-fit:cover;">
                    </div>

                    <!-- รูปที่ 2 -->
                    <div class="carousel-item">
                        <img src="assets/promotion2.png" class="d-block w-100" alt="รูป 2" style="object-fit:cover;">
                    </div>

                    <!-- ปุ่มเลื่อนไปซ้าย -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#autoCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>

                    <!-- ปุ่มเลื่อนไปขวา -->
                    <button class="carousel-control-next" type="button" data-bs-target="#autoCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
            </div>
        </div>
        <br><br>


        <?php include 'chatbot.php' ?>
        <?php include 'footer.php' ?>
        </script>

        <script>
            $('#datetime').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD',
                    separetor: ' - '
                },
                startDate: '<?= $startDate ?>',
                endDate: '<?= $endDate ?>'
            });
            $('#booking-ref').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
            });
            const texts = [
                "ค้นหารถเช่าที่ใช่ ในราคาที่ชอบ...",
                "เปรียบเทียบราคา สะดวก ปลอดภัย",
                "คิดถึงรถเช่านึกถึง Auto Car",
            ];

            let textIndex = 0;
            let charIndex = 0;
            let isDeleting = false;
            const speed = 170;
            const delay = 1700;

            function typeWriter() {
                const currentText = texts[textIndex];
                const typingDiv = document.getElementById("typing");

                if (!isDeleting) {
                    typingDiv.textContent = currentText.substring(0, charIndex++);
                    if (charIndex > currentText.length) {
                        isDeleting = true;
                        setTimeout(typeWriter, delay);
                        return;
                    }
                } else {
                    typingDiv.textContent = currentText.substring(0, charIndex--);
                    if (charIndex < 0) {
                        isDeleting = false;
                        textIndex = (textIndex + 1) % texts.length; // ไปข้อความถัดไป
                    }
                }
                setTimeout(typeWriter, isDeleting ? speed / 2 : speed);
            }

            typeWriter();

            $("#form-search").on("submit", function(e) {
                e.preventDefault();
                const province = $("#booking-ref").val();
                const datetime = $("#datetime").val();
                var selectedText = $('#booking-ref option:selected').text();
                window.location.href = `results.php?datetime=${datetime}&province=${province}&province_name=${selectedText}`;
            });
        </script>


</body>

</html>