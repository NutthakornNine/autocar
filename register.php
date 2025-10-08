<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>สมัครสมาชิก — AutoHub</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/fonts.css">
  <?php include 'header.php'; ?>

  <style>
    .input-big {
      font-size: 20px;
      padding: 14px 16px;
      border-radius: 10px;
      height: 60px;
      width: 590px;
      box-sizing: border-box;}
    select.form-select option[value="provider"] {
      color: #0d6efd;
      font-weight: 500;
}
    
  </style>
</head>
<?php include 'menu.php'; ?>

<body class="d-flex align-items-center" style="min-height:100vh ; background: linear-gradient(135deg, #1a73e8, #1f53d7ff); ">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-7 col-lg-6">
        <div class="p-4 bg-white rounded-4 border shadow-sm" style="margin-top: 65px;">
          <div class="text-center mb-3">
            <img src="assets/logo2.png" alt="logo" tyle="height:300px" />
            <h1 style="font-size:25px;"><b>สมัครสมาชิก</b> </h1>
          </div>
          <div class="row g-3">
            <div class="col-md-6"><input class="form-control input-big" style="font-size:19px;" placeholder="ชื่อ" /></div>
            <div class="col-md-6"><input class="form-control input-big" style="font-size:19px;" placeholder="นามสกุล" /></div>
            <div class="col-md-6"><input class="form-control input-big" style="font-size:19px;" placeholder="อีเมล" /></div>
            <div class="col-md-6"><input class="form-control input-big" style="font-size:19px;" placeholder="โทรศัพท์" /></div>
            <div class="col-md-6"><input class="form-control input-big" style="font-size:19px;" placeholder="รหัสผ่าน" type="password" /></div>
            <div class="col-md-6"><input class="form-control input-big" style="font-size:19px;" placeholder="ยืนยันรหัสผ่าน" type="password" /></div>
            <div class="col-md-12">
              <textarea name="address" class="form-control" id="address" cols="6" rows="6" placeholder="ที่อยู่"></textarea>
            </div>
             <div class="col-md-12">
            <select  class="form-control input-big" style="font-size:19px;" name="role"  >
              <option value="" selected disabled >เลือกประเภทบัญชีของคุณ</option>
              <option value="user">ลูกค้าผู้เช่ารถ (สำหรับผู้ที่ต้องการเช่ารถ)</option>
              <option value="provider">ผู้ให้บริการรถเช่า (สำหรับผู้ที่นำรถมาปล่อยเช่า)</option>
            </select>
          </div>

          </div>
         
          <div class="text-center small mt-3"><input class="input-big btn btn-outline-primary" style="font-size:20px; " type="submit" value="เข้าสู่ระบบ"></div>

          <div class="text-center small mt-3" style="font-size:19px;">มีบัญชีแล้ว? <a href="login.php" style="color: #1a73e8;">เข้าสู่ระบบ</a></div>
        </div>
      </div>
    </div>
  </div>
  <?php include 'footer.php'; ?>
</body>

</html>