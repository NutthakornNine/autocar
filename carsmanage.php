<!doctype html>
<html lang="th">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>เพิ่มรถ | AutoCar</title>
    <?php include 'header.php'; ?>
    <style>
        .hero {
            background: linear-gradient(135deg, #0d6efd, #0aa3ff);
            color: #fff;
        }

        .card-soft {
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .08);
        }

        .img-preview {
            width: 100%;
            max-height: 220px;
            object-fit: cover;
            border-radius: .75rem;
        }
    </style>
</head>

<body class="bg-light">
    <?php include 'menu.php'; ?>
    <br><br>



    <section style="background:#f4f8ff;border-bottom:1px solid #e3eefb;padding:20px 0;">
        <div class="container  mt-5">
            <h2 class="display-7 fw-bold mb-1">เพิ่มรถของคุณ</h2>
            <p class="mb-0 opacity-75">กรอกข้อมูลให้ครบถ้วนเพื่อปล่อยเช่าบนแพลตฟอร์ม</p>
        </div>
        <div class="container pb-5 ">
            <form id="carForm" class="needs-validation" novalidate enctype="multipart/form-data" action="add_car.php" method="post">
                <div class="row g-4">

                    <div class="col-lg-8">
                        <div class="card card-soft">
                            <div class="card-body p-4">
                                <h5 class="mb-3">รายละเอียดรถ</h5>

                                <div class="row g-3">


                                    <div class="col-md-6">
                                        <label class="form-label">ประเภทรถ </label>
                                        <select class="form-select" name="car_type" required>
                                            <option value="">— เลือก —</option>
                                            <option>Sedan</option>
                                            <option>SUV</option>
                                            <option>Hatchback</option>
                                            <option>Pickup</option>
                                            <option>EV</option>
                                        </select>
                                        <div class="invalid-feedback">เลือกประเภทรถ</div>
                                    </div>

                                    <!-- brand / model -->
                                    <div class="col-md-6">
                                        <label class="form-label">ยี่ห้อ </label>
                                        <input type="text" class="form-control" name="car_brand" placeholder="Toyota / Honda / MG" required>
                                        <div class="invalid-feedback">กรอกยี่ห้อ</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">รุ่น </label>
                                        <input type="text" class="form-control" name="car_model" placeholder="Yaris / City / ZS" required>
                                        <div class="invalid-feedback">กรอกรุ่น</div>
                                    </div>

                                    <!-- color / plate -->
                                    <div class="col-md-6">
                                        <label class="form-label">สีรถ </label>
                                        <input type="text" class="form-control" name="car_color" placeholder="เทา / ขาว / ดำ" required>
                                        <div class="invalid-feedback">กรอกสีรถ</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">ทะเบียนรถ <small class="text-muted">(license_plate)</small></label>
                                        <input type="text" class="form-control" name="license_plate" placeholder="กก 1234" required>
                                        <div class="invalid-feedback">กรอกทะเบียนรถ</div>
                                    </div>

                                    <!-- seats / fuel -->
                                    <div class="col-md-6">
                                        <label class="form-label">ที่นั่ง </label>
                                        <input type="number" min="1" class="form-control" name="seats" value="5" required>
                                        <div class="invalid-feedback">กรอกจำนวนที่นั่ง</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">ระบบเชื้อเพลิง <small class="text-muted">(fuelsystem)</small></label>
                                        <select class="form-select" name="fuelsystem" required>
                                            <option value="">— เลือก —</option>
                                            <option>Benzine</option>
                                            <option>Diesel</option>
                                            <option>Hybrid</option>
                                            <option>Electric</option>
                                            <option>LPG</option>
                                        </select>
                                        <div class="invalid-feedback">เลือกชนิดเชื้อเพลิง</div>
                                    </div>

                                    <!-- price / status -->
                                    <div class="col-md-6">
                                        <label class="form-label">ราคา/วัน (บาท) </label>
                                        <div class="input-group">
                                            <span class="input-group-text">฿</span>
                                            <input type="number" min="0" step="0.01" class="form-control" name="price_per_day" placeholder="850.00" required>
                                        </div>
                                        <div class="invalid-feedback">กรอกราคา/วัน</div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">สถานะประกาศ </label>
                                        <select class="form-select" name="car_status" required>
                                            <option value="">— เลือก —</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                        <div class="invalid-feedback">เลือกสถานะ</div>
                                    </div>

                                    <!-- province -->
                                    <div class="col-md-6">
                                        <label class="form-label">จังหวัด </label>
                                        <select name="province" id="province" class="form-select">
                                            <option value="">-- เลือกจังหวัด --</option>
                                            <option value="กรุงเทพมหานคร">กรุงเทพมหานคร</option>
                                            <option value="กระบี่">กระบี่</option>
                                            <option value="กาญจนบุรี">กาญจนบุรี</option>
                                            <option value="กาฬสินธุ์">กาฬสินธุ์</option>
                                            <option value="กำแพงเพชร">กำแพงเพชร</option>
                                            <option value="ขอนแก่น">ขอนแก่น</option>
                                            <option value="จันทบุรี">จันทบุรี</option>
                                            <option value="ฉะเชิงเทรา">ฉะเชิงเทรา</option>
                                            <option value="ชลบุรี">ชลบุรี</option>
                                            <option value="ชัยนาท">ชัยนาท</option>
                                            <option value="ชัยภูมิ">ชัยภูมิ</option>
                                            <option value="ชุมพร">ชุมพร</option>
                                            <option value="เชียงราย">เชียงราย</option>
                                            <option value="เชียงใหม่">เชียงใหม่</option>
                                            <option value="ตรัง">ตรัง</option>
                                            <option value="ตราด">ตราด</option>
                                            <option value="ตาก">ตาก</option>
                                            <option value="นครนายก">นครนายก</option>
                                            <option value="นครปฐม">นครปฐม</option>
                                            <option value="นครพนม">นครพนม</option>
                                            <option value="นครราชสีมา">นครราชสีมา</option>
                                            <option value="นครศรีธรรมราช">นครศรีธรรมราช</option>
                                            <option value="นครสวรรค์">นครสวรรค์</option>
                                            <option value="นนทบุรี">นนทบุรี</option>
                                            <option value="นราธิวาส">นราธิวาส</option>
                                            <option value="น่าน">น่าน</option>
                                            <option value="บึงกาฬ">บึงกาฬ</option>
                                            <option value="บุรีรัมย์">บุรีรัมย์</option>
                                            <option value="ปทุมธานี">ปทุมธานี</option>
                                            <option value="ประจวบคีรีขันธ์">ประจวบคีรีขันธ์</option>
                                            <option value="ปราจีนบุรี">ปราจีนบุรี</option>
                                            <option value="ปัตตานี">ปัตตานี</option>
                                            <option value="พระนครศรีอยุธยา">พระนครศรีอยุธยา</option>
                                            <option value="พังงา">พังงา</option>
                                            <option value="พัทลุง">พัทลุง</option>
                                            <option value="พิจิตร">พิจิตร</option>
                                            <option value="พิษณุโลก">พิษณุโลก</option>
                                            <option value="เพชรบุรี">เพชรบุรี</option>
                                            <option value="เพชรบูรณ์">เพชรบูรณ์</option>
                                            <option value="แพร่">แพร่</option>
                                            <option value="พะเยา">พะเยา</option>
                                            <option value="ภูเก็ต">ภูเก็ต</option>
                                            <option value="มหาสารคาม">มหาสารคาม</option>
                                            <option value="มุกดาหาร">มุกดาหาร</option>
                                            <option value="แม่ฮ่องสอน">แม่ฮ่องสอน</option>
                                            <option value="ยโสธร">ยโสธร</option>
                                            <option value="ยะลา">ยะลา</option>
                                            <option value="ร้อยเอ็ด">ร้อยเอ็ด</option>
                                            <option value="ระนอง">ระนอง</option>
                                            <option value="ระยอง">ระยอง</option>
                                            <option value="ราชบุรี">ราชบุรี</option>
                                            <option value="ลพบุรี">ลพบุรี</option>
                                            <option value="ลำปาง">ลำปาง</option>
                                            <option value="ลำพูน">ลำพูน</option>
                                            <option value="เลย">เลย</option>
                                            <option value="ศรีสะเกษ">ศรีสะเกษ</option>
                                            <option value="สกลนคร">สกลนคร</option>
                                            <option value="สงขลา">สงขลา</option>
                                            <option value="สตูล">สตูล</option>
                                            <option value="สมุทรปราการ">สมุทรปราการ</option>
                                            <option value="สมุทรสงคราม">สมุทรสงคราม</option>
                                            <option value="สมุทรสาคร">สมุทรสาคร</option>
                                            <option value="สระแก้ว">สระแก้ว</option>
                                            <option value="สระบุรี">สระบุรี</option>
                                            <option value="สิงห์บุรี">สิงห์บุรี</option>
                                            <option value="สุโขทัย">สุโขทัย</option>
                                            <option value="สุพรรณบุรี">สุพรรณบุรี</option>
                                            <option value="สุราษฎร์ธานี">สุราษฎร์ธานี</option>
                                            <option value="สุรินทร์">สุรินทร์</option>
                                            <option value="หนองคาย">หนองคาย</option>
                                            <option value="หนองบัวลำภู">หนองบัวลำภู</option>
                                            <option value="อ่างทอง">อ่างทอง</option>
                                            <option value="อำนาจเจริญ">อำนาจเจริญ</option>
                                            <option value="อุดรธานี">อุดรธานี</option>
                                            <option value="อุตรดิตถ์">อุตรดิตถ์</option>
                                            <option value="อุทัยธานี">อุทัยธานี</option>
                                            <option value="อุบลราชธานี">อุบลราชธานี</option>
                                            </select>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ขวา: อัปโหลดรูป -->
                    <div class="col-lg-4">
                        <div class="card card-soft">
                            <div class="card-body p-4">
                                <h5 class="mb-3">รูปภาพรถ </h5>
                                <img id="preview" class="img-preview mb-3 d-none" alt="preview">
                                <div class="mb-3">
                                    <input class="form-control" type="file" name="car_image[]" id="car_image" accept="image/*" multiple>
                                    <div class="form-text">รองรับ .jpg .png ขนาดแนะนำ ≥ 1200×800</div>
                                </div>

                                <div class="d-grid gap-2 mt-4">
                                    <button class="btn btn-primary btn-lg" type="submit">บันทึกรถ</button>
                                    <a href="/host/cars" class="btn btn-outline-secondary">ยกเลิก</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <section class="mt-4">
        <div class="container  mt-4">
            <h2 class="display-7 fw-bold mb-1">ข้อมูลรถของฉัน</h2>
            <hr>
        </div>
        <div class="container">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col" data-aos="fade-up">
                    <div class="card h-100">
                        <img src="assets/car1.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is a longer card with supporting text below as a natural lead-in to </p>
                            <div class="d-flex gap-2">
                                <a href="car.php" class="btn btn-outline-primary  btn-lg ">ดูรายละเอียด</a>
                                <a href="" class="btn btn-primary btn-lg">แก้ไขข้อมุล</a>
                                <a href="" class="btn btn-danger btn-lg">ลบข้อมูลรถ</a>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="col" data-aos="fade-up">
                    <div class="card h-100">
                        <img src="assets/car1.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is a longer card with supporting text below as a natural lead-in to </p>
                            <div class="d-flex gap-2">
                                <a href="car.php" class="btn btn-outline-primary  btn-lg ">ดูรายละเอียด</a>
                                <a href="" class="btn btn-primary btn-lg">แก้ไขข้อมุล</a>
                                <a href="" class="btn btn-danger btn-lg">ลบข้อมูลรถ</a>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="col" data-aos="fade-up">
                    <div class="card h-100">
                        <img src="assets/car1.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is a longer card with supporting text below as a natural lead-in to </p>
                            <div class="d-flex gap-2">
                                <a href="car.php" class="btn btn-outline-primary  btn-lg ">ดูรายละเอียด</a>
                                <a href="" class="btn btn-primary btn-lg">แก้ไขข้อมุล</a>
                                <a href="" class="btn btn-danger btn-lg">ลบข้อมูลรถ</a>
                            </div>
                        </div>
                    </div>
                </div>
                
    </section>
<br><br>
   <?php include 'footer.php'; ?>
    <script>
        // Bootstrap validation
        (() => {
            const form = document.getElementById('carForm');
            form.addEventListener('submit', e => {
                if (!form.checkValidity()) {
                    e.preventDefault();
                    e.stopPropagation();
                }
                form.classList.add('was-validated');
            });
        })();

        // Preview รูป
        const fileInput = document.getElementById('car_image');
        const preview = document.getElementById('preview');
        fileInput?.addEventListener('change', (e) => {
            const f = e.target.files?.[0];
            if (!f) return;
            preview.src = URL.createObjectURL(f);
            preview.classList.remove('d-none');
        });
    </script>
</body>

</html>