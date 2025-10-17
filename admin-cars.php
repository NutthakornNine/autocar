<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <?php include 'header.php'; ?>
</head>

<body>

  <?php include 'menu.php'; ?>

  <div class="content mt-5">
    <section class="py-4">
      <div class="container">
        <h4 class="mb-4 mt-5"> <b>จัดการข้อมูลรถ</b></h4>

        <!-- Filter -->
        <div class="card auto-card p-3 p-md-4 mb-4">
          <form class="row g-3">
            <div class="col-12 col-md-4">
              <label class="form-label">คำค้น (ยี่ห้อ/รุ่น/ทะเบียน)</label>
              <input type="text" class="form-control" name="cars" placeholder="เช่น Toyota / กก 1234">
            </div>
            <div class="col-6 col-md-3">
              <label class="form-label">จังหวัด</label>
              <select class="form-select" name="province_id">
                <option value="">ทั้งหมด</option>
                <?php foreach (getProvince() as $p): ?>
                  <option value="<?= $p['id'] ?>"><?= $p['name_th'] ?></option>
                <?php endforeach ?>
              </select>
            </div>
            <div class="col-6 col-md-3">
              <label class="form-label">สถานะรถ</label>
              <select class="form-select" name="car_status">
                <option value="">ทั้งหมด</option>
                <option value="1">พร้อมให้เช่า</option>
                <option value="none">ไม่พร้อม</option>
              </select>
            </div>
            <div class="col-12 col-md-2 d-flex align-items-end">
              <button class="btn btn-primary w-100" type="submit"><i class="bi bi-search"></i> ค้นหา</button>
            </div>
          </form>
        </div>

        <!-- Table -->
        <div class="card auto-card p-3 p-md-4">
          <div class="table-responsive">
            <table class="table align-middle">
              <thead class="table-light">
                <tr>
                  <th>#</th>
                  <th>รถ</th>
                  <th>ทะเบียน</th>
                  <th>เจ้าของ</th>
                  <th>จังหวัด</th>
                  <th>ราคา/วัน</th>
                  <th>สถานะ</th>
                  <th class="text-end">การจัดการ</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach (getCarsAdmin() as $key => $row):
                ?>
                  <tr>
                    <td><?= $key + 1 ?></td>
                    <td><?= $row['car_name'] ?></td>
                    <td><?= $row['license_plate'] ?></td>
                    <td><?= $row['fullname'] ?></td>
                    <td><?= $row['name_th'] ?></td>
                    <td><?= $row['price_per_day'] ?></td>
                    <td>
                      <?php
                      switch ($row['car_status']) {
                        case '0':
                          echo "
                              <span class='badge text-bg-danger'>ไม่ว่าง</span>
                            ";
                          break;
                        case '1':
                          echo "
                            <span class='badge text-bg-success'>ปกติ</span>
                            ";
                          break;
                      }
                      ?>

                    </td>
                    <td class="text-end">
                      <button class="btn btn-sm btn-outline-danger btn-delete" data-car_id="<?= $row['car_id'] ?>">
                        ลบข้อมูลรถ<i class="bi bi-trash"></i>
                      </button>
                    </td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
  </div>


  <?php include 'footer.php'; ?>
  <script>
    $(document).ready(function () {
      
      $(document).on("click", ".btn-delete", function (e) {
      e.preventDefault();
      const formData = $(this).data();
      Swal.fire({
        title: 'ลบข้อมูลรถ',
        text: 'กรุณายืนยัน',
        icon: 'success',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ยืนยัน'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type: "POST",
            url: "api/delete_car.api.php",
            data: formData,
            success: function (response) {
              location.reload();
            }
          });
        }
      })
    })

    });
  </script>

</body>

</html>