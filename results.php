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
    <title>ผลการค้นหา — AutoHub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/searchbar.css">
    <?php include 'header.php'; ?>

    <style>
        .img-cover {
            display: block;
            width: 100%;
            height: 265px;
            object-fit: cover;
            border-top-left-radius: .5rem;
            border-bottom-left-radius: .5rem;
        }


        @media (max-width: 767.98px) {
            .img-cover {
                height: 350px;
                border-bottom-left-radius: 0;
                border-top-right-radius: .5rem;
            }
        }

        .card-tall {
            min-height: 400px;
        }

        @media (max-width: 991.98px) {
            .card-tall {
                min-height: 300px;
            }
        }
    </style>
</head>

<body>


    <?php include 'menu.php'; ?> <br><br>

    <section style="background:#f4f8ff;border-bottom:1px solid #e3eefb;padding:50px 0;">
        <form id="form-result">
            <div style="max-width:1400px;margin:0 auto;padding:0 16px;">
                <div class="card shadow rounded-4 p-4">
                    <div class="row">
                        <div class="col-12 col-md-4 col-lg-4">
                            <div class="form-group">
                                <label for="booking-ref">เลือกจังหวัดที่ต้องการจอง</label>
                                <select id="booking-ref" name="province" class="form-control form-select shadow-4" data-placeholder="กรุณาเลือก" required>
                                    <?php if (isset($_GET['province'])): ?>
                                        <option value="<?= $_GET['province'] ?? '' ?>" selected><?= $_GET['province_name'] ?? '' ?></option>
                                    <?php else: ?>
                                        <option value="" disabled selected>กรุณาเลือก</option>
                                    <?php endif ?>
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
                <input type="hidden" name="province_name" value="<?= $_GET['province_name'] ?>">
        </form>
    </section>

    <div class="container py-4 mt-5">
        <div class="row g-4 align-items-start">
            <aside class="col-12 col-lg-4">
                <form action="" method="get">
                    <div class="p-3 bg-white rounded-4 border shadow h-100">
                        <div class="p-3 border rounded-4 bg-white">
                            <div class="h5 mb-3">ช่วงราคา (ต่อวัน)</div>

                            <!-- สไลเดอร์สองหัว -->
                            <div id="priceSlider" class="mb-3"></div>

                            <!-- ช่วงราคาขั้นต่ำ-สูงสุด -->
                            <div class="row g-3 align-items-center">
                                <div class="col-12 col-md-5">
                                    <label class="text-secondary small mb-1 d-block">ราคาต่ำสุด</label>
                                    <div class="input-group">
                                        <span class="input-group-text">฿</span>
                                        <input id="minprice" name="minprice" type="text" class="form-control" inputmode="numeric" value="1">
                                    </div>
                                </div>

                                <div class="col-12 col-md-2 text-center text-secondary">ถึง</div>

                                <div class="col-12 col-md-5">
                                    <label class="text-secondary small mb-1 d-block">ราคาสูงสุด</label>
                                    <div class="input-group">
                                        <span class="input-group-text">฿</span>
                                        <input id="maxprice" type="text" name="maxprice" class="form-control" inputmode="numeric" placeholder="6000+">
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <div class="mb-3">
                            <label class="form-label"> <h5>ประเภทรถ</h5></label>
                            <select class="form-select" id="filterType" name="car_type">
                                <option value="">ทั้งหมด</option>
                                <option value="Sedan">Sedan</option>
                                <option value="SUV">SUV</option>
                                <option value="Hatchback">Hatchback</option>
                                <option value="EV">EV</option>
                            </select>
                        </div>
                        <div class="container py-4">
                            <h5 class="mb-3">ยี่ห้อรถ</h5>
                            <div class="row g-3">
                                <div class="row row-cols-2 row-cols-md-3 g-2">
                                    <div class="col">
                                        <input class="btn-check" id="brand-honda" name="car_brand[]" type="checkbox" value="Honda" autocomplete="off">
                                        <label class="btn btn-outline-secondary color-pill w-100" for="brand-honda">
                                            <span class="swatch" style="background:#000"></span> Honda
                                        </label>
                                    </div>
                                    <div class="col">
                                        <input class="btn-check" id="brand-toyota" name="car_brand[]" type="checkbox" value="Toyota" autocomplete="off">
                                        <label class="btn btn-outline-secondary color-pill w-100" for="brand-toyota">
                                            <span class="swatch" style="background:#000"></span> Toyota
                                        </label>
                                    </div>
                                    <div class="col">
                                        <input class="btn-check" id="brand-ford" name="car_brand[]" type="checkbox" value="Ford" autocomplete="off">
                                        <label class="btn btn-outline-secondary color-pill w-100" for="brand-ford">
                                            <span class="swatch" style="background:#000"></span> Ford
                                        </label>
                                    </div>
                                    <div class="col">
                                        <input class="btn-check" id="brand-bmw" name="car_brand[]" type="checkbox" value="BMW" autocomplete="off">
                                        <label class="btn btn-outline-secondary color-pill w-100" for="brand-bmw">
                                            <span class="swatch" style="background:#000"></span> BMW
                                        </label>
                                    </div>
                                </div>

                            </div>
                            <hr>
                            <div class="mb-3">
                                <div class="d-flex gap-2 flex-wrap">
                                    <label class="filter-chip"><h5>ที่นั่งมาก</h5></label>
                                    <select class="form-select" id="seats" name="seats">
                                        <option value="">ทั้งหมด</option>
                                        <option value="2">2</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                    </select>
                                </div>
                                <hr>
                                 <h5 class="mb-3">เชื้อเพลิง</h5>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="fuelsystem[]" value="Benzine">
                                    <label class="form-check-label" for="inlineCheck1">Benzine</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="fuelsystem[]" value="Diesel">
                                    <label class="form-check-label" for="inlineCheck2">Diesel</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="fuelsystem[]" value="Hybrid">
                                    <label class="form-check-label" for="inlineCheck3">Hybrid</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="fuelsystem[]" value="EV">
                                    <label class="form-check-label" for="ELectric">Electric</label>
                                </div>
                                <hr>
                                <label class="filter-chip"><h5>สีรถ</h5> </label>
                                <div class="row row-cols-2 row-cols-md-3 g-2">
                                    <div class="col">
                                        <input class="btn-check" id="c-black" name="car_color[]" type="checkbox" value="ดำ" autocomplete="off">
                                        <label class="btn btn-outline-secondary color-pill w-100" for="c-black">
                                            <span class="swatch" style="background:#000"></span> สีดำ
                                        </label>
                                    </div>
                                    <div class="col">
                                        <input class="btn-check" id="c-white" name="car_color[]" type="checkbox" value="ขาว" autocomplete="off">
                                        <label class="btn btn-outline-secondary color-pill w-100" for="c-white">
                                            <span class="swatch" style="background:#fff;"></span> สีขาว
                                        </label>
                                    </div>

                                    <div class="col">
                                        <input class="btn-check" id="c-gray" name="car_color[]" type="checkbox" value="เทา" autocomplete="off">
                                        <label class="btn btn-outline-secondary color-pill w-100" for="c-gray">
                                            <span class="swatch" style="background:#9e9e9e"></span> สีเทา
                                        </label>
                                    </div>

                                    <div class="col">
                                        <input class="btn-check" id="c-blue" name="car_color[]" type="checkbox" value="ฟ้า" autocomplete="off">
                                        <label class="btn btn-outline-secondary color-pill w-100" for="c-blue">
                                            <span class="swatch" style="background:#2f80ed"></span> สีฟ้า
                                        </label>
                                    </div>

                                    <div class="col">
                                        <input class="btn-check" id="c-red" name="car_color[]" type="checkbox" value="แดง" autocomplete="off">
                                        <label class="btn btn-outline-secondary color-pill w-100" for="c-red">
                                            <span class="swatch" style="background:#e11d48"></span> สีแดง
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-primary w-100 <?= isset($_GET['province_name']) ? '' : 'disabled'; ?>" value="ค้นหา">
                            <input type="hidden" name="state" value="1">
                            <input type="hidden" name="province" value="<?= $_GET['province'] ?? '' ?>">
                            <input type="hidden" name="province_name" value="<?= $_GET['province_name'] ?? '' ?>">
                            <input type="hidden" name="datetime" value="<?= $_GET['datetime'] ?? '' ?>">
                </form>
        </div>
    </div>
    </aside>


    <section class="col-12 col-lg-8">
        <div class="row g-4">
            <?php foreach (getCarListNoOwner() as $car) : ?>
                <div class="col-md-12">
                    <div class="card shadow h-100 overflow-hidden">
                        <div class="row g-0 align-items-stretch">
                            <div class="col-md-5">
                                <img src="upload/<?= explode(",", $car['car_image'])[0] ?>"
                                    class="img-fluid w-100 h-100 object-fit-cover"
                                    style="object-fit: cover;"
                                    alt="">
                            </div>

                            <div class="col-md-7">
                                <div class="card-body d-flex flex-column h-100">
                                    <h3 class="card-title"><b><?= $car['car_name'] ?></b></h3>
                                    <p class="card-text"><b> รายละเอียด </b><?= $car['car_detail'] ?></p>
                                    <p class="card-text"> <b> จังหวัด </b><?= $car['province_name'] ?></p>
                                    <p class="card-text"><small class="text-muted">Last updated <?= $car['add_date'] ?> mins ago</small></p>
                                    


                                    <hr class="my-3" style="border: 1.5px solid #000;">

                                    <div class="d-flex justify-content-between align-items-center mt-auto">
                                        <h3 class="mb-0">
                                            <span class="fw-bold">฿<?= $car['price_per_day'] ?></span><span class="text-muted">/วัน</span>
                                        </h3>
                                        <a href="car.php?datetime=<?= $_GET['datetime'] ?>&car_id=<?= $car['car_id'] ?>" class="btn btn-primary btn-lg">
                                            ดูรายละเอียด
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </section>
    </div>
    </div>
    <?php include 'chatbot.php' ?>
    <?php include 'footer.php' ?>
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
        $("#form-result").on("submit", function(e) {
            e.preventDefault();
            const province = $("#booking-ref").val();
            const datetime = $("#datetime").val();
            var selectedText = $('#booking-ref option:selected').text();
            window.location.href = `results.php?datetime=${datetime}&province=${province}&province_name=${selectedText}`;
        });
    </script>
</body>

</html>