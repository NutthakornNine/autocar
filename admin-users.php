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
      <h4 class="mb-4 mt-5"> <b>จัดการผู้ใช้</b></h4>
      <div class="card auto-card p-3 p-md-4 mb-4 ">
        <form class="row g-3">
          <div class="col-12 col-md-4">
            <label class="form-label">คำค้น (ชื่อ/อีเมล)</label>
            <input type="text" class="form-control" name="name" placeholder="พิมพ์เพื่อค้นหา...">
          </div>
          <div class="col-6 col-md-3">
            <label class="form-label">บทบาท</label>
            <select class="form-select" name="role">
              <option value="">ทั้งหมด</option>
              <option value="1">ผู้ใช้</option>
              <option value="2">ผู้ให้บริการ</option>
              <option value="admin">แอดมิน</option>
            </select>
          </div>
          <div class="col-6 col-md-3">
            <label class="form-label">สถานะบัญชี</label>
            <select class="form-select" name="status">
              <option value="">ทั้งหมด</option>
              <option value="1">ปกติ</option>
              <option value="disable">ระงับ</option>
            </select>
          </div>
          <div class="col-12 col-md-2 d-flex align-items-end">
            <button class="btn btn-primary w-100" type="submit"><i class="bi bi-search"></i> ค้นหา</button>
          </div>
        </form>
      </div>
      <div class="card auto-card p-3 p-md-4">
        <div class="table-responsive">
          <table class="table align-middle">
            <thead class="table-light">
              <tr>
                <th>#</th>
                <th>ชื่อ–นามสกุล</th>
                <th>อีเมล</th>
                <th>เบอร์</th>
                <th>ที่อยู่</th>
                <th>บทบาท</th>
                <th>สถานะ</th>
                <th class="text-end">การจัดการ</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach (getUsers() as $key => $row) : ?>
                <tr>
                  <td><?=$key + 1?></td>
                  <td><?=$row['fullname']?> <?=$row['lastname']?></td>
                  <td><?=$row['email']?></td>
                  <td><?=$row['phone']?></td>
                  <td><?=$row['address']?></td>
                  <td>
                    <?php
                      switch ($row['role']) {
                        case '1':
                          echo "<span class='badge text-bg-secondary'>ผู้ใช้</span>";
                          break;
                        case '2':
                          echo "<span class='badge text-bg-primary'>ผู้ให้บริการ</span>";
                          break;
                        case '0':
                          echo "<span class='badge text-bg-dark'>แอดมิน</span>";
                          break;
                      }
                    ?>
                  </td>
                  <td>
                      <?php
                      if ($_SESSION['userid'] == $row['user_id']) {
                        echo "<span class='badge text-bg-warning'>ไม่อนุญาติ</span>";
                      } else {
                        switch ($row['status']) {
                          case '0':
                            echo "
                              <a href='#' data-id='$row[user_id]' data-status='$row[status]' class='btn-status'>
                                <span class='badge text-bg-danger'>ระงับ</span>
                              </a>
                            ";
                            break;
                          case '1':
                            echo "
                            <a href='#' data-id='$row[user_id]' data-status='$row[status]' class='btn-status'>
                              <span class='badge text-bg-success'>ปกติ</span>
                            </a>
                            ";
                            break;
                        }
                      }
                    ?>
                  </td>
                  <td class="text-end">
                    <?php if ($_SESSION['userid'] == $row['user_id']) { ?>
                     <span class='badge text-bg-warning'>ไม่อนุญาติ</span>
                    <?php } else { ?>
                        <button 
                          type="button"
                          data-user_id="<?=$row['user_id']?>"
                          class="btn btn-sm btn-outline-danger btn-delete"
                          >
                          <i class="bi bi-trash">ลบข้อมูลลูกค้า</i>
                        </button>
                    <?php } ?>

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
    
    $(document).on("click", ".btn-status", function (e) {
      e.preventDefault();
      const formData = $(this).data();
      Swal.fire({
        title: 'ระงับบัญชีผู้ใช้',
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
            url: "api/user_status.api.php",
            data: formData,
            success: function (response) {
              location.reload();
            }
          });
        }
      })
    })

    $(document).on("click", ".btn-delete", function (e) {
      e.preventDefault();
      const formData = $(this).data();
      Swal.fire({
        title: 'ลบบัญชี',
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
            url: "api/delete_user.api.php",
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