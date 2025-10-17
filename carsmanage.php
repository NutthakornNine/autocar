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



    <section style="background:#f4f8ff;border-bottom:1px solid #e3eefb;padding:60px 0;">
  <div class="container">
    <div class="text-center mb-3">
      <h2 class="fw-bold display-6 text-primary mb-1">เพิ่มรถของคุณ</h2>
      <p class="text-secondary mb-0 fs-5">กรอกข้อมูลให้ครบถ้วนเพื่อปล่อยเช่าบนแพลตฟอร์มของเรา</p>
    </div>

    <form id="carForm" class="needs-validation" enctype="multipart/form-data" method="post" novalidate>
      <div class="row g-4">
        
        <!-- Left -->
        <div class="col-lg-8">
          <div class="card border-0 shadow-lg rounded-4">
            <div class="card-body p-4">
              <h5 class="fw-bold mb-4 border-start border-4 border-primary ps-3">รายละเอียดรถ</h5>
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label fw-semibold">ประเภทรถ</label>
                  <select class="form-select" name="car_type" id="car_type" required>
                    <option value="">— เลือก —</option>
                    <option>Sedan</option>
                    <option>SUV</option>
                    <option>Hatchback</option>
                    <option>Pickup</option>
                    <option>EV</option>
                  </select>
                  <div class="invalid-feedback">เลือกประเภทรถ</div>
                </div>

                <div class="col-md-6">
                  <label class="form-label fw-semibold">ยี่ห้อ</label>
                  <input type="text" class="form-control" name="car_brand" id="car_brand" required placeholder="Toyota / Honda / MG">
                </div>

                <div class="col-md-6">
                  <label class="form-label fw-semibold">รุ่น</label>
                  <input type="text" class="form-control" name="car_model" id="car_model" required placeholder="Yaris / City / ZS">
                </div>

                <div class="col-md-6">
                  <label class="form-label fw-semibold">สีรถ</label>
                  <input type="text" class="form-control" name="car_color" id="car_color" required placeholder="เทา / ขาว / ดำ">
                </div>

                <div class="col-md-6">
                  <label class="form-label fw-semibold">ทะเบียนรถ</label>
                  <input type="text" class="form-control" name="license_plate" id="license_plate" required placeholder="กก 1234">
                </div>

                <div class="col-md-6">
                  <label class="form-label fw-semibold">จำนวนที่นั่ง</label>
                  <input type="number" min="1" class="form-control" name="seats" id="seats" required value="5">
                </div>

                <div class="col-md-6">
                  <label class="form-label fw-semibold">ระบบเชื้อเพลิง</label>
                  <select class="form-select" name="fuelsystem" id="fuelsystem" required>
                    <option value="">— เลือก —</option>
                    <option>Benzine</option>
                    <option>Diesel</option>
                    <option>Hybrid</option>
                    <option>Electric</option>
                  </select>
                </div>

                <div class="col-md-6">
                  <label class="form-label fw-semibold">ราคา/วัน (บาท)</label>
                  <div class="input-group">
                    <span class="input-group-text bg-primary text-white">฿</span>
                    <input type="number" min="0" step="0.01" class="form-control" name="price_per_day" id="price_per_day" required>
                  </div>
                </div>

                <div class="col-md-6">
                  <label class="form-label fw-semibold">สถานะ</label>
                  <select class="form-select" name="car_status" id="car_status" required>
                    <option value="">— เลือก —</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                  </select>
                </div>

                <div class="col-md-6">
                  <label class="form-label fw-semibold">จังหวัด</label>
                  <select name="province" id="province" class="form-select" required>
                    <option value="">-- เลือกจังหวัด --</option>
                    <?php foreach (getProvince() as $p): ?>
                      <option value="<?= $p['id'] ?>"><?= $p['name_th'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Right -->
        <div class="col-lg-4">
          <div class="card border-0 shadow-lg rounded-4">
            <div class="card-body p-4">
              <h5 class="fw-bold mb-4 border-start border-4 border-primary ps-3">รูปภาพรถ</h5>

              <div class="text-center mb-3">
                <img id="preview" class="img-fluid rounded-3 shadow-sm d-none" alt="preview" style="max-height:200px;">
              </div>

              <div class="mb-3">
                <input class="form-control" type="file" name="car_image[]" id="car_image" required accept="image/*" multiple>
                <div class="form-text text-muted small">รองรับ .jpg .png (ขนาดแนะนำ ≥ 1200×800)</div>
              </div>

              <div class="d-grid gap-2 mt-4">
                <button class="btn btn-primary btn-lg shadow-sm" type="submit">
                  <i class="bi bi-save me-1"></i> บันทึกรถ
                </button>
                <button type="reset" class="btn btn-outline-secondary btn-lg">
                  <i class="bi bi-x-circle me-1"></i> ยกเลิก
                </button>
              </div>
            </div>
          </div>
        </div>

      </div>
    </form>
  </div>
</section>


    <section class="mt-4" id="car_list">
        <div class="container  mt-4">
            <h2 class="display-7 fw-bold mb-1">ข้อมูลรถของฉัน</h2>
            <hr>
        </div>
        <div class="container">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php foreach (getCarList() as $car) : ?>
                    <div class="col" data-aos="fade-up">
                        <div class="card h-100">
                            <img src="upload/<?= explode(",", $car['car_image'])[0] ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><b><?= $car['car_name'] ?></b></h5>
                                <p class="card-title"><b>จังหวัด</b> <?= $car['province_name'] ?></p>
                                <p class="card-text"> <b>รายละเอียดรถ</b> <?= $car['car_detail'] ?> </p>
                                <div class="d-flex gap-2">
                                    <a href="car.php?car_id=<?= $car['car_id'] ?>" class="btn btn-outline-primary  btn-lg ">ดูรายละเอียด</a>
                                    <a
                                        href="javascript:void(0);"
                                        data-car_id="<?= $car['car_id'] ?>"
                                        data-car_type="<?= $car['car_type'] ?>"
                                        data-car_brand="<?= $car['car_brand'] ?>"
                                        data-car_model="<?= $car['car_model'] ?>"
                                        data-car_color="<?= $car['car_color'] ?>"
                                        data-license_plate="<?= $car['license_plate'] ?>"
                                        data-seats="<?= $car['seats'] ?>"
                                        data-fuelsystem="<?= $car['fuelsystem'] ?>"
                                        data-price_per_day="<?= $car['price_per_day'] ?>"
                                        data-car_status="<?= $car['car_status'] ?>"
                                        data-province_id="<?= $car['province_id'] ?>"
                                        data-province_name="<?= $car['province_name'] ?>"
                                        data-car_status_name="<?= $car['car_status_name'] ?>"
                                        class="btn btn-primary btn-lg btn-edit">
                                        แก้ไขข้อมุล
                                    </a>
                                    <a
                                        href="javascript:void(0);"
                                        data-car_id="<?= $car['car_id'] ?>"
                                        class="btn btn-danger btn-lg btn-delete">
                                        ลบข้อมูลรถ
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
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

        $(document).ready(function() {

            function reloadAndScrollTo(targetId, delay = 2000) {
                setTimeout(function() {
                    window.location.href = window.location.pathname + "#" + targetId;
                    window.location.reload();
                }, delay);
            }

            $("#carForm").on("submit", function(e) {
                e.preventDefault();
                const formData = $(this);
                const saveForm = new FormData(formData[0]);
                $.ajax({
                    type: "POST",
                    url: "./api/save-car.api.php",
                    data: saveForm,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response == 'success') {
                            Swal.fire({
                                title: 'บันทึกข้อมูลรถสำเร็จ',
                                text: 'Vehicle data saved successfully',
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $("#carForm").trigger("reset");
                                    reloadAndScrollTo("car_list", 1000)
                                }
                            })
                        } else {
                            Swal.fire(
                                'Error',
                                '',
                                'error'
                            )
                        }
                    }
                });
            });
            $(document).on("click", ".btn-edit", function(e) {
                e.preventDefault();
                const formData = $(this).data();
                const strHtml = `
                    <form id="carEdit" class="needs-validation" enctype="multipart/form-data" method="post">
                        <div class="row g-4">

                            <div class="col-lg-8">
                                <div class="card card-soft">
                                    <div class="card-body p-4">
                                        <h5 class="mb-3">รายละเอียดรถ</h5>
                                        <div class="row g-3">


                                            <div class="col-md-6">
                                                <label class="form-label">ประเภทรถ </label>
                                                <select class="form-select" name="car_type" id="car_type">
                                                    <option value="${formData.car_type}">${formData.car_type}</option>
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
                                                <input type="text" class="form-control" name="car_brand" id="car_brand" required placeholder="Toyota / Honda / MG" value="${formData.car_brand}">
                                                <div class="invalid-feedback">กรอกยี่ห้อ</div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">รุ่น </label>
                                                <input type="text" class="form-control" name="car_model" id="car_model" required placeholder="Yaris / City / ZS"  value="${formData.car_model}">
                                                <div class="invalid-feedback">กรอกรุ่น</div>
                                            </div>

                                            <!-- color / plate -->
                                            <div class="col-md-6">
                                                <label class="form-label">สีรถ </label>
                                                <input type="text" class="form-control" name="car_color" id="car_color" required placeholder="เทา / ขาว / ดำ" value="${formData.car_color}" >
                                                <div class="invalid-feedback">กรอกสีรถ</div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">ทะเบียนรถ <small class="text-muted"></small></label>
                                                <input type="text" class="form-control" name="license_plate" id="license_plate" required placeholder="กก 1234" value="${formData.license_plate}">
                                                <div class="invalid-feedback">กรอกทะเบียนรถ</div>
                                            </div>

                                            <!-- seats / fuel -->
                                            <div class="col-md-6">
                                                <label class="form-label">ที่นั่ง </label>
                                                <input type="number" min="1" class="form-control"  name="seats"  id="seats" required value="5" value="${formData.seats}" >
                                                <div class="invalid-feedback">กรอกจำนวนที่นั่ง</div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">ระบบเชื้อเพลิง <small class="text-muted">(fuelsystem)</small></label>
                                                <select class="form-select" name="fuelsystem"  id="fuelsystem" required>
                                                    <option value="${formData.fuelsystem}">${formData.fuelsystem}</option>
                                                    <option>Benzine</option>
                                                    <option>Diesel</option>
                                                    <option>Hybrid</option>
                                                    <option>Electric</option>
                                                </select>
                                                <div class="invalid-feedback">เลือกชนิดเชื้อเพลิง</div>
                                            </div>

                                            <!-- price / status -->
                                            <div class="col-md-6">
                                                <label class="form-label">ราคา/วัน (บาท) </label>
                                                <div class="input-group">
                                                    <span class="input-group-text">฿</span>
                                                    <input type="number" min="0" step="0.01" class="form-control" name="price_per_day" id="price_per_day" value="${formData.price_per_day}" required>
                                                </div>
                                                <div class="invalid-feedback">กรอกราคา/วัน</div>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">สถานะประกาศ </label>
                                                <select class="form-select" name="car_status" id="car_status" required>
                                                    <option value="${formData.car_status}">${formData.car_status_name}</option>
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                                <div class="invalid-feedback">เลือกสถานะ</div>
                                            </div>

                                            <!-- province -->
                                            <div class="col-md-6">
                                                <label class="form-label">จังหวัด </label>
                                                <select name="province" id="province" class="form-select" required>
                                                    <option value="${formData.province_id}">${formData.province_name}</option>
                                                <?php foreach (getProvince() as $p): ?>
                                                <option value="<?= $p['id'] ?>"><?= $p['name_th'] ?></option>
                                            <?php endforeach ?>
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
                                            <input class="form-control" type="file" name="car_image[]" id="car_image" required accept="image/*" multiple>
                                            <div class="form-text">รองรับ .jpg .png ขนาดแนะนำ ≥ 1200×800</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="car_id" value="${formData.car_id}" />
                    </form>
                `;
                Swal.fire({
                    title: 'แก้ไขข้อมูลรถ',
                    html: strHtml,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'แก้ไข',
                    width: '90%',
                }).then((result) => {
                    if (result.isConfirmed) {
                        const current_edit = $("#carEdit")[0];
                        const formEdit = new FormData(current_edit);
                        $.ajax({
                            type: "POST",
                            url: "./api/edit-car.api.php",
                            data: formEdit,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                if (response == 'success') {
                                    Swal.fire({
                                        title: 'แก้ไขข้อมูลสำเร็จ',
                                        text: 'Edit Data is Success',
                                        icon: 'success',
                                        showCancelButton: false,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'OK'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    })
                                } else {
                                    Swal.fire(
                                        'Error',
                                        '',
                                        'error'
                                    )
                                }
                            }
                        });
                    }
                })
            });
            $(document).on("click", ".btn-delete", function(e) {
                e.preventDefault();
                const formData = $(this).data();
                Swal.fire({
                    title: 'ลบ ข้อมูลรถ',
                    text: '',
                    icon: 'error',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ลบ',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: "./api/delete-car.api.php",
                            data: formData,
                            success: function(response) {
                                if (response == 'success') {
                                    Swal.fire({
                                        title: 'ลบข้อมูลรถสำเร็จ',
                                        text: 'Delete Data is Success',
                                        icon: 'success',
                                        showCancelButton: false,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'OK'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    })
                                } else {
                                    Swal.fire(
                                        'Error',
                                        '',
                                        'error'
                                    )
                                }
                            }
                        });
                    }
                })
            });

        });
    </script>
</body>

</html>