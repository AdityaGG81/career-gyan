/**
 * CareerGyan AI Chatbot Widget
 * Embed directly on careergyan.in or call via custom JavaScript
 */
(function () {
  const API_ENDPOINT = (function () {
    // Automatically detect host from the script src tag
    const scripts = document.getElementsByTagName("script");
    for (let i = 0; i < scripts.length; i++) {
      if (scripts[i].src && scripts[i].src.includes("widget.js")) {
        const url = new URL(scripts[i].src);
        return `${url.protocol}//${url.host}/api/chat`;
      }
    }
    return "http://localhost:8000/api/chat";
  })();

  // Global helper if website already has custom UI
  window.CareerGyanAI = {
    chat: async function (message, history = []) {
      const res = await fetch(API_ENDPOINT, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ message, history })
      });
      return await res.json();
    }
  };

  // Only create floating widget if no custom widget container exists
  if (document.getElementById("careergyan-ai-bubble")) return;

  const style = document.createElement("style");
  style.innerHTML = `
    #careergyan-ai-bubble {
      position: fixed;
      bottom: 24px;
      right: 24px;
      z-index: 999999;
      font-family: 'DM Sans', system-ui, -apple-system, sans-serif;
    }
    .cg-launcher-btn {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      background: linear-gradient(135deg, #1a56db, #1341a8);
      color: #fff;
      border: none;
      box-shadow: 0 8px 24px rgba(26, 86, 219, 0.4);
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 26px;
      transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .cg-launcher-btn:hover {
      transform: scale(1.08) translateY(-2px);
      box-shadow: 0 12px 30px rgba(26, 86, 219, 0.5);
    }
    .cg-chat-window {
      position: fixed;
      bottom: 96px;
      right: 24px;
      width: 380px;
      max-width: calc(100vw - 48px);
      height: 560px;
      max-height: calc(100vh - 120px);
      background: #ffffff;
      border-radius: 20px;
      box-shadow: 0 16px 48px rgba(15, 23, 42, 0.2);
      border: 1px solid #e2e8f0;
      display: flex;
      flex-direction: column;
      overflow: hidden;
      opacity: 0;
      pointer-events: none;
      transform: translateY(20px) scale(0.96);
      transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
      z-index: 999999;
    }
    .cg-chat-window.active {
      opacity: 1;
      pointer-events: auto;
      transform: translateY(0) scale(1);
    }
    .cg-chat-header {
      background: linear-gradient(135deg, #1a56db, #1e3a8a);
      color: #ffffff;
      padding: 16px 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .cg-header-info h4 {
      margin: 0;
      font-size: 16px;
      font-weight: 700;
    }
    .cg-header-info p {
      margin: 2px 0 0;
      font-size: 12px;
      opacity: 0.85;
    }
    .cg-close-btn {
      background: none;
      border: none;
      color: #fff;
      font-size: 20px;
      cursor: pointer;
      opacity: 0.8;
      transition: 0.2s;
    }
    .cg-close-btn:hover { opacity: 1; }
    .cg-chat-messages {
      flex: 1;
      padding: 16px;
      overflow-y: auto;
      display: flex;
      flex-direction: column;
      gap: 12px;
      background: #f8fafc;
    }
    .cg-msg {
      max-width: 85%;
      padding: 10px 14px;
      border-radius: 14px;
      font-size: 14px;
      line-height: 1.5;
    }
    .cg-msg.bot {
      background: #ffffff;
      color: #0f172a;
      border: 1px solid #e2e8f0;
      align-self: flex-start;
      border-bottom-left-radius: 4px;
    }
    .cg-msg.user {
      background: #1a56db;
      color: #ffffff;
      align-self: flex-end;
      border-bottom-right-radius: 4px;
    }
    .cg-sources {
      margin-top: 8px;
      font-size: 11.5px;
      border-top: 1px solid #e2e8f0;
      padding-top: 6px;
    }
    .cg-sources a {
      color: #1a56db;
      text-decoration: underline;
      display: inline-block;
      margin-right: 8px;
    }
    .cg-chat-input-box {
      display: flex;
      padding: 12px;
      background: #ffffff;
      border-top: 1px solid #e2e8f0;
      gap: 8px;
    }
    .cg-chat-input {
      flex: 1;
      border: 1px solid #e2e8f0;
      border-radius: 24px;
      padding: 10px 16px;
      font-size: 14px;
      outline: none;
      font-family: inherit;
    }
    .cg-chat-input:focus {
      border-color: #1a56db;
    }
    .cg-send-btn {
      background: #1a56db;
      color: #fff;
      border: none;
      border-radius: 50%;
      width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      font-size: 16px;
      transition: 0.2s;
    }
    .cg-send-btn:hover {
      background: #1341a8;
    }
    .cg-typing {
      font-style: italic;
      color: #64748b;
      font-size: 13px;
    }
  `;
  document.head.appendChild(style);

  // Markup
  const container = document.createElement("div");
  container.id = "careergyan-ai-bubble";
  container.innerHTML = `
    <div class="cg-chat-window" id="cgChatWindow">
      <div class="cg-chat-header">
        <div class="cg-header-info">
          <h4>CareerGyan Assistant</h4>
          <p>Ask anything about careers, exams & colleges</p>
        </div>
        <button class="cg-close-btn" id="cgCloseBtn">&times;</button>
      </div>
      <div class="cg-chat-messages" id="cgChatMessages">
        <div class="cg-msg bot">
          👋 Hi! I am the official CareerGyan Career Assistant. How can I help you explore courses, colleges, or entrance exams today?
        </div>
      </div>
      <form class="cg-chat-input-box" id="cgChatForm">
        <input type="text" class="cg-chat-input" id="cgChatInput" placeholder="Ask about colleges, careers, MHT CET..." autocomplete="off" />
        <button type="submit" class="cg-send-btn" id="cgSendBtn">➤</button>
      </form>
    </div>
    <button class="cg-launcher-btn" id="cgLauncherBtn">💬</button>
  `;
  document.body.appendChild(container);

  // Widget Logic
  const launcher = document.getElementById("cgLauncherBtn");
  const chatWin = document.getElementById("cgChatWindow");
  const closeBtn = document.getElementById("cgCloseBtn");
  const form = document.getElementById("cgChatForm");
  const input = document.getElementById("cgChatInput");
  const messagesBox = document.getElementById("cgChatMessages");

  let conversationHistory = [];

  function toggleChat() {
    chatWin.classList.toggle("active");
    if (chatWin.classList.contains("active")) {
      input.focus();
    }
  }

  launcher.addEventListener("click", toggleChat);
  closeBtn.addEventListener("click", toggleChat);

  function appendMessage(role, text, sources = []) {
    const msgDiv = document.createElement("div");
    msgDiv.className = `cg-msg ${role}`;
    msgDiv.innerText = text;

    if (sources && sources.length > 0) {
      const srcDiv = document.createElement("div");
      srcDiv.className = "cg-sources";
      srcDiv.innerHTML = "<strong>Sources:</strong> " + sources.map(s => `<a href="${s.url}" target="_blank">${s.title || s.url}</a>`).join(" ");
      msgDiv.appendChild(srcDiv);
    }

    messagesBox.appendChild(msgDiv);
    messagesBox.scrollTop = messagesBox.scrollHeight;
  }

  form.addEventListener("submit", async function (e) {
    e.preventDefault();
    const query = input.value.trim();
    if (!query) return;

    input.value = "";
    appendMessage("user", query);
    conversationHistory.push({ role: "user", content: query });

    // Typing indicator
    const typing = document.createElement("div");
    typing.className = "cg-msg bot cg-typing";
    typing.innerText = "Consulting CareerGyan knowledge base...";
    messagesBox.appendChild(typing);
    messagesBox.scrollTop = messagesBox.scrollHeight;

    try {
      const data = await window.CareerGyanAI.chat(query, conversationHistory);
      typing.remove();
      appendMessage("bot", data.reply, data.sources);
      conversationHistory.push({ role: "assistant", content: data.reply });
    } catch (err) {
      typing.remove();
      appendMessage("bot", "Sorry, I am having trouble reaching the server right now. Please verify the API is running.");
    }
  });
})();
