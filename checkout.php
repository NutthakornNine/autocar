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
    <form method="post" id="reserved" enctype="multipart/form-data">
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
          <div class="form-check mb-3"> 
            <input class="form-check-input pay_type" type="radio" name="pay_type" value="transfer" checked/> 
            <label for="pay2" class="form-check-label">โอนผ่านธนาคาร</label> 
          </div> 
          <div class="form-check mb-3"> 
            <input class="form-check-input pay_type" type="radio" name="pay_type" value="qrcode"/> 
            <label for="pay2" class="form-check-label">สแกนจ่าย</label> 
          </div> 
          <div class="row g-3"> 
            <div class="col-md-8">
                <input class="form-control" id="book_number" placeholder="หมายเลขบัญชี" name="book_number" readonly="readonly" value="153-8-51851-0"/>
            </div>
          </div> 
          <div class="row g-3" > 
            <div class="col-md-8">
              <img src="assets/qrcode.jpeg" alt="" width="400"  id="qrcode" hidden>
            </div>
          </div> 
          <div class="row g-3" > 
            <div class="col-md-8">
              <label for="">รูปสลีปโอนเงิน</label>
              <input type="file" name="slip" id="slip" class="form-control" required>
            </div>
          </div> 
          <button id="fakePay" class="btn btn-primary mt-3" name="fakePay" >ชำระเงิน</button> 
        </div> 
        <input type="hidden" name="car_id" value="<?=$_GET['car_id']?>">
        <input type="hidden" name="user_id" value="<?=$_SESSION['userid']?>">
        <input type="hidden" name="start_date" value="<?=$_GET['start_date']?>">
        <input type="hidden" name="end_date" value="<?=$_GET['end_date']?>">
        <input type="hidden" name="pay" value="1">
        <input type="hidden" name="status" value="1">
        </form> 
      </section> 
      <aside class="col-lg-5"> 
        <div class="p-3 bg-white rounded-4 border"> 
          <div class="d-flex"> 
            <img id="sumImg" src="assets/car1.jpg" class="rounded me-3" style="width:120px;height:80px;object-fit:cover" alt="sum"/> 
            <div> 
              <div id="sumTitle" class="fw-bold"><?=$data['car_name']?></div> 
              <div id="sumMeta" class="small text-secondary"><?=$data['car_detail']?></div> 
            </div> 
          </div> 
          <hr/> 
          <div class="d-flex justify-content-between"> 
            <div>ราคา/วัน</div> 
            <div id="sumPrice" class="fw-bold">฿<?=$data['price_per_day']?></div> 
          </div> 
          <div class="small text-secondary mt-2">ราคารวมจะคำนวณตอนชำระ (เดโม)</div> 
        </div> 
      </aside> 
    </div> 
  </main> 
 
  <?php include 'footer.php'; ?>

  <script>
    $(document).ready(function () {
      
      $(document).on("change", ".pay_type", function (e) {
        e.preventDefault();
        const state = $(this).val();
        if (state == 'transfer') {
          $("#book_number").attr("hidden", false);
          $("#qrcode").attr("hidden", true);
        } else {
          $("#qrcode").attr("hidden", false);
          $("#book_number").attr("hidden", true);
        }
      });
      $("#reserved").on("submit", function (e) {
        e.preventDefault();
        const formData = $(this)[0];
        const params = new FormData(formData);
        $.ajax({
          type: "POST",
          url: "api/reserved.api.php",
          data: params,
          processData: false,
          contentType: false,
          success: function (response) {
            if (response == 'success') {
              Swal.fire(
                'Success',
                'Success',
                'success'
              )
              setTimeout(() => {
                window.location.href = "bookings.php";
              }, 1000);
            } else {
              Swal.fire(
                'Error',
                'Error',
                'error'
              )
            }
          }
        });
      });

    });
  </script>

</body> 
</html> 
