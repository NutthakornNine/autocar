 <?php
 if (session_status() === PHP_SESSION_NONE) { session_start(); }
  if (!empty($_SESSION['role'])) {
    header("location: index.php");
    exit;
  }
?>
<!DOCTYPE html> 
<html lang="th"> 
<head> 
  <meta charset="utf-8"/> 
  <meta name="viewport" content="width=device-width, initial-scale=1"/> 
  <title>เข้าสู่ระบบ — AutoHub</title> 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/> 
  <link rel="stylesheet" href="css/fonts.css">
  <?php include 'header.php'; ?>
    <style>
    .input-big{
        font-size: 20px;       
        padding: 14px 16px;    
        border-radius: 10px;   
        height: 60px;
        width: 425px;
        box-sizing: border-box; }
    </style>
</head> 
<body class="d-flex align-items-center" style="min-height:100vh; background: linear-gradient(135deg, #1a73e8, #1f53d7ff);">
  <div class="container">
    <form action="" method="post" id="login">
      <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
          <div class="p-4 p-md-5 bg-white rounded-4 border shadow">
            <div class="text-center mb-3">
              <img src="assets/logo2.png" alt="logo" class="img-fluid" style="max-height:220px;" />
              <h1 class="mt-2 mb-0" style="font-size:25px;">เข้าสู่ระบบ</h1>
            </div>

            <div class="mb-3">
              <label for="email" class="form-label visually-hidden">อีเมล</label>
              <input type="email" class="form-control form-control-lg" placeholder="อีเมล" name="email" id="email" required autocomplete="email" />
            </div>


            <div class="mb-3">
              <label for="password" class="form-label visually-hidden">รหัสผ่าน</label>
              <input type="password" class="form-control form-control-lg" placeholder="รหัสผ่าน" id="password" name="password" required autocomplete="current-password" />
            </div>


            <div class="d-grid">
              <button type="submit" class="btn btn-primary btn-lg">เข้าสู่ระบบ</button>
            </div>

            <div class="text-center mt-3" style="font-size:19px;">
              ยังไม่มีบัญชี? <a href="register.php" style="color:#1a73e8;">สมัครสมาชิก</a>
            </div>
          </div>
        </div>
      </div>/
    </form>
  </div> 
  <?php include 'footer.php'; ?>
  <script>
    $(document).ready(function () {

        $('#login').on("submit", function (e) {
          e.preventDefault();
          var formData = $(this).serializeArray();
          $.post("api/login.api.php", formData, (res) => {
            if (res == 'success') {
              Swal.fire(
                  'สมัครสมาชิกสำเร็จ',
                  'login Success ',
                  'success'
                );
                setTimeout(() => {
                  window.location.href = 'index.php';
                }, 1000);
            } else if (res == 'ban') {
              Swal.fire(
                'ผู้ใช้ของคุณโดนระงับชั่วคราว',
                '',
                'error'
              );
            } else {
              Swal.fire(
                'รหัสผ่านไม่ถูกต้อง',
                'รบกวนกรอกรหัสผ่านใหม่อีกครั้ง',
                'error'
              );
              $("#password").val('')
              setTimeout(() => {
                $("#password").focus()
              }, 200);
            }
          });
        });
    });
  </script>

</body> 
</html> 
