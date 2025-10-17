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

<body class="min-vh-100 d-flex align-items-center" style="background: linear-gradient(135deg,#1a73e8,#1f53d7ff);">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-7 col-lg-6">
        <!-- ตัด min-width ออก ให้การ์ดยืดหยุ่นตามคอลัมน์ -->
        <div class="p-4 bg-white rounded-4 border shadow-sm mt-5">
          <div class="text-center mb-3">
            <img src="assets/logo2.png" alt="logo" class="img-fluid" style="height:140px;object-fit:contain;" />
            <h1 class="h4 mb-0"><b>สมัครสมาชิก</b></h1>
          </div>

          <form action="" method="post" id="register" novalidate>
            <div class="row g-3">
              <div class="col-md-6">
                <input class="form-control form-control-lg" name="fullname" id="fullname" required placeholder="ชื่อ" />
              </div>
              <div class="col-md-6">
                <input class="form-control form-control-lg" name="lastname" id="lastname" required placeholder="นามสกุล" />
              </div>
              <div class="col-md-6">
                <input class="form-control form-control-lg" type="email" name="email" id="email" required placeholder="อีเมล" />
              </div>
              <div class="col-md-6">
                <input class="form-control form-control-lg" name="phone" id="phone" required placeholder="โทรศัพท์" />
              </div>
              <div class="col-md-6">
                <input class="form-control form-control-lg" name="password1" id="password1" required placeholder="รหัสผ่าน" type="password" minlength="8" />
              </div>
              <div class="col-md-6">
                <input class="form-control form-control-lg" name="password2" id="password2" required placeholder="ยืนยันรหัสผ่าน" type="password" minlength="8" />
              </div>
              <div class="col-12">
                <textarea name="address" class="form-control form-control-lg" id="address" required placeholder="ที่อยู่" rows="5"></textarea>
              </div>
              <div class="col-12">
                <!-- เปลี่ยนเป็น form-select ให้สูงเท่า input อื่น ๆ -->
                <select class="form-select form-select-lg" required name="role" id="role">
                  <option value="" selected disabled>เลือกประเภทบัญชีของคุณ</option>
                  <option value="1">ลูกค้าผู้เช่ารถ (สำหรับผู้ที่ต้องการเช่ารถ)</option>
                  <option value="2">ผู้ให้บริการรถเช่า (สำหรับผู้ที่นำรถมาปล่อยเช่า)</option>
                </select>
              </div>

              <div class="col-12 mt-2">
                <button class="btn btn-primary w-100 py-2 fs-5" type="submit">สมัครสมาชิก</button>
              </div>
            </div>
          </form>

          <div class="text-center small mt-3 fs-6">
            มีบัญชีแล้ว? <a href="login.php" class="link-primary">เข้าสู่ระบบ</a>
          </div>
        </div>
      </div>
    </div>  
  </div>
</body> 
  <?php include 'footer.php'; ?>
  <script>
    $(document).ready(function () {
      
        $("#register").on("submit", function (e) {
          e.preventDefault();
          var formData = $(this).serializeArray();
          var password1 = $('#password1').val();
          var password2 = $('#password2').val();
          if (password1.length < 8) {
            Swal.fire(
              'รหัสผ่านต้องมีมากกว่า 8 ตัว',
              '',
              'error'
            );
            e.preventDefault();
            return;
          }
          if (password1 !== password2) {
            Swal.fire(
              'รหัสผ่านไม่ตรงกัน',
              '',
              'error'
            );
            e.preventDefault();
            return;
          }
          $.post("api/register.api.php", formData, (res) => {
            if (res == 'success') {
                Swal.fire(
                  'สมัครสมาชิกสำเร็จ',
                  'Register Success ',
                  'success'
                );
                setTimeout(() => {
                  window.location.href = "login.php";
                }, 1000);
            } else if (res == 'dup') {
                Swal.fire(
                  'Email นี้มีอยู่ในระบบแล้ว',
                  'กรุณากรอก Email ใหม่เพื่อดำเนินการสมัครสมาชิก',
                  'error'
                )
            } else {
              Swal.fire(
                'สมัครสมาชิกไม่สำเร็จ',
                'Register Error',
                'error'
              );
            }
          });
        });

    });
  </script>
</body>

</html>