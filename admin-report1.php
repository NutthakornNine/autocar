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
<br><br> 
<div class="content mt-5">
  <section class="py-4">
    <div class="container">
      <h5 class="mb-4">รายงานยอดขาย</h5>

      <!-- Summary Cards -->
      <div class="row g-3 mb-4">
        <div class="col-12 col-md-4">
          <div class="card auto-card p-3">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <div class="text-muted small">ยอดชำระสำเร็จ (เดือนนี้)</div>
                <div class="fs-4 fw-bold">฿ 128,500</div>
              </div>
              <i class="bi bi-cash-coin fs-2"></i>
            </div>
            <div class="progress mt-2" style="height:8px;">
              <div class="progress-bar" style="width: 68%"></div>
            </div>
            <small class="text-muted">เพิ่มขึ้น 12% จากเดือนก่อน</small>
          </div>
        </div>

        <div class="col-12 col-md-4">
          <div class="card auto-card p-3">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <div class="text-muted small">จำนวนการจอง (เดือนนี้)</div>
                <div class="fs-4 fw-bold">86</div>
              </div>
              <i class="bi bi-journal-check fs-2"></i>
            </div>
            <div class="progress mt-2" style="height:8px;">
              <div class="progress-bar" style="width: 54%"></div>
            </div>
            <small class="text-muted">+8 รายการ</small>
          </div>
        </div>

        <div class="col-12 col-md-4">
          <div class="card auto-card p-3">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <div class="text-muted small">อัตราการยืนยัน</div>
                <div class="fs-4 fw-bold">91%</div>
              </div>
              <i class="bi bi-graph-up-arrow fs-2"></i>
            </div>
            <div class="progress mt-2" style="height:8px;">
              <div class="progress-bar" style="width: 91%"></div>
            </div>
            <small class="text-muted">จบด้วยการชำระสำเร็จ</small>
          </div>
        </div>
      </div>

      <!-- Filters -->
      <div class="card auto-card p-3 p-md-4 mb-4">
        <form class="row g-3">
          <div class="col-12 col-md-3">
            <label class="form-label">ช่วงเวลา</label>
            <select class="form-select">
              <option>เดือนนี้</option>
              <option>ไตรมาสนี้</option>
              <option>ปีนี้</option>
              <option>กำหนดเอง</option>
            </select>
          </div>
          <div class="col-6 col-md-3">
            <label class="form-label">ตั้งแต่</label>
            <input type="date" class="form-control">
          </div>
          <div class="col-6 col-md-3">
            <label class="form-label">ถึง</label>
            <input type="date" class="form-control">
          </div>
          <div class="col-12 col-md-3 d-flex align-items-end">
            <div class="d-flex gap-2 w-100">
              <button class="btn btn-primary w-100" type="submit"><i class="bi bi-search"></i> ดูรายงาน</button>
              <button class="btn btn-outline-dark w-100" type="button"><i class="bi bi-download"></i> ดาวน์โหลด</button>
            </div>
          </div>
        </form>
      </div>

      <!-- Transactions Table -->
      <div class="card auto-card p-3 p-md-4">
        <div class="table-responsive">
          <table class="table align-middle">
            <thead class="table-light">
              <tr>
                <th>#</th>
                <th>เลขที่จอง</th>
                <th>ผู้จอง</th>
                <th>รถ</th>
                <th>วันที่ชำระ</th>
                <th>ยอดเงิน</th>
                <th>สถานะ</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>#R-000245</td>
                <td>นาย สมชาย</td>
                <td>Toyota GR Yaris</td>
                <td>10/10/2025 14:23</td>
                <td>฿ 1,700.00</td>
                <td><span class="badge text-bg-success">สำเร็จ</span></td>
              </tr>
              <tr>
                <td>2</td>
                <td>#R-000246</td>
                <td>นางสาว อมร</td>
                <td>Honda City</td>
                <td>10/10/2025 18:02</td>
                <td>฿ 700.00</td>
                <td><span class="badge text-bg-danger">ล้มเหลว</span></td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Total Sales Button -->
        <!--
            Added a summary button below the transaction table to display
            the total amount of all sales listed in the current table.  The
            button shows the computed total on page load and can be styled
            further using Bootstrap utility classes.  The calculation
            happens client‑side via the script included at the bottom of
            this page.
        -->
        <div class="d-flex justify-content-end mt-3">
          <button id="totalSalesBtn" type="button" class="btn btn-primary">
            รวมยอดขาย: <span id="totalSales">฿ 0.00</span>
          </button>
        </div>
        <!-- Pagination -->
        <nav class="mt-3" aria-label="transactions page">
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

<?php include 'footer.php'; ?>

<!-- Script to calculate and display total sales on the summary button -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Find all numeric cells in the money column (6th column in the table)
    var moneyCells = document.querySelectorAll('table.align-middle tbody td:nth-child(6)');
    var total = 0;
    moneyCells.forEach(function (cell) {
      // Remove any non‑numeric characters (e.g. currency symbols and commas)
      var cleaned = cell.textContent.replace(/[^0-9.\-]/g, '');
      var value = parseFloat(cleaned);
      if (!isNaN(value)) {
        total += value;
      }
    });
    // Format the total as Thai Baht with two decimal places
    var formattedTotal = new Intl.NumberFormat('th-TH', { style: 'currency', currency: 'THB' }).format(total);
    // Update the button span with the formatted total (remove the currency code if present)
    var totalElem = document.getElementById('totalSales');
    if (totalElem) {
      totalElem.textContent = formattedTotal.replace('THB', '฿');
    }
  });
</script>

    
</body>
</html>