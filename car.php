<!DOCTYPE html> 
<html lang="th"> 
<head> 
  <meta charset="utf-8"/> 
  <meta name="viewport" content="width=device-width, initial-scale=1"/> 
  <title>รายละเอียดรถ — AutoHub</title> 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/> 
    <?php include 'header.php'; ?>
</head> 
<body> 
 
 <?php include 'menu.php'; ?>

  <br><br> 
  <main class="container py-4 mt-5"> 
    <div class="row g-4"> 
      <div class="col-lg-7"> 
        <img id="carImg" src="assets/car1.jpg" class="w-100 rounded-4 shadow object-fit-cover" style="height:340px" alt="Car"/> 
        <div class="mt-4 p-3 bg-white rounded-4 border"> 
          <h2 id="carTitle" class="h4 mb-2">ชื่อรถ</h2> 
          <div id="carMeta" class="text-secondary">รายละเอียดเมตา</div> 
          <hr/> 
          <p class="mb-0">คุณสมบัติเด่น: เกียร์อัตโนมัติ • แอร์เย็น • มีประกันพื้นฐาน • ฟรียกเลิกภายใน 48 ชม.</p> 
        </div> 
      </div> 
      <div class="col-lg-5"> 
        <div class="p-3 bg-white rounded-4 border"> 
          <div class="d-flex justify-content-between align-items-end"> 
            <div> 
              <div class="text-secondary"><h5>ราคาเริ่มต้น</h5> </div> 
              <div id="carPrice" class="fs-3 fw-bold">฿0/วัน</div> 
            </div> 
            <div> 
              <a id="goCheckout" href="checkout.php" class="btn btn-outline-primary btn-lg "  >จองทันที</a> 
            </div> 
          </div> 
          <hr/> 
          <div class="row g-2"> 
            <div class="col-6"><input type="datetime-local" class="form-control"/></div> 
            <div class="col-6"><input type="datetime-local" class="form-control"/></div> 
          </div> 
        </div> 
      </div> 
    </div> 
  </main> 

 
    <?php include 'footer.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> 
  <script src="../js/app.js"></script> 
  <script>initCar();</script> 
</body> 
</html> 
