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
                                <select id="booking-ref">
                                    <?php if (isset($_GET['province'])): ?>
                                        <option value="<?=$_GET['province'] ?? ''?>" selected><?=$_GET['province'] ?? ''?></option>
                                    <?php else: ?>
                                        <option value="" disabled selected>กรุณาเลือก</option>
                                    <?php endif ?>
                                    <?php foreach (getProvince() as $p): ?>
                                        <option value="<?=$p['id']?>"><?=$p['name_th']?></option>
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

   <div class="container py-4 mt-5">
        <div class="row g-4 align-items-start">
            <aside class="col-12 col-lg-4">
                <div class="p-3 bg-white rounded-4 border shadow h-100">
                    <h5 class="mb-3">ตัวช่วยค้นหา</h5>
                    <div class="mb-3">
                        <label class="form-label">ประเภทรถ</label>
                        <select class="form-select" id="filterType">
                            <option value="">ทั้งหมด</option>
                            <option value="Sedan">Sedan</option>
                            <option value="SUV">SUV</option>
                            <option value="Hatchback">Hatchback</option>
                            <option value="EV">EV</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex gap-2 flex-wrap">
                            <span class="filter-chip">ราคาต่ำ→สูง</span>
                            <span class="filter-chip">ที่นั่งมาก</span>
                            <span class="filter-chip">พลังงานไฟฟ้า</span>
                        </div>
                    </div>
                </div>
            </aside>


            <section class="col-12 col-lg-8">
                <div class="card shadow h-100">
                    <div class="row g-0 align-items-stretch">
                        <?php foreach (getCarListNoOwner() as $car) : ?>
                            <div class="col-md-5 h-100">
                                <img src="upload/<?= explode(",", $car['car_image'])[0] ?>" class="img-cover" alt="">
                            </div>
    
                            <div class="col-md-7 h-100">
                                <div class="card-body d-flex flex-column h-100">
                                    <h3 class="card-title"><b><?=$car['car_name']?></b></h3>
                                    <p class="card-text">
                                       <?=$car['car_detail']?>
                                    </p>
                                    <p class="card-text"><small class="text-muted">Last updated <?=$car['add_date']?> mins ago</small></p>
    
                                    <hr style="border: 2px solid #000;">
    
                
                                    <div class="d-flex justify-content-between align-items-center mt-auto">
                                        <h3 class="mb-0">
                                            <span class="fw-bold">฿<?=$car['price_per_day']?></span><span class="text-muted">/วัน</span>
                                        </h3>
                                        <a href="car.php?datetime=<?=$_GET['datetime']?>&car_id=<?=$car['car_id']?>" class="btn btn-primary btn-lg">ดูรายละเอียด</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
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
            startDate: '<?=explode(" - ", $_GET['datetime'])[0]?>',
            endDate: '<?=explode(" - ", $_GET['datetime'])[1]?>'
        });
</script>
</body>

</html>