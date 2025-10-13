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
  <main class="container py-4 mt-5">
    <div class="row g-4">
      <div class="col-lg-7">
        <div id="carCarousel" class="carousel slide rounded-4 shadow" data-bs-ride="carousel">
          <div class="carousel-inner" style="height:340px;">
            <?php
              $imageList = explode(",", $data['car_image']);
              foreach ($imageList as $img):
            ?>
              <div class="carousel-item active">
                <img src="upload/<?=$img?>" class="d-block w-100 rounded-4 object-fit-cover" alt="Car 1">
              </div>
            <?php endforeach ?>
          </div>

          <!-- ปุ่มเลื่อนซ้าย/ขวา -->
          <button class="carousel-control-prev" type="button" data-bs-target="#carCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
          </button>
        </div>

        <div class="mt-4 p-3 bg-white rounded-4 border">
          <h2 id="carTitle" class="h4 mb-2"><?= $data['car_name'] ?></h2>
          <div id="carMeta" class="text-secondary">รายละเอียด</div>
          <hr />
          <p class="mb-0"><?= $data['car_detail'] ?></p>
        </div>
      </div>

      <div class="col-lg-5">
        <div class="p-3 bg-white rounded-4 border">
          <div class="d-flex justify-content-between align-items-end">
            <div>
              <div class="text-secondary">
                <h5>ราคาเริ่มต้น</h5>
              </div>
              <div id="carPrice" class="fs-3 fw-bold">฿<?= $data['price_per_day'] ?>/วัน</div>
            </div>
            <div>
              <a id="goCheckout" href="checkout.php?car_id=<?= $data['car_id'] ?>&start_date=<?=$startDate?>&end_date=<?=$endDate?>" class="btn btn-outline-primary btn-lg ">จองทันที</a>
            </div>
          </div>
          <hr />
          <?php if ($_SESSION['role'] == 1): ?>
            <div class="col-12 col-md-12 col-lg-12">
              <div class="form-group">
                <label for="start-date">วันที่ต้องการเช่า</label>
                <input type="text" id="datetime" name="datetime">
              </div>
            </div>
          <?php endif ?>
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