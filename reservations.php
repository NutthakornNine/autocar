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
                <h5 class="mb-4">การจองรถของฉัน</h5>

                <!-- Filter -->
                <div class="card shadow rounded-4 p-4 mb-4">
                    <form class="row g-3">
                        <div class="col-12 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label class="form-label">สถานะการจอง</label>
                                <select class="form-select">
                                    <option value="">ทั้งหมด</option>
                                    <option value="confirmed">ยืนยันแล้ว</option>
                                    <option value="cancelled">ยกเลิก</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-4 col-lg-4">
                            <div class="form-group">
                                <label class="form-label">ชื่อผู้จอง</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>

                        <div class="col-12 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label for="start-date">วันที่ต้องการเช่า</label>
                                <input type="text" id="datetime">
                            </div>
                        </div>

                       <div class="col-12 col-md-2 col-lg-2" style="margin-top: 35px;">
                            <button type="submit" class="submit-btn w-100 mb-3">ค้นหา</button>
                        </div>
                    </form>
                </div>

                <!-- Table -->
                <div class="card auto-card p-3 p-md-4">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>ผู้จอง</th>
                                    <th>รถที่จอง</th>
                                    <th>วันที่จอง</th>
                                    <th>สถานะ</th>
                                    <th>การชำระเงิน</th>
                                    <th class="text-end">การจัดการ</th>
                                </tr>
                            </thead>
                            <!-- PHP loop ตัวอย่าง -->
                            <tr>
                                <td>1</td>
                                <td>
                                    <div>นาย สมชาย</div>
                                    <small class="text-muted">somchai@example.com</small>
                                </td>
                                <td>
                                    <div>Toyota GR Yaris</div>
                                    <small class="text-muted">ทะเบียน กก 1234</small>
                                </td>
                                <td>01/10/2025 – 03/10/2025</td>
                                <td><span class="badge text-bg-warning">รอชำระ</span></td>
                                <td><span class="badge text-bg-secondary">ยังไม่ส่งสลิป</span></td>
                                <td class="text-end">
                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#viewModal">
                                        <i class="bi bi-eye">ดูรายละเอียด</i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-success">
                                        <i class="bi bi-check2-circle">ดำเนินการสำเร็จ</i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-x-circle">ลบข้อมูล</i>
                                    </button>
                                </td>
                            </tr>

                            <tr>
                                <td>2</td>
                                <td>
                                    <div>นางสาว อมร</div>
                                    <small class="text-muted">amon@example.com</small>
                                </td>
                                <td>
                                    <div>Honda City</div>
                                    <small class="text-muted">ทะเบียน ขข 5678</small>
                                </td>
                                <td>05/10/2025 – 06/10/2025</td>
                                <td><span class="badge text-bg-success">ยืนยันแล้ว</span></td>
                                <td><span class="badge text-bg-success">ชำระแล้ว</span></td>
                                <td class="text-end">
                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#viewModal">
                                        <i class="bi bi-eye">ดูรายละเอียด</i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-x-circle">ลบข้อมูล</i>
                                    </button>
                                </td>
                            </tr>


                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal: รายละเอียดการจอง -->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">รายละเอียดการจอง</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <h6>ข้อมูลผู้จอง</h6>
                            <p class="mb-1"><strong>ชื่อ:</strong> นาย สมชาย</p>
                            <p class="mb-1"><strong>อีเมล:</strong> somchai@example.com</p>
                            <p class="mb-1"><strong>เบอร์:</strong> 081-234-5678</p>
                        </div>
                        <div class="col-md-6">
                            <h6>ข้อมูลรถ</h6>
                            <p class="mb-1"><strong>รุ่น:</strong> Toyota GR Yaris</p>
                            <p class="mb-1"><strong>ทะเบียน:</strong> กก 1234</p>
                            <p class="mb-1"><strong>ราคา/วัน:</strong> ฿850</p>
                        </div>
                        <div class="col-12">
                            <h6>รายละเอียดการจอง</h6>
                            <p class="mb-1"><strong>วันที่จอง:</strong> 01/10/2025 – 03/10/2025</p>
                            <p class="mb-1"><strong>สถานะ:</strong> รอชำระ</p>
                            <p class="mb-1"><strong>การชำระเงิน:</strong> ยังไม่ส่งสลิป</p>
                        </div>
                        <div class="col-12">
                            <h6>หลักฐานการโอน</h6>
                            <div class="border rounded p-3 text-center">
                                <i class="bi bi-file-earmark-image fs-2 text-muted"></i>
                                <p class="small text-muted mb-0">ยังไม่มีสลิป</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" data-bs-dismiss="modal">ปิด</button>
                    <button class="btn btn-success">ยืนยันการชำระ</button>
                    <button class="btn btn-danger">ปฏิเสธการชำระ</button>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
    <script>
        $('#datetime').daterangepicker();
        $('#booking-ref').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
        });
    </script>
</body>

</html>