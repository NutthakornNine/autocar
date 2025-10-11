<!DOCTYPE html> 
<html lang="th"> 
<head> 
  <meta charset="utf-8"/> 
  <meta name="viewport" content="width=device-width, initial-scale=1"/> 
  <title>การจองของฉัน — AutoHub</title> 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/> 
    <?php include 'header.php'; ?>
 
  <style> .img-cover {
            display: block;
            width: 100%;
            height: 257px;
            object-fit: cover;
            border-top-left-radius: .5rem;
            border-bottom-left-radius: .5rem;
        }


        @media (max-width: 767.98px) {
            .img-cover {
                height: 350px;
                border-bottom-left-radius: 0;
                border-top-right-radius: .5rem;
            }
        }

         .card-tall {
            min-height: 400px;
        }

        @media (max-width: 991.98px) {
            .card-tall {
                min-height: 300px;
            }
        }
    </style></style>
</head> 
<body> 

 <?php include 'menu.php'; ?> <br><br>

 
  <div class="container py-4 mt-5" > 
    <h1 class="h4 mb-3">การจองของฉัน</h1> 
     <div class="card shadow h-100">
                    <div class="row g-0 align-items-stretch">
                 
                        <div class="col-md-5 h-100">
                            <img src="assets/car1.jpg" class="img-cover" alt="">
                        </div>

                        <div class="col-md-7 h-100">
                            <div class="card-body d-flex flex-column h-100">
                                <h3 class="card-title"><b>Toyota</b></h3>
                                <p class="card-text">
                                    This is a wider card with supporting text below as a natural lead-in to additional content.
                                </p>
                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>

                                <hr class="my-3">

            
                                <div class="d-flex justify-content-between align-items-center mt-4">
                                    <h4 class="mb-0">
                                        <span class="fw-bold">วันที่จอง</span><span class="text-muted"> 20/10/2025 - 21/10/2025 </span>
                                    </h4>
                                     <div class="d-flex gap-2  me-1"> 
                                    <a href="car.php" class="btn btn-primary btn-lg ">ดูรายละเอียดการจอง</a>
                                    <a href="car.php" class="btn btn-outline-primary btn-lg">ยกเลิกการจอง</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
</div> 
    <?php include 'chatbot.php' ?>
    <?php include 'footer.php'; ?> 
</body> 
</html> 
