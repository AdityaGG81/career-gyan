@php
    $gurujiAvatar = asset('images/ai-career-guruji/ai-career-guruji-avatar.svg');
@endphp

<style>
    .ai-career-guruji-widget {
        position: fixed !important;
        right: 24px !important;
        bottom: 24px !important;
        z-index: 999999 !important;
        font-family: 'Inter', system-ui, sans-serif;
    }

    .ai-career-guruji-fab-wrap {
        position: absolute;
        bottom: 0;
        right: 0;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 10px;
    }

    .ai-career-guruji-label {
        background: #ffffff;
        color: #1e3a8a;
        font-size: 12px;
        font-weight: 700;
        padding: 6px 12px;
        border-radius: 999px;
        box-shadow: 0 4px 14px rgba(15, 23, 42, 0.12);
        border: 1px solid #bfdbfe;
        white-space: nowrap;
        pointer-events: none;
        opacity: 0;
        transform: translateY(6px);
        transition: opacity 0.25s ease, transform 0.25s ease;
    }

    .ai-career-guruji-widget:hover .ai-career-guruji-label,
    .ai-career-guruji-widget:focus-within .ai-career-guruji-label {
        opacity: 1;
        transform: translateY(0);
    }

    .ai-career-guruji-button {
        position: relative;
        width: 64px;
        height: 64px;
        border: none;
        border-radius: 50%;
        padding: 0;
        cursor: pointer;
        background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 55%, #38bdf8 100%);
        box-shadow: 0 6px 22px rgba(29, 78, 216, 0.45);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        animation: gurujiPulse 2.8s ease-in-out infinite;
        outline: none;
    }

    .ai-career-guruji-button:hover,
    .ai-career-guruji-button:focus-visible {
        transform: scale(1.06) translateY(-2px);
        box-shadow: 0 10px 28px rgba(29, 78, 216, 0.55);
    }

    .ai-career-guruji-button::before {
        content: '';
        position: absolute;
        inset: -4px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(56, 189, 248, 0.35) 0%, transparent 70%);
        z-index: -1;
        animation: gurujiGlow 2.8s ease-in-out infinite;
    }

    @keyframes gurujiPulse {
        0%, 100% { box-shadow: 0 6px 22px rgba(29, 78, 216, 0.4); }
        50% { box-shadow: 0 8px 28px rgba(56, 189, 248, 0.55); }
    }

    @keyframes gurujiGlow {
        0%, 100% { opacity: 0.5; transform: scale(1); }
        50% { opacity: 1; transform: scale(1.08); }
    }

    .ai-career-guruji-avatar {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
        display: block;
        border: 2px solid rgba(255, 255, 255, 0.85);
    }

    .ai-career-guruji-online-dot {
        position: absolute;
        top: 2px;
        right: 2px;
        width: 14px;
        height: 14px;
        background: #10b981;
        border: 2px solid #fff;
        border-radius: 50%;
        z-index: 2;
    }

    .ai-career-guruji-ai-badge {
        position: absolute;
        bottom: -2px;
        left: -2px;
        background: #f59e0b;
        color: #1e3a8a;
        font-size: 9px;
        font-weight: 800;
        padding: 2px 6px;
        border-radius: 8px;
        border: 1.5px solid #fff;
        line-height: 1;
        z-index: 2;
        letter-spacing: 0.5px;
    }

    .ai-career-guruji-tooltip {
        position: absolute;
        right: 72px;
        bottom: 18px;
        background: #0f172a;
        color: #fff;
        font-size: 12px;
        font-weight: 600;
        padding: 8px 12px;
        border-radius: 8px;
        white-space: nowrap;
        opacity: 0;
        pointer-events: none;
        transform: translateX(8px);
        transition: opacity 0.2s ease, transform 0.2s ease;
    }

    .ai-career-guruji-tooltip::after {
        content: '';
        position: absolute;
        right: -5px;
        top: 50%;
        transform: translateY(-50%);
        border: 5px solid transparent;
        border-left-color: #0f172a;
    }

    .ai-career-guruji-button:hover + .ai-career-guruji-tooltip,
    .ai-career-guruji-button:focus-visible + .ai-career-guruji-tooltip {
        opacity: 1;
        transform: translateX(0);
    }

    .ai-career-guruji-panel {
        position: absolute;
        bottom: 82px;
        right: 0;
        width: 390px;
        height: 580px;
        max-height: calc(100vh - 120px);
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 16px 40px rgba(15, 23, 42, 0.18);
        display: flex;
        flex-direction: column;
        overflow: hidden;
        opacity: 0;
        pointer-events: none;
        transform: translateY(20px) scale(0.95);
        transform-origin: bottom right;
        transition: all 0.32s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 1px solid #e2e8f0;
    }

    .ai-career-guruji-panel.active {
        opacity: 1;
        pointer-events: auto;
        transform: translateY(0) scale(1);
    }

    .ai-career-guruji-header {
        background: linear-gradient(135deg, #0e1f6b 0%, #1e3a8a 40%, #2563eb 75%, #38bdf8 100%);
        padding: 16px 18px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        color: #fff;
        flex-shrink: 0;
    }

    .ai-career-guruji-header-info {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
    }

    .ai-career-guruji-header-avatar {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        border: 2px solid rgba(255, 255, 255, 0.75);
        background: #fff;
        flex-shrink: 0;
        object-fit: cover;
    }

    .ai-career-guruji-header-text h4 {
        margin: 0;
        font-family: 'Sora', sans-serif;
        font-size: 16px;
        font-weight: 700;
        line-height: 1.2;
    }

    .ai-career-guruji-header-text p {
        margin: 2px 0 0;
        font-size: 11.5px;
        opacity: 0.9;
        line-height: 1.3;
    }

    .ai-career-guruji-header-actions {
        display: flex;
        gap: 6px;
        flex-shrink: 0;
    }

    .ai-career-guruji-header-actions button {
        background: rgba(255, 255, 255, 0.15);
        border: none;
        color: #fff;
        width: 32px;
        height: 32px;
        border-radius: 8px;
        font-size: 14px;
        cursor: pointer;
        transition: background 0.2s;
    }

    .ai-career-guruji-header-actions button:hover {
        background: rgba(255, 255, 255, 0.28);
    }

    .ai-career-guruji-body {
        flex: 1;
        overflow-y: auto;
        background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);
        display: flex;
        flex-direction: column;
    }

    .ai-career-guruji-body::-webkit-scrollbar { width: 6px; }
    .ai-career-guruji-body::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }

    .ai-career-guruji-guest {
        padding: 32px 24px;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        flex: 1;
    }

    .ai-career-guruji-guest h5 {
        margin: 0 0 8px;
        font-size: 16px;
        color: #0f172a;
    }

    .ai-career-guruji-guest p {
        font-size: 13px;
        color: #64748b;
        margin: 0 0 16px;
    }

    .ai-career-guruji-login-btn {
        background: #1d4ed8;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 12px 24px;
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        display: inline-block;
        transition: background 0.2s;
    }

    .ai-career-guruji-login-btn:hover {
        background: #1e40af;
        color: #fff;
    }

    .ai-career-guruji-messages {
        display: none;
        flex-direction: column;
        gap: 14px;
        padding: 18px;
    }

    .ai-career-guruji-messages.active {
        display: flex;
    }

    .ai-career-guruji-msg {
        max-width: 88%;
        padding: 12px 15px;
        font-size: 14px;
        line-height: 1.55;
        border-radius: 16px;
        word-wrap: break-word;
    }

    .ai-career-guruji-msg.bot {
        background: #fff;
        color: #0f172a;
        border: 1px solid #e2e8f0;
        align-self: flex-start;
        border-bottom-left-radius: 4px;
        box-shadow: 0 2px 8px rgba(15, 23, 42, 0.06);
    }

    .ai-career-guruji-msg.user {
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
        color: #1e3a8a;
        align-self: flex-end;
        border-bottom-right-radius: 4px;
        box-shadow: 0 2px 8px rgba(29, 78, 216, 0.1);
    }

    .ai-career-guruji-suggestions {
        display: none;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 4px;
    }

    .ai-career-guruji-suggestions-chip {
        background: #fff;
        border: 1px solid #93c5fd;
        color: #1d4ed8;
        padding: 7px 12px;
        border-radius: 20px;
        font-size: 11.5px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        font-family: inherit;
        text-align: left;
        line-height: 1.3;
    }

    .ai-career-guruji-suggestions-chip:hover:not(:disabled) {
        background: #1d4ed8;
        color: #fff;
        border-color: #1d4ed8;
    }

    .ai-career-guruji-suggestions.disabled,
    .ai-career-guruji-suggestions-chip:disabled {
        pointer-events: none;
        opacity: 0.5;
        cursor: not-allowed;
    }

    .ai-career-guruji-typing {
        display: none;
        align-items: center;
        gap: 4px;
        padding: 12px 16px;
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        border-bottom-left-radius: 4px;
        align-self: flex-start;
        width: fit-content;
        box-shadow: 0 2px 6px rgba(15, 23, 42, 0.05);
    }

    .ai-career-guruji-typing.active { display: flex; }

    .ai-career-guruji-dot {
        width: 6px;
        height: 6px;
        background: #94a3b8;
        border-radius: 50%;
        animation: gurujiTyping 1.4s infinite ease-in-out both;
    }

    .ai-career-guruji-dot:nth-child(1) { animation-delay: -0.32s; }
    .ai-career-guruji-dot:nth-child(2) { animation-delay: -0.16s; }

    @keyframes gurujiTyping {
        0%, 80%, 100% { transform: scale(0); }
        40% { transform: scale(1); }
    }

    .ai-career-guruji-footer-wrap {
        background: #fff;
        border-top: 1px solid #e2e8f0;
        display: none;
        flex-direction: column;
        flex-shrink: 0;
    }

    .ai-career-guruji-footer-wrap.active { display: flex; }

    .ai-career-guruji-limit {
        padding: 8px 16px;
        font-size: 11px;
        color: #64748b;
        text-align: center;
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        font-weight: 600;
    }

    .ai-career-guruji-reset {
        display: block;
        margin-top: 4px;
        font-size: 10px;
        font-weight: 500;
        color: #94a3b8;
        background: none;
        border: none;
        cursor: pointer;
        text-decoration: underline;
        padding: 0;
        font-family: inherit;
    }

    .ai-career-guruji-reset:hover { color: #1d4ed8; }

    .ai-career-guruji-footer {
        padding: 14px 16px;
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .ai-career-guruji-input {
        flex: 1;
        border: 1px solid #e2e8f0;
        border-radius: 24px;
        padding: 12px 16px;
        font-size: 14px;
        outline: none;
        font-family: inherit;
        background: #f8fafc;
        transition: border-color 0.2s, background 0.2s;
    }

    .ai-career-guruji-input:focus {
        border-color: #2563eb;
        background: #fff;
    }

    .ai-career-guruji-input:disabled {
        background: #f1f5f9;
        cursor: not-allowed;
    }

    .ai-career-guruji-send {
        width: 44px;
        height: 44px;
        background: linear-gradient(135deg, #1e3a8a, #2563eb);
        color: #fff;
        border: none;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: transform 0.2s, box-shadow 0.2s;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(29, 78, 216, 0.3);
    }

    .ai-career-guruji-send:hover:not(:disabled) {
        transform: scale(1.05);
        box-shadow: 0 6px 16px rgba(29, 78, 216, 0.4);
    }

    .ai-career-guruji-send:disabled {
        background: #94a3b8;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    @media (max-width: 480px) {
        .ai-career-guruji-widget {
            right: 16px !important;
            bottom: 16px !important;
        }

        .ai-career-guruji-panel {
            width: calc(100vw - 32px);
            right: 0;
            bottom: 78px;
            height: min(520px, calc(100vh - 100px));
        }

        .ai-career-guruji-button {
            width: 58px;
            height: 58px;
        }

        .ai-career-guruji-label {
            font-size: 11px;
            padding: 5px 10px;
        }

        .ai-career-guruji-tooltip {
            display: none;
        }
    }
</style>

<div class="ai-career-guruji-widget" id="aiCareerGurujiWidget">
    <div class="ai-career-guruji-fab-wrap">
        <span class="ai-career-guruji-label">AI Career Guruji</span>

        <button
            type="button"
            class="ai-career-guruji-button"
            id="aiChatBtn"
            aria-label="Open AI Career Guruji"
        >
            <img
                src="{{ $gurujiAvatar }}"
                alt=""
                class="ai-career-guruji-avatar"
                width="64"
                height="64"
            >
            <span class="ai-career-guruji-online-dot" aria-hidden="true"></span>
            <span class="ai-career-guruji-ai-badge" aria-hidden="true">AI</span>
        </button>
        <span class="ai-career-guruji-tooltip" role="tooltip">Ask AI Career Guruji</span>
    </div>

    <div class="ai-career-guruji-panel" id="aiChatWindow" role="dialog" aria-label="AI Career Guruji chat">
        <header class="ai-career-guruji-header">
            <div class="ai-career-guruji-header-info">
                <img
                    src="{{ $gurujiAvatar }}"
                    alt=""
                    class="ai-career-guruji-header-avatar"
                    width="44"
                    height="44"
                >
                <div class="ai-career-guruji-header-text">
                    <h4>AI Career Guruji</h4>
                    <p>Your personal career guidance assistant</p>
                </div>
            </div>
            <div class="ai-career-guruji-header-actions">
                <button type="button" id="aiChatMinimize" aria-label="Minimize chat"><i class="fa-solid fa-minus"></i></button>
                <button type="button" id="aiChatClose" aria-label="Close chat"><i class="fa-solid fa-xmark"></i></button>
            </div>
        </header>

        <div class="ai-career-guruji-body" id="aiChatBodyContainer">
            @guest
            <div class="ai-career-guruji-guest">
                <i class="fa-solid fa-lock" style="font-size: 32px; color: #94a3b8; margin-bottom: 12px;"></i>
                <h5>Login Required</h5>
                <p>Please log in to chat with AI Career Guruji.</p>
                <a href="{{ route('login') }}" class="ai-career-guruji-login-btn">Log In to Chat</a>
            </div>
            @endguest

            <div class="ai-career-guruji-messages" id="aiChatMessages">
                <div class="ai-career-guruji-msg bot" id="aiChatWelcomeMsg"></div>

                <div class="ai-career-guruji-suggestions" id="aiChatSuggestions">
                    <button type="button" class="ai-career-guruji-suggestions-chip ai-chat-suggestion-chip" data-prompt="Which career options are available after 10th?">Careers after 10th</button>
                    <button type="button" class="ai-career-guruji-suggestions-chip ai-chat-suggestion-chip" data-prompt="Suggest best career options after 12th Science.">Careers after 12th Science</button>
                    <button type="button" class="ai-career-guruji-suggestions-chip ai-chat-suggestion-chip" data-prompt="Suggest best career options after 12th Commerce.">Careers after 12th Commerce</button>
                    <button type="button" class="ai-career-guruji-suggestions-chip ai-chat-suggestion-chip" data-prompt="Suggest best career options after 12th Arts.">Careers after 12th Arts</button>
                    <button type="button" class="ai-career-guruji-suggestions-chip ai-chat-suggestion-chip" data-prompt="How can I find top colleges for my career?">Find top colleges</button>
                    <button type="button" class="ai-career-guruji-suggestions-chip ai-chat-suggestion-chip" data-prompt="How can I take the Quick Test?">Take Quick Test</button>
                    <button type="button" class="ai-career-guruji-suggestions-chip ai-chat-suggestion-chip" data-prompt="Compare two careers for me.">Compare two careers</button>
                    <button type="button" class="ai-career-guruji-suggestions-chip ai-chat-suggestion-chip" data-prompt="Give me a step-by-step career roadmap.">Career roadmap</button>
                    <button type="button" class="ai-career-guruji-suggestions-chip ai-chat-suggestion-chip" data-prompt="Which entrance exams are required for my career?">Entrance exams guidance</button>
                    <button type="button" class="ai-career-guruji-suggestions-chip ai-chat-suggestion-chip" data-prompt="What skills are required for this career?">Skills required for a career</button>
                </div>

                <div class="ai-career-guruji-typing" id="aiChatTyping">
                    <div class="ai-career-guruji-dot"></div>
                    <div class="ai-career-guruji-dot"></div>
                    <div class="ai-career-guruji-dot"></div>
                </div>
            </div>
        </div>

        <div class="ai-career-guruji-footer-wrap" id="aiChatFooterWrapper">
            <div class="ai-career-guruji-limit" id="aiChatLimitInfo">
                Free questions left today: <span id="aiChatRemaining">5</span>/5
                <button type="button" class="ai-career-guruji-reset" id="aiChatResetDetails">Clear chat</button>
            </div>
            <div class="ai-career-guruji-footer">
                <input
                    type="text"
                    class="ai-career-guruji-input"
                    id="aiChatInput"
                    placeholder="Ask Guruji about careers, colleges, exams, skills..."
                    autocomplete="off"
                >
                <button type="button" class="ai-career-guruji-send" id="aiChatSend" aria-label="Send message">
                    <i class="fa-solid fa-paper-plane"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatBtn = document.getElementById('aiChatBtn');
    const chatWindow = document.getElementById('aiChatWindow');
    const minimizeBtn = document.getElementById('aiChatMinimize');
    const closeBtn = document.getElementById('aiChatClose');
    const chatMessages = document.getElementById('aiChatMessages');
    const chatFooterWrapper = document.getElementById('aiChatFooterWrapper');
    const chatBodyContainer = document.getElementById('aiChatBodyContainer');
    const welcomeMsg = document.getElementById('aiChatWelcomeMsg');
    const chatInput = document.getElementById('aiChatInput');
    const sendBtn = document.getElementById('aiChatSend');
    const typingIndicator = document.getElementById('aiChatTyping');
    const suggestionChips = document.querySelectorAll('.ai-chat-suggestion-chip');
    const suggestionsContainer = document.getElementById('aiChatSuggestions');
    const remainingText = document.getElementById('aiChatRemaining');
    const resetDetailsBtn = document.getElementById('aiChatResetDetails');

    const welcomeText = "Namaste! I'm AI Career Guruji 👋\nI can help you explore careers, colleges, entrance exams, skills, salary scope, and step-by-step career roadmaps.";

    let isRequestInProgress = false;
    @auth
    const isAuthenticated = true;
    @else
    const isAuthenticated = false;
    @endauth

    function isOnboardingComplete() {
        return isAuthenticated;
    }

    function setChatInteractionEnabled(enabled) {
        if (!chatInput || !sendBtn) return;
        chatInput.disabled = !enabled;
        sendBtn.disabled = !enabled;
        suggestionsContainer.classList.toggle('disabled', !enabled);
        suggestionChips.forEach(chip => { chip.disabled = !enabled; });
    }

    function toggleChat() {
        chatWindow.classList.toggle('active');
        if (chatWindow.classList.contains('active')) {
            initChatState();
        }
    }

    chatBtn.addEventListener('click', toggleChat);
    minimizeBtn.addEventListener('click', toggleChat);
    closeBtn.addEventListener('click', () => chatWindow.classList.remove('active'));

    function scrollToBottom() {
        chatBodyContainer.scrollTop = chatBodyContainer.scrollHeight;
    }

    function clearChatHistory() {
        chatMessages.querySelectorAll('.ai-career-guruji-msg:not(#aiChatWelcomeMsg)').forEach(el => el.remove());
        suggestionsContainer.style.display = '';
        if (remainingText) remainingText.textContent = '5';
        if (chatInput) chatInput.placeholder = 'Ask Guruji about careers, colleges, exams, skills...';
        welcomeMsg.innerHTML = welcomeText.replace(/\n/g, '<br>');
    }

    async function initChatState() {
        if (!isOnboardingComplete()) return;

        welcomeMsg.innerHTML = welcomeText.replace(/\n/g, '<br>');
        suggestionsContainer.style.display = '';
        chatMessages.classList.add('active');
        chatFooterWrapper.classList.add('active');
        setChatInteractionEnabled(true);

        try {
            const response = await fetch('/ai-career-chat/limit', {
                headers: { 'Accept': 'application/json' }
            });
            if (response.ok) {
                const data = await response.json();
                if (data.remaining !== undefined) {
                    remainingText.textContent = data.remaining;
                    if (data.remaining <= 0) handleLimitReached();
                }
            }
        } catch (e) {
            console.error('Failed to fetch limit:', e);
        }

        if (chatWindow.classList.contains('active') && !chatInput.disabled) {
            chatInput.focus();
        }
        scrollToBottom();
    }

    resetDetailsBtn.addEventListener('click', () => {
        clearChatHistory();
        initChatState();
    });

    function appendMessage(text, sender) {
        const msgDiv = document.createElement('div');
        msgDiv.className = `ai-career-guruji-msg ${sender}`;
        msgDiv.innerHTML = text.replace(/\n/g, '<br>');
        chatMessages.insertBefore(msgDiv, typingIndicator);
        scrollToBottom();
    }

    function handleLimitReached() {
        chatInput.disabled = true;
        sendBtn.disabled = true;
        chatInput.placeholder = 'Daily limit reached.';
        remainingText.textContent = '0';
    }

    suggestionChips.forEach(chip => {
        chip.addEventListener('click', function() {
            if (!isOnboardingComplete() || isRequestInProgress || chatInput.disabled) return;
            const prompt = this.dataset.prompt || this.textContent.trim();
            chatInput.value = prompt;
            sendMessage(prompt);
        });
    });

    async function sendMessage(text = null) {
        if (!isOnboardingComplete()) return;

        const message = (text || chatInput.value).trim();
        if (!message || isRequestInProgress || chatInput.disabled) return;

        if (message.length > 500) {
            alert('Message is too long. Maximum 500 characters allowed.');
            return;
        }

        if (suggestionsContainer.style.display !== 'none') {
            suggestionsContainer.style.display = 'none';
        }

        chatInput.value = '';
        appendMessage(message, 'user');

        isRequestInProgress = true;
        sendBtn.disabled = true;
        typingIndicator.classList.add('active');
        scrollToBottom();

        try {
            const response = await fetch('/ai-career-chat/message', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ message: message })
            });

            const data = await response.json();
            typingIndicator.classList.remove('active');

            if (data.remaining !== undefined) {
                remainingText.textContent = data.remaining;
                if (data.remaining <= 0) handleLimitReached();
            }

            if (response.ok && data.success) {
                appendMessage(data.reply, 'bot');
            } else {
                appendMessage(data.reply || 'Sorry, I encountered an error. Please try again.', 'bot');
                if (response.status === 429) handleLimitReached();
            }
        } catch (error) {
            console.error('AI Chat Error:', error);
            typingIndicator.classList.remove('active');
            appendMessage('Network error. Please check your connection and try again.', 'bot');
        } finally {
            isRequestInProgress = false;
            if (!chatInput.disabled) {
                sendBtn.disabled = false;
                if (chatWindow.classList.contains('active')) chatInput.focus();
            }
            scrollToBottom();
        }
    }

    sendBtn.addEventListener('click', () => sendMessage());
    chatInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            sendMessage();
        }
    });

    setChatInteractionEnabled(false);
    if (isAuthenticated) initChatState();
});
</script>
