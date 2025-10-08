 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">
 <link rel="stylesheet" href="css/fonts.css">
 <nav class="navbar navbar-expand-lg fixed-top bg-white shadow">
   <div class="container-fluid">

     <a class="navbar-brand d-flex align-items-center ms-4" href="index.php">
       <img src="assets/logo1.png" alt="AutoHub" class="me-2" />
       <span class="fw-bold text-primary ms-2" style="font-size:30px"> Auto Car</span>
     </a>


     <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainnav">
       <span class="navbar-toggler-icon"></span>
     </button>

     <div class="collapse navbar-collapse" id="mainnav">
       <ul class="navbar-nav ms-auto align-items-lg-center me-4 ">
         <li class="nav-item" style="font-size:21px;">
           <a class="nav-link active" href="index.php">หน้าแรก</a>
         </li>
         <li class="nav-item" style="font-size:21px;">
           <a class="nav-link" href="results.php">ค้นหารถ</a>
         </li>
         <li class="nav-item" style="font-size:21px;">
           <a class="nav-link" href="bookings.php">การจองของฉัน</a>
         </li>
         <!-- ฝั่งผู้ให้บริการปล่อยรถเช้า -->
         <div class="dropdown">
           <button class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="font-size:21px;">
             ผู้ให้บริการ
           </button>
           <ul class="dropdown-menu">
             <li><a class="dropdown-item" href="carsmanage.php">จัดการรถ</a></li>
             <li><a class="dropdown-item" href="reservations.php">ดูข้อมูลการจอง</a></li>
           </ul>
         </div>
         <!-- ฝั่งผู้ให้บริการ Admin -->
         <div class="dropdown">
           <button class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="font-size:21px;">
             Admin
           </button>
           <ul class="dropdown-menu">
             <li><a class="dropdown-item" href="admin-users.php">จัดการผู้ใช้</a></li>
             <li><a class="dropdown-item" href="admin-cars.php">จัดการข้อมูลรถ</a></li>
             <li><a class="dropdown-item" href="admin-report.php">รายงานยอดขาย</a></li>
           </ul>
         </div>

         <li class="nav-item">
           <a class="text-primary w3-button w3-border w3-round-large  ms-lg-2" style="font-size:21px; " href="login.php"> เข้าสู่ระบบ</a>
         </li>
       </ul>
     </div>
   </div>
 </nav>