<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>การจองของฉัน — AutoHub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <?php include 'header.php'; ?>

    <style>
        .img-cover {
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
    </style>
    </style>
</head>

<body>

    <?php include 'menu.php'; ?> <br><br>


    <div class="container py-4 mt-5">
  <h1 class="h4 mb-3">การจองของฉัน</h1>

  <?php foreach (getReservedCar() as $car): ?>
  <div class="card shadow mb-4"> <!-- ✅ เพิ่ม mb-4 ให้มีระยะห่างระหว่างการ์ด -->
    <div class="row g-0 align-items-stretch">
      <div class="col-md-5">
        <img src="upload/<?= explode(",", $car['car_image'])[0] ?>" class="img-cover w-100 h-100 object-fit-cover rounded-start" alt="">
      </div>

      <div class="col-md-7">
        <div class="card-body d-flex flex-column h-100">
          <h3 class="card-title"><b><?= $car['car_name'] ?></b></h3>
          <p class="card-text">
            <?= $car['car_detail'] ?>
          </p>
          <p class="card-text"><small class="text-muted">Last updated <?= $car['reserved_date'] ?> mins ago</small></p>

          <hr class="my-3">

          <div class="d-flex justify-content-between align-items-center mt-auto">
            <h4 class="mb-0">
              <span class="fw-bold">วันที่จอง</span> 
              <span class="text-muted"> <?= date("d/m/y", strtotime($car['start_date'])) ?> - <?= date("d/m/y", strtotime($car['end_date'])) ?> </span>
            </h4>
            <div class="d-flex gap-2 me-1">
              <a href="car.php?car_id=<?=$car['car_id']?>&datetime=<?=$car['start_date'].' - '.$car['end_date']?>" class="btn btn-primary btn-lg">ดูรายละเอียดการจอง</a>
              <a href="javascript:void(0);" class="btn btn-outline-primary btn-lg btn-delete" data-reserved_id="<?=$car['reserved_id']?>">ยกเลิกการจอง</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach ?>
</div>

    <?php include 'chatbot.php' ?>
    <?php include 'footer.php'; ?>
    <script>
      $(document).ready(function () {
        
        $(document).on("click", ".btn-delete", function(e) {
            e.preventDefault();
            const formData = $(this).data();
            Swal.fire({
                title: 'ลบ',
                text: '',
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ลบ',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "./api/delete-reserved.api.php",
                        data: formData,
                        success: function(response) {
                            if (response == 'success') {
                                Swal.fire({
                                    title: 'Success',
                                    text: 'Delete Data is Success',
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'OK'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload();
                                    }
                                })
                            } else {
                                Swal.fire(
                                    'Error',
                                    '',
                                    'error'
                                )
                            }
                        }
                    });
                }
            })
        });

      });
    </script>
</body>

</html>