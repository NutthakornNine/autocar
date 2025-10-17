<?php
session_start();
if (empty($_SESSION['userid'])) {
  header("location: login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>สรุปและชำระเงิน — AutoHub</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <?php include 'header.php'; ?>
  <?php $data = getCarListById(); ?>
</head>

<body>

  <?php include 'menu.php'; ?> <br><br>
  <main class="container-xxl py-5 mt-5">
    <style>
      body {
        background: #f6f8fb
      }

      .section-card {
        border: 0;
        border-radius: 1.25rem;
        box-shadow: 0 6px 24px rgba(0, 0, 0, .06)
      }

      .section-title {
        font-weight: 800;
        letter-spacing: .2px
      }

      .hint {
        font-size: .925rem;
        color: #6c757d
      }

      .bank-box {
        background: #f8fafc;
        border: 1px dashed #cbd5e1;
        border-radius: .85rem
      }

      .qr-img {
        width: 100%;
        max-width: 420px;
        height: auto;
        border-radius: 1rem
      }

      .sum-img {
        width: 140px;
        height: 96px;
        object-fit: cover;
        border-radius: 1rem
      }

      .sum-label {
        color: #64748b
      }

      .btn-xl {
        padding: .95rem 1.25rem;
        font-size: 1.125rem;
        border-radius: .9rem
      }

      .form-control-lg,
      .form-select-lg {
        padding: .9rem 1rem;
        font-size: 1.05rem;
        border-radius: .9rem
      }
    </style>

    <form method="post" id="reserved" enctype="multipart/form-data">
      <div class="row g-4 g-xl-5">

        <!-- LEFT -->
        <section class="col-lg-7">
          <!-- ข้อมูลผู้เช่า -->
          <div class="section-card p-4 p-md-5 mb-4 bg-white">
            <h5 class="section-title mb-4">ข้อมูลผู้เช่า</h5>
            <div class="row g-3">
              <div class="col-md-6">
                <input class="form-control form-control-lg" name="firstname" placeholder="ชื่อ"
                  value="<?= $_SESSION['users']['fullname'] ?? '' ?>">
              </div>
              <div class="col-md-6">
                <input class="form-control form-control-lg" name="lastname" placeholder="นามสกุล"
                  value="<?= $_SESSION['users']['lastname'] ?? '' ?>">
              </div>
              <div class="col-md-6">
                <input class="form-control form-control-lg" name="email" placeholder="อีเมล"
                  value="<?= $_SESSION['users']['email'] ?? '' ?>">
              </div>
              <div class="col-md-6">
                <input class="form-control form-control-lg" name="phone" placeholder="โทรศัพท์"
                  value="<?= $_SESSION['users']['phone'] ?? '' ?>">
              </div>
              <div class="col-12">
                <input class="form-control form-control-lg" name="address" placeholder="ที่อยู่สำหรับติดต่อ"
                  value="<?= $_SESSION['users']['address'] ?? '' ?>">
              </div>
            </div>
          </div>

          <!-- วิธีชำระเงิน -->
          <div class="section-card p-4 p-md-5 bg-white">
            <h5 class="section-title mb-4">วิธีชำระเงิน</h5>

            <div class="row g-3 align-items-center mb-2">
              <div class="col-auto">
                <div class="form-check">
                  <input class="form-check-input pay_type" type="radio" id="pay_transfer"
                    name="pay_type" value="transfer" checked>
                  <label class="form-check-label" for="pay_transfer">โอนผ่านธนาคาร</label>
                </div>
              </div>
              <div class="col-auto">
                <div class="form-check">
                  <input class="form-check-input pay_type" type="radio" id="pay_qr"
                    name="pay_type" value="qrcode">
                  <label class="form-check-label" for="pay_qr">สแกนจ่าย (QR พร้อมเพย์)</label>
                </div>
              </div>
            </div>

            <!-- โอนผ่านธนาคาร -->
            <div id="bankBox" class="bank-box p-3 p-md-4 mb-3">
              <label class="form-label mb-2">หมายเลขบัญชี</label>
              <div class="input-group input-group-lg">
                <input class="form-control" id="book_number" name="book_number" readonly
                  value="153-8-51851-0">
                <button class="btn btn-outline-secondary" type="button" id="btnCopy">คัดลอก</button>
              </div>
              <div class="hint mt-2">ชื่อบัญชี: บริษัท ออโรร่าคาร์ เรนทัล จำกัด (ธ.กสิกรไทย)</div>
            </div>

            <!-- QR Code -->
            <div id="qrBox" class="text-center mb-3" style="display:none;">
              <img src="assets/qrcode.jpeg" class="qr-img" alt="QR พร้อมเพย์">
              <div class="hint mt-2">สแกนด้วยแอปธนาคารของคุณเพื่อชำระเงิน</div>
            </div>

            <!-- อัปโหลดสลิป -->
            <div class="row g-3">
              <div class="col-md-8">
                <label for="slip" class="form-label">อัปโหลดสลิปโอนเงิน</label>
                <input type="file" name="slip" id="slip" class="form-control form-control-lg" required accept="image/*">
                <div class="hint mt-2">รองรับ: JPG, PNG, WEBP ขนาดไม่เกิน 5MB</div>
                <img id="slipPreview" style="display:none;" class="mt-3 rounded-3 w-100" />
              </div>
            </div>

            <button id="fakePay" class="btn btn-primary btn-xl mt-4 w-100" name="fakePay">
              ชำระเงิน
            </button>
          </div>

          <!-- Hidden fields -->
          <input type="hidden" name="car_id" value="<?= $_GET['car_id'] ?? '' ?>">
          <input type="hidden" name="user_id" value="<?= $_SESSION['userid'] ?? '' ?>">
          <input type="hidden" name="start_date" value="<?= $_GET['start_date'] ?? '' ?>">
          <input type="hidden" name="end_date" value="<?= $_GET['end_date'] ?? '' ?>">
          <input type="hidden" name="pay" value="1">
          <input type="hidden" name="status" value="1">
        </section>

        <!-- RIGHT -->
        <aside class="col-lg-5">
          <div class="section-card p-4 p-md-5 bg-white position-sticky top-0">
            <div class="d-flex align-items-start">
              <img id="sumImg" src="upload/<?= explode(",", $data['car_image'])[0] ?>" class="sum-img me-3" alt="sum">
              <div>
                <div id="sumTitle" class="fw-bold fs-5 mb-1"><?= $data['car_name'] ?></div>
                <div id="sumMeta" class="small text-secondary"><?= $data['car_detail'] ?></div>
              </div>
            </div>

            <hr class="my-4">

            <div class="d-flex justify-content-between">
              <div class="sum-label">วันที่เช่า</div>
              <div class="fw-semibold">
                <?= $_GET['start_date'] ?? '-' ?> – <?= $_GET['end_date'] ?? '-' ?>
              </div>
            </div>
            <div class="d-flex justify-content-between mt-2">
              <div class="sum-label">ราคารายวัน</div>
              <div class="fw-semibold">฿<?= number_format($data['price_per_day'], 2) ?></div>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
              <div class="fs-6">ราคาสุทธิ</div>
              <div id="sumPrice" class="fw-bold fs-4">
                ฿<?= number_format($data['price_per_day'] * $data['total_day'], 2) ?>
              </div>
            </div>
            <div class="hint mt-2">* ราคารวมจะคำนวณตอนชำระ</div>
          </div>
        </aside>

      </div>
    </form>

    <script>
      // Toggle โหมดชำระเงิน
      document.querySelectorAll('.pay_type').forEach(r => {
        r.addEventListener('change', function() {
          const isQR = this.value === 'qrcode';
          document.getElementById('qrBox').style.display = isQR ? 'block' : 'none';
          document.getElementById('bankBox').style.display = isQR ? 'none' : 'block';
        });
      });

      // คัดลอกเลขบัญชี
      document.getElementById('btnCopy')?.addEventListener('click', async () => {
        const val = document.getElementById('book_number').value;
        try {
          await navigator.clipboard.writeText(val);
          const old = document.getElementById('btnCopy').textContent;
          document.getElementById('btnCopy').textContent = 'คัดลอกแล้ว ✓';
          setTimeout(() => {
            document.getElementById('btnCopy').textContent = old;
          }, 1200);
        } catch (e) {
          alert('คัดลอกไม่สำเร็จ');
        }
      });

      // พรีวิวสลิป
      document.getElementById('slip')?.addEventListener('change', function(e) {
        const file = e.target.files?.[0];
        const prev = document.getElementById('slipPreview');
        if (!file) {
          prev.style.display = 'none';
          return;
        }
        const url = URL.createObjectURL(file);
        prev.src = url;
        prev.style.display = 'block';
      });
    </script>
  </main>


  <?php include 'footer.php'; ?>

  <script>
    $(document).ready(function() {

      $(document).on("change", ".pay_type", function(e) {
        e.preventDefault();
        const state = $(this).val();
        if (state == 'transfer') {
          $("#book_number").attr("hidden", false);
          $("#qrcode").attr("hidden", true);
        } else {
          $("#qrcode").attr("hidden", false);
          $("#book_number").attr("hidden", true);
        }
      });
      $("#reserved").on("submit", function(e) {
        e.preventDefault();
        const formData = $(this)[0];
        const params = new FormData(formData);
        $.ajax({
          type: "POST",
          url: "api/reserved.api.php",
          data: params,
          processData: false,
          contentType: false,
          success: function(response) {
            if (response == 'success') {
              Swal.fire(
                'ดำเนินการเช่าสำเร็จ',
                'Car rental successful.',
                'success'
              )
              setTimeout(() => {
                window.location.href = "bookings.php";
              }, 2000);
            } else {
              Swal.fire(
                'ดำเนินการเช่าสไม่เร็จ',
                'Error',
                'error'
              )
            }
          }
        });
      });

    });
  </script>

</body>

</html>