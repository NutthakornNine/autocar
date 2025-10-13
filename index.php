
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>AutoHub — ตัวกลางบริการรถเช่า</title>
    <style>
        .sriracha-regular {
            font-family: "Sriracha", cursive;

        }

        .hero {
            position: relative;
        }

        .hero-img {
            width: 100%;
            height: 360px;
            object-fit: cover;
            filter: contrast(1.02) saturate(1.05);
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #fff;
            background: linear-gradient(180deg, rgba(0, 0, 0, .0), rgba(0, 0, 0, .35));
            text-align: center;
            padding: 16px;
        }

        .hero-title {
            font-size: 60px;
            text-shadow: 0 4px 16px rgba(0, 0, 0, .35);
            border-right: .12em solid #f0eaeaff;

        }

        @keyframes blink {
            50% {
                border-color: transparent;
            }

        }

        @keyframes reveal {
            to {
                background-size: 100% 100%;
            }
        }

        @keyframes typing {
            to {
                width: var(--chars)ch;
            }
        }

        @keyframes blink {
            50% {
                border-color: transparent;
            }
        }

        .hero-sub {
            opacity: .95;
            margin-top: 6px;
            font-size: 20px;
            text-shadow: 0 4px 16px rgba(0, 0, 0, .35);
        }
    </style>
    <?php include 'header.php' ?>

</head>

<body>
    <?php include 'menu.php'; ?> 
    <section class="hero">
        <img src="assets/banner.png" class="hero-img" alt="Autocar Banner" />
        <div class="hero-overlay">
            <h1 class="hero-title" id="typing"></h1>
            <p class="hero-sub">ดีลพิเศษจากผู้ให้บริการทั่วไทย </p>
        </div>
    </section>

    <section style="background:#f4f8ff;border-bottom:1px solid #e3eefb;padding:80px 0;">
            <div style="max-width:1400px;margin:0 auto;padding:0 16px;">
                <div class="card shadow rounded-4 p-4">
                    <div class="row">
                        <div class="col-12 col-md-4 col-lg-4">
                            <div class="form-group">
                                <label for="booking-ref">เลือกจังหวัดที่ต้องการจอง</label>
                                <select id="booking-ref" name="province" class="form-control form-select shadow-4" data-placeholder="เลือกรถ">
                                    <option value="" disabled selected>กรุณาเลือก</option>
                                    <?php foreach (getProvince() as $p): ?>
                                        <option value="<?=$p['id']?>"><?=$p['name_th']?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="start-date">วันที่ต้องการเช่า</label>
                                <input type="text" id="datetime" name="datetime">
                            </div>
                        </div>
                        <div class="col-12 col-md-2 col-lg-2" style="margin-top: 35px;">
                            <button type="submit" class="submit-btn w-100 mb-3">ค้นหา</button>
                        </div>

                    </div>
                </div>
        </form>
    </section>
    <div class="container ">
         <h3><b>รถแนะนำ</b></h3> <hr>
    </div>
    <section id="car-list ">
        <div class="container ">
            <div class="row row-cols-1 row-cols-md-2 g-4">
                 <?php foreach (getCarListNoOwner() as $car) : ?>
                <div class="col" data-aos="fade-up">
                    <div class="card">
                        <img src="upload/<?= explode(",", $car['car_image'])[0] ?>" class="card-img-top fixed-img" alt="...">
                        <div class="card-body">
                            <h4 class="card-title"><b><?=$car['car_name']?></b> </h4>
                            <p class="card-text"><?=$car['car_detail']?></p>
                             <div class="d-flex justify-content-between align-items-center">
                                <div>
                                <b> <h3><span class="fw-bold">฿<?=$car['price_per_day']?></span><span class="text-muted">/วัน</span> </b></h3> 
                                </div>
                                <div class="d-flex gap-2">
                                <a href="car.php" class="btn btn-outline-primary btn-lg ">ดูรายละเอียด</a>
                                <a href="checkout.php?car_id=<?=$car['car_id']?>" class="btn btn-primary btn-lg ">จองทันที</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                  <?php endforeach ?>
        </div>
    </section> <br><br>

    <?php include 'chatbot.php' ?>
   <?php include 'footer.php' ?>
    </script>

    <script>
        $('#datetime').daterangepicker({
           locale: {
             format: 'YYYY-MM-DD',
             separetor: ' - '
           }
        });
        $( '#booking-ref' ).select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
        } );
        const texts = [
            "ค้นหารถเช่าที่ใช่ ในราคาที่ชอบ...",
            "เปรียบเทียบราคา สะดวก ปลอดภัย",
            "คิดถึงรถเช่านึกถึง Auto Car",
        ];

        let textIndex = 0;
        let charIndex = 0;
        let isDeleting = false;
        const speed = 170;
        const delay = 1700;

        function typeWriter() {
            const currentText = texts[textIndex];
            const typingDiv = document.getElementById("typing");

            if (!isDeleting) {
                typingDiv.textContent = currentText.substring(0, charIndex++);
                if (charIndex > currentText.length) {
                    isDeleting = true;
                    setTimeout(typeWriter, delay);
                    return;
                }
            } else {
                typingDiv.textContent = currentText.substring(0, charIndex--);
                if (charIndex < 0) {
                    isDeleting = false;
                    textIndex = (textIndex + 1) % texts.length; // ไปข้อความถัดไป
                }
            }
            setTimeout(typeWriter, isDeleting ? speed / 2 : speed);
        }

        typeWriter();

        $("#form-search").on("submit", function (e) {
            this.submit();
        });
    </script>


</body>

</html>