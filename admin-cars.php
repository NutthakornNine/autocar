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
      <h5 class="mb-4">จัดการข้อมูลรถ</h5>

      <!-- Filter -->
      <div class="card auto-card p-3 p-md-4 mb-4">
        <form class="row g-3">
          <div class="col-12 col-md-4">
            <label class="form-label">คำค้น (ยี่ห้อ/รุ่น/ทะเบียน)</label>
            <input type="text" class="form-control" name="q" placeholder="เช่น Toyota / กก 1234">
          </div>
          <div class="col-6 col-md-3">
            <label class="form-label">จังหวัด</label>
            <select class="form-select" name="province_id">
              <option value="">ทั้งหมด</option>
              <!-- loop thai_provinces -->
              <option>กรุงเทพมหานคร</option>
              <option>เชียงใหม่</option>
            </select>
          </div>
          <div class="col-6 col-md-3">
            <label class="form-label">สถานะรถ</label>
            <select class="form-select" name="car_status">
              <option value="">ทั้งหมด</option>
              <option value="1">พร้อมให้เช่า</option>
              <option value="0">ไม่พร้อม</option>
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
              <tr>
                <td>1</td>
                <td>Toyota GR Yaris</td>
                <td>กก 1234</td>
                <td>นาย สมชาย</td>
                <td>กรุงเทพมหานคร</td>
                <td>฿850</td>
                <td><span class="badge text-bg-success">พร้อม</span></td>
                <td class="text-end">
                  <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#carView">รายละเอียด<i class="bi bi-eye"></i></button>
                  <button class="btn btn-sm btn-outline-danger">ลบข้อมูลรถ<i class="bi bi-trash"></i></button>
                </td>
              </tr>
              <tr>
                <td>2</td>
                <td>Honda City</td>
                <td>ขข 5678</td>
                <td>นางสาว อมร</td>
                <td>เชียงใหม่</td>
                <td>฿700</td>
                <td><span class="badge text-bg-secondary">ไม่พร้อม</span></td>
                <td class="text-end">
                  <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#carView">รายละเอียด<i class="bi bi-eye"></i></button>
                  <button class="btn btn-sm btn-outline-danger">ลบข้อมูลรถ<i class="bi bi-trash"></i></button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Pagination -->
        <nav class="mt-3" aria-label="cars page">
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

<!-- Modal ดูรายละเอียดรถ -->
<div class="modal fade" id="carView" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title">รายละเอียดรถ</h6>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="row g-3">
          <div class="col-md-5">
            <img class="img-fluid rounded" src="/autocar/assets/sample/car-1.jpg" alt="">
          </div>
          <div class="col-md-7">
            <p class="mb-1"><strong>ยี่ห้อ/รุ่น:</strong> Toyota GR Yaris</p>
            <p class="mb-1"><strong>ทะเบียน:</strong> กก 1234</p>
            <p class="mb-1"><strong>ระบบเชื้อเพลิง:</strong> เบนซิน</p>
            <p class="mb-1"><strong>ที่นั่ง:</strong> 5</p>
            <p class="mb-1"><strong>จังหวัด:</strong> กรุงเทพมหานคร</p>
            <p class="mb-0"><strong>ราคา/วัน:</strong> ฿850</p>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-outline-secondary" data-bs-dismiss="modal">ปิด</button>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>