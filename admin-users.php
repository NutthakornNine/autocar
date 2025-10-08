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
      <h5 class="mb-4">จัดการผู้ใช้</h5>

      <!-- Filter -->
      <div class="card auto-card p-3 p-md-4 mb-4">
        <form class="row g-3">
          <div class="col-12 col-md-4">
            <label class="form-label">คำค้น (ชื่อ/อีเมล)</label>
            <input type="text" class="form-control" name="q" placeholder="พิมพ์เพื่อค้นหา...">
          </div>
          <div class="col-6 col-md-3">
            <label class="form-label">บทบาท</label>
            <select class="form-select" name="role">
              <option value="">ทั้งหมด</option>
              <option value="0">ผู้ใช้</option>
              <option value="1">ผู้ให้บริการ</option>
              <option value="2">แอดมิน</option>
            </select>
          </div>
          <div class="col-6 col-md-3">
            <label class="form-label">สถานะบัญชี</label>
            <select class="form-select" name="status">
              <option value="">ทั้งหมด</option>
              <option value="0">ปกติ</option>
              <option value="1">ระงับ</option>
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
                <th>ชื่อ–นามสกุล</th>
                <th>อีเมล</th>
                <th>เบอร์</th>
                <th>บทบาท</th>
                <th>สถานะ</th>
                <th class="text-end">การจัดการ</th>
              </tr>
            </thead>
            <tbody>
              <!-- loop ตัวอย่าง -->
              <tr>
                <td>1</td>
                <td>นาย สมชาย</td>
                <td>somchai@example.com</td>
                <td>081-234-5678</td>
                <td><span class="badge text-bg-secondary">ผู้ใช้</span></td>
                <td><span class="badge text-bg-success">ปกติ</span></td>
                <td class="text-end">
                  <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#userView">รายละเอียด<i class="bi bi-eye"></i></button>
                  <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash">ลบข้อมูลลูกค้า</i></button>
                </td>
              </tr>
              <tr>
                <td>2</td>
                <td>นางสาว อมร</td>
                <td>amon@example.com</td>
                <td>089-999-9999</td>
                <td><span class="badge text-bg-info">ผู้ให้บริการ</span></td>
                <td><span class="badge text-bg-danger">ระงับ</span></td>
                <td class="text-end">
                  <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#userView">รายละเอียด<i class="bi bi-eye"></i></button>
                  <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash">ลบข้อมูลลูกค้า</i></button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <nav class="mt-3" aria-label="users page">
          <ul class="pagination justify-content-end">
            <li class="page-item disabled"><span class="page-link">ก่อนหน้า</span></li>
            <li class="page-item active"><span class="page-link">1</span></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">ถัดไป</a></li>
          </ul>
        </nav>
      </div>
    </div>
  </section>
</div>

<!-- Modal ดูรายละเอียดผู้ใช้ -->
<div class="modal fade" id="userView" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title">รายละเอียดผู้ใช้</h6>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p class="mb-1"><strong>ชื่อ:</strong> นาย สมชาย</p>
        <p class="mb-1"><strong>อีเมล:</strong> somchai@example.com</p>
        <p class="mb-1"><strong>เบอร์:</strong> 081-234-5678</p>
        <p class="mb-1"><strong>บทบาท:</strong> ผู้ใช้</p>
        <p class="mb-1"><strong>สถานะ:</strong> ปกติ</p>
        <p class="mb-0"><strong>ที่อยู่:</strong> 123 ถนนสุขุมวิท กรุงเทพฯ</p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-outline-secondary" data-bs-dismiss="modal">ปิด</button>
        <button class="btn btn-warning">ระงับบัญชี</button>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>