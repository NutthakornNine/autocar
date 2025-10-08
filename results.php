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
                                    <option value="" disabled selected>กรุณาเลือก</option>
                                    <option value="CAR001">ปัตตานี</option>
                                    <option value="CAR002">กรุงเทพ</option>
                                    <option value="CAR003">ชลบุรี</option>
                                    <option value="VAN001">VAN001 - รถตู้ Toyota</option>
                                    <option value="BIKE001">BIKE001 - มอเตอร์ไซค์</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label for="start-date">เริ่มเช่า</label>
                                <input type="datetime-local" id="start-date">
                            </div>
                        </div>
                        <div class="col-12 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label for="end-date">สิ้นสุด</label>
                                <input type="datetime-local" id="end-date">
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
                 
                        <div class="col-md-5 h-100">
                            <img src="assets/car1.jpg" class="img-cover" alt="">
                        </div>

                        <div class="col-md-7 h-100">
                            <div class="card-body d-flex flex-column h-100">
                                <h3 class="card-title"><b>Toyota</b></h3>
                                <p class="card-text">
                                    This is a wider card with supporting text below as a natural lead-in to additional content.
                                </p>
                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>

                                <hr style="border: 2px solid #000;">

            
                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                    <h3 class="mb-0">
                                        <span class="fw-bold">฿850</span><span class="text-muted">/วัน</span>
                                    </h3>
                                    <a href="car.php" class="btn btn-primary btn-lg">ดูรายละเอียด</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

<?php include 'footer.php' ?>
</body>

</html>