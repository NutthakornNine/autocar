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
  <title>รายละเอียดรถ — AutoHub</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <?php include 'header.php'; ?>
  <?php $data = getCarListById() ?>
</head>

<body>

  <?php include 'menu.php'; ?>

  <br><br>
  <main class="container-xxl py-5 mt-5">
  <style>
    body{background:#f6f8fb}
    .card-soft{border:0;border-radius:1.25rem;box-shadow:0 10px 30px rgba(2,6,23,.06)}
    .h-title{font-weight:800;letter-spacing:.2px}
    .text-sub{color:#718096}
    .carousel-hero{height:420px}
    @media (min-width: 992px){ .carousel-hero{height:480px} }
    .carousel-hero img{width:100%;height:100%;object-fit:cover}
    .carousel-indicators [data-bs-target]{width:10px;height:10px;border-radius:50%}
    .badge-pill{border-radius:999px}
    .sticky-aside{position:sticky;top:90px}
    .btn-xl{padding:1rem 1.25rem;font-size:1.1rem;border-radius:999px}
    .price-lg{font-size:2.25rem;line-height:1;font-weight:800}
  </style>

  <div class="row g-4 g-xxl-5">
    <!-- รูปสไลด์ + รายละเอียด -->
    <div class="col-lg-7">
     <div id="carCarousel" class="carousel slide shadow rounded-4 overflow-hidden" data-bs-ride="carousel">
  <div class="carousel-inner">
    <?php
      $imageList = explode(",", $data['car_image']);
      foreach ($imageList as $index => $img):
        $active = $index === 0 ? 'active' : '';
    ?>
      <div class="carousel-item <?= $active ?>">
        <img src="upload/<?= trim($img) ?>" 
             class="d-block w-100"
             style="height:480px;object-fit:cover;" 
             alt="Car Image">
      </div>
    <?php endforeach ?>
  </div>

  <!-- ปุ่มเลื่อน -->
  <button class="carousel-control-prev" type="button" data-bs-target="#carCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>

      <!-- รายละเอียดรถ -->
      <div class="mt-4 card-soft bg-white p-4 p-md-5">
        <div class="d-flex align-items-center gap-2 mb-2">
          <span class="badge bg-success-subtle text-success border border-success-subtle badge-pill px-3 py-2">พร้อมให้เช่า</span>
          <span class="badge bg-primary-subtle text-primary border border-primary-subtle badge-pill px-3 py-2"><?= count($imageList) ?> รูป</span>
        </div>
        <h2 id="carTitle" class="h-title mb-2"><?= $data['car_name'] ?></h2>
        <div id="carMeta" class="text-sub">รายละเอียดรถ</div>
        <hr>
        <p class="mb-0 fs-5 lh-lg"><?= $data['car_detail'] ?></p>
        <p class="mb-0 fs-5 lh-lg"><b>จังหวัด </b><?=$data['province_name']?></p>
      </div>
    </div>

    <!-- การจอง -->
    <div class="col-lg-5">
      <div class="card-soft bg-white p-4 p-md-5 sticky-aside">
        <div class="d-flex justify-content-between align-items-end">
          <div>
            <div class="text-sub mb-1">ราคาเริ่มต้น</div>
            <div id="carPrice" class="price-lg text-primary">
              ฿<?= number_format($data['price_per_day'], 0) ?><span class="fs-6 text-dark"> / วัน</span>
            </div>
          </div>

          <?php if (!isset($_GET['state']) && $_SESSION['role'] == 1): ?>
            <a id="goCheckout"
               href="checkout.php?car_id=<?= $data['car_id'] ?>&start_date=<?= $startDate ?>&end_date=<?= $endDate ?>"
               class="btn btn-primary btn-xl shadow-sm">
              <i class="bi bi-calendar-check me-1"></i> จองทันที
            </a>
          <?php endif ?>

          <?php if (getIfReservedExists()): ?>
            <a href="#" class="btn btn-warning btn-xl shadow-sm disabled">
              <i class="bi bi-calendar-check me-1"></i> คุณกำลังจอง
            </a>
          <?php endif ?>
        </div>

        <hr class="my-4">

        <?php if ($_SESSION['role'] == 1): ?>
          <div class="col-12">
            <label for="datetime" class="form-label fw-semibold">วันที่ต้องการเช่า</label>
            <input type="text" id="datetime" name="datetime"
                   class="form-control form-control-lg"
                   placeholder="เลือกวันที่...">
            <div class="form-text">เลือกระยะเวลาเพื่อคำนวณราคาอัตโนมัติในขั้นตอนถัดไป</div>
          </div>
        <?php endif ?>
      </div>
    </div>
  </div>
</main>



  <?php include 'footer.php'; ?>
  <script>
    $('#datetime').daterangepicker({
      locale: {
        autoUpdateInput: false,
        cancelLabel: 'Clear',
        format: 'YYYY-MM-DD',
        separetor: ' - '
      },
      startDate: '<?= explode(" - ", $_GET['datetime'])[0] ?>',
      endDate: '<?= explode(" - ", $_GET['datetime'])[1] ?>'
    });
    $('#datetime').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
    });

    // 🧹 ล้างค่าเมื่อกดปุ่ม Clear
    $('#datetime').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../js/app.js"></script>
  <script>
    initCar();
  </script>
</body>

</html>