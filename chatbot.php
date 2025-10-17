
<link rel="stylesheet" href="css/chatbot.css">
<button class="chat-toggle" id="chatToggle" aria-haspopup="dialog" aria-controls="chatPopup" aria-expanded="false" aria-label="เปิดแชทบอท">
  <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
    <path d="M7 9h6M7 13h10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
    <path d="M12 21c-4.97 0-9-3.582-9-8s4.03-8 9-8 9 3.582 9 8c0 2.01-.76 3.86-2.05 5.3l.8 2.5a1 1 0 0 1-1.27 1.26l-2.52-.81A9.64 9.64 0 0 1 12 21Z"
          stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
  </svg>
</button>
<section class="chat-popup" id="chatPopup" role="dialog" aria-modal="true" aria-label="หน้าต่างสนทนา">
  <header class="chat-header">
    <div class="chat-avatar">AI</div>
    <div>
      <div class="chat-title">Auto Assistant</div>
      <div class="chat-sub">พร้อมช่วยค้นหารถ/ตอบคำถาม</div>
    </div>
    <button class="chat-close" id="chatClose" aria-label="ปิดแชท">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true">
        <path d="M6 6l12 12M18 6L6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
      </svg>
    </button>
  </header>

  <main class="chat-body" id="chatBody">
    <div class="msg bot">
      สวัสดีค่ะ 👋 ต้องการความช่วยเหลือเรื่องอะไรดีคะ?
      <span class="time">ตอนนี้</span>
    </div>
    <div class="msg user">
      อยากดูรถเช่าที่แนะนำหน่อยครับ
      <span class="time">ตอนนี้</span>
    </div>
  </main>

  <form class="chat-input" id="chatForm" onsubmit="return false;">
    <input id="chatText" type="text" placeholder="พิมพ์ข้อความ..." autocomplete="off" />
    <button class="send-btn" id="sendBtn" type="submit">ส่ง</button>
  </form>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
  const popup   = document.getElementById('chatPopup');
  const toggle  = document.getElementById('chatToggle');
  const closeBt = document.getElementById('chatClose');
  const form    = document.getElementById('chatForm');
  const input   = document.getElementById('chatText');
  const body    = document.getElementById('chatBody');

  const openPopup = () => {
    popup.classList.add('open');
    toggle.setAttribute('aria-expanded', 'true');
    setTimeout(() => input.focus(), 120);
  };
  const closePopup = () => {
    popup.classList.remove('open');
    toggle.setAttribute('aria-expanded', 'false');
  };

  toggle.addEventListener('click', () => {
    popup.classList.contains('open') ? closePopup() : openPopup();
  });
  closeBt.addEventListener('click', closePopup);

  // ===== ฟังก์ชันป้องกัน XSS =====
  function escapeHtml(str){
    return str.replace(/[&<>"']/g, s => ({
      '&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'
    }[s]));
  }

  // ===== ส่งข้อความ (UI + AJAX) =====
  form.addEventListener('submit', e => {
    e.preventDefault();
    const text = input.value.trim();
    if(!text) return;

    // สร้างข้อความฝั่ง user
    const m = document.createElement('div');
    m.className = 'msg user';
    m.innerHTML = `${escapeHtml(text)}<span class="time">ส่งแล้ว</span>`;
    body.appendChild(m);
    input.value = '';
    body.scrollTop = body.scrollHeight;

    // สร้างบับเบิลของ bot แบบ loading
    const b = document.createElement('div');
    b.className = 'msg bot';
    b.innerHTML = `<span class="loading">...</span>`;
    body.appendChild(b);
    body.scrollTop = body.scrollHeight;

    // ส่ง AJAX ไป PHP
    $.ajax({
      type: "POST",
      url: "api/AIChat.php",
      data: { question: text },
      dataType: "json",
      success: function (response) {
        b.innerHTML = escapeHtml(response?.answer || "ไม่มีคำตอบ");
        body.scrollTop = body.scrollHeight;
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error("AJAX error:", textStatus, errorThrown);
        console.log("Response text:", jqXHR.responseText);
        b.innerHTML = "<span class='error'>เกิดข้อผิดพลาดในการเชื่อมต่อ</span>";
      }
    });
  });
</script>
