<?php 
  session_start();
  if (empty($_SESSION['userid'])) {
    header("location: login.php");
    exit;
  }
?>
<!DOCTYPE html> 
<html lang="th"> 
<head> 
  <meta charset="utf-8"/> 
  <meta name="viewport" content="width=device-width, initial-scale=1"/> 
  <title>สรุปและชำระเงิน — AutoHub</title> 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/> 
  <?php include 'header.php'; ?>
  <?php $data = getCarListById(); ?>
</head> 
<body> 

 <?php include 'menu.php'; ?> <br><br>
  <main class="container py-4 mt-5"> 
    <div class="row g-4"> 
      <section class="col-lg-7"> 
        <div class="p-3 bg-white rounded-4 border mb-3"> 
          <h5 class="mb-3">ข้อมูลผู้เช่า</h5> 
          <div class="row g-3"> 
            <div class="col-md-6"><input class="form-control" placeholder="ชื่อ" value="<?=$_SESSION['users']['fullname']?>"/></div> 
            <div class="col-md-6"><input class="form-control" placeholder="นามสกุล" value="<?=$_SESSION['users']['lastname']?>"/></div> 
            <div class="col-md-6"><input class="form-control" placeholder="อีเมล" value="<?=$_SESSION['users']['email']?>"/></div> 
            <div class="col-md-6"><input class="form-control" placeholder="โทรศัพท์" value="<?=$_SESSION['users']['phone']?>"/></div> 
            <div class="col-12"><input class="form-control" placeholder="ที่อยู่สำหรับติดต่อ" value="<?=$_SESSION['users']['address']?>"/></div> 
          </div> 
        </div> 
        <div class="p-3 bg-white rounded-4 border"> 
          <h5 class="mb-3">วิธีชำระเงิน</h5> 
          <div class="form-check mb-2"> 
            <input class="form-check-input" type="radio" name="pay" id="pay1" checked/> 
            <label for="pay1" class="form-check-label">บัตรเครดิต/เดบิต</label> 
          </div> 
          <div class="form-check mb-3"> 
            <input class="form-check-input" type="radio" name="pay" id="pay2"/> 
            <label for="pay2" class="form-check-label">โอนผ่านธนาคาร</label> 
          </div> 
          <div class="row g-3"> 
            <div class="col-md-8"><input class="form-control" placeholder="หมายเลขบัตร"/></div> 
            <div class="col-md-2"><input class="form-control" placeholder="MM/YY"/></div> 
            <div class="col-md-2"><input class="form-control" placeholder="CVV"/></div> 
          </div> 
          <button id="fakePay" class="btn btn-brand mt-3">ชำระเงิน</button> 
        </div> 
      </section> 
      <aside class="col-lg-5"> 
        <div class="p-3 bg-white rounded-4 border"> 
          <div class="d-flex"> 
            <img id="sumImg" src="assets/car1.jpg" class="rounded me-3" style="width:120px;height:80px;object-fit:cover" alt="sum"/> 
            <div> 
              <div id="sumTitle" class="fw-bold">รถที่เลือก</div> 
              <div id="sumMeta" class="small text-secondary">เมตา</div> 
            </div> 
          </div> 
          <hr/> 
          <div class="d-flex justify-content-between"> 
            <div>ราคา/วัน</div> 
            <div id="sumPrice" class="fw-bold">฿0</div> 
          </div> 
          <div class="small text-secondary mt-2">ราคารวมจะคำนวณตอนชำระ (เดโม)</div> 
        </div> 
      </aside> 
    </div> 
  </main> 
 
  <?php include 'footer.php'; ?>

</body> 
</html> 
