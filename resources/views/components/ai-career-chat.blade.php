<style>
    /* Widget Container */
    .ai-chat-widget {
        position: fixed !important;
        right: 24px !important;
        bottom: 24px !important;
        z-index: 999999 !important;
    }

    /* Floating Button */
    .ai-chat-btn {
        position: absolute;
        bottom: 0;
        right: 0;
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 16px rgba(29, 78, 216, 0.4);
        cursor: pointer;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        outline: none;
    }

    .ai-chat-btn:hover {
        transform: scale(1.05) translateY(-2px);
        box-shadow: 0 6px 20px rgba(29, 78, 216, 0.5);
    }

    .ai-chat-btn i {
        color: white;
        font-size: 26px;
    }

    .ai-chat-online-dot {
        position: absolute;
        top: 2px;
        right: 2px;
        width: 14px;
        height: 14px;
        background-color: #10b981;
        border: 2px solid white;
        border-radius: 50%;
    }

    /* Chat Window */
    .ai-chat-window {
        position: absolute;
        bottom: 75px;
        right: 0;
        width: 380px;
        height: 560px;
        max-height: calc(100vh - 120px);
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        display: flex;
        flex-direction: column;
        overflow: hidden;
        opacity: 0;
        pointer-events: none;
        transform: translateY(20px) scale(0.95);
        transform-origin: bottom right;
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 1px solid #e2e8f0;
    }

    .ai-chat-window.active {
        opacity: 1;
        pointer-events: auto;
        transform: translateY(0) scale(1);
    }

    /* Header */
    .ai-chat-header {
        background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 100%);
        padding: 16px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        color: white;
    }

    .ai-chat-header-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .ai-chat-header-icon {
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .ai-chat-header-text h4 {
        margin: 0;
        font-family: 'Sora', sans-serif;
        font-size: 16px;
        font-weight: 600;
        line-height: 1.2;
    }

    .ai-chat-header-text p {
        margin: 0;
        font-size: 12px;
        opacity: 0.8;
    }

    .ai-chat-header-actions {
        display: flex;
        gap: 8px;
    }

    .ai-chat-header-actions button {
        background: transparent;
        border: none;
        color: white;
        font-size: 16px;
        cursor: pointer;
        opacity: 0.8;
        transition: opacity 0.2s;
        padding: 4px;
    }

    .ai-chat-header-actions button:hover {
        opacity: 1;
    }

    /* Body Container */
    .ai-chat-body-container {
        flex: 1;
        overflow-y: auto;
        background: #f8fafc;
        display: flex;
        flex-direction: column;
    }

    /* Scrollbar */
    .ai-chat-body-container::-webkit-scrollbar {
        width: 6px;
    }
    .ai-chat-body-container::-webkit-scrollbar-track {
        background: transparent;
    }
    .ai-chat-body-container::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }

    /* Onboarding Form */
    .ai-chat-onboarding {
        padding: 24px 20px;
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .ai-chat-onboarding h5 {
        margin: 0;
        font-size: 15px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 4px;
    }

    .ai-chat-form-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .ai-chat-form-group label {
        font-size: 13px;
        font-weight: 600;
        color: #475569;
    }

    .ai-chat-form-control {
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        padding: 10px 12px;
        font-size: 14px;
        outline: none;
        font-family: inherit;
        background: white;
        transition: border-color 0.2s;
    }

    .ai-chat-form-control:focus {
        border-color: #1a56db;
    }

    .ai-chat-start-btn {
        margin-top: 8px;
        background: #1a56db;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 12px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: background 0.2s;
        font-family: inherit;
    }

    .ai-chat-start-btn:hover {
        background: #1d4ed8;
    }

    /* Chat Messages View */
    .ai-chat-messages {
        display: none;
        flex-direction: column;
        gap: 16px;
        padding: 20px;
    }

    .ai-chat-messages.active {
        display: flex;
    }

    .ai-chat-msg {
        max-width: 85%;
        padding: 12px 16px;
        font-size: 14.5px;
        line-height: 1.5;
        border-radius: 16px;
        word-wrap: break-word;
    }

    .ai-chat-msg.bot {
        background: white;
        color: #0f172a;
        border: 1px solid #e2e8f0;
        align-self: flex-start;
        border-bottom-left-radius: 4px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    }

    .ai-chat-msg.user {
        background: #e8f0fe;
        color: #1a56db;
        align-self: flex-end;
        border-bottom-right-radius: 4px;
    }

    /* Suggestions */
    .ai-chat-suggestions {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 4px;
    }

    .ai-chat-suggestion-chip {
        background: white;
        border: 1px solid #1a56db;
        color: #1a56db;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12.5px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .ai-chat-suggestion-chip:hover {
        background: #1a56db;
        color: white;
    }

    /* Typing Loader */
    .ai-chat-typing {
        display: none;
        align-items: center;
        gap: 4px;
        padding: 12px 16px;
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        border-bottom-left-radius: 4px;
        align-self: flex-start;
        width: fit-content;
    }

    .ai-chat-typing.active {
        display: flex;
    }

    .ai-chat-dot {
        width: 6px;
        height: 6px;
        background: #94a3b8;
        border-radius: 50%;
        animation: typing 1.4s infinite ease-in-out both;
    }

    .ai-chat-dot:nth-child(1) { animation-delay: -0.32s; }
    .ai-chat-dot:nth-child(2) { animation-delay: -0.16s; }

    @keyframes typing {
        0%, 80%, 100% { transform: scale(0); }
        40% { transform: scale(1); }
    }

    /* Input Area */
    .ai-chat-footer-wrapper {
        background: white;
        border-top: 1px solid #e2e8f0;
        display: none;
        flex-direction: column;
    }
    
    .ai-chat-footer-wrapper.active {
        display: flex;
    }

    .ai-chat-limit-info {
        padding: 8px 16px;
        font-size: 11px;
        color: #64748b;
        text-align: center;
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        font-weight: 600;
    }

    .ai-chat-reset-link {
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

    .ai-chat-reset-link:hover {
        color: #1a56db;
    }

    .ai-chat-form-error {
        font-size: 12px;
        color: #dc2626;
        margin: 0;
        display: none;
    }

    .ai-chat-form-error.visible {
        display: block;
    }

    .ai-chat-suggestions.disabled,
    .ai-chat-suggestion-chip:disabled {
        pointer-events: none;
        opacity: 0.5;
        cursor: not-allowed;
    }

    .ai-chat-footer {
        padding: 16px;
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .ai-chat-input {
        flex: 1;
        border: 1px solid #e2e8f0;
        border-radius: 24px;
        padding: 12px 16px;
        font-size: 14px;
        outline: none;
        transition: border-color 0.2s;
        font-family: inherit;
        background: #f8fafc;
    }

    .ai-chat-input:focus {
        border-color: #1a56db;
        background: white;
    }
    
    .ai-chat-input:disabled {
        background: #f1f5f9;
        cursor: not-allowed;
    }

    .ai-chat-send {
        width: 44px;
        height: 44px;
        background: #1a56db;
        color: white;
        border: none;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background 0.2s, transform 0.2s;
        flex-shrink: 0;
    }

    .ai-chat-send:hover {
        background: #1d4ed8;
        transform: scale(1.05);
    }
    
    .ai-chat-send:disabled {
        background: #94a3b8;
        cursor: not-allowed;
        transform: none;
    }

    @media (max-width: 480px) {
        .ai-chat-window {
            width: calc(100vw - 32px);
            right: 16px;
            bottom: 85px;
            height: 500px;
        }
        .ai-chat-btn {
            right: 16px;
            bottom: 16px;
            width: 54px;
            height: 54px;
        }
        .ai-chat-btn i {
            font-size: 22px;
        }
    }
</style>

<!-- AI CHATBOT COMPONENT LOADED -->
<div class="ai-chat-widget">
    <!-- Floating Button -->
    <button class="ai-chat-btn" id="aiChatBtn" aria-label="Open AI Career Guide">
        <i class="fa-solid fa-robot"></i>
        <div class="ai-chat-online-dot"></div>
    </button>

    <!-- Chat Window -->
    <div class="ai-chat-window" id="aiChatWindow">
        <div class="ai-chat-header">
            <div class="ai-chat-header-info">
                <div class="ai-chat-header-icon">
                    <i class="fa-solid fa-robot"></i>
                </div>
                <div class="ai-chat-header-text">
                    <h4>AI Career Guide</h4>
                    <p>Your smart career assistant</p>
                </div>
            </div>
            <div class="ai-chat-header-actions">
                <button id="aiChatMinimize" aria-label="Minimize"><i class="fa-solid fa-minus"></i></button>
                <button id="aiChatClose" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
            </div>
        </div>

        <div class="ai-chat-body-container" id="aiChatBodyContainer">
            
            @guest
            <div class="ai-chat-onboarding" style="text-align: center; justify-content: center; height: 100%;">
                <i class="fa-solid fa-lock" style="font-size: 32px; color: #94a3b8; margin-bottom: 12px;"></i>
                <h5>Login Required</h5>
                <p style="font-size: 13px; color: #64748b; margin-bottom: 16px;">Please log in to use the AI Career Guide.</p>
                <a href="{{ route('login') }}" class="ai-chat-start-btn" style="text-decoration: none; display: inline-block;">Log In to Chat</a>
            </div>
            @endguest

            <!-- Chat Messages -->
            <div class="ai-chat-messages" id="aiChatMessages">
                <div class="ai-chat-msg bot" id="aiChatWelcomeMsg"></div>
                
                <div class="ai-chat-suggestions" id="aiChatSuggestions" style="display: none;">
                    <button class="ai-chat-suggestion-chip">Which career is best for me?</button>
                    <button class="ai-chat-suggestion-chip">Popular careers in India</button>
                    <button class="ai-chat-suggestion-chip">Courses after 12th</button>
                    <button class="ai-chat-suggestion-chip">Skills in demand</button>
                </div>

                <div class="ai-chat-typing" id="aiChatTyping">
                    <div class="ai-chat-dot"></div>
                    <div class="ai-chat-dot"></div>
                    <div class="ai-chat-dot"></div>
                </div>
            </div>

        </div>

        <div class="ai-chat-footer-wrapper" id="aiChatFooterWrapper">
            <div class="ai-chat-limit-info" id="aiChatLimitInfo">
                Free questions left today: <span id="aiChatRemaining">5</span>/5
                <button type="button" class="ai-chat-reset-link" id="aiChatResetDetails">Reset details</button>
            </div>
            <div class="ai-chat-footer">
                <input type="text" class="ai-chat-input" id="aiChatInput" placeholder="Type your question..." autocomplete="off">
                <button class="ai-chat-send" id="aiChatSend" aria-label="Send Message">
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
    
    const onboardingForm = document.getElementById('aiChatOnboarding');
    const chatMessages = document.getElementById('aiChatMessages');
    const chatFooterWrapper = document.getElementById('aiChatFooterWrapper');
    const chatBodyContainer = document.getElementById('aiChatBodyContainer');
    
    const formName = document.getElementById('aiChatFormName');
    const formEmail = document.getElementById('aiChatFormEmail');
    const formQual = document.getElementById('aiChatFormQual');
    const welcomeMsg = document.getElementById('aiChatWelcomeMsg');
    
    const chatInput = document.getElementById('aiChatInput');
    const sendBtn = document.getElementById('aiChatSend');
    const typingIndicator = document.getElementById('aiChatTyping');
    const suggestionChips = document.querySelectorAll('.ai-chat-suggestion-chip');
    const suggestionsContainer = document.getElementById('aiChatSuggestions');
    const remainingText = document.getElementById('aiChatRemaining');
    const formError = document.getElementById('aiChatFormError');
    const resetDetailsBtn = document.getElementById('aiChatResetDetails');

    let isRequestInProgress = false;
    @auth
    const isAuthenticated = true;
    const userName = "{{ auth()->user()->name ?? auth()->user()->first_name ?? 'User' }}";
    @else
    const isAuthenticated = false;
    const userName = "";
    @endauth

    function isOnboardingComplete() {
        return isAuthenticated;
    }

    function setChatInteractionEnabled(enabled) {
        chatInput.disabled = !enabled;
        sendBtn.disabled = !enabled;
        suggestionsContainer.classList.toggle('disabled', !enabled);
        suggestionChips.forEach(chip => {
            chip.disabled = !enabled;
        });
    }

    // Toggle Chat
    function toggleChat() {
        chatWindow.classList.toggle('active');
        if (chatWindow.classList.contains('active')) {
            initChatState();
        }
    }

    chatBtn.addEventListener('click', toggleChat);
    minimizeBtn.addEventListener('click', toggleChat);
    closeBtn.addEventListener('click', () => {
        chatWindow.classList.remove('active');
    });

    // Scroll to bottom
    function scrollToBottom() {
        chatBodyContainer.scrollTop = chatBodyContainer.scrollHeight;
    }

    function clearChatHistory() {
        chatMessages.querySelectorAll('.ai-chat-msg:not(#aiChatWelcomeMsg)').forEach(el => el.remove());
        suggestionsContainer.style.display = '';
        remainingText.textContent = '5';
        chatInput.placeholder = 'Type your question...';
    }

    // Initialize State
    function initChatState() {
        if (isOnboardingComplete()) {
            welcomeMsg.textContent = `Hello ${userName}! 👋 How can I help you today?`;
            suggestionsContainer.style.display = '';
            chatMessages.classList.add('active');
            chatFooterWrapper.classList.add('active');
            setChatInteractionEnabled(true);
            if (chatWindow.classList.contains('active')) {
                chatInput.focus();
            }
            scrollToBottom();
        } else {
            // Only elements for guests are visible by default
        }
    }

    function resetUserDetails() {
        // Nothing to reset for auth logic
        clearChatHistory();
        initChatState();
    }

    resetDetailsBtn.addEventListener('click', resetUserDetails);

    // Append Message
    function appendMessage(text, sender) {
        const msgDiv = document.createElement('div');
        msgDiv.className = `ai-chat-msg ${sender}`;
        msgDiv.innerHTML = text.replace(/\n/g, '<br>');
        
        chatMessages.insertBefore(msgDiv, typingIndicator);
        scrollToBottom();
    }

    // Handle Limit Reached
    function handleLimitReached() {
        chatInput.disabled = true;
        sendBtn.disabled = true;
        chatInput.placeholder = "Daily limit reached.";
        remainingText.textContent = "0";
    }

    // Handle Suggestions
    suggestionChips.forEach(chip => {
        chip.addEventListener('click', function() {
            if (!isOnboardingComplete() || isRequestInProgress || chatInput.disabled) return;
            const text = this.textContent;
            suggestionsContainer.style.display = 'none';
            sendMessage(text);
        });
    });

    // Send Message
    async function sendMessage(text = null) {
        if (!isOnboardingComplete()) return;

        const message = text || chatInput.value.trim();
        
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
                body: JSON.stringify({
                    message: message
                })
            });

            const data = await response.json();
            
            typingIndicator.classList.remove('active');
            
            if (data.remaining !== undefined) {
                remainingText.textContent = data.remaining;
                if (data.remaining <= 0) {
                    handleLimitReached();
                }
            }
            
            if (response.ok && data.success) {
                appendMessage(data.reply, 'bot');
            } else {
                appendMessage(data.reply || 'Sorry, I encountered an error. Please try again.', 'bot');
                if (response.status === 429) {
                    handleLimitReached();
                }
            }
        } catch (error) {
            console.error('AI Chat Error:', error);
            typingIndicator.classList.remove('active');
            appendMessage('Network error. Please check your connection and try again.', 'bot');
        } finally {
            isRequestInProgress = false;
            if (!chatInput.disabled) {
                sendBtn.disabled = false;
                if (chatWindow.classList.contains('active')) {
                    chatInput.focus();
                }
            }
            scrollToBottom();
        }
    }

    // Send Button Click
    sendBtn.addEventListener('click', () => sendMessage());

    // Enter Key Press
    chatInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            sendMessage();
        }
    });

    setChatInteractionEnabled(false);
    initChatState();
});
</script>
