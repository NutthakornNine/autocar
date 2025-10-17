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
    <div class="content mt-5"> <br>
        <section class="py-4">
            <div class="container">
                <h4 class="mb-4"> <b>การจองรถของฉัน</b></h4>

                <div class="card shadow rounded-4 p-4 mb-4">
                    <form class="row g-3" method="get" autocomplete="off">

                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label class="form-label">ค้นหาชื่อผู้จอง</label>
                                <input type="text" name="reserved_name" class="form-control">
                            </div>
                        </div>

                        <div class="col-12 col-md-4 col-lg-4">
                            <div class="form-group">
                                <label for="start-date">ค้นหาวันที่จอง</label>
                                <input type="text" id="datetime" name="datetime" >
                            </div>
                        </div>

                        <div class="col-12 col-md-2 col-lg-2" style="margin-top: 35px; margin-top: 50px">
                            <button type="submit" class="submit-btn w-100 mb-3">ค้นหา</button>
                        </div>
                    </form>
                </div>

                <!-- Table -->
                <div class="card border-0 shadow-lg rounded-4 auto-card p-3 p-md-4">
  <div class="card-header bg-white border-0 pb-3">
    <h5 class="fw-bold mb-0 text-primary">
      <i class="bi bi-calendar-check me-2"></i> รายการจองทั้งหมด
    </h5>
  </div>

  <div class="table-responsive">
    <table class="table align-middle table-hover mb-0">
      <thead class="table-light">
        <tr>
          <th class="text-center">#</th>
          <th>ผู้จอง</th>
          <th>รถที่จอง</th>
          <th>วันที่จอง</th>
          <th>สถานะ</th>
          <th class="text-end">การจัดการ</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach (getReservation() as $k => $row):
          $strDate = date("Y-m-d");

          if ($row['is_return'] == 1) {
              $status = "<span class='badge bg-success px-3 py-2 rounded-pill'>คืนรถแล้ว</span>";
          } else if ($strDate > $row['end_date']) {
              $status = "<span class='badge bg-primary px-3 py-2 rounded-pill'>ดำเนินการสำเร็จ</span>";
          } else {
              $status = "<span class='badge bg-warning text-dark px-3 py-2 rounded-pill'>อยู่ระหว่างการเช่า</span>";
          }
        ?>
          <tr>
            <td class="text-center fw-bold"><?= $k + 1; ?></td>
            <td>
              <div class="fw-semibold text-dark"><?= $row['reserved_name'] ?></div>
              <small class="text-muted"><i class="bi bi-envelope me-1"></i><?= $row['email'] ?></small>
            </td>
            <td>
              <div class="fw-semibold text-dark"><?= $row['car_name'] ?></div>
              <small class="text-muted"><i class="bi bi-car-front me-1"></i><?= $row['license_plate'] ?></small>
            </td>
            <td>
              <div class="fw-semibold">
                <?= date("d/m/Y", strtotime($row['start_date'])) ?> – <?= date("d/m/Y", strtotime($row['end_date'])) ?>
              </div>
            </td>
            <td><?= $status ?></td>
            <td class="text-end">
              <button
                type="button"
                class="btn btn-outline-primary btn-sm rounded-pill px-3 me-2 btn-view"
                data-reserved_id="<?= $row['reserved_id'] ?>"
                data-car_id="<?= $row['car_id'] ?>">
                <i class="bi bi-eye-fill me-1"></i> ดูรายละเอียด
              </button>
              <button
                type="button"
                class="btn btn-outline-danger btn-sm rounded-pill px-3 btn-delete"
                data-reserved_id="<?= $row['reserved_id'] ?>">
                <i class="bi bi-trash3-fill me-1"></i> ลบ
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
        $('#datetime').daterangepicker({
            autoUpdateInput: false, // ❌ ไม่ให้ใส่ค่าอัตโนมัติ
            locale: {
                format: 'YYYY-MM-DD',
                separator: ' - ',
                cancelLabel: 'Clear'
            }
        });

        // ✅ อัปเดต input ตอนเลือกวันที่เท่านั้น
        $('#datetime').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
        });

        // 🧹 ล้างค่าเมื่อกดปุ่ม Clear
        $('#datetime').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
        $('#booking-ref').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
        });
        $(document).on("click", ".btn-view", function(e) {
            e.preventDefault();
            var reserved_id = $(this).data("reserved_id");
            var car_id = $(this).data("car_id");
            $.ajax({
                type: "POST",
                url: "api/get-reservation.api.php",
                data: {
                    reserved_id: reserved_id
                },
                dataType: "JSON",
                success: function(response) {
                    const html = `
                        <div class="container text-start">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="p-3 bg-light rounded border h-100">
                                        <h6 class="fw-bold mb-2 text-primary">ข้อมูลผู้จอง</h6>
                                        <p class="mb-1"><strong>ชื่อ:</strong> ${response.data.reserved_name}</p>
                                        <p class="mb-1"><strong>อีเมล:</strong> ${response.data.email}</p>
                                        <p class="mb-0"><strong>เบอร์:</strong> ${response.data.phone}</p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="p-3 bg-light rounded border h-100">
                                        <h6 class="fw-bold mb-2 text-primary">ข้อมูลรถ</h6>
                                        <p class="mb-1"><strong>รุ่น:</strong> ${response.data.car_name}</p>
                                        <p class="mb-1"><strong>ทะเบียน:</strong>${response.data.license_plate}</p>
                                        <p class="mb-0"><strong>ราคา/วัน:</strong> ฿${response.amount}</p>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="p-3 bg-light rounded border">
                                        <h6 class="fw-bold mb-2 text-primary">รายละเอียดการจอง</h6>
                                        <p class="mb-0"><strong>วันที่จอง:</strong> ${response.data.start_date} – ${response.data.end_date}</p>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="p-3 bg-light rounded border text-center">
                                        <h6 class="fw-bold mb-3 text-primary">หลักฐานการโอน</h6>
                                        <div class="border rounded p-3 text-center bg-white">
                                            <i class="bi bi-file-earmark-image fs-1 text-muted"></i>
                                            <img src="upload/${response.data.slip}" alt="" width="400">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;

                    Swal.fire({
                        title: '<h4 class="fw-bold mb-3">แสดงข้อมูลรายละเอียด</h4>',
                        html: html,
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'คืนรถ',
                        cancelButtonText: 'ปิดหน้าจอ',
                        width: '65%',
                        customClass: {
                            popup: 'p-4'
                        }
                    }).then((result) => {
                      if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: "api/return_car.api.php",
                            data: {
                                car_id: car_id,
                                reserved_id: reserved_id
                            },
                            success: function (response) {
                                location.reload();
                            }
                        });
                      }
                    });
                }
            });

        });
        $(document).on("click", ".btn-delete", function(e) {
            e.preventDefault();
            const formData = $(this).data();
            Swal.fire({
                title: 'ลข้อมูลการจอง',
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
                                    title: 'ลบข้อมูลการจองสำเร็จ',
                                    text: 'Successfully deleted booking information',
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
    </script>
</body>

</html>