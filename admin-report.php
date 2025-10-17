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
                <div class="text-muted small">ยอดชำระสำเร็จทั้งหมด</div>
                <div class="fs-4 fw-bold">฿ <?=getPayAmount()?></div>
              </div>
              <i class="bi bi-cash-coin fs-2"></i>
            </div>
            <div class="progress mt-2" style="height:8px;">
              <div class="progress-bar" style="width: 68%"></div>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-4">
          <div class="card auto-card p-3">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <div class="text-muted small">ยอดชำระสำเร็จ (เดือนนี้)</div>
                <div class="fs-4 fw-bold">฿ <?=getPayAmountByMonth()?></div>
              </div>
              <i class="bi bi-journal-check fs-2"></i>
            </div>
            <div class="progress mt-2" style="height:8px;">
              <div class="progress-bar" style="width: 54%"></div>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-4">
          <div class="card auto-card p-3">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <div class="text-muted small">จำนวนการจอง (เดือนนี้)</div>
                <div class="fs-4 fw-bold"><?=getCountReserved()?></div>
              </div>
              <i class="bi bi-graph-up-arrow fs-2"></i>
            </div>
            <div class="progress mt-2" style="height:8px;">
              <div class="progress-bar" style="width: 91%"></div>
            </div>
          </div>
        </div>
      </div>

      <!-- Filters -->
      <div class="card auto-card p-3 p-md-4 mb-4">
        <form class="row g-3">
          <div class="col-5 col-md-5">
            <label class="form-label">ตั้งแต่</label>
            <input type="date" class="form-control" name="start_date">
          </div>
          <div class="col-5 col-md-5">
            <label class="form-label">ถึง</label>
            <input type="date" class="form-control" name="end_date">
          </div>
          <div class="col-2 col-md-2 d-flex align-items-end">
            <div class="d-flex gap-2 w-100">
              <button class="btn btn-primary w-100" type="submit"><i class="bi bi-search"></i> ดูรายงาน</button>
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
              <?php foreach (getSumTotalTable() as $key => $row): ?>
              <tr>
                <td><?=$key + 1?></td>
                <td><?=$row['reserved_id']?></td>
                <td><?=$row['reserved_name']?></td>
                <td><?=$row['car_name']?></td>
                <td><?=$row['date_time']?></td>
                <td>฿<?=number_format($row['total'], 2)?></td>
                <td>
                  <?php
                    switch ($row['is_return']) {
                        case '1':
                          echo "
                              <span class='badge text-bg-success'>คืนแล้ว</span>
                            ";
                          break;
                        case '0':
                          echo "
                            <span class='badge text-bg-danger'>อยู่ระหว่างการยืม</span>
                            ";
                          break;
                      }
                  ?>
                </td>
              </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
        <!-- Pagination -->
        <nav class="mt-3" aria-label="transactions page">
          
         
          <ul class="pagination justify-content-end">
             <button type="button" class="btn btn-primary me-2" >
            รวมยอดขาย: <span id="totalSales">฿<?=getSumTotal()?></span>
          </button>

        </nav>
      </div>
    </div>
  </section>
</div>

<?php include 'footer.php'; ?>

    
</body>
</html>