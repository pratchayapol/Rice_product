<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Chatbot ระบบโภชนาการข้าวไทย</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex flex-col h-screen">

  <!-- Header -->
  <header class="bg-green-600 text-white text-xl font-semibold px-6 py-4 shadow">
    Chatbot โภชนาการข้าวไทย 🌾
  </header>

  <!-- Chat Area -->
  <main class="flex-1 overflow-y-auto p-4 space-y-4" id="chatbox">
    <!-- Chat messages will appear here -->
  </main>

  <!-- Input Box -->
  <footer class="p-4 bg-white border-t flex items-center space-x-2">
    <input id="userInput"
           type="text"
           placeholder="พิมพ์คำถามเกี่ยวกับข้าวที่นี่..."
           class="flex-1 border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"/>
    <button onclick="sendMessage()"
            class="bg-green-600 text-white px-4 py-2 rounded-xl hover:bg-green-700 transition">
      ส่ง
    </button>
  </footer>

  <!-- Script -->
  <script>
    async function sendMessage() {
      const input = document.getElementById('userInput');
      const message = input.value.trim();
      if (!message) return;

      // แสดงข้อความผู้ใช้
      appendMessage('user', message);
      input.value = '';

      // เรียก API (คุณสามารถเปลี่ยน URL นี้ไปยัง PHP หรือ Rasa API)
      try {
        const res = await fetch('/chat-api.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ message })
        });
        const data = await res.json();
        appendMessage('bot', data.reply || 'เกิดข้อผิดพลาด...');
      } catch (error) {
        appendMessage('bot', 'เกิดข้อผิดพลาดในการเชื่อมต่อเซิร์ฟเวอร์');
      }
    }

    function appendMessage(sender, text) {
      const chatbox = document.getElementById('chatbox');
      const align = sender === 'user' ? 'justify-end' : 'justify-start';
      const bg = sender === 'user' ? 'bg-green-100 text-right' : 'bg-white';
      const bubble = `
        <div class="flex ${align}">
          <div class="max-w-sm p-3 rounded-xl shadow ${bg}">${text}</div>
        </div>
      `;
      chatbox.insertAdjacentHTML('beforeend', bubble);
      chatbox.scrollTop = chatbox.scrollHeight;
    }
  </script>

</body>
</html>
