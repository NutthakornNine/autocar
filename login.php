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
<body class="d-flex align-items-center" style="min-height:100vh ; background: linear-gradient(135deg, #1a73e8, #1f53d7ff); "> 
  <div class="container"> 
    <form action="" method="post" id="login">
      <div class="row justify-content-center"> 
        <div class="col-md-6 col-lg-5"> 
          <div class="p-5 bg-white rounded-4 border shadow"> 
            <div class="text-center mb-3"> 
              <img src="assets/logo2.png" alt="logo" style="height:300px"/> 
              <h1 class="h5 mt-2 mb-0" style="font-size:25px;" >เข้าสู่ระบบ</h1> 
            </div> 
            <div class="mb-3"><input class="input-big" placeholder="อีเมล" name="email" id="email" required /></div> 
            <div class="mb-3"><input class="input-big" placeholder="รหัสผ่าน" type="password" id="password" name="password" required /></div> 
            <div class="text-center small mt-3"><input class="input-big btn btn-outline-primary" type="submit" style="font-size:20px;" value="เข้าสู่ระบบ"></div> 
            <div class="text-center small mt-3" style="font-size:19px;">ยังไม่มีบัญชี? <a href="register.php" style="color: #1a73e8;">สมัครสมาชิก</a></div>   
          </div> 
        </div> 
      </div> 
      
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
              window.location.href = 'index.php';
            } else {
              Swal.fire(
                'Error',
                'Error',
                'error'
              );
            }
          });
        });

    });
  </script>

</body> 
</html> 
