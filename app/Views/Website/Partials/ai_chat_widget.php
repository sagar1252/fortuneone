<style>
/* Fortune One AI Chat Widget Styles */
.ai-chat-widget {
    position: fixed;
    bottom: 90px;
    right: 30px;
    width: 380px;
    height: 600px;
    max-height: 80vh;
    background: #1A2530; /* Fortune One dark blue */
    border: 1px solid #D4A574; /* Bronze border */
    border-radius: 12px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.3);
    display: flex;
    flex-direction: column;
    z-index: 9999;
    transform: translateY(20px);
    opacity: 0;
    pointer-events: none;
    transition: all 0.3s ease;
    overflow: hidden;
}

.ai-chat-widget.active {
    transform: translateY(0);
    opacity: 1;
    pointer-events: all;
}

.ai-chat-header {
    background: linear-gradient(135deg, #2A3B4C, #1A2530);
    padding: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid rgba(212, 165, 116, 0.3);
}

.ai-chat-header-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.ai-chat-avatar {
    width: 42px;
    height: 42px;
    background: #fff;
    border: 2px solid #D4A574;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    padding: 2px;
}

.ai-chat-avatar img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.ai-chat-title {
    margin: 0;
    font-size: 1.25rem;
    font-weight: 700;
    background: linear-gradient(135deg, #FFF, #F3D295, #D4A574);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    text-shadow: 0px 2px 4px rgba(0,0,0,0.4);
    letter-spacing: 0.5px;
}

.ai-chat-status {
    color: #D4A574;
    font-size: 0.8rem;
    margin: 0;
}

.ai-chat-close {
    background: none;
    border: none;
    color: #fff;
    cursor: pointer;
    opacity: 0.7;
    transition: 0.3s;
}

.ai-chat-close:hover {
    opacity: 1;
    color: #D4A574;
}

.ai-chat-messages {
    flex: 1;
    padding: 20px;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    gap: 15px;
    background: #f8f9fa; /* Softer background */
}

.chat-message {
    max-width: 85%;
    padding: 14px 18px;
    border-radius: 16px;
    font-size: 0.95rem;
    line-height: 1.5;
    position: relative;
    animation: fadeIn 0.3s ease;
    box-shadow: 0 2px 6px rgba(0,0,0,0.04);
}

.chat-message p {
    margin: 0;
}
.chat-message p + p {
    margin-top: 10px;
}

.chat-message.assistant {
    align-self: flex-start;
    background: #ffffff;
    color: #2D3748;
    border: 1px solid #eaeaea;
    border-bottom-left-radius: 4px;
}

.chat-message.user {
    align-self: flex-end;
    background: linear-gradient(135deg, #1A2530, #2A3B4C);
    color: #fff;
    border-bottom-right-radius: 4px;
    box-shadow: 0 4px 10px rgba(26, 37, 48, 0.2);
}

.ai-chat-input-area {
    padding: 15px;
    background: #fff;
    border-top: 1px solid #eaeaea;
    display: flex;
    gap: 10px;
    box-shadow: 0 -2px 10px rgba(0,0,0,0.03);
}

/* Booking Popup */
.ai-booking-popup {
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: #fff;
    z-index: 100;
    display: flex;
    flex-direction: column;
    padding: 20px;
    transform: translateY(100%);
    transition: transform 0.3s ease;
}
.ai-booking-popup.active {
    transform: translateY(0);
}
.ai-booking-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
    border-bottom: 1px solid #eaeaea;
    padding-bottom: 10px;
}
.ai-booking-header h4 {
    margin: 0;
    color: #1A2530;
    font-size: 1.1rem;
}
.ai-booking-close {
    background: none; border: none; font-size: 1.5rem; cursor: pointer; color: #999;
}
.ai-booking-form {
    display: flex; flex-direction: column; gap: 10px; overflow-y: auto; padding-right: 5px;
}
.ai-booking-form input {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 0.9rem;
    width: 100%;
    box-sizing: border-box;
}
.ai-booking-form button {
    background: #1A2530;
    color: #fff;
    border: none;
    padding: 12px;
    border-radius: 6px;
    font-weight: 600;
    cursor: pointer;
    margin-top: 10px;
}
.ai-booking-form button:hover {
    background: #2A3B4C;
}


.ai-chat-input-area input {
    flex: 1;
    padding: 12px 15px;
    border: 1px solid #ccc;
    border-radius: 24px;
    outline: none;
    font-size: 0.95rem;
    transition: 0.3s;
}

.ai-chat-input-area input:focus {
    border-color: #D4A574;
}

.ai-chat-send {
    background: #D4A574;
    color: #1A2530;
    border: none;
    width: 44px;
    height: 44px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: 0.3s;
}

.ai-chat-send:hover {
    background: #b88d60;
}

.ai-chat-send svg {
    width: 20px;
    height: 20px;
    margin-left: 2px;
}

.typing-indicator {
    display: none;
    align-self: flex-start;
    background: #f0f4f8;
    padding: 12px 16px;
    border-radius: 8px;
    border-bottom-left-radius: 2px;
}

.typing-indicator span {
    display: inline-block;
    width: 6px;
    height: 6px;
    background: #888;
    border-radius: 50%;
    margin: 0 2px;
    animation: typing 1.4s infinite both;
}

.typing-indicator span:nth-child(1) { animation-delay: 0s; }
.typing-indicator span:nth-child(2) { animation-delay: 0.2s; }
.typing-indicator span:nth-child(3) { animation-delay: 0.4s; }

@keyframes typing {
    0%, 80%, 100% { transform: scale(0); }
    40% { transform: scale(1); }
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.ai-chat-voice-controls {
    display: flex;
    justify-content: flex-end;
    padding: 10px 20px 0;
    gap: 10px;
    background: #fdfdfd;
}

.ai-chat-btn-small {
    background: #eaeaea;
    border: none;
    padding: 6px 12px;
    border-radius: 12px;
    font-size: 0.8rem;
    cursor: pointer;
    color: #333;
    display: flex;
    align-items: center;
    gap: 6px;
    transition: 0.3s;
}

.ai-chat-btn-small:hover {
    background: #dcdcdc;
}

.ai-chat-btn-small.active {
    background: #D4A574;
    color: #1A2530;
}

.ai-chat-btn-small.mute-active {
    color: #e74c3c;
}

.ai-chat-mic {
    background: transparent;
    border: none;
    cursor: pointer;
    color: #888;
    transition: 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 44px;
    height: 44px;
}

.ai-chat-mic:hover { color: #D4A574; }

.ai-chat-mic.listening {
    color: #e74c3c;
    animation: pulse-mic 1.5s infinite;
}

@keyframes pulse-mic {
    0% { transform: scale(1); }
    50% { transform: scale(1.15); }
    100% { transform: scale(1); }
}

.ai-chat-launcher-container {
    position: fixed;
    bottom: 30px;
    right: 30px;
    z-index: 9998;
    width: 65px;
    height: 65px;
    transition: all 0.3s ease;
}

.ai-chat-launcher-container.hidden {
    opacity: 0;
    pointer-events: none;
    transform: scale(0.8);
}

.ai-chat-popups {
    position: absolute;
    width: 160px;
    height: 160px;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    animation: fadeInPopup 0.5s ease 0.5s both;
    pointer-events: none;
}

.we-are-here-wrapper {
    position: relative;
    width: 100%;
    height: 100%;
    pointer-events: auto;
    cursor: pointer;
    transition: transform 0.3s ease;
    filter: drop-shadow(0 4px 6px rgba(0,0,0,0.2));
}

.we-are-here-wrapper:hover {
    transform: scale(1.05);
}

.waving-hand-icon {
    position: absolute;
    top: 50%;
    left: -5px;
    transform: translateY(-50%);
    font-size: 35px;
    transform-origin: bottom center;
    animation: wave-hand 2.5s infinite;
    z-index: 2;
}

.we-are-here-svg {
    width: 100%;
    height: 100%;
    overflow: visible;
}

.we-are-here-text {
    font-size: 19px;
    font-weight: 700;
font-family: 'Poppins', sans-serif;
fill: #FFFFFF;
    stroke: #1A2530;
    stroke-width: 4px;
    paint-order: stroke fill;
    letter-spacing: 1px;
}

@keyframes fadeInPopup {
    from { opacity: 0; transform: translate(-50%, -35%) scale(0.9); }
    to { opacity: 1; transform: translate(-50%, -50%) scale(1); }
}

@keyframes wave-hand {
    0% { transform: rotate(0deg); }
    10% { transform: rotate(14deg); }
    20% { transform: rotate(-8deg); }
    30% { transform: rotate(14deg); }
    40% { transform: rotate(-4deg); }
    50% { transform: rotate(10deg); }
    60% { transform: rotate(0deg); }
    100% { transform: rotate(0deg); }
}

.ai-chat-launcher {
    width: 65px;
    height: 65px;
    background: #FFFFFF;
    color: #1A2530;
    border: 3px solid #1A2530;
    border-radius: 50%;
    box-shadow: 0 8px 24px rgba(0,0,0,0.3);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    animation: bounce-attention 2s infinite;
}

.ai-chat-launcher:hover {
    transform: scale(1.1);
    animation: none;
}

.ai-chat-launcher svg, .ai-chat-launcher .launcher-logo {
    width: 40px;
    height: 40px;
    object-fit: contain;
    transition: all 0.3s ease;
}

.ai-chat-launcher:hover .launcher-logo {
    transform: scale(1.1) rotate(5deg);
}

.notification-dot {
    position: absolute;
    top: 0;
    right: 0;
    width: 14px;
    height: 14px;
    background: #e74c3c;
    border: 2px solid #fff;
    border-radius: 50%;
    animation: pulse-red 2s infinite;
}

@keyframes bounce-attention {
    0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
    40% { transform: translateY(-15px); }
    60% { transform: translateY(-7px); }
}

@keyframes pulse-red {
    0% { box-shadow: 0 0 0 0 rgba(231, 76, 60, 0.7); }
    70% { box-shadow: 0 0 0 10px rgba(231, 76, 60, 0); }
    100% { box-shadow: 0 0 0 0 rgba(231, 76, 60, 0); }
}

}

.ai-booking-popup {
    display: none;
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: #fff;
    z-index: 1000;
    border-top-left-radius: 20px;
    border-top-right-radius: 20px;
    box-shadow: 0 -5px 25px rgba(0,0,0,0.1);
    flex-direction: column;
    padding: 20px;
    transition: transform 0.3s ease;
    transform: translateY(100%);
}

.ai-booking-popup.active {
    display: flex;
    transform: translateY(0);
}

.ai-booking-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
    border-bottom: 1px solid #f0f0f0;
    padding-bottom: 10px;
}

.ai-booking-header h4 {
    margin: 0;
    color: #1a1a1a;
    font-size: 16px;
    font-weight: 600;
}

.ai-booking-close {
    background: none;
    border: none;
    font-size: 24px;
    color: #888;
    cursor: pointer;
    line-height: 1;
}

.ai-booking-form {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.ai-booking-form input {
    padding: 12px 15px;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    font-size: 14px;
    outline: none;
    transition: border-color 0.2s;
}

.ai-booking-form input:focus {
    border-color: #2196F3;
}

.ai-booking-form button[type="submit"] {
    background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
    color: white;
    border: none;
    padding: 14px;
    border-radius: 8px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    margin-top: 5px;
    transition: transform 0.2s, box-shadow 0.2s;
}

.ai-booking-form button[type="submit"]:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(30, 60, 114, 0.2);
}

@media (max-width: 480px) {
    .ai-chat-widget {
        bottom: 90px;
        right: 15px;
        width: calc(100% - 30px);
        height: 550px;
        max-height: calc(100vh - 110px);
        border-radius: 12px;
        border: 1px solid #D4A574;
    }
    .ai-chat-launcher-container {
        bottom: 20px;
        right: 15px;
    }
    .ai-chat-launcher {
        bottom: 0;
        right: 0;
    }
    .ai-chat-popups {
        width: 120px;
        height: 120px;
    }
    .waving-hand-icon {
        font-size: 26px;
    }
    .we-are-here-text {
        font-size: 15px;
    }
}

/* Custom Radio Button Styles */
.ai-radio-container {
    margin-top: 12px;
    padding-top: 10px;
    border-top: 1px dashed rgba(212, 165, 116, 0.25);
    display: flex;
    flex-direction: column;
    gap: 8px;
    width: 100%;
}

.ai-radio-options {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.ai-radio-option-label {
    display: flex;
    align-items: center;
    padding: 10px 14px;
    background: #FFFFFF;
    border: 1px solid #D0D7DE;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.2s ease;
    user-select: none;
}

.ai-radio-option-label:hover {
    border-color: #D4A574;
    background: #FAF8F5;
}

.ai-radio-option-label.selected {
    border-color: #D4A574;
    background: #FFF9F2;
    box-shadow: 0 0 0 1px #D4A574;
}

.ai-radio-input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    height: 0;
    width: 0;
}

.ai-radio-custom-circle {
    height: 18px;
    width: 18px;
    background-color: #fff;
    border: 2px solid #ccc;
    border-radius: 50%;
    margin-right: 12px;
    display: inline-block;
    position: relative;
    flex-shrink: 0;
    transition: all 0.2s ease;
}

.ai-radio-option-label.selected .ai-radio-custom-circle {
    border-color: #D4A574;
}

.ai-radio-custom-circle::after {
    content: "";
    position: absolute;
    display: none;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: #D4A574;
}

.ai-radio-option-label.selected .ai-radio-custom-circle::after {
    display: block;
}

.ai-radio-text {
    font-size: 0.9rem;
    color: #1A2530;
    font-weight: 500;
}

.ai-radio-submit-btn {
    background: #1A2530;
    color: #ffffff;
    border: 1px solid #D4A574;
    padding: 10px 16px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.2s ease;
    text-align: center;
    width: 100%;
}

.ai-radio-submit-btn:hover:not(:disabled) {
    background: #D4A574;
    color: #1A2530;
    box-shadow: 0 4px 10px rgba(212, 165, 116, 0.2);
}

.ai-radio-submit-btn:disabled {
    background: #ccc;
    border-color: #ccc;
    color: #fff;
    cursor: not-allowed;
    opacity: 0.6;
}

/* Chat Pill Option Styles */
.ai-chat-pill {
    display: inline-block;
    padding: 8px 14px;
    margin: 6px 6px 0 0;
    background: #FFFFFF;
    border: 1px solid #D4A574;
    border-radius: 16px;
    font-size: 0.85rem;
    color: #1A2530;
    cursor: pointer;
    transition: all 0.2s ease;
    font-weight: 500;
    user-select: none;
}

.ai-chat-pill:hover {
    background: #D4A574;
    color: #FFFFFF;
    box-shadow: 0 2px 8px rgba(212, 165, 116, 0.3);
    transform: translateY(-1px);
}
</style>

<!-- Chat Launcher Container -->
<div class="ai-chat-launcher-container" id="aiChatLauncherContainer">
    <div class="ai-chat-popups" id="aiChatPopups" onclick="toggleAiChat()">
        <div class="we-are-here-wrapper">
            <!--<div class="waving-hand-icon">👋</div>-->
            <svg viewBox="0 0 160 160" class="we-are-here-svg">
                <path id="text-curve" d="M 25 85 A 55 55 0 0 1 135 85" fill="transparent" />
                <!--<text class="we-are-here-text">-->
                <!--    <textPath href="#text-curve" startOffset="50%" text-anchor="middle">-->
                <!--        We Are Here!-->
                <!--    </textPath>-->
                <!--</text>-->
            </svg>
        </div>
    </div>
    <button class="ai-chat-launcher" id="aiChatLauncher" onclick="toggleAiChat()">
        <div class="notification-dot">1</div>
        <img src="<?= base_url('assets/images/ai%20logo.png') ?>" alt="Chat" class="launcher-logo">
    </button>
</div>

<div class="ai-chat-widget" id="aiChatWidget">
    <div class="ai-chat-header">
        <div class="ai-chat-header-info">
            <div class="ai-chat-avatar">
                <img src="<?= base_url('assets/images/ai%20logo.png') ?>" alt="VAN Ai">
            </div>
            <div>
                <h3 class="ai-chat-title">VAN Ai ✨</h3>
                <p class="ai-chat-status">Your Real Estate Expert</p>
            </div>
        </div>
        <button class="ai-chat-close" onclick="toggleAiChat()">
            <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
    </div>
    
    <div class="ai-chat-voice-controls" id="aiVoiceControls" style="display:none;">
        <button class="ai-chat-btn-small" onclick="stopAiAudio()" id="aiStopAudioBtn" title="Stop Audio">
            <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="9" y1="9" x2="15" y2="15"></line><line x1="15" y1="9" x2="9" y2="15"></line></svg> Stop Audio
        </button>
        <button class="ai-chat-btn-small" onclick="toggleVoiceMute()" id="aiMuteBtn" title="Mute/Unmute Voice">
            <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"></polygon><path d="M15.54 8.46a5 5 0 0 1 0 7.07"></path><path d="M19.07 4.93a10 10 0 0 1 0 14.14"></path></svg> Mute
        </button>
    </div>
    
    <div class="ai-chat-messages" id="aiChatMessages">
        <!-- Initial Message -->
        <div class="chat-message assistant">
            <p>Hi! Welcome to Fortune One. I'm VAN Ai. Whether you're looking for a peaceful farmland retreat, a villa plot, or just checking out smart real estate options in Bangalore &mdash; I'm here to help. What brings you to our page today?</p>
        </div>
        <div class="typing-indicator" id="aiTypingIndicator">
            <span></span><span></span><span></span>
        </div>
    </div>

    <!-- Booking Popup is now handled by the global booking_modal.php -->

    <div class="ai-chat-input-area">
        <button class="ai-chat-mic" id="aiMicBtn" onclick="toggleSpeechRecognition()" title="Voice Input">
            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"></path><path d="M19 10v2a7 7 0 0 1-14 0v-2"></path><line x1="12" y1="19" x2="12" y2="23"></line><line x1="8" y1="23" x2="16" y2="23"></line></svg>
        </button>
        <input type="text" id="aiChatInput" placeholder="Type your message..." onkeypress="handleAiChatEnter(event)">
        <button class="ai-chat-send" onclick="sendAiMessage()">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
        </button>
    </div>
</div>

<script>
let aiChatHistory = [];
const chatEndpoint = '<?= base_url("api/chat") ?>';
let isVoiceMode = false;
let isMuted = false;

// Speech Recognition Setup
const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
let recognition = null;
if (SpeechRecognition) {
    recognition = new SpeechRecognition();
    recognition.continuous = false;
    recognition.interimResults = true;
    recognition.lang = 'en-IN'; // Indian English
    
    recognition.onstart = function() {
        document.getElementById('aiMicBtn').classList.add('listening');
        document.getElementById('aiChatInput').placeholder = "Listening...";
        document.getElementById('aiVoiceControls').style.display = 'flex';
        isVoiceMode = true;
        stopAiAudio(); // Interrupt AI if user starts speaking
    };
    
    recognition.onresult = function(event) {
        let interimTranscript = '';
        let finalTranscript = '';
        for (let i = event.resultIndex; i < event.results.length; ++i) {
            if (event.results[i].isFinal) {
                finalTranscript += event.results[i][0].transcript;
            } else {
                interimTranscript += event.results[i][0].transcript;
            }
        }
        if (finalTranscript) {
            document.getElementById('aiChatInput').value = finalTranscript;
        } else {
            document.getElementById('aiChatInput').value = interimTranscript;
        }
    };
    
    recognition.onend = function() {
        document.getElementById('aiMicBtn').classList.remove('listening');
        document.getElementById('aiChatInput').placeholder = "Type your message...";
        
        const inputField = document.getElementById('aiChatInput');
        if (inputField.value.trim() !== '' && isVoiceMode) {
            // Auto send if voice mode captured something
            sendAiMessage();
        }
    };
    
    recognition.onerror = function(event) {
        console.error("Speech recognition error", event.error);
        document.getElementById('aiMicBtn').classList.remove('listening');
        document.getElementById('aiChatInput').placeholder = "Type your message...";
    };
}

function toggleSpeechRecognition() {
    if (!recognition) {
        alert("Sorry, your browser doesn't support speech recognition.");
        return;
    }
    
    const micBtn = document.getElementById('aiMicBtn');
    if (micBtn.classList.contains('listening')) {
        recognition.stop();
        isVoiceMode = false;
    } else {
        isVoiceMode = true;
        try {
            recognition.start();
        } catch (e) {
            console.error("Speech recognition start failed:", e);
        }
    }
}

// Text to Speech Setup
const synth = window.speechSynthesis;
let voiceInstance = null;

function getFemaleVoice() {
    const voices = synth.getVoices();
    // Try Indian English Female first
    let voice = voices.find(v => v.lang === 'en-IN' && v.name.toLowerCase().includes('female'));
    if (!voice) {
        voice = voices.find(v => v.lang === 'en-IN');
    }
    // Fallback to US/UK female
    if (!voice) {
        voice = voices.find(v => (v.lang === 'en-US' || v.lang === 'en-GB') && (v.name.toLowerCase().includes('female') || v.name.toLowerCase().includes('zira')));
    }
    return voice || voices[0];
}

function speakAiResponse(text) {
    if (!synth || isMuted || !isVoiceMode) return;
    
    // Stop current speech before starting new
    stopAiAudio();
    
    // Strip markdown formatting like *, #, etc. for better speech
    let cleanText = text.replace(/[*_#`~>]/g, '');
    
    voiceInstance = new SpeechSynthesisUtterance(cleanText);
    voiceInstance.voice = getFemaleVoice();
    voiceInstance.rate = 1.0;
    voiceInstance.pitch = 1.1; // Slightly higher pitch for female typical tone
    
    voiceInstance.onend = function() {
        // Continuous conversation: if in voice mode and not muted, start listening again
        if (isVoiceMode && !isMuted && recognition) {
            // Slight delay before turning mic back on to prevent trailing echoes
            setTimeout(() => {
                if(!synth.speaking && isVoiceMode) {
                    try {
                        recognition.start();
                    } catch (e) {
                        console.error("Speech recognition start failed:", e);
                    }
                }
            }, 500);
        }
    };
    
    synth.speak(voiceInstance);
}

function stopAiAudio() {
    if (synth && synth.speaking) {
        synth.cancel();
    }
}

function toggleVoiceMute() {
    isMuted = !isMuted;
    const muteBtn = document.getElementById('aiMuteBtn');
    if (isMuted) {
        muteBtn.classList.add('mute-active');
        muteBtn.innerHTML = '<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"></polygon><line x1="23" y1="9" x2="17" y2="15"></line><line x1="17" y1="9" x2="23" y2="15"></line></svg> Unmute';
        stopAiAudio();
    } else {
        muteBtn.classList.remove('mute-active');
        muteBtn.innerHTML = '<svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"></polygon><path d="M15.54 8.46a5 5 0 0 1 0 7.07"></path><path d="M19.07 4.93a10 10 0 0 1 0 14.14"></path></svg> Mute';
    }
}

// Load voices proactively
if (speechSynthesis.onvoiceschanged !== undefined) {
    speechSynthesis.onvoiceschanged = getFemaleVoice;
}

function toggleAiChat() {
    const widget = document.getElementById('aiChatWidget');
    const container = document.getElementById('aiChatLauncherContainer');
    const popups = document.getElementById('aiChatPopups');
    
    widget.classList.toggle('active');
    
    if (widget.classList.contains('active')) {
        document.getElementById('aiChatInput').focus();
        container.classList.add('hidden');
        if (popups) popups.style.display = 'none'; // Permanently hide attention grabber once interacted with
    } else {
        container.classList.remove('hidden');
    }
}

function openAndSend(text) {
    toggleAiChat();
    const inputField = document.getElementById('aiChatInput');
    inputField.value = text;
    sendAiMessage();
}

function handleAiChatEnter(event) {
    if (event.key === 'Enter') {
        sendAiMessage();
    }
}

function submitRadioSelection(uniqueId) {
    const container = document.getElementById(`container_${uniqueId}`);
    if (!container) return;
    
    const selectedInput = container.querySelector('input[name="' + uniqueId + '"]:checked');
    if (!selectedInput) return;
    
    const val = selectedInput.value;
    
    // Disable all options and the submit button to prevent double-submitting
    container.querySelectorAll('input').forEach(i => i.disabled = true);
    const submitBtn = container.querySelector('.ai-radio-submit-btn');
    if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.style.display = 'none'; // hide submit button after selection
    }
    
    // Send the message as the user
    const inputField = document.getElementById('aiChatInput');
    inputField.value = val;
    sendAiMessage();
}

function sendOption(text) {
    const inputField = document.getElementById('aiChatInput');
    inputField.value = text;
    sendAiMessage();
}

function appendMessage(role, text) {
    const messagesContainer = document.getElementById('aiChatMessages');
    const indicator = document.getElementById('aiTypingIndicator');
    
    const msgDiv = document.createElement('div');
    msgDiv.className = `chat-message ${role}`;
    
    // Simple markdown to HTML for line breaks and basic formatting
    let formattedText = text.replace(/\n/g, '<br>');
    msgDiv.innerHTML = `<p>${formattedText}</p>`;
    
    messagesContainer.insertBefore(msgDiv, indicator);
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
}

async function sendAiMessage(hiddenSystemMessage = null) {
    const inputField = document.getElementById('aiChatInput');
    let message = inputField.value.trim();
    
    if (hiddenSystemMessage) {
        message = hiddenSystemMessage;
        aiChatHistory.push({ role: 'user', content: message });
    } else {
        if (!message) return;
        inputField.value = '';
        appendMessage('user', message);
        aiChatHistory.push({ role: 'user', content: message });
    }
    
    // Show typing indicator
    const indicator = document.getElementById('aiTypingIndicator');
    indicator.style.display = 'block';
    
    try {
        const response = await fetch(chatEndpoint, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ 
                messages: aiChatHistory,
                mode: isVoiceMode ? 'voice' : 'text'
            })
        });
        
        indicator.style.display = 'none';
        
        if (!response.ok) {
            throw new Error(`Server returned ${response.status}`);
        }
        
        // Prepare empty message div for streaming text
        const messagesContainer = document.getElementById('aiChatMessages');
        const msgDiv = document.createElement('div');
        msgDiv.className = 'chat-message assistant';
        const pTag = document.createElement('p');
        msgDiv.appendChild(pTag);
        messagesContainer.insertBefore(msgDiv, document.getElementById('aiTypingIndicator'));
        
        const reader = response.body.getReader();
        const decoder = new TextDecoder('utf-8');
        let botReply = '';
        let buffer = '';
        let fullRawResponse = '';

        while (true) {
            const { done, value } = await reader.read();
            if (done) break;
            
            const chunkText = decoder.decode(value, {stream: true});
            fullRawResponse += chunkText;
            buffer += chunkText;
            const lines = buffer.split('\n');
            buffer = lines.pop(); // Keep the last incomplete line in buffer
            
            for (let line of lines) {
                const trimmedLine = line.trim();
                if (trimmedLine.startsWith('data: ')) {
                    const dataStr = trimmedLine.substring(6).trim();
                    if (!dataStr || dataStr === '[DONE]') continue;
                    
                    try {
                        const dataObj = JSON.parse(dataStr);
                        if (dataObj.error) {
                            botReply = dataObj.error;
                            pTag.innerHTML = botReply;
                            continue;
                        }
                        if (dataObj.candidates && dataObj.candidates[0].content.parts[0].text) {
                            botReply += dataObj.candidates[0].content.parts[0].text;
                            
                            // Check if botReply is streaming a JSON object
                            let cleanReply = botReply.trim();
                            if (cleanReply.startsWith('{') || cleanReply.startsWith('```json') || cleanReply.startsWith('```')) {
                                pTag.innerHTML = `<em>VAN Ai is formatting options...</em>`;
                            } else {
                                // Check if $$SHOW_BOOKING_POPUP$$ is being generated. If so, hide it visually
                                let displayReply = botReply;
                                if (botReply.includes('$$SHOW_BOOKING_POPUP$$')) {
                                    displayReply = botReply.replace(/\$\$SHOW_BOOKING_POPUP\$\$/g, '');
                                }
                                
                                // fallback for old booking tag
                                const bookingMatch = displayReply.match(/\$\$BOOKING_DATA=(\{.*?\})\$\$/);
                                if (bookingMatch || displayReply.includes('$$BOOKING_DATA')) {
                                    displayReply = displayReply.split('$$BOOKING_DATA')[0];
                                }
                                
                                pTag.innerHTML = displayReply.replace(/\n/g, '<br>');
                            }
                            messagesContainer.scrollTop = messagesContainer.scrollHeight;
                        }
                    } catch (e) {
                        // Incomplete JSON string, ignore and wait for more chunks
                    }
                }
            }
        }
        
        // If no SSE data was found, check if the entire response is a JSON error
        if (!botReply && fullRawResponse.trim().startsWith('{')) {
            try {
                const errObj = JSON.parse(fullRawResponse);
                if (errObj.error && errObj.error.message) {
                    if (errObj.error.code === 429) {
                        botReply = "The system is currently receiving a high volume of requests. Please try sending your message again in a minute.";
                    } else {
                        botReply = errObj.error.message;
                    }
                    pTag.innerHTML = botReply;
                }
            } catch(e) {}
        }
        
        // Finalize
        // Finalize
        let isJson = false;
        let jsonData = null;
        let cleanBotReply = botReply.trim();
        let precedingText = '';

        // Extract JSON block even if mixed with text
        const jsonMatch = cleanBotReply.match(/```json\s*([\s\S]*?)\s*```/);
        let potentialJsonStr = '';

        if (jsonMatch) {
            potentialJsonStr = jsonMatch[1];
            precedingText = cleanBotReply.split('```json')[0].trim();
        } else if (cleanBotReply.includes('```')) {
            // fallback for missing 'json' word
            const fallbackMatch = cleanBotReply.match(/```\s*(\{[\s\S]*?\})\s*```/);
            if (fallbackMatch) {
                potentialJsonStr = fallbackMatch[1];
                precedingText = cleanBotReply.split('```')[0].trim();
            }
        } else if (cleanBotReply.startsWith('{') && cleanBotReply.endsWith('}')) {
            potentialJsonStr = cleanBotReply;
        }

        try {
            if (potentialJsonStr) {
                jsonData = JSON.parse(potentialJsonStr);
                if (jsonData && jsonData.type === 'radio') {
                    isJson = true;
                }
            }
        } catch (e) {
            console.log("Could not parse final stream as JSON:", e);
        }

        if (isJson && jsonData) {
            // Parse preceding text with basic markdown
            let textHtml = '';
            if (precedingText) {
                let pText = precedingText;
                pText = pText.replace(/### (.*?)(?=\n|$)/g, '<strong>$1</strong>');
                pText = pText.replace(/## (.*?)(?=\n|$)/g, '<strong>$1</strong>');
                pText = pText.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
                textHtml = `<p>${pText.replace(/\n/g, '<br>')}</p><br>`;
            }

            const question = jsonData.question;
            const options = jsonData.options;
            const uniqueId = 'group_' + Date.now();
            
            let html = textHtml + `<p>${question.replace(/\n/g, '<br>')}</p>`;
            html += `<div class="ai-radio-container" id="container_${uniqueId}">`;
            html += `<div class="ai-radio-options">`;
            options.forEach((opt, idx) => {
                html += `
                    <label class="ai-radio-option-label" for="opt_${uniqueId}_${idx}">
                        <input type="radio" id="opt_${uniqueId}_${idx}" name="${uniqueId}" value="${opt.replace(/"/g, '&quot;')}" class="ai-radio-input">
                        <span class="ai-radio-custom-circle"></span>
                        <span class="ai-radio-text">${opt}</span>
                    </label>
                `;
            });
            html += `</div>`;
            html += `<button class="ai-radio-submit-btn" onclick="submitRadioSelection('${uniqueId}')" disabled>Submit</button>`;
            html += `</div>`;
            
            pTag.innerHTML = html;
            
            // Add event listeners to enable the submit button when an option is selected
            setTimeout(() => {
                const container = document.getElementById(`container_${uniqueId}`);
                if (container) {
                    const inputs = container.querySelectorAll('.ai-radio-input');
                    const btn = container.querySelector('.ai-radio-submit-btn');
                    inputs.forEach(input => {
                        input.addEventListener('change', () => {
                            btn.removeAttribute('disabled');
                            
                            // Highlight the selected option and remove highlight from others
                            container.querySelectorAll('.ai-radio-option-label').forEach(label => {
                                label.classList.remove('selected');
                            });
                            input.parentElement.classList.add('selected');
                        });
                    });
                }
            }, 50);

            // Save the JSON content to history, but we want the AI to remember the JSON structured prompt
            aiChatHistory.push({ role: 'assistant', content: botReply });
            
            // Speak only the question
            speakAiResponse(question);
        } else {
            // Check for booking tag
            if (botReply.includes('$$SHOW_BOOKING_POPUP$$')) {
                botReply = botReply.replace(/\$\$SHOW_BOOKING_POPUP\$\$/g, '').trim();
                pTag.innerHTML = botReply.replace(/\n/g, '<br>');
                if (typeof openBookingModal === 'function') {
                    openBookingModal();
                }
            }
            
            // Fallback for old tag
            const bookingMatch = botReply.match(/\$\$BOOKING_DATA=(\{.*?\})\$\$/);
            if (bookingMatch) {
                try {
                    botReply = botReply.replace(bookingMatch[0], '').trim();
                } catch(e) {}
            }
            
            // Basic Markdown Parsing
            let cleanReply = botReply;
            cleanReply = cleanReply.replace(/### (.*?)(?=\n|$)/g, '<strong>$1</strong>');
            cleanReply = cleanReply.replace(/## (.*?)(?=\n|$)/g, '<strong>$1</strong>');
            cleanReply = cleanReply.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
            
            const lines = cleanReply.split('\n');
            let hasBullets = false;
            let formattedHtml = '';
            
            lines.forEach(line => {
                const trimmed = line.trim();
                // Only treat as a pill if it's a strict bullet point (asterisk/dash followed by space)
                // AND it's reasonably short (not a huge paragraph)
                if ((trimmed.startsWith('* ') || trimmed.startsWith('- ')) && trimmed.length < 60 && !trimmed.includes('<strong>')) {
                    hasBullets = true;
                    const optionText = trimmed.substring(2).trim();
                    // Render as a clickable pill
                    formattedHtml += `<div class="ai-chat-pill" onclick="sendOption('${optionText.replace(/'/g, "\\'")}')">${optionText}</div>`;
                } else if (trimmed.startsWith('* ') || trimmed.startsWith('- ')) {
                    // Regular bullet point
                    const text = trimmed.substring(2).trim();
                    formattedHtml += `<p style="margin-left: 15px;">• ${text}</p>`;
                } else {
                    if (trimmed) {
                        formattedHtml += `<p>${trimmed}</p>`;
                    }
                }
            });
            
            if (hasBullets) {
                pTag.innerHTML = formattedHtml;
            } else {
                pTag.innerHTML = cleanReply.replace(/\n/g, '<br>');
            }
            
            if (botReply) {
                aiChatHistory.push({ role: 'assistant', content: botReply });
                speakAiResponse(botReply);
            } else {
                // Remove the empty message bubble and show a fallback
                msgDiv.remove();
                if (hiddenSystemMessage && hiddenSystemMessage.includes('SYSTEM: Booking successful')) {
                    const fallbackThankYou = "Thanks for your registration! Please join the meeting at the scheduled time to clear all your queries.";
                    appendMessage('assistant', fallbackThankYou);
                    aiChatHistory.push({ role: 'assistant', content: fallbackThankYou });
                    speakAiResponse(fallbackThankYou);
                } else {
                    appendMessage('assistant', "I apologize, but I'm currently unable to connect to the assistant. Please try again in a few moments.");
                }
            }
        }
        
    } catch (error) {
        console.error('Chat error:', error);
        indicator.style.display = 'none';
        if (typeof msgDiv !== 'undefined' && msgDiv) {
            msgDiv.remove();
        }
        if (hiddenSystemMessage && hiddenSystemMessage.includes('SYSTEM: Booking successful')) {
            const fallbackThankYou = "Thanks for your registration! Please join the meeting at the scheduled time to clear all your queries.";
            appendMessage('assistant', fallbackThankYou);
            aiChatHistory.push({ role: 'assistant', content: fallbackThankYou });
            speakAiResponse(fallbackThankYou);
        } else {
            appendMessage('assistant', "Oops, something went wrong with the connection. Please try again.");
        }
    }
}

</script>
