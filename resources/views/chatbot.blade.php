@extends('layout')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');

    :root {
        /* Theme Colors - Matching Homepage */
        --primary: #fd7205;
        --primary-dark: #e65100;
        --primary-light: #ff9800;
        --secondary: #0066ff;
        --secondary-dark: #0056c9;
        --secondary-light: #3d8bff;
        --success: #7f9c53;
        --success-light: #a8c778;
        --background: #f8f1e5;
        --background-light: #fffdf9;
        --surface: #ffffff;
        --surface-elevated: #fafafa;

        /* Text Colors */
        --text-primary: #2d3748;
        --text-secondary: #64748b;
        --text-muted: #94a3b8;
        --text-inverse: #ffffff;

        /* Border & Shadow */
        --border-light: #e2e8f0;
        --border-medium: #cbd5e1;
        --shadow-xs: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow-sm: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);

        /* Radius */
        --radius-sm: 0.5rem;
        --radius-md: 0.75rem;
        --radius-lg: 1rem;
        --radius-xl: 1.5rem;
        --radius-2xl: 2rem;

        /* Spacing */
        --space-xs: 0.5rem;
        --space-sm: 0.75rem;
        --space-md: 1rem;
        --space-lg: 1.5rem;
        --space-xl: 2rem;
        --space-2xl: 3rem;

        /* Typography */
        --font-primary: 'Poppins', 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        --font-secondary: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    }

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: var(--font-primary);
        background: linear-gradient(135deg, var(--background) 0%, var(--background-light) 100%);
        margin: 0;
        padding: 0;
        min-height: 100vh;
        line-height: 1.6;
        color: var(--text-primary);
        overflow-x: hidden;
    }

    /* ===== MODERN LAYOUT STRUCTURE ===== */
    .chatbot-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: var(--space-lg);
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        gap: var(--space-xl);
    }

    .chatbot-header {
        text-align: center;
        padding: var(--space-xl) 0;
        background: var(--surface);
        border-radius: var(--radius-2xl);
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border-light);
        position: relative;
        overflow: hidden;
    }

    .chatbot-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary), var(--secondary), var(--success));
        animation: shimmer 3s ease-in-out infinite;
    }

    .chatbot-main {
        display: grid;
        grid-template-columns: 1fr;
        gap: var(--space-xl);
        flex: 1;
    }

    @media (min-width: 1024px) {
        .chatbot-main {
            grid-template-columns: 1fr 400px;
        }
    }

    /* ===== ANIMATIONS ===== */
    @keyframes shimmer {

        0%,
        100% {
            transform: translateX(-100%);
        }

        50% {
            transform: translateX(100%);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(30px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes pulse {

        0%,
        100% {
            transform: scale(1);
            box-shadow: 0 0 0 0 rgba(253, 114, 5, 0.4);
        }

        50% {
            transform: scale(1.05);
            box-shadow: 0 0 0 10px rgba(253, 114, 5, 0);
        }
    }

    @keyframes bounce {

        0%,
        20%,
        53%,
        80%,
        100% {
            transform: translate3d(0, 0, 0);
        }

        40%,
        43% {
            transform: translate3d(0, -8px, 0);
        }

        70% {
            transform: translate3d(0, -4px, 0);
        }

        90% {
            transform: translate3d(0, -2px, 0);
        }
    }

    /* ===== ENHANCED CHAT INTERFACE ===== */
    .chat-container {
        background: var(--surface);
        border-radius: var(--radius-2xl);
        box-shadow: var(--shadow-lg);
        border: 1px solid var(--border-light);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        height: 600px;
        animation: fadeInUp 0.6s ease-out;
    }

    .chat-header {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: var(--text-inverse);
        padding: var(--space-lg);
        display: flex;
        align-items: center;
        gap: var(--space-md);
        position: relative;
    }

    .chat-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    }

    .ai-avatar {
        width: 48px;
        height: 48px;
        background: var(--surface);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        box-shadow: var(--shadow-md);
        animation: bounce 2s infinite;
    }

    .chat-info h3 {
        font-family: var(--font-primary);
        font-weight: 600;
        font-size: 1.25rem;
        margin-bottom: 4px;
    }

    .chat-info p {
        font-size: 0.875rem;
        opacity: 0.9;
        font-weight: 400;
    }

    .chat-messages {
        flex: 1;
        padding: var(--space-lg);
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: var(--space-md);
        background: linear-gradient(to bottom, var(--surface), var(--surface-elevated));
    }

    .chat-messages::-webkit-scrollbar {
        width: 6px;
    }

    .chat-messages::-webkit-scrollbar-track {
        background: var(--border-light);
        border-radius: 3px;
    }

    .chat-messages::-webkit-scrollbar-thumb {
        background: var(--primary);
        border-radius: 3px;
    }

    .chat-messages::-webkit-scrollbar-thumb:hover {
        background: var(--primary-dark);
    }

    /* ===== MODERN MESSAGE STYLING ===== */
    .message {
        display: flex;
        gap: var(--space-sm);
        animation: fadeInUp 0.4s ease-out;
        max-width: 85%;
    }

    .message.user {
        align-self: flex-end;
        flex-direction: row-reverse;
    }

    .message.bot {
        align-self: flex-start;
    }

    .message-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        font-weight: 600;
        flex-shrink: 0;
        box-shadow: var(--shadow-sm);
    }

    .message.user .message-avatar {
        background: linear-gradient(135deg, var(--secondary), var(--secondary-dark));
        color: var(--text-inverse);
    }

    .message.bot .message-avatar {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: var(--text-inverse);
    }

    .message-content {
        background: var(--surface);
        padding: var(--space-md) var(--space-lg);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border-light);
        position: relative;
        font-family: var(--font-secondary);
        line-height: 1.5;
    }

    .message.user .message-content {
        background: linear-gradient(135deg, var(--secondary), var(--secondary-dark));
        color: var(--text-inverse);
        border: none;
        border-bottom-right-radius: var(--radius-sm);
    }

    .message.bot .message-content {
        background: var(--surface);
        color: var(--text-primary);
        border-bottom-left-radius: var(--radius-sm);
    }

    .message.bot .message-content.summary-title {
        background: linear-gradient(135deg, var(--success), var(--success-light));
        color: var(--text-inverse);
        font-weight: 600;
        border: none;
    }

    .message.bot .message-content.error-message {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: var(--text-inverse);
        border: none;
    }

    /* ===== TYPING INDICATOR ===== */
    .typing-indicator {
        display: flex;
        align-items: center;
        gap: var(--space-sm);
        padding: var(--space-md);
        background: var(--surface-elevated);
        border-radius: var(--radius-lg);
        border: 1px solid var(--border-light);
        animation: fadeInUp 0.3s ease-out;
    }

    .typing-dots {
        display: flex;
        gap: 4px;
    }

    .typing-dot {
        width: 8px;
        height: 8px;
        background: var(--primary);
        border-radius: 50%;
        animation: typingBounce 1.4s infinite ease-in-out;
    }

    .typing-dot:nth-child(1) {
        animation-delay: -0.32s;
    }

    .typing-dot:nth-child(2) {
        animation-delay: -0.16s;
    }

    .typing-dot:nth-child(3) {
        animation-delay: 0s;
    }

    @keyframes typingBounce {

        0%,
        80%,
        100% {
            transform: scale(0.8);
            opacity: 0.5;
        }

        40% {
            transform: scale(1);
            opacity: 1;
        }
    }

    /* ===== CHAT INPUT ===== */
    .chat-input-container {
        padding: var(--space-lg);
        background: var(--surface);
        border-top: 1px solid var(--border-light);
        display: flex;
        gap: var(--space-md);
        align-items: flex-end;
    }

    .chat-input {
        flex: 1;
        padding: var(--space-md) var(--space-lg);
        border: 2px solid var(--border-light);
        border-radius: var(--radius-lg);
        font-family: var(--font-secondary);
        font-size: 1rem;
        line-height: 1.5;
        background: var(--surface);
        color: var(--text-primary);
        transition: all 0.3s ease;
        resize: none;
        min-height: 44px;
        max-height: 120px;
    }

    .chat-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(253, 114, 5, 0.1);
        transform: translateY(-1px);
    }

    .chat-input::placeholder {
        color: var(--text-muted);
        font-style: italic;
    }

    .chat-send-button {
        padding: var(--space-md);
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: var(--text-inverse);
        border: none;
        border-radius: var(--radius-lg);
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 44px;
        height: 44px;
        box-shadow: var(--shadow-sm);
    }

    .chat-send-button:hover:not(:disabled) {
        background: linear-gradient(135deg, var(--primary-dark), #d84315);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .chat-send-button:disabled {
        background: var(--border-medium);
        color: var(--text-muted);
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    /* ===== MODERN CATEGORY CARDS ===== */
    .categories-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: var(--space-lg);
        margin-bottom: var(--space-xl);
    }

    .category-card {
        background: var(--surface);
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border-light);
        padding: var(--space-xl);
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        animation: fadeInUp 0.6s ease-out;
    }

    .category-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary), var(--secondary));
        transform: scaleX(0);
        transition: transform 0.4s ease;
        transform-origin: left;
    }

    .category-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: var(--shadow-xl);
        border-color: var(--primary);
    }

    .category-card:hover::before {
        transform: scaleX(1);
    }

    .category-card:active {
        transform: translateY(-4px) scale(1.01);
    }

    .category-icon {
        width: 64px;
        height: 64px;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        border-radius: var(--radius-lg);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        color: var(--text-inverse);
        margin-bottom: var(--space-lg);
        box-shadow: var(--shadow-md);
        transition: all 0.3s ease;
    }

    .category-card:hover .category-icon {
        transform: scale(1.1) rotate(5deg);
        box-shadow: var(--shadow-lg);
    }

    .category-title {
        font-family: var(--font-primary);
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: var(--space-sm);
        line-height: 1.3;
    }

    .category-description {
        font-family: var(--font-secondary);
        font-size: 0.95rem;
        color: var(--text-secondary);
        line-height: 1.6;
        margin-bottom: var(--space-lg);
    }

    .category-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: var(--space-md);
        border-top: 1px solid var(--border-light);
        font-size: 0.875rem;
        color: var(--text-muted);
    }

    .category-questions {
        display: flex;
        align-items: center;
        gap: var(--space-xs);
    }

    .category-cost {
        display: flex;
        align-items: center;
        gap: var(--space-xs);
        font-weight: 600;
        color: var(--primary);
    }

    /* ===== SIDEBAR COMPONENTS ===== */
    .sidebar {
        display: flex;
        flex-direction: column;
        gap: var(--space-lg);
        animation: slideInRight 0.6s ease-out;
    }

    .sidebar-card {
        background: var(--surface);
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border-light);
        overflow: hidden;
    }

    .sidebar-header {
        background: linear-gradient(135deg, var(--secondary), var(--secondary-dark));
        color: var(--text-inverse);
        padding: var(--space-lg);
        font-family: var(--font-primary);
        font-weight: 600;
        font-size: 1.125rem;
        display: flex;
        align-items: center;
        gap: var(--space-sm);
    }

    .sidebar-content {
        padding: var(--space-lg);
    }

    /* ===== COIN BALANCE DISPLAY ===== */
    .coin-balance {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: var(--text-inverse);
        padding: var(--space-lg);
        border-radius: var(--radius-xl);
        text-align: center;
        box-shadow: var(--shadow-md);
        position: relative;
        overflow: hidden;
    }

    .coin-balance::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        transform: rotate(45deg);
        animation: coinShine 3s ease-in-out infinite;
    }

    @keyframes coinShine {

        0%,
        100% {
            transform: translateX(-100%) translateY(-100%) rotate(45deg);
        }

        50% {
            transform: translateX(100%) translateY(100%) rotate(45deg);
        }
    }

    .coin-amount {
        font-size: 2rem;
        font-weight: 800;
        font-family: var(--font-primary);
        margin-bottom: var(--space-xs);
        position: relative;
        z-index: 1;
    }

    .coin-label {
        font-size: 0.875rem;
        opacity: 0.9;
        font-weight: 500;
        position: relative;
        z-index: 1;
    }

    /* ===== MODERN BUTTONS ===== */
    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: var(--space-sm);
        padding: var(--space-md) var(--space-lg);
        border: none;
        border-radius: var(--radius-lg);
        font-family: var(--font-primary);
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        text-decoration: none;
        box-shadow: var(--shadow-sm);
    }

    .btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s ease;
    }

    .btn:hover::before {
        left: 100%;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: var(--text-inverse);
    }

    .btn-primary:hover:not(:disabled) {
        background: linear-gradient(135deg, var(--primary-dark), #d84315);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .btn-secondary {
        background: linear-gradient(135deg, var(--secondary), var(--secondary-dark));
        color: var(--text-inverse);
    }

    .btn-secondary:hover:not(:disabled) {
        background: linear-gradient(135deg, var(--secondary-dark), #0056c9);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .btn-success {
        background: linear-gradient(135deg, var(--success), var(--success-light));
        color: var(--text-inverse);
    }

    .btn-success:hover:not(:disabled) {
        background: linear-gradient(135deg, #6b8e3d, var(--success));
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .btn-outline {
        background: transparent;
        border: 2px solid var(--primary);
        color: var(--primary);
    }

    .btn-outline:hover:not(:disabled) {
        background: var(--primary);
        color: var(--text-inverse);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .btn:disabled {
        background: var(--border-medium) !important;
        color: var(--text-muted) !important;
        cursor: not-allowed;
        transform: none !important;
        box-shadow: none !important;
    }

    .btn:disabled::before {
        display: none;
    }

    .btn-sm {
        padding: var(--space-sm) var(--space-md);
        font-size: 0.875rem;
    }

    .btn-lg {
        padding: var(--space-lg) var(--space-xl);
        font-size: 1.125rem;
    }

    /* ===== MODERN PROGRESS INDICATORS ===== */
    .progress-container {
        background: var(--surface);
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border-light);
        padding: var(--space-lg);
        margin-bottom: var(--space-lg);
        animation: fadeInUp 0.5s ease-out;
    }

    .progress-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: var(--space-md);
    }

    .progress-title {
        font-family: var(--font-primary);
        font-weight: 600;
        color: var(--text-primary);
        font-size: 1.125rem;
    }

    .progress-stats {
        font-family: var(--font-secondary);
        font-size: 0.875rem;
        color: var(--text-secondary);
        font-weight: 500;
    }

    .progress-bar-container {
        background: var(--border-light);
        border-radius: var(--radius-lg);
        height: 12px;
        overflow: hidden;
        position: relative;
    }

    .progress-bar {
        height: 100%;
        background: linear-gradient(90deg, var(--primary), var(--secondary));
        border-radius: var(--radius-lg);
        transition: width 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .progress-bar::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        animation: progressShine 2s ease-in-out infinite;
    }

    @keyframes progressShine {
        0% {
            transform: translateX(-100%);
        }

        100% {
            transform: translateX(100%);
        }
    }

    /* ===== MODERN MODAL STYLING ===== */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(0, 0, 0, 0.85) !important;
        backdrop-filter: blur(12px) !important;
        -webkit-backdrop-filter: blur(12px) !important;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999 !important;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }

    .modal-overlay.active {
        opacity: 1;
        visibility: visible;
    }

    .modal-content {
        background: #ffffff !important;
        border-radius: var(--radius-2xl);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5) !important;
        border: 2px solid rgba(255, 255, 255, 0.1);
        max-width: 600px;
        width: 90%;
        max-height: 90vh;
        overflow-y: auto;
        transform: scale(0.9) translateY(20px);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        z-index: 10000;
    }

    .modal-overlay.active .modal-content {
        transform: scale(1) translateY(0);
    }

    .modal-header {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: var(--text-inverse);
        padding: var(--space-xl);
        border-radius: var(--radius-2xl) var(--radius-2xl) 0 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-title {
        font-family: var(--font-primary);
        font-size: 1.5rem;
        font-weight: 700;
        margin: 0;
    }

    .modal-close {
        background: rgba(255, 255, 255, 0.2);
        border: none;
        color: var(--text-inverse);
        width: 40px;
        height: 40px;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        transition: all 0.3s ease;
    }

    .modal-close:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: scale(1.1);
    }

    .modal-body {
        padding: var(--space-xl);
    }

    .modal-footer {
        padding: var(--space-lg) var(--space-xl);
        border-top: 1px solid var(--border-light);
        display: flex;
        gap: var(--space-md);
        justify-content: flex-end;
    }

    /* ===== RESPONSIVE DESIGN ===== */
    @media (max-width: 768px) {
        .chatbot-container {
            padding: var(--space-md);
            gap: var(--space-lg);
        }

        .chatbot-main {
            grid-template-columns: 1fr;
        }

        .categories-grid {
            grid-template-columns: 1fr;
            gap: var(--space-md);
        }

        .category-card {
            padding: var(--space-lg);
        }

        .category-icon {
            width: 48px;
            height: 48px;
            font-size: 20px;
        }

        .category-title {
            font-size: 1.25rem;
        }

        .chat-container {
            height: 500px;
        }

        .chat-header {
            padding: var(--space-md);
        }

        .ai-avatar {
            width: 40px;
            height: 40px;
            font-size: 20px;
        }

        .chat-info h3 {
            font-size: 1.125rem;
        }

        .message {
            max-width: 95%;
        }

        .message-avatar {
            width: 32px;
            height: 32px;
            font-size: 14px;
        }

        .coin-amount {
            font-size: 1.5rem;
        }

        .btn {
            padding: var(--space-sm) var(--space-md);
            font-size: 0.875rem;
        }
    }

    @media (max-width: 480px) {
        .chatbot-container {
            padding: var(--space-sm);
        }

        .chatbot-header {
            padding: var(--space-lg) var(--space-md);
        }

        .category-card {
            padding: var(--space-md);
        }

        .chat-container {
            height: 400px;
        }

        .chat-messages {
            padding: var(--space-md);
        }

        .chat-input-container {
            padding: var(--space-md);
        }
    }


    .header-ai {
        position: relative;
        display: inline-block;
        margin-bottom: 20px;
    }

    .header-ai img {
        display: block;
    }

    .welcome-bubble {
        position: absolute;
        top: 10px;
        left: calc(100% + 15px);
        /* Posisi bubble dari logo AI */
        background-color: #a8c778;
        min-width: 280px;
        /* Lebar minimum agar teks cukup */
        max-width: 400px;
        /* Lebar maksimum */
        color: white;
        padding: 10px 15px;
        border-radius: 15px;
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
        font-size: 0.95rem;
        /* Sesuaikan ukuran font bubble */
        line-height: 1.4;
    }

    .typed-cursor {
        opacity: 1;
        animation: blink 0.7s infinite;
    }

    @keyframes blink {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0;
        }
    }

    /* Enhanced Category Cards */
    .category-card {
        background: var(--card-bg);
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow-md);
        padding: 24px;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid var(--border-color);
        position: relative;
        overflow: hidden;
    }

    .category-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .category-card:hover {
        box-shadow: var(--shadow-xl);
        transform: translateY(-8px) scale(1.02);
        border-color: var(--primary-color);
    }

    .category-card:hover::before {
        transform: scaleX(1);
    }

    .category-card:active {
        transform: translateY(-4px) scale(1.01);
    }

    .category-card h2 {
        font-size: 1.25rem;
        /* text-xl */
        font-weight: 600;
        /* semibold */
        color: var(--primary-color);
        margin-bottom: 8px;
    }

    .category-card p {
        color: #718096;
        /* gray-600 */
        font-size: 0.875rem;
        /* text-sm */
    }

    /* Enhanced Modal Design */
    #category-selection-modal,
    #overall-summary-modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(8px);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        padding: 20px;
        animation: modalFadeIn 0.3s ease-out;
    }

    @keyframes modalFadeIn {
        from {
            opacity: 0;
            backdrop-filter: blur(0px);
        }

        to {
            opacity: 1;
            backdrop-filter: blur(8px);
        }
    }

    .modal-content {
        background: var(--card-bg);
        padding: 32px;
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow-xl);
        width: 100%;
        max-width: 520px;
        border: 1px solid var(--border-color);
        animation: modalSlideIn 0.3s ease-out;
        position: relative;
    }

    @keyframes modalSlideIn {
        from {
            opacity: 0;
            transform: translateY(-20px) scale(0.95);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .modal-content h2 {
        font-size: 1.5rem;
        /* text-2xl */
        font-weight: 600;
        /* semibold */
        color: #4a5568;
        /* gray-700 */
        margin-bottom: 16px;
    }

    /* Enhanced Buttons */
    .question-option-button {
        background: linear-gradient(135deg, var(--success-color), #059669);
        color: white;
        font-weight: 600;
        padding: 16px 20px;
        border-radius: var(--radius-lg);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        border: none;
        cursor: pointer;
        text-align: center;
        box-shadow: var(--shadow-sm);
        position: relative;
        overflow: hidden;
    }

    .question-option-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .question-option-button:hover {
        background: linear-gradient(135deg, #059669, #047857);
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
    }

    .question-option-button:hover::before {
        left: 100%;
    }

    .question-option-button:active {
        transform: translateY(0);
    }

    .question-option-button:disabled {
        background: var(--border-color);
        color: var(--text-secondary);
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    .question-option-button:disabled::before {
        display: none;
    }

    .question-option-button img {
        width: 20px;
        height: auto;
    }

    .modal-close-button {
        background-color: #e2e8f0;
        /* gray-300 */
        color: #4a5568;
        /* gray-700 */
        font-weight: 600;
        padding: 8px 16px;
        border-radius: 6px;
        margin-top: 20px;
        border: none;
        cursor: pointer;
    }

    .modal-close-button:hover {
        background-color: #cbd5e0;
        /* gray-400 */
    }

    /* Hidden class untuk modal */
    .hidden {
        display: none !important;
    }

    .user-info {
        text-align: right;
        margin-bottom: 20px;
        font-size: 1rem;
        color: #4A5568;
        /* gray-700 */
    }

    .user-info strong {
        color: #2D3748;
        /* gray-800 */
    }

    .user-info img {
        width: 20px;
        height: auto;
        vertical-align: middle;
        margin-left: 5px;
    }

    #overall-summary-content {
        /* Untuk styling konten summary keseluruhan */
        background-color: white;
        border-radius: 8px;
        padding: 20px;
        margin-top: 10px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    /* AI Typing Animation */
    .typing-indicator {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 12px 16px;
        background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
        border-radius: var(--radius-lg);
        border: 1px solid var(--border-color);
        margin-bottom: 12px;
        animation: messageSlideIn 0.3s ease-out;
    }

    .typing-dots {
        display: flex;
        gap: 4px;
        align-items: center;
    }

    .typing-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background-color: var(--text-secondary);
        animation: typingDot 1.4s infinite ease-in-out;
    }

    .typing-dot:nth-child(1) {
        animation-delay: 0s;
    }

    .typing-dot:nth-child(2) {
        animation-delay: 0.2s;
    }

    .typing-dot:nth-child(3) {
        animation-delay: 0.4s;
    }

    @keyframes typingDot {

        0%,
        60%,
        100% {
            transform: scale(1);
            opacity: 0.5;
        }

        30% {
            transform: scale(1.2);
            opacity: 1;
        }
    }

    .ai-typing-text {
        color: var(--text-secondary);
        font-style: italic;
        font-size: 0.9rem;
    }

    /* Enhanced Spinner */
    .spinner {
        border: 3px solid var(--border-color);
        border-radius: 50%;
        border-top-color: var(--primary-color);
        width: 20px;
        height: 20px;
        animation: spin 1s linear infinite;
        display: inline-block;
        margin-left: 8px;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    /* Typewriter Effect */
    .typewriter {
        overflow: hidden;
        white-space: nowrap;
        animation: typewriter 2s steps(40, end);
    }

    @keyframes typewriter {
        from {
            width: 0;
        }

        to {
            width: 100%;
        }
    }



    /* Animation for simulation prompt */
    @keyframes fadeInScale {
        0% {
            opacity: 0;
            transform: scale(0.9) translateY(20px);
        }

        100% {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    @keyframes fadeOut {
        0% {
            opacity: 1;
            transform: scale(1);
        }

        100% {
            opacity: 0;
            transform: scale(0.9);
        }
    }

    /* Pulse animation for simulation prompt */
    @keyframes pulse {

        0%,
        100% {
            box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.7);
        }

        50% {
            box-shadow: 0 0 0 10px rgba(59, 130, 246, 0);
        }
    }

    #simulation-prompt-section {
        animation: pulse 2s infinite;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        body {
            padding: 10px;
        }

        .modal-content {
            padding: 24px;
            margin: 10px;
        }

        .category-card {
            padding: 20px;
        }

        .category-card:hover {
            transform: translateY(-4px) scale(1.01);
        }

        .input-area {
            flex-direction: column;
            gap: 8px;
        }

        .input-area button {
            width: 100%;
            padding: 12px;
        }

        .question-option-button {
            padding: 14px 16px;
            font-size: 0.9rem;
        }

        #question-console {
            max-height: 400px;
        }

        .welcome-bubble {
            position: static;
            margin-top: 15px;
            margin-left: 0;
            max-width: 100%;
        }

        .header-ai {
            text-align: center;
        }
    }

    @media (max-width: 480px) {
        .modal-content {
            padding: 20px;
        }

        .category-card h2 {
            font-size: 1.1rem;
        }

        .chatbot-message {
            max-width: 95%;
            padding: 10px 14px;
        }

        .typing-indicator {
            padding: 10px 14px;
        }
    }

    /* Loading States */
    .loading {
        opacity: 0.7;
        pointer-events: none;
        position: relative;
    }

    .loading::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 20px;
        height: 20px;
        margin: -10px 0 0 -10px;
        border: 2px solid var(--border-color);
        border-top-color: var(--primary-color);
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    /* Progress Indicator */
    .progress-bar {
        width: 100%;
        height: 4px;
        background: var(--border-color);
        border-radius: 2px;
        overflow: hidden;
        margin: 16px 0;
    }

    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        border-radius: 2px;
        transition: width 0.3s ease;
    }
</style>

<div class="chatbot-container">
    {{-- Modern Header --}}
    <header class="chatbot-header">
        <div style="display: flex; align-items: center; gap: 1rem; justify-content: center;">
            <div class="ai-avatar">🤖</div>
            <div>
                <h1
                    style="font-family: var(--font-primary); font-size: 2rem; font-weight: 800; color: var(--text-primary); margin: 0;">
                    AI Career Advisor
                </h1>
                <p
                    style="font-family: var(--font-secondary); color: var(--text-secondary); margin: 0; font-size: 1.125rem;">
                    Halo, <strong>{{ Auth::user()->name ?? 'Pengguna' }}</strong>! Temukan jurusan yang tepat untuk masa
                    depanmu
                </p>
            </div>
        </div>
    </header>

    {{-- Main Content Area --}}
    <main class="chatbot-main">
        {{-- Left Column: Categories & Chat --}}
        <div>
            {{-- Categories Section --}}
            <section id="categories-section">
                <div style="text-align: center; margin-bottom: var(--space-xl);">
                    <h2
                        style="font-family: var(--font-primary); font-size: 1.75rem; font-weight: 700; color: var(--text-primary); margin-bottom: var(--space-sm);">
                        Pilih Kategori Assessment
                    </h2>
                    <p id="typed-welcome"
                        style="font-family: var(--font-secondary); color: var(--text-secondary); font-size: 1.125rem; max-width: 600px; margin: 0 auto;">
                        Setiap kategori akan membantu AI memahami kepribadian dan minatmu dengan lebih baik
                    </p>
                </div>

                <div class="categories-grid" id="categories-container">
                    {{-- Categories will be loaded here dynamically, but fallback categories below --}}

                    {{-- Server-side categories disabled to prevent duplicates --}}
                    {{-- Categories are now loaded entirely by JavaScript --}}
                    {{-- @forelse ($categories as $categoryId => $category)
                    <div class="category-card" data-category-id="{{ $categoryId }}"
                        data-category-label="{{ $category['label'] ?? 'Kategori' }}"
                        data-total-questions="{{ count($category['questions'] ?? []) }}"
                        data-cost-per-question="{{ $category['cost_per_question'] ?? 15 }}"
                        onclick="console.log('🖱️ Category card clicked:', '{{ $categoryId }}'); selectCategory('{{ $categoryId }}', '{{ $category['label'] ?? 'Kategori' }}', {{ count($category['questions'] ?? []) }}, {{ $category['cost_per_question'] ?? 15 }})">
                        <div class="category-icon">
                            @switch($categoryId)
                            @case('bakat_minat') 🎯 @break
                            @case('kepribadian') 🧠 @break
                            @case('nilai_kehidupan') 💎 @break
                            @case('gaya_belajar') 📚 @break
                            @case('lingkungan_kerja') 🏢 @break
                            @case('kemampuan_akademik') 🎓 @break
                            @default 📋
                            @endswitch
                        </div>
                        <h3 class="category-title">{{ $category['label'] ?? 'Kategori' }}</h3>
                        <p class="category-description">
                            Eksplorasi {{ strtolower($category['label'] ?? 'aspek penting') }} untuk menentukan jurusan
                            yang tepat
                        </p>
                        <div class="category-meta">
                            <div class="category-questions">
                                <span>📝</span>
                                <span>{{ count($category['questions'] ?? []) }} pertanyaan</span>
                            </div>
                            <div class="category-cost">
                                <span>🪙</span>
                                <span>{{ $category['cost_per_question'] ?? 15 }}/pertanyaan</span>
                            </div>
                        </div>
                    </div>
                    @empty --}}
                    {{-- Loading placeholder will be shown by JavaScript --}}
                    {{-- @endforelse --}}
                </div>
            </section>

            {{-- Chat Interface --}}
            <section id="chat-section" style="display: none;">
                <div class="chat-container">
                    <div class="chat-header">
                        <div class="ai-avatar">🤖</div>
                        <div class="chat-info">
                            <h3>AI Assistant</h3>
                            <p>Siap membantu analisis kariermu</p>
                        </div>
                        <button onclick="hideQuestionConsole()" class="btn btn-outline btn-sm"
                            style="margin-left: auto; background-color:white">
                            ← Kembali
                        </button>
                    </div>

                    <div class="chat-messages" id="chat-history">
                        {{-- Messages will appear here --}}
                    </div>

                    <div class="chat-input-container">
                        <textarea id="user-input" class="chat-input" placeholder="Ketik jawabanmu di sini..."
                            rows="1"></textarea>
                        <button id="send-button" class="chat-send-button">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <line x1="22" y1="2" x2="11" y2="13"></line>
                                <polygon points="22,2 15,22 11,13 2,9"></polygon>
                            </svg>
                        </button>
                    </div>
                </div>
            </section>
        </div>

        {{-- Right Sidebar --}}
        <aside class="sidebar">
            {{-- Coin Balance --}}
            <div class="coin-balance">
                <div class="coin-amount" id="user-coin-balance">{{ $userCoins }}</div>
                <div class="coin-label">🪙 Coins Available</div>
            </div>

            {{-- Progress Card --}}
            <div class="sidebar-card" id="progress-card" style="display: none;">
                <div class="sidebar-header">
                    <span>📊</span>
                    Progress Assessment
                </div>
                <div class="sidebar-content">
                    <div class="progress-container">
                        <div class="progress-header">
                            <div class="progress-title" id="progress-category">Kategori</div>
                            <div class="progress-stats" id="progress-text">0/0</div>
                        </div>
                        <div class="progress-bar-container">
                            <div class="progress-bar" id="progress-bar" style="width: 0%"></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Overall Summary Button --}}
            <div class="sidebar-card">
                <div class="sidebar-header">
                    <span>🎯</span>
                    Rekomendasi Final
                </div>
                <div class="sidebar-content">
                    <p
                        style="font-size: 0.875rem; color: var(--text-secondary); margin-bottom: var(--space-md); line-height: 1.5;">
                        Setelah menyelesaikan beberapa kategori, dapatkan rekomendasi jurusan yang komprehensif
                    </p>
                    <button id="request-overall-summary-button" class="btn btn-success" style="width: 100%;"
                        onclick="requestOverallSummary()">
                        <span>✨</span>
                        Lihat Rekomendasi
                    </button>
                </div>
            </div>
        </aside>
    </main>
</div>

{{-- LEGACY Modal Pemilihan Jumlah Pertanyaan - DISABLED to prevent double modal --}}
{{-- This modal is replaced by the modern modal system in selectCategory() --}}
{{--
<div id="category-selection-modal" class="hidden">
    <div class="modal-content">
        <h2 id="selection-title">Pilih Jumlah Pertanyaan</h2>
        <div id="question-options-container" class="grid gap-3 grid-cols-2 md:grid-cols-2">
            {{-- Opsi akan dimasukkan oleh JavaScript --}}
        </div>
        <button class="modal-close-button" data-action="close-category-modal">Kembali</button>
    </div>
</div>
--}}

{{-- Konsol Pertanyaan (Chatbox) --}}
<div id="question-console" class="bg-[#f0f4f8] p-4 rounded-lg mb-6 shadow-inner hidden"> {{-- Warna latar
    chatbox
    diubah agar kontras --}}
    <h2 id="console-title" class="text-2xl font-semibold text-[#2d3748] mb-4 text-center"></h2>

    {{-- Progress Indicator --}}
    <div id="progress-container" class="progress-bar hidden">
        <div id="progress-fill" class="progress-fill" style="width: 0%"></div>
    </div>
    <div id="progress-text" class="text-center text-sm text-gray-600 mb-4 hidden">
        Pertanyaan <span id="current-question">1</span> dari <span id="total-questions">5</span>
    </div>

    <div id="chat-history" class="flex-grow overflow-y-auto mb-4 p-2 space-y-3">
        {{-- Riwayat chat akan muncul di sini --}}
    </div>
    <div class="input-area">
        <input type="text" id="user-input" placeholder="Ketik jawabanmu di sini..." autocomplete="off">
        <button id="send-button" onclick="processUserInput()">Kirim</button>
    </div>
    <button onclick="hideQuestionConsole()" class="modal-close-button w-full mt-4">Tutup Konsol
        Kategori</button>
</div>

{{-- Tombol & Area Summary Keseluruhan --}}
<div class="flex w-full flex-col items-center justify-center mt-10">
    <button id="request-overall-summary-button" onclick="requestOverallSummary()"
        class="bg-[#ff933c] hover:bg-[#a8c778] text-white font-bold py-3 px-8 rounded-full focus:outline-none min-w-[280px] flex flex-col items-center justify-center text-lg shadow-lg transition-transform transform hover:scale-105">
        <span class="mb-1">Lihat Rekomendasi Jurusan Final</span>
        <div class="flex items-center gap-2 text-sm">
            <img src="{{ asset('logoAI/coin.png') }}" alt="koin" class="w-5 h-auto">
            <span>5 Koin</span> {{-- Biaya summary keseluruhan --}}
        </div>
    </button>
    <div id="overall-summary-content" class="mt-6 w-full max-w-3xl hidden">
        <h2 class="text-2xl font-semibold text-[#fd7205] mb-4 text-center">Rekomendasi Jurusan Final Untukmu
        </h2>
        <div id="overall-summary-text" class="text-gray-700 leading-relaxed">
            {{-- Summary keseluruhan akan muncul di sini --}}
        </div>
        <button onclick="hideOverallSummaryContainer()" class="modal-close-button w-full mt-4">Tutup
            Rekomendasi
            Final</button>
    </div>
</div>

{{-- Simulation Modal --}}
<div id="simulation-modal"
    class="fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-xl shadow-2xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 id="simulation-title" class="text-2xl font-bold text-gray-800">🎯 Simulasi Interaktif
                </h2>
                <button onclick="closeSimulation()" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
            </div>

            {{-- Progress Bar --}}
            <div id="simulation-progress" class="mb-6 hidden">
                <div class="flex justify-between text-sm text-gray-600 mb-2">
                    <span>Progress Simulasi</span>
                    <span id="progress-text-sim">0%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div id="progress-bar-sim"
                        class="bg-gradient-to-r from-blue-500 to-purple-600 h-2 rounded-full transition-all duration-300"
                        style="width: 0%"></div>
                </div>
            </div>

            {{-- Simulation Content --}}
            <div id="simulation-content">
                {{-- Content will be dynamically loaded here --}}
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('scripts')
<script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
<script>
    // Error handling for missing libraries
    window.addEventListener('error', function (e) {
        if (e.message && e.message.includes('AOS')) {
            console.log('🔧 AOS library not found, creating fallback');
            window.AOS = {
                init: function () {
                    console.log('🔧 AOS fallback initialized');
                },
                refresh: function () {
                    console.log('🔧 AOS fallback refresh');
                }
            };
        }
    });

    // Ensure AOS fallback is available immediately
    if (typeof AOS === 'undefined') {
        window.AOS = {
            init: function () {
                console.log('🔧 AOS fallback initialized');
            },
            refresh: function () {
                console.log('🔧 AOS fallback refresh');
            }
        };
    }
</script>
<script>
    // Data dari Backend (Global)
    const categoriesData = @json($categories);
    let currentUserCoins = {{ $userCoins ?? 0 }};
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Debug: Log categories data immediately
    console.log('🔍 Categories data received from server:', categoriesData);
    console.log('🔍 Categories data type:', typeof categoriesData);
    console.log('🔍 Categories data keys:', Object.keys(categoriesData || {}));
    console.log('🔍 Categories data length:', Object.keys(categoriesData || {}).length);

    // State Aplikasi (Global)
    let currentCategoryId = null;
    let currentCategoryLabel = '';
    let currentCategoryQuestions = [];
    let questionsToAsk = [];
    let currentQuestionIndex = 0;
    let userAnswersForCurrentCategory = [];
    let allUserAnswers = {};

    // DOM elements for modern UI (will be initialized in DOMContentLoaded)
    let categoriesContainer, categoriesSection, chatSection, chatHistoryElement, userInputElement, sendButton, progressElement, progressTextElement, progressCategoryElement;

    // Initialize the modern UI
    document.addEventListener('DOMContentLoaded', function () {
        console.log('🚀 Modern UI DOMContentLoaded - Starting initialization');

        // Initialize DOM elements
        categoriesContainer = document.getElementById('categories-container');
        categoriesSection = document.getElementById('categories-section');
        chatSection = document.getElementById('chat-section');
        chatHistoryElement = document.getElementById('chat-history');
        userInputElement = document.getElementById('user-input');
        sendButton = document.getElementById('send-button');
        progressElement = document.getElementById('progress-bar');
        progressTextElement = document.getElementById('progress-text');
        progressCategoryElement = document.getElementById('progress-category');

        console.log('🔍 Categories container element:', categoriesContainer);
        console.log('🔍 Categories section element:', categoriesSection);
        console.log('🔍 Chat section element:', chatSection);
        console.log('🔍 Chat history element:', chatHistoryElement);

        loadCategories();
        updateCoinDisplay();
        initializeEventListeners();

        console.log('✅ Modern UI initialization complete');
    });

    // Load categories into the modern grid
    function loadCategories() {
        console.log('🔄 Loading categories...');
        console.log('Categories container:', categoriesContainer);
        console.log('Categories data:', categoriesData);

        if (!categoriesContainer) {
            console.error('❌ Categories container not found!');
            return;
        }

        // Always clear existing categories to prevent duplicates
        console.log('🔄 Clearing existing categories to prevent duplicates');

        // Show loading placeholder
        categoriesContainer.innerHTML = `
            <div id="categories-loading" style="grid-column: 1 / -1; text-align: center; padding: var(--space-xl); color: var(--text-secondary);">
                <div style="font-size: 3rem; margin-bottom: 1rem;">📋</div>
                <h3 style="margin-bottom: 0.5rem; color: var(--text-primary);">Memuat Kategori...</h3>
                <p>Kategori assessment sedang dimuat. Mohon tunggu sebentar.</p>
            </div>
        `;

        // Check if categoriesData exists and has content
        if (!categoriesData || Object.keys(categoriesData).length === 0) {
            console.log('⚠️ No categories data available - loading fallback categories');

            console.log('🔧 Creating fallback categories...');

            // Create fallback categories if data is missing
            const fallbackCategories = {
                'bakat_minat': {
                    label: 'Bakat & Minat',
                    questions: Array(10).fill().map((_, i) => `Pertanyaan ${i + 1}`),
                    cost_per_question: 15
                },
                'kepribadian': {
                    label: 'Kepribadian',
                    questions: Array(10).fill().map((_, i) => `Pertanyaan ${i + 1}`),
                    cost_per_question: 15
                },
                'nilai_kehidupan': {
                    label: 'Nilai Kehidupan',
                    questions: Array(10).fill().map((_, i) => `Pertanyaan ${i + 1}`),
                    cost_per_question: 15
                },
                'gaya_belajar': {
                    label: 'Gaya Belajar',
                    questions: Array(10).fill().map((_, i) => `Pertanyaan ${i + 1}`),
                    cost_per_question: 15
                },
                'lingkungan_kerja': {
                    label: 'Lingkungan Kerja',
                    questions: Array(10).fill().map((_, i) => `Pertanyaan ${i + 1}`),
                    cost_per_question: 15
                },
                'kemampuan_akademik': {
                    label: 'Kemampuan Akademik',
                    questions: Array(10).fill().map((_, i) => `Pertanyaan ${i + 1}`),
                    cost_per_question: 15
                }
            };

            categoriesContainer.innerHTML = `
                <div style="grid-column: 1 / -1; text-align: center; padding: var(--space-xl); color: var(--text-secondary);">
                    <div style="font-size: 3rem; margin-bottom: 1rem;">⚠️</div>
                    <h3 style="margin-bottom: 0.5rem; color: var(--text-primary);">Data kategori tidak ditemukan</h3>
                    <p>Menggunakan kategori fallback. Silakan refresh halaman untuk data terbaru.</p>
                    <button onclick="location.reload()" class="btn btn-primary" style="margin-top: 1rem;">
                        🔄 Refresh Halaman
                    </button>
                    <button onclick="loadFallbackCategories()" class="btn btn-secondary" style="margin-top: 1rem; margin-left: 1rem;">
                        📋 Gunakan Kategori Fallback
                    </button>
                </div>
            `;

            // Store fallback categories globally
            window.fallbackCategories = fallbackCategories;
            return;
        }

        console.log(`✅ Found ${Object.keys(categoriesData).length} categories`);

        // Clear loading placeholder and add categories
        categoriesContainer.innerHTML = '';

        Object.entries(categoriesData).forEach(([categoryId, category]) => {
            console.log(`Creating card for category: ${categoryId}`, category);
            const categoryCard = createCategoryCard(categoryId, category);
            categoriesContainer.appendChild(categoryCard);
        });

        console.log('✅ Categories loaded successfully');
    }

    // Create modern category card
    function createCategoryCard(categoryId, category) {
        console.log(`🎨 Creating card for: ${categoryId}`, category);

        const card = document.createElement('div');
        card.className = 'category-card';
        card.style.animationDelay = `${Math.random() * 0.3}s`;

        const iconMap = {
            'bakat_minat': '🎯',
            'kepribadian': '🧠',
            'nilai_kehidupan': '💎',
            'gaya_belajar': '📚',
            'lingkungan_kerja': '🏢',
            'kemampuan_akademik': '🎓'
        };

        const icon = iconMap[categoryId] || '📋';

        // Handle different data structures
        let questionCount = 0;
        let costPerQuestion = 15;
        let categoryLabel = 'Kategori';

        if (category) {
            // Try different possible structures
            if (Array.isArray(category.questions)) {
                questionCount = category.questions.length;
            } else if (typeof category.questions === 'object' && category.questions) {
                questionCount = Object.keys(category.questions).length;
            } else if (category.question_count) {
                questionCount = category.question_count;
            }

            costPerQuestion = category.cost_per_question || category.cost || 15;
            categoryLabel = category.label || category.name || 'Kategori';
        }

        console.log(`📊 Card data - Label: ${categoryLabel}, Questions: ${questionCount}, Cost: ${costPerQuestion}`);

        card.innerHTML = `
            <div class="category-icon">${icon}</div>
            <h3 class="category-title">${categoryLabel}</h3>
            <p class="category-description">
                Eksplorasi ${categoryLabel.toLowerCase()} untuk menentukan jurusan yang tepat
            </p>
            <div class="category-meta">
                <div class="category-questions">
                    <span>📝</span>
                    <span>${questionCount} soal</span>
                </div>
                <div class="category-cost">
                    <span>🪙</span>
                    <span>${costPerQuestion} koin/soal</span>
                </div>
            </div>
        `;

        card.addEventListener('click', () => {
            console.log(`🖱️ Category clicked: ${categoryId}`);
            selectCategory(categoryId, categoryLabel, questionCount, costPerQuestion);
        });

        return card;
    }

    // Send user message function (alias for processUserInput)
    function sendUserMessage() {
        console.log('📤 sendUserMessage called');
        if (typeof processUserInput === 'function') {
            processUserInput();
        } else {
            console.error('❌ processUserInput function not found');
        }
    }

    // Make sendUserMessage globally available
    window.sendUserMessage = sendUserMessage;

    // Initialize event listeners for modern UI
    function initializeEventListeners() {
        // Chat input auto-resize
        if (userInputElement) {
            userInputElement.addEventListener('input', function () {
                this.style.height = 'auto';
                this.style.height = Math.min(this.scrollHeight, 120) + 'px';
            });

            // Enter key to send message
            userInputElement.addEventListener('keydown', function (e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    sendUserMessage();
                }
            });
        }

        // Send button click
        if (sendButton) {
            sendButton.addEventListener('click', sendUserMessage);
        }
    }

    // Update coin display in modern UI
    function updateCoinDisplay() {
        const coinElements = document.querySelectorAll('#user-coin-balance, #user-coins');
        coinElements.forEach(element => {
            if (element) {
                element.textContent = currentUserCoins;
            }
        });
    }

    // Show/hide sections for modern UI
    function showChatInterface() {
        if (categoriesSection) categoriesSection.style.display = 'none';
        if (chatSection) chatSection.style.display = 'block';

        // Show progress card
        const progressCard = document.getElementById('progress-card');
        if (progressCard) progressCard.style.display = 'block';
    }

    function hideChatInterface() {
        if (categoriesSection) categoriesSection.style.display = 'block';
        if (chatSection) chatSection.style.display = 'none';

        // Hide progress card
        const progressCard = document.getElementById('progress-card');
        if (progressCard) progressCard.style.display = 'none';

        // Clear chat history
        if (chatHistoryElement) {
            chatHistoryElement.innerHTML = '';
        }

        // Reset state
        currentCategoryId = null;
        currentCategoryLabel = '';
        questionsToAsk = [];
        currentQuestionIndex = 0;
        userAnswersForCurrentCategory = [];
    }

    // Modern category selection function (Global scope)
    window.selectCategory = function (categoryId, categoryLabel, questionCount, costPerQuestion) {
        console.log(`🎯 Selecting category: ${categoryId} (${categoryLabel})`);
        console.log(`📊 Questions: ${questionCount}, Cost: ${costPerQuestion}`);
        console.log(`🔍 Current categoriesData:`, categoriesData);

        // Store category info
        currentCategoryId = categoryId;
        currentCategoryLabel = categoryLabel;

        // Get category data - try multiple approaches
        let categoryData = null;

        // Try to get from categoriesData first
        if (categoriesData && categoriesData[categoryId]) {
            categoryData = categoriesData[categoryId];
            console.log(`✅ Found category data in categoriesData:`, categoryData);
        } else {
            console.log(`⚠️ Category data not found in categoriesData for: ${categoryId}`);

            // Create fallback category data based on parameters
            categoryData = {
                label: categoryLabel,
                questions: Array(questionCount).fill().map((_, i) => `Pertanyaan ${i + 1} untuk ${categoryLabel}`),
                cost_per_question: costPerQuestion
            };
            console.log(`🔧 Created fallback category data:`, categoryData);
        }

        // Show question selection modal or start directly
        if (questionCount > 0) {
            console.log(`📋 Opening question selection modal for ${categoryLabel}`);
            showQuestionSelectionModal(categoryId, categoryLabel, questionCount, costPerQuestion);
        } else {
            alert('Kategori ini belum memiliki pertanyaan. Silakan pilih kategori lain.');
        }
    };

    // Also create a non-window version for internal use
    function selectCategory(categoryId, categoryLabel, questionCount, costPerQuestion) {
        return window.selectCategory(categoryId, categoryLabel, questionCount, costPerQuestion);
    }

    // Show question selection modal for modern UI (Global scope)
    window.showQuestionSelectionModal = function (categoryId, categoryLabel, totalQuestions, costPerQuestion) {
        console.log(`📋 Showing question selection for: ${categoryLabel}`);
        console.log(`🔍 Modal function called with:`, { categoryId, categoryLabel, totalQuestions, costPerQuestion });

        // Create modal overlay
        const modalOverlay = document.createElement('div');
        modalOverlay.className = 'modal-overlay';
        modalOverlay.id = 'question-selection-overlay';

        // Force strong background styling
        modalOverlay.style.cssText = `
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            bottom: 0 !important;
            width: 100vw !important;
            height: 100vh !important;
            background: rgba(0, 0, 0, 0.85) !important;
            backdrop-filter: blur(12px) !important;
            -webkit-backdrop-filter: blur(12px) !important;
            z-index: 9999 !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        `;

        // Create modal content
        const modalContent = document.createElement('div');
        modalContent.className = 'modal-content';

        // Force strong content styling
        modalContent.style.cssText = `
            background: #ffffff !important;
            border-radius: 24px !important;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5) !important;
            border: 2px solid rgba(255, 255, 255, 0.1) !important;
            max-width: 600px !important;
            width: 90% !important;
            max-height: 90vh !important;
            overflow-y: auto !important;
            position: relative !important;
            z-index: 10000 !important;
            transform: scale(0.9) translateY(20px);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        `;

        modalContent.innerHTML = `
            <div class="modal-header">
                <h3 class="modal-title">📋 ${categoryLabel}</h3>
                <button class="modal-close" onclick="closeQuestionSelectionModal()">×</button>
            </div>
            <div class="modal-body">
                <div style="text-align: center; margin-bottom: var(--space-lg);">
                    <div style="font-size: 4rem; margin-bottom: var(--space-md);">🎯</div>
                    <p style="font-size: 1.125rem; color: var(--text-secondary); line-height: 1.6;">
                        Pilih berapa banyak soal yang ingin Anda jawab untuk kategori <strong>${categoryLabel}</strong>
                    </p>
                </div>

                <div style="display: flex; flex-direction: column; gap: var(--space-sm); max-width: 400px; margin: 0 auto; max-height: 300px; overflow-y: auto;">
                    ${generateQuestionOptions(totalQuestions, costPerQuestion)}
                </div>

                <div style="margin-top: var(--space-lg); padding: var(--space-md); background: var(--surface-elevated); border-radius: var(--radius-md); text-align: center;">
                    <p style="font-size: 0.875rem; color: var(--text-muted); margin: 0;">
                        💰 Biaya: ${costPerQuestion} koin per soal<br>
                        🪙 Koin Anda: <span id="modal-coin-display">${currentUserCoins}</span>
                    </p>
                </div>
            </div>
        `;

        modalOverlay.appendChild(modalContent);
        document.body.appendChild(modalOverlay);

        // Show modal with animation
        setTimeout(() => {
            modalOverlay.classList.add('active');
            // Force visibility and opacity
            modalOverlay.style.opacity = '1';
            modalOverlay.style.visibility = 'visible';
            // Animate modal content
            modalContent.style.transform = 'scale(1) translateY(0)';
        }, 10);
    };

    // Also create non-window version for internal use
    function showQuestionSelectionModal(categoryId, categoryLabel, totalQuestions, costPerQuestion) {
        return window.showQuestionSelectionModal(categoryId, categoryLabel, totalQuestions, costPerQuestion);
    }

    // Generate question options for modal
    function generateQuestionOptions(totalQuestions, costPerQuestion) {
        console.log(`🔧 Generating question options - Total: ${totalQuestions}, Cost: ${costPerQuestion}`);

        const options = [];

        // Create smart question options based on available questions
        let questionCounts = [];

        if (totalQuestions >= 1) {
            // Always offer these options if possible
            const baseOptions = [1, 2, 3, 4, 5];

            // Add more options if we have enough questions
            if (totalQuestions >= 6) baseOptions.push(6, 7);
            if (totalQuestions >= 8) baseOptions.push(8, 9);
            if (totalQuestions >= 10) baseOptions.push(10);

            // Filter to only include options <= totalQuestions
            questionCounts = baseOptions.filter(count => count <= totalQuestions);
        } else {
            // Fallback if no questions available
            questionCounts = [3, 5]; // Default options
        }

        console.log(`📊 Question count options: [${questionCounts.join(', ')}]`);

        questionCounts.forEach(count => {
            const cost = count * costPerQuestion;
            const canAfford = currentUserCoins >= cost;

            console.log(`💰 Option ${count} questions: ${cost} coins, can afford: ${canAfford}`);

            options.push(`
                <button
                    onclick="startCategoryQuestions(${count})"
                    class="btn ${canAfford ? 'btn-primary' : 'btn-outline'}"
                    ${!canAfford ? 'disabled' : ''}
                    style="padding: var(--space-lg); text-align: left; display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--space-sm);"
                >
                    <div>
                        <div style="font-weight: 600; margin-bottom: 4px;">${count} Soal</div>
                        <div style="font-size: 0.875rem; opacity: 0.8;">Biaya: ${cost} koin</div>
                    </div>
                    <div style="font-size: 1.5rem;">${canAfford ? '✅' : '❌'}</div>
                </button>
            `);
        });

        console.log(`✅ Generated ${options.length} question options`);
        return options.join('');
    }

    // Close question selection modal (Global scope)
    window.closeQuestionSelectionModal = function () {
        console.log('🔒 Closing question selection modal');
        const modalOverlay = document.getElementById('question-selection-overlay');
        if (modalOverlay) {
            const modalContent = modalOverlay.querySelector('.modal-content');

            // Animate out
            modalOverlay.style.opacity = '0';
            modalOverlay.style.visibility = 'hidden';
            if (modalContent) {
                modalContent.style.transform = 'scale(0.9) translateY(20px)';
            }

            modalOverlay.classList.remove('active');
            setTimeout(() => {
                modalOverlay.remove();
            }, 300);
        }
    };

    function closeQuestionSelectionModal() {
        return window.closeQuestionSelectionModal();
    }

    // Start category questions (Global scope)
    window.startCategoryQuestions = function (numQuestions) {
        console.log(`🚀 Starting ${numQuestions} questions for ${currentCategoryLabel}`);
        console.log(`🔍 Current category ID: ${currentCategoryId}`);
        console.log(`🔍 Categories data available:`, categoriesData);

        // Close modal
        closeQuestionSelectionModal();

        // Get category data and questions
        let categoryData = categoriesData[currentCategoryId];

        if (!categoryData || !categoryData.questions) {
            console.log('⚠️ No category data found, creating fallback questions');

            // Create fallback questions if data is missing
            categoryData = {
                label: currentCategoryLabel,
                questions: Array(numQuestions).fill().map((_, i) => `Pertanyaan ${i + 1} untuk ${currentCategoryLabel}: Bagaimana penilaian Anda terhadap aspek ini?`),
                cost_per_question: 15
            };

            console.log(`🔧 Created fallback category data:`, categoryData);
        }

        // Prepare questions
        const allQuestions = Array.isArray(categoryData.questions)
            ? categoryData.questions
            : Object.values(categoryData.questions);

        questionsToAsk = allQuestions.slice(0, numQuestions);
        currentQuestionIndex = 0;
        userAnswersForCurrentCategory = [];

        console.log(`📝 Prepared ${questionsToAsk.length} questions:`, questionsToAsk);

        // Switch to chat interface
        showChatInterface();

        // Update progress
        updateProgress();

        // Start first question
        displayNextQuestion();
    };

    // Also create non-window version for internal use
    function startCategoryQuestions(numQuestions) {
        return window.startCategoryQuestions(numQuestions);
    }

    // Update progress for modern UI
    function updateProgress() {
        if (progressElement && progressTextElement && progressCategoryElement) {
            const progress = questionsToAsk.length > 0 ? (currentQuestionIndex / questionsToAsk.length) * 100 : 0;

            progressElement.style.width = `${progress}%`;
            progressTextElement.textContent = `${currentQuestionIndex}/${questionsToAsk.length}`;
            progressCategoryElement.textContent = currentCategoryLabel;

            console.log(`📊 Progress updated: ${currentQuestionIndex}/${questionsToAsk.length} (${progress.toFixed(1)}%)`);
        }
    }

    // Hide question console (go back to categories) - Global scope
    window.hideQuestionConsole = function () {
        console.log('🔙 Returning to categories');
        hideChatInterface();
    };

    function hideQuestionConsole() {
        return window.hideQuestionConsole();
    }

    // Load fallback categories - Global scope
    window.loadFallbackCategories = function () {
        console.log('🔧 Loading fallback categories...');

        if (!window.fallbackCategories) {
            console.error('❌ Fallback categories not available');
            return;
        }

        if (!categoriesContainer) {
            console.error('❌ Categories container not found');
            return;
        }

        categoriesContainer.innerHTML = '';

        Object.entries(window.fallbackCategories).forEach(([categoryId, category]) => {
            console.log(`Creating fallback card for category: ${categoryId}`, category);
            const categoryCard = createCategoryCard(categoryId, category);
            categoriesContainer.appendChild(categoryCard);
        });

        console.log('✅ Fallback categories loaded successfully');
    };

    function loadFallbackCategories() {
        return window.loadFallbackCategories();
    }

    // Additional DOM elements (avoid duplication with modern UI elements above)
    let coinBalanceElement, categorySelectionModal, selectionTitleElement, questionOptionsContainer,
        questionConsoleElement, consoleTitleElement, overallSummaryContentElement, overallSummaryTextElement, requestOverallSummaryButton,
        progressContainer, progressFill, progressText, currentQuestionSpan, totalQuestionsSpan;

    // --- FUNGSI HELPER DAN INTERAKTIF (GLOBAL SCOPE) ---

    function updateCoinBalanceUI(newBalance) {
        console.log("Updating coin balance UI to:", newBalance);
        currentUserCoins = newBalance;
        if (coinBalanceElement) {
            coinBalanceElement.textContent = currentUserCoins;
        } else {
            console.warn("coinBalanceElement not found when trying to update UI.");
        }
    }

    // Progress tracking functions (legacy)
    function updateProgressLegacy() {
        if (progressContainer && progressFill && progressText && currentQuestionSpan && totalQuestionsSpan) {
            const progress = ((currentQuestionIndex + 1) / questionsToAsk.length) * 100;
            progressFill.style.width = progress + '%';
            currentQuestionSpan.textContent = currentQuestionIndex + 1;
            totalQuestionsSpan.textContent = questionsToAsk.length;

            // Show progress elements
            progressContainer.classList.remove('hidden');
            progressText.classList.remove('hidden');
        }
    }

    function hideProgress() {
        if (progressContainer && progressText) {
            progressContainer.classList.add('hidden');
            progressText.classList.add('hidden');
        }
    }

    function displayMessageInChat(message, type, isHTML = false) {
        if (!chatHistoryElement) {
            // console.warn("chatHistoryElement not found for displayMessageInChat. Message:", message);
            return;
        }

        // Create modern message structure
        const messageWrapper = document.createElement('div');
        messageWrapper.className = `message ${type}`;

        const avatar = document.createElement('div');
        avatar.className = 'message-avatar';
        avatar.textContent = type === 'user' ? '👤' : '🤖';

        const content = document.createElement('div');
        content.className = 'message-content';

        // Add special styling for different message types
        if (type === 'bot' && (message.includes('🎉') || message.includes('Semua pertanyaan'))) {
            content.classList.add('summary-title');
        }
        if (type === 'bot' && message.includes('Error')) {
            content.classList.add('error-message');
        }

        if (isHTML || type === 'bot') {
            content.innerHTML = message;
        } else {
            content.textContent = message;
        }

        messageWrapper.appendChild(avatar);
        messageWrapper.appendChild(content);

        chatHistoryElement.appendChild(messageWrapper);
        chatHistoryElement.scrollTop = chatHistoryElement.scrollHeight;
    }

    // Enhanced AI Typing Animation
    function showTypingIndicator(text = "AI sedang mengetik") {
        const typingId = 'typing-' + Date.now();
        const typingHTML = `
            <div id="${typingId}" class="typing-indicator">
                <span class="ai-typing-text">${text}</span>
                <div class="typing-dots">
                    <div class="typing-dot"></div>
                    <div class="typing-dot"></div>
                    <div class="typing-dot"></div>
                </div>
            </div>
        `;

        if (chatHistoryElement) {
            chatHistoryElement.insertAdjacentHTML('beforeend', typingHTML);
            chatHistoryElement.scrollTop = chatHistoryElement.scrollHeight;
        }
        return typingId;
    }

    function removeTypingIndicator(typingId) {
        const el = document.getElementById(typingId);
        if (el) {
            el.style.animation = 'messageSlideOut 0.3s ease-in forwards';
            setTimeout(() => {
                if (el.parentNode) {
                    el.parentNode.removeChild(el);
                }
            }, 300);
        }
    }

    // Reliable HTML typewriter effect - renders HTML properly
    function typewriterEffect(element, htmlContent, speed = 30) {
        return new Promise((resolve) => {
            // Immediately set the HTML content to render it properly
            element.innerHTML = htmlContent;

            // Get the rendered text content
            const fullText = element.textContent || element.innerText || '';

            // Now clear and start the typing effect
            element.innerHTML = '';
            let currentIndex = 0;

            function typeNextChar() {
                if (currentIndex < fullText.length) {
                    // Get current text portion
                    const currentText = fullText.substring(0, currentIndex + 1);

                    // Create HTML that matches this text length
                    const partialHTML = createHTMLForTextLength(htmlContent, currentText.length);
                    element.innerHTML = partialHTML;

                    currentIndex++;
                    setTimeout(typeNextChar, speed);
                } else {
                    // Ensure final HTML is complete
                    element.innerHTML = htmlContent;
                    resolve();
                }
            }

            typeNextChar();
        });
    }

    // Create HTML content up to a specific text length
    function createHTMLForTextLength(originalHTML, targetLength) {
        if (targetLength <= 0) return '';

        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = originalHTML;

        let currentLength = 0;
        let result = '';

        function walkNodes(node) {
            if (currentLength >= targetLength) return false;

            if (node.nodeType === Node.TEXT_NODE) {
                const text = node.textContent;
                const remainingLength = targetLength - currentLength;

                if (remainingLength >= text.length) {
                    result += text;
                    currentLength += text.length;
                } else {
                    result += text.substring(0, remainingLength);
                    currentLength = targetLength;
                    return false;
                }
            } else if (node.nodeType === Node.ELEMENT_NODE) {
                const tagName = node.tagName.toLowerCase();
                result += `<${tagName}>`;

                // Process child nodes
                for (let child of node.childNodes) {
                    if (!walkNodes(child)) break;
                }

                result += `</${tagName}>`;
            }

            return currentLength < targetLength;
        }

        for (let child of tempDiv.childNodes) {
            if (!walkNodes(child)) break;
        }

        return result;
    }

    // Simple and reliable HTML typewriter effect
    function typewriterEffectWithHTML(element, htmlContent, speed = 30) {
        return new Promise((resolve) => {
            // First, render the HTML to extract the plain text
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = htmlContent;
            const plainText = tempDiv.textContent || tempDiv.innerText || '';

            // Clear the element and start typing
            element.innerHTML = '';
            let currentIndex = 0;

            function typeNextChar() {
                if (currentIndex < plainText.length) {
                    // Get the current text portion
                    const currentText = plainText.substring(0, currentIndex + 1);

                    // Rebuild HTML with current text length
                    const currentHTML = buildHTMLWithTextLimit(htmlContent, currentText.length);
                    element.innerHTML = currentHTML;

                    currentIndex++;
                    setTimeout(typeNextChar, speed);
                } else {
                    // Show complete HTML
                    element.innerHTML = htmlContent;
                    resolve();
                }
            }

            typeNextChar();
        });
    }

    // Build HTML content limited to specific text length
    function buildHTMLWithTextLimit(htmlContent, maxLength) {
        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = htmlContent;

        let textCount = 0;
        let result = '';

        function processNode(node) {
            if (textCount >= maxLength) return false;

            if (node.nodeType === Node.TEXT_NODE) {
                const text = node.textContent;
                const remaining = maxLength - textCount;

                if (remaining >= text.length) {
                    result += text;
                    textCount += text.length;
                } else {
                    result += text.substring(0, remaining);
                    textCount = maxLength;
                    return false;
                }
            } else if (node.nodeType === Node.ELEMENT_NODE) {
                const tagName = node.tagName.toLowerCase();
                result += `<${tagName}>`;

                for (let child of node.childNodes) {
                    if (!processNode(child)) break;
                }

                result += `</${tagName}>`;
            }

            return textCount < maxLength;
        }

        for (let child of tempDiv.childNodes) {
            if (!processNode(child)) break;
        }

        return result;
    }

    // Simple HTML typewriter that renders HTML properly
    function simpleHTMLTypewriter(element, htmlContent, speed = 15) {
        return new Promise((resolve) => {
            // Show a brief loading state
            element.innerHTML = '<span style="opacity: 0.6;">Memuat respons AI...</span>';

            setTimeout(() => {
                // Extract plain text for typing effect
                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = htmlContent;
                const plainText = tempDiv.textContent || tempDiv.innerText || '';

                // Clear and start typing
                element.innerHTML = '';
                let currentIndex = 0;

                function typeChar() {
                    if (currentIndex < plainText.length) {
                        // For simplicity, just add characters to a text node
                        // and then replace with full HTML at the end
                        element.textContent = plainText.substring(0, currentIndex + 1);
                        currentIndex++;
                        setTimeout(typeChar, speed);
                    } else {
                        // Replace with properly formatted HTML
                        element.innerHTML = htmlContent;
                        resolve();
                    }
                }

                typeChar();
            }, 300); // Shorter delay to show loading
        });
    }

    // Fallback simple typewriter for plain text
    function simpleTypewriterEffect(element, text, speed = 30) {
        return new Promise((resolve) => {
            element.innerHTML = '';
            let i = 0;

            function typeChar() {
                if (i < text.length) {
                    element.innerHTML += text.charAt(i);
                    i++;
                    setTimeout(typeChar, speed);
                } else {
                    resolve();
                }
            }

            typeChar();
        });
    }

    // ===== DIRECT MAJOR SELECTION SYSTEM =====

    // Extract majors from AI response with multiple patterns
    function extractMajorsFromAI(aiResponse) {
        console.log('🔍 Extracting majors from AI response...');
        const majors = [];

        // Pattern 1: "1. Teknologi Peternakan" followed by "Alasan:"
        const pattern1 = /(?:^|\n)\s*(\d+)\.\s*([^\n]+?)(?=\s*\n\s*(?:Alasan|Reasoning|Penjelasan))/gm;
        let match;
        while ((match = pattern1.exec(aiResponse)) !== null) {
            const major = match[2].trim();
            if (major.length > 3 && major.length < 60 && !majors.includes(major)) {
                majors.push(major);
                console.log('✅ Found major (Pattern 1):', major);
            }
        }

        // Pattern 2: "1. Teknologi Peternakan:" (with colon)
        if (majors.length === 0) {
            const pattern2 = /(?:^|\n)\s*(\d+)\.\s*([^:\n]+?):/gm;
            while ((match = pattern2.exec(aiResponse)) !== null) {
                const major = match[2].trim();
                if (major.length > 3 && major.length < 60 && !majors.includes(major)) {
                    majors.push(major);
                    console.log('✅ Found major (Pattern 2):', major);
                }
            }
        }

        // Pattern 3: Look for common major keywords as fallback
        if (majors.length === 0) {
            const commonMajors = [
                'Teknologi Peternakan', 'Biologi', 'Ilmu Lingkungan', 'Teknik Informatika',
                'Sistem Informasi', 'Teknik Komputer', 'Manajemen', 'Ekonomi', 'Akuntansi',
                'Psikologi', 'Kedokteran', 'Hukum', 'Sastra Inggris', 'Pendidikan', 'Komunikasi'
            ];

            for (const major of commonMajors) {
                if (aiResponse.toLowerCase().includes(major.toLowerCase())) {
                    majors.push(major);
                    console.log('✅ Found major (Fallback):', major);
                }
            }
        }

        console.log('📋 Total extracted majors:', majors);
        return majors.slice(0, 5); // Limit to 5 majors
    }

    // Show direct major selection immediately after AI response
    function showDirectMajorSelection(aiResponse, userAnswers) {
        console.log('🚀 showDirectMajorSelection called');
        console.log('AI Response length:', aiResponse.length);

        // Extract majors from AI response
        const extractedMajors = extractMajorsFromAI(aiResponse);

        if (extractedMajors.length === 0) {
            console.log('❌ No majors found in AI response');
            return;
        }

        console.log('✅ Found majors, creating selection buttons');

        // Find the overall summary container
        const overallSummaryContent = document.getElementById('overall-summary-content');
        if (!overallSummaryContent) {
            console.error('❌ overall-summary-content not found!');
            return;
        }

        // Remove any existing major selection
        const existingSelection = document.getElementById('major-selection-section');
        if (existingSelection) {
            existingSelection.remove();
        }

        // Create major selection section
        const majorSelectionDiv = document.createElement('div');
        majorSelectionDiv.id = 'major-selection-section';
        majorSelectionDiv.className = 'mt-6 p-6 bg-gradient-to-r from-green-50 to-blue-50 rounded-lg border-2 border-green-300 shadow-lg';

        majorSelectionDiv.innerHTML = `
            <div class="text-center">
                <div class="text-4xl mb-4">🎓</div>
                <h3 class="text-xl font-bold text-gray-800 mb-4">Pilih Jurusan untuk Analisis Mendalam</h3>
                <p class="text-gray-600 mb-6">Klik salah satu jurusan yang direkomendasikan AI untuk mendapatkan analisis yang lebih mendalam:</p>

                <div class="grid gap-3 max-w-2xl mx-auto">
                    ${extractedMajors.map((major, index) => `
                        <button onclick="selectMajorDirectly('${major.replace(/'/g, "\\'")}', '${btoa(aiResponse)}', '${btoa(JSON.stringify(userAnswers))}')"
                                class="w-full p-4 bg-white border-2 border-green-200 rounded-lg hover:border-green-500 hover:bg-green-50 transition-all duration-300 transform hover:scale-105 shadow-md hover:shadow-lg">
                            <div class="flex items-center justify-between">
                                <div class="text-left">
                                    <div class="font-bold text-gray-800 text-lg">${major}</div>
                                    <div class="text-sm text-gray-600">Klik untuk analisis mendalam</div>
                                </div>
                                <div class="text-3xl">🎯</div>
                            </div>
                        </button>
                    `).join('')}
                </div>

                <div class="mt-6 text-sm text-gray-500">
                    💡 Tip: Pilih jurusan yang paling menarik minat Anda untuk mendapatkan rekomendasi yang lebih spesifik
                </div>
            </div>
        `;

        // Add to the overall summary content
        overallSummaryContent.appendChild(majorSelectionDiv);

        // Scroll to the selection with smooth animation
        majorSelectionDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });

        // Add entrance animation
        majorSelectionDiv.style.opacity = '0';
        majorSelectionDiv.style.transform = 'translateY(20px)';

        setTimeout(() => {
            majorSelectionDiv.style.transition = 'all 0.5s ease-out';
            majorSelectionDiv.style.opacity = '1';
            majorSelectionDiv.style.transform = 'translateY(0)';
        }, 100);

        console.log('✅ Major selection buttons created and displayed');
    }

    // Handle direct major selection
    function selectMajorDirectly(selectedMajor, encodedAiResponse, encodedUserAnswers) {
        console.log('🎯 User selected major:', selectedMajor);

        try {
            const aiResponse = atob(encodedAiResponse);
            const userAnswers = JSON.parse(atob(encodedUserAnswers));

            // Hide the major selection section with animation
            const majorSelectionSection = document.getElementById('major-selection-section');
            if (majorSelectionSection) {
                majorSelectionSection.style.transition = 'all 0.3s ease-out';
                majorSelectionSection.style.opacity = '0';
                majorSelectionSection.style.transform = 'translateY(-20px)';

                setTimeout(() => {
                    majorSelectionSection.remove();
                }, 300);
            }

            // Show processing message
            showMajorProcessingMessage(selectedMajor);

            // Process the selected major (you can expand this)
            setTimeout(() => {
                processMajorSelection(selectedMajor, aiResponse, userAnswers);
            }, 1000);

        } catch (error) {
            console.error('Error processing major selection:', error);
            alert('Terjadi kesalahan saat memproses pilihan Anda. Silakan coba lagi.');
        }
    }

    // Show processing message for selected major
    function showMajorProcessingMessage(selectedMajor) {
        const overallSummaryContent = document.getElementById('overall-summary-content');
        if (!overallSummaryContent) return;

        const processingDiv = document.createElement('div');
        processingDiv.id = 'major-processing-section';
        processingDiv.className = 'mt-6 p-6 bg-gradient-to-r from-blue-50 to-purple-50 rounded-lg border-2 border-blue-300 shadow-lg text-center';

        processingDiv.innerHTML = `
            <div class="text-4xl mb-4">⚡</div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Menganalisis Pilihan Anda</h3>
            <p class="text-gray-600 mb-4">Sedang memproses analisis mendalam untuk <strong>${selectedMajor}</strong>...</p>
            <div class="flex justify-center">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
            </div>
        `;

        overallSummaryContent.appendChild(processingDiv);
        processingDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    // Process the major selection (placeholder for future development)
    function processMajorSelection(selectedMajor, aiResponse, userAnswers) {
        console.log('🔄 Processing major selection:', selectedMajor);

        // Remove processing message
        const processingSection = document.getElementById('major-processing-section');
        if (processingSection) {
            processingSection.remove();
        }

        // Show result
        const overallSummaryContent = document.getElementById('overall-summary-content');
        if (!overallSummaryContent) return;

        const resultDiv = document.createElement('div');
        resultDiv.className = 'mt-6 p-6 bg-gradient-to-r from-green-50 to-emerald-50 rounded-lg border-2 border-green-400 shadow-lg text-center';

        resultDiv.innerHTML = `
            <div class="text-4xl mb-4">🎉</div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Analisis Selesai!</h3>
            <p class="text-gray-700 mb-4">
                Anda telah memilih <strong>${selectedMajor}</strong> untuk analisis mendalam.
                Berdasarkan profil dan preferensi Anda, ini adalah pilihan yang sangat baik!
            </p>
            <div class="bg-white p-4 rounded-lg border border-green-200 mb-4">
                <h4 class="font-semibold text-green-800 mb-2">Rekomendasi untuk ${selectedMajor}:</h4>
                <ul class="text-left text-sm text-gray-700 space-y-1">
                    <li>✅ Sesuai dengan minat dan bakat yang Anda tunjukkan</li>
                    <li>✅ Memiliki prospek karir yang baik di masa depan</li>
                    <li>✅ Cocok dengan kepribadian dan gaya belajar Anda</li>
                </ul>
            </div>
            <button onclick="startNewAnalysis()"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors">
                Mulai Analisis Baru
            </button>
        `;

        overallSummaryContent.appendChild(resultDiv);
        resultDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });

        console.log('✅ Major selection processing completed');
    }

    // Start new analysis (reset function)
    function startNewAnalysis() {
        location.reload();
    }

    // Show simulation prompt button directly after AI summary
    function showSimulationPromptButton(aiResponse, userAnswers) {
        const overallSummaryContent = document.getElementById('overall-summary-content');

        // Check if button already exists
        if (document.getElementById('simulation-prompt-button')) {
            return; // Don't add duplicate button
        }

        // Create simulation prompt section
        const simulationPromptDiv = document.createElement('div');
        simulationPromptDiv.id = 'simulation-prompt-section';
        simulationPromptDiv.className = 'mt-6 p-6 bg-gradient-to-r from-blue-50 to-purple-50 rounded-lg border border-blue-200';

        // First, try to extract majors to show preview
        const tempMajors = extractMajorsPreview(aiResponse);
        const majorsPreview = tempMajors.length > 0 ?
            `<div class="bg-blue-50 p-3 rounded-lg mb-4 border border-blue-200">
                <p class="text-xs text-blue-600 mb-2">Jurusan yang direkomendasikan AI:</p>
                <div class="text-sm text-blue-800 font-medium">
                    ${tempMajors.map(major => `• ${major}`).join('<br>')}
                </div>
            </div>` : '';

        simulationPromptDiv.innerHTML = `
            <div class="text-center">
                <div class="text-4xl mb-3">🎯</div>
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Validasi Rekomendasi Jurusan</h3>

                ${majorsPreview}

                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                    Dari rekomendasi jurusan yang telah AI berikan di atas, apakah Anda ingin memilih salah satu
                    untuk dianalisis lebih mendalam melalui simulasi interaktif? Simulasi ini akan membantu Anda
                    memahami lebih dalam apakah pilihan jurusan tersebut benar-benar sesuai dengan kepribadian dan preferensi Anda.
                </p>

                <div class="flex gap-3 justify-center">
                    <button id="simulation-prompt-button" onclick="startSimulationFromButton('${btoa(aiResponse)}', '${btoa(JSON.stringify(userAnswers))}')"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-semibold transition-colors text-sm flex items-center gap-2">
                        <span>✨</span> Ya, saya ingin mencoba simulasi
                    </button>
                    <button onclick="hideSimulationPrompt()"
                            class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg font-semibold transition-colors text-sm">
                        Tidak, terima kasih
                    </button>
                </div>
            </div>
        `;

        // Add to overall summary content
        if (overallSummaryContent) {
            overallSummaryContent.appendChild(simulationPromptDiv);
        }
    }

    // Hide simulation prompt
    function hideSimulationPrompt() {
        const simulationPromptSection = document.getElementById('simulation-prompt-section');
        if (simulationPromptSection) {
            simulationPromptSection.style.animation = 'fadeOut 0.3s ease-out forwards';
            setTimeout(() => {
                simulationPromptSection.remove();
            }, 300);
        }
    }

    // Start simulation from button (opens modal)
    function startSimulationFromButton(encodedAiResponse, encodedUserAnswers) {
        // Hide the prompt section
        hideSimulationPrompt();

        // Start the simulation in modal
        startSimulation(encodedAiResponse, encodedUserAnswers);
    }

    // Show simulation prompt after AI recommendation
    function showSimulationPrompt(aiResponse, userAnswers) {
        const simulationModal = document.getElementById('simulation-modal');
        const simulationContent = document.getElementById('simulation-content');

        simulationContent.innerHTML = `
            <div class="text-center">
                <div class="mb-6">
                    <div class="text-6xl mb-4">🎯</div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Validasi Rekomendasi Jurusan</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Apakah Anda ingin mencoba simulasi interaktif untuk memvalidasi rekomendasi jurusan ini?
                        Simulasi ini akan membantu Anda memahami lebih dalam apakah pilihan jurusan tersebut
                        benar-benar sesuai dengan kepribadian dan preferensi Anda.
                    </p>
                </div>

                <div class="flex gap-4 justify-center">
                    <button onclick="startSimulation('${btoa(aiResponse)}', '${btoa(JSON.stringify(userAnswers))}')"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors">
                        ✨ Ya, saya ingin mencoba simulasi
                    </button>
                    <button onclick="closeSimulation()"
                            class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold transition-colors">
                        Tidak, terima kasih
                    </button>
                </div>
            </div>
        `;

        simulationModal.classList.remove('hidden');
    }

    // Start simulation
    async function startSimulation(encodedAiResponse, encodedUserAnswers) {
        try {
            const aiResponse = atob(encodedAiResponse);
            const userAnswers = JSON.parse(atob(encodedUserAnswers));

            const response = await fetch('/simulation/start', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    ai_response: aiResponse,
                    user_answers: userAnswers
                })
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.error || 'Gagal memulai simulasi');
            }

            currentSimulationSession = data.session_id;
            simulationData = data;

            // Show dynamic simulation prompt with AI memory content
            showDynamicSimulationPrompt(data);

        } catch (error) {
            console.error('Error starting simulation:', error);
            alert('Terjadi kesalahan saat memulai simulasi: ' + error.message);
        }
    }

    // Show dynamic prompt response with AI-generated content
    function showDynamicSimulationPrompt(data) {
        const simulationContent = document.getElementById('simulation-content');

        // Extract recommendations and dynamic content
        const recommendations = data.recommendations || [];
        const followUpQuestion = data.follow_up_question || "Apakah Anda ingin mencoba simulasi interaktif?";
        const dynamicOptions = data.dynamic_options || [];

        simulationContent.innerHTML = `
            <div class="text-center">
                <div class="mb-6">
                    <div class="text-4xl mb-4">🧠</div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">AI Memory System</h3>
                    <div class="bg-gradient-to-r from-blue-50 to-purple-50 p-4 rounded-lg mb-4 border border-blue-200">
                        <p class="text-sm text-gray-600 mb-3">AI telah menganalisis rekomendasi dan mengidentifikasi:</p>
                        <div class="grid gap-2 text-left">
                            ${recommendations.map(rec => `
                                <div class="bg-white p-3 rounded border-l-4 border-blue-500">
                                    <div class="font-semibold text-blue-800">${rec.major}</div>
                                    <div class="text-xs text-gray-600 mt-1">${rec.reasoning.substring(0, 100)}...</div>
                                    <div class="text-xs text-blue-600 mt-1">Confidence: ${Math.round(rec.confidence * 100)}%</div>
                                </div>
                            `).join('')}
                        </div>
                    </div>
                    <div class="bg-yellow-50 p-4 rounded-lg mb-4 border border-yellow-200">
                        <p class="text-gray-700 font-medium">${followUpQuestion}</p>
                    </div>
                </div>

                <div class="space-y-3">
                    ${dynamicOptions.map(option => `
                        <button onclick="selectDynamicMajor('${option.major}', ${option.id})"
                                class="w-full p-4 bg-white border-2 border-gray-200 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition-all text-left">
                            <div class="flex items-center justify-between">
                                <div>
                                    <div class="font-semibold text-gray-800">${option.display_text}</div>
                                    <div class="text-sm text-gray-600 mt-1">${option.short_description}</div>
                                </div>
                                <div class="text-2xl">${option.confidence > 0.8 ? '🌟' : option.confidence > 0.6 ? '⭐' : '✨'}</div>
                            </div>
                        </button>
                    `).join('')}

                    <button onclick="respondToPrompt('no')"
                            class="w-full mt-4 bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold transition-colors">
                        Tidak, terima kasih
                    </button>
                </div>
            </div>
        `;
    }

    // Select major from dynamic options
    function selectDynamicMajor(major, optionId) {
        console.log('Selected major from AI memory:', major, 'Option ID:', optionId);

        // Store selected major in simulation data
        if (simulationData) {
            simulationData.selectedMajor = major;
            simulationData.selectedOptionId = optionId;
        }

        // Proceed with simulation for selected major
        proceedWithSelectedMajor(major);
    }

    // Proceed with selected major
    async function proceedWithSelectedMajor(major) {
        try {
            const response = await fetch('/simulation/confirm-major', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    session_id: currentSimulationSession,
                    confirmed: true,
                    selected_major: major
                })
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.error || 'Gagal memproses pilihan major');
            }

            // Show confirmation and proceed to deep simulation
            showMajorConfirmation(major, data);

        } catch (error) {
            console.error('Error selecting major:', error);
            alert('Terjadi kesalahan: ' + error.message);
        }
    }

    // Show major confirmation with AI context
    function showMajorConfirmation(major, data) {
        const simulationContent = document.getElementById('simulation-content');

        simulationContent.innerHTML = `
            <div class="text-center">
                <div class="mb-6">
                    <div class="text-4xl mb-4">🎯</div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Pilihan Berdasarkan AI Memory</h3>
                    <div class="bg-green-50 p-6 rounded-lg mb-6 border border-green-200">
                        <h4 class="text-lg font-semibold text-green-800 mb-3">Jurusan Terpilih: ${major}</h4>
                        <p class="text-gray-700 leading-relaxed">
                            Berdasarkan analisis AI terhadap rekomendasi sebelumnya dan pilihan Anda,
                            ${major} menunjukkan kesesuaian yang baik dengan profil dan preferensi Anda.
                            AI telah menyimpan konteks dan reasoning dari rekomendasi ini untuk simulasi mendalam.
                        </p>
                    </div>
                    <div class="bg-blue-50 p-4 rounded-lg mb-6 border border-blue-200">
                        <p class="text-sm text-blue-800 font-medium">🧠 AI Memory Active</p>
                        <p class="text-xs text-blue-600 mt-1">
                            Sistem akan menggunakan konteks dan reasoning AI untuk membuat pertanyaan simulasi yang relevan
                        </p>
                    </div>
                </div>

                <div class="flex gap-4 justify-center">
                    <button onclick="startDeepSimulation()"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors">
                        🚀 Mulai Simulasi Mendalam
                    </button>
                    <button onclick="closeSimulation()"
                            class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold transition-colors">
                        Selesai
                    </button>
                </div>
            </div>
        `;
    }

    // Start deep simulation with AI context
    async function startDeepSimulation() {
        try {
            const response = await fetch('/simulation/start-deep', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    session_id: currentSimulationSession
                })
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.error || 'Gagal memulai simulasi mendalam');
            }

            // Show deep simulation questions
            if (data.questions && data.questions.length > 0) {
                showSimulationQuestions(data.questions, 'deep');
            }

        } catch (error) {
            console.error('Error starting deep simulation:', error);
            alert('Terjadi kesalahan: ' + error.message);
        }
    }

    // Respond to simulation prompt
    async function respondToPrompt(response) {
        try {
            const apiResponse = await fetch('/simulation/prompt-response', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    session_id: currentSimulationSession,
                    response: response
                })
            });

            const data = await apiResponse.json();

            if (!apiResponse.ok) {
                throw new Error(data.error || 'Gagal memproses respons');
            }

            if (response === 'no') {
                closeSimulation();
                return;
            }

            // Start initial questions
            showSimulationQuestions(data.questions, data.phase);
            updateSimulationProgress(0, data.total_questions);

        } catch (error) {
            console.error('Error responding to prompt:', error);
            alert('Terjadi kesalahan: ' + error.message);
        }
    }

    // Show simulation questions
    function showSimulationQuestions(questions, phase) {
        const simulationContent = document.getElementById('simulation-content');
        const progressContainer = document.getElementById('simulation-progress');

        progressContainer.classList.remove('hidden');

        if (questions && questions.length > 0) {
            showQuestion(questions[0], 0, questions.length, phase);
        }
    }

    // Show individual question
    function showQuestion(question, currentIndex, totalQuestions, phase) {
        const simulationContent = document.getElementById('simulation-content');

        simulationContent.innerHTML = `
            <div>
                <div class="mb-6">
                    <div class="text-sm text-gray-500 mb-2">
                        ${phase === 'initial' ? 'Fase Awal' : 'Simulasi Mendalam'} - Pertanyaan ${currentIndex + 1} dari ${totalQuestions}
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">${question.question}</h3>
                </div>

                <div class="space-y-3">
                    ${question.options.map(option => `
                        <button onclick="submitAnswer(${question.id}, '${option.id}')"
                                class="w-full text-left p-4 border border-gray-200 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition-colors">
                            <span class="font-medium text-blue-600">${option.id}.</span> ${option.text}
                        </button>
                    `).join('')}
                </div>
            </div>
        `;

        updateSimulationProgress(currentIndex + 1, totalQuestions);
    }

    // Submit answer
    async function submitAnswer(questionId, answer) {
        try {
            const response = await fetch('/simulation/submit-answer', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    session_id: currentSimulationSession,
                    question_id: questionId,
                    answer: answer
                })
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.error || 'Gagal menyimpan jawaban');
            }

            // Check if phase is complete
            if (data.phase === 'confirmation') {
                showConfirmation(data.selected_major, data.explanation);
            } else if (data.phase === 'analysis') {
                showAnalysis(data.analysis);
            } else {
                // Continue with next question
                // This would need to fetch the next question from the session
                updateSimulationProgress(data.next_question, data.total_questions);
            }

        } catch (error) {
            console.error('Error submitting answer:', error);
            alert('Terjadi kesalahan: ' + error.message);
        }
    }

    // Show confirmation
    function showConfirmation(selectedMajor, explanation) {
        const simulationContent = document.getElementById('simulation-content');

        simulationContent.innerHTML = `
            <div class="text-center">
                <div class="mb-6">
                    <div class="text-4xl mb-4">🎯</div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Hasil Analisis Awal</h3>
                    <div class="bg-green-50 p-6 rounded-lg mb-6">
                        <h4 class="text-lg font-semibold text-green-800 mb-3">Jurusan yang Cocok: ${selectedMajor}</h4>
                        <p class="text-gray-700 leading-relaxed">${explanation}</p>
                    </div>
                </div>

                <div class="flex gap-4 justify-center">
                    <button onclick="confirmMajor(true)"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors">
                        ✨ Ya, lanjutkan simulasi mendalam
                    </button>
                    <button onclick="confirmMajor(false)"
                            class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold transition-colors">
                        Tidak, cukup sampai di sini
                    </button>
                </div>
            </div>
        `;
    }

    // Confirm major selection
    async function confirmMajor(confirmed) {
        try {
            const response = await fetch('/simulation/confirm-major', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    session_id: currentSimulationSession,
                    confirmed: confirmed
                })
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.error || 'Gagal memproses konfirmasi');
            }

            if (!confirmed) {
                closeSimulation();
                return;
            }

            // Start deep simulation
            showSimulationQuestions(data.questions, data.phase);

        } catch (error) {
            console.error('Error confirming major:', error);
            alert('Terjadi kesalahan: ' + error.message);
        }
    }

    // Update progress bar (simulation)
    function updateSimulationProgress(current, total) {
        const progressBar = document.getElementById('progress-bar-sim');
        const progressText = document.getElementById('progress-text-sim');

        const percentage = Math.round((current / total) * 100);

        if (progressBar) {
            progressBar.style.width = percentage + '%';
        }

        if (progressText) {
            progressText.textContent = percentage + '%';
        }
    }

    // Close simulation modal
    function closeSimulation() {
        const simulationModal = document.getElementById('simulation-modal');
        simulationModal.classList.add('hidden');
        currentSimulationSession = null;
        simulationData = null;
    }

    // ===== REMOVED COMPLEX SIMULATION CODE =====
    // Old complex simulation system has been removed and replaced with direct major selection

    // ===== OLD FUNCTIONS REMOVED =====
    // Replaced with new direct major selection system above

    // ===== ALL OLD SIMULATION FUNCTIONS REMOVED =====
    // Replaced with direct major selection system

    function displayLoadingMessage(text = "Sedang memproses...") {
        const loadingId = 'loading-' + Date.now();
        displayMessageInChat(`<span id="${loadingId}">${text} <span class="spinner"></span></span>`, 'bot', true);
        return loadingId;
    }

    function removeLoadingMessage(loadingId) {
        const el = document.getElementById(loadingId);
        if (el && el.parentElement) {
            if (el.parentElement.classList.contains('bot-message')) {
                el.parentElement.remove();
            } else {
                el.remove();
            }
        }
    }

    function displayErrorMessageInChat(message) {
        displayMessageInChat(`<strong>Error:</strong> ${message}`, 'bot error-message', true);
    }

    // LEGACY FUNCTION - DISABLED to prevent double modal issue
    // This function is replaced by selectCategory() -> showQuestionSelectionModal()
    function showCategorySelection_DISABLED(categoryId, categoryLabel, totalQuestions, costPerQuestion) {
        console.log("--- showCategorySelection CALLED (DISABLED) ---");
        console.log("This function is disabled to prevent double modal issue");
        console.log("Use selectCategory() instead");
        return;

        console.log("Args:", {
            categoryId,
            categoryLabel,
            totalQuestions,
            costPerQuestion
        });
        console.log("Current categoriesData:", JSON.parse(JSON.stringify(categoriesData))); // Log a copy
        console.log("Current currentUserCoins:", currentUserCoins);

        // Pastikan elemen DOM sudah diinisialisasi (seharusnya sudah via DOMContentLoaded)
        if (!selectionTitleElement || !questionOptionsContainer || !categorySelectionModal) {
            console.error(
                "CRITICAL: Modal DOM elements (selectionTitleElement, questionOptionsContainer, or categorySelectionModal) not found!"
            );
            alert("Terjadi kesalahan internal: Komponen modal tidak siap. Silakan refresh halaman.");
            return;
        }
        console.log("Modal elements seem to be found.");

        currentCategoryId = categoryId;
        currentCategoryLabel = categoryLabel;

        if (!categoriesData || !categoriesData[categoryId] || typeof categoriesData[categoryId].questions ===
            'undefined') {
            console.error("ERROR: Category data is invalid, or 'questions' array is missing for categoryId:",
                categoryId);
            console.log("Details of categoriesData[categoryId]:", categoriesData ? categoriesData[categoryId] :
                'categoriesData is null/undefined');
            selectionTitleElement.textContent = `Error Data Kategori`;
            questionOptionsContainer.innerHTML =
                '<p class="text-red-500 text-center col-span-full">Maaf, data pertanyaan untuk kategori ini tidak dapat dimuat.</p>';
            categorySelectionModal.classList.remove('hidden');
            return;
        }
        currentCategoryQuestions = categoriesData[categoryId].questions; // Simpan semua pertanyaan asli
        console.log("Original questions for this category:", currentCategoryQuestions);


        selectionTitleElement.textContent = `Pilih Jumlah Pertanyaan untuk "${categoryLabel}"`;
        questionOptionsContainer.innerHTML = ''; // Kosongkan opsi sebelumnya
        console.log("Cleared questionOptionsContainer.");

        // totalQuestions harusnya dari count($category['questions']) di Blade, pastikan itu angka
        totalQuestions = Number(totalQuestions);
        costPerQuestion = Number(costPerQuestion || 15); // Default cost if undefined

        console.log("Processed totalQuestions:", totalQuestions, "Processed costPerQuestion:", costPerQuestion);

        if (isNaN(totalQuestions) || totalQuestions < 0) {
            console.error("Invalid totalQuestions value:", totalQuestions);
            questionOptionsContainer.innerHTML =
                '<p class="text-center text-gray-500 col-span-full">Jumlah pertanyaan tidak valid.</p>';
        } else if (totalQuestions === 0) {
            console.log("No questions available (totalQuestions is 0).");
            questionOptionsContainer.innerHTML =
                '<p class="text-center text-gray-500 col-span-full">Tidak ada pertanyaan untuk kategori ini.</p>';
        } else {
            const minQuestions = Math.max(1, Math.min(2, totalQuestions));
            console.log("Calculated minQuestions:", minQuestions);

            let buttonsHtml = '';
            for (let i = minQuestions; i <= totalQuestions; i++) {
                console.log("Looping to create button for 'i':", i);
                const cost = i * costPerQuestion;
                let disabledAttr = '';
                let disabledText = '';
                if (currentUserCoins < cost) {
                    disabledAttr = 'disabled title="Koin tidak cukup"';
                    disabledText =
                        ' <small style="display:block; font-size:0.7rem; color:var(--red-500)">(Koin tdk cukup)</small>'; // Ganti warna jika perlu
                }
                // Simpan parameter fungsi startQuestionConsole ke data- attributes
                buttonsHtml += `
                    <button class="question-option-button"
                            data-questions="${i}"
                            data-cost="${cost}"
                            ${disabledAttr}>
                        ${i} Pertanyaan
                        <img src="/logoAI/coin.png" alt="koin" style="width:20px; height:auto;">
                        <span>${cost} Koin</span>
                        ${disabledText}
                    </button>
                `;
            }
            questionOptionsContainer.innerHTML = buttonsHtml;
            console.log("Generated buttons HTML:", buttonsHtml);

            // Tambahkan event listener ke tombol yang baru dibuat
            questionOptionsContainer.querySelectorAll('.question-option-button').forEach(button => {
                if (button.disabled) return; // Jangan tambahkan listener ke tombol disabled
                button.addEventListener('click', function () {
                    const numQ = parseInt(this.dataset.questions);
                    const cost = parseInt(this.dataset.cost);
                    console.log("Question option button clicked for", numQ, "questions. Cost:", cost);
                    if (currentUserCoins >= cost) {
                        startQuestionConsole(numQ, cost);
                    } else {
                        alert(`Koin Anda (${currentUserCoins}) tidak cukup. Butuh ${cost} koin.`);
                    }
                });
            });


            if (questionOptionsContainer.childElementCount === 0 && totalQuestions > 0) {
                console.warn(
                    "Loop for buttons ran, but no buttons were added. Check minQuestions and totalQuestions logic.");
                questionOptionsContainer.innerHTML =
                    '<p class="text-center text-gray-500 col-span-full">Tidak ada opsi jumlah pertanyaan yang valid saat ini.</p>';
            }
        }
        categorySelectionModal.classList.remove('hidden');
        categorySelectionModal.style.display = 'flex'; // Force show dengan style juga
        console.log("Modal should be visible. Number of buttons in container:", questionOptionsContainer
            .childElementCount);
        console.log("Modal classes after show:", categorySelectionModal.className);
        console.log("--- showCategorySelection END ---");
    }

    // Throttle untuk mencegah multiple calls
    let isHiding = false;

    function hideCategorySelection() {
        if (isHiding) {
            console.log("hideCategorySelection already in progress, skipping...");
            return;
        }

        isHiding = true;
        console.log("--- hideCategorySelection CALLED ---");

        const modal = document.getElementById('category-selection-modal');
        if (modal) {
            modal.classList.add('hidden');
            modal.style.display = 'none'; // Force hide dengan style juga
            console.log("Modal 'hidden' class ADDED and display set to none.");
            console.log("Modal classes after hide:", modal.className);
        } else {
            console.error("CRITICAL: categorySelectionModal element not found for hideCategorySelection!");
            alert("Error: Komponen modal tidak bisa ditutup.");
        }

        console.log("--- hideCategorySelection END ---");

        // Reset throttle setelah delay singkat
        setTimeout(() => {
            isHiding = false;
        }, 100);
    }

    // Modal initialization will be handled in the main DOMContentLoaded listener below

    // ... (sisa fungsi Anda: startQuestionConsole, displayNextQuestion, processUserInput, dll. tetap sama seperti sebelumnya)
    // Pastikan fungsi-fungsi ini juga di luar DOMContentLoaded
    function startQuestionConsole(numQuestionsToAsk, cost) {
        console.log("startQuestionConsole called with:", numQuestionsToAsk, cost);
        if (currentUserCoins < cost) {
            alert("Koin tidak cukup.");
            return;
        }
        hideCategorySelection();
        if (consoleTitleElement) consoleTitleElement.textContent = `Kategori: ${currentCategoryLabel}`;
        if (chatHistoryElement) chatHistoryElement.innerHTML = '';
        userAnswersForCurrentCategory = [];
        currentQuestionIndex = 0;
        questionsToAsk = currentCategoryQuestions.slice(0, numQuestionsToAsk);
        console.log("Questions to ask:", questionsToAsk);
        if (questionConsoleElement) questionConsoleElement.classList.remove('hidden');
        if (userInputElement) {
            userInputElement.disabled = false;
            userInputElement.value = '';
            userInputElement.focus();
        }
        if (sendButton) sendButton.disabled = false;
        displayNextQuestion();
    }

    function displayNextQuestion() {
        console.log("displayNextQuestion called. Current index:", currentQuestionIndex, "Total to ask:", questionsToAsk
            .length);
        if (!userInputElement || !sendButton || !chatHistoryElement) {
            console.error("Chat console elements not ready for displayNextQuestion.");
            return;
        }

        // Update progress
        updateProgress();

        if (currentQuestionIndex < questionsToAsk.length) {
            console.log(`Showing question ${currentQuestionIndex + 1} of ${questionsToAsk.length}`);
            displayMessageInChat(questionsToAsk[currentQuestionIndex], 'bot');
        } else {
            console.log("All questions answered for this category.");
            console.log("Current question index:", currentQuestionIndex);
            console.log("Total questions to ask:", questionsToAsk.length);

            // Hide progress when done
            hideProgress();

            userInputElement.disabled = true;
            sendButton.disabled = true;

            // Show completion message with AI recommendation button
            displayMessageInChat(
                "🎉 Semua pertanyaan untuk kategori ini telah selesai! Klik tombol di bawah untuk mendapatkan analisis AI.",
                'bot summary-title');

            // Create AI recommendation button (different from old category summary)
            const aiRecommendationButton = document.createElement('button');
            aiRecommendationButton.textContent = '🤖 Berikan Rekomendasi';
            aiRecommendationButton.className = 'ai-recommendation-button';

            // Styling for the new button
            aiRecommendationButton.style.cssText = `
                background: linear-gradient(135deg, var(--primary-color), var(--primary-dark)) !important;
                color: white !important;
                font-weight: 600 !important;
                border: none !important;
                padding: 12px 24px !important;
                border-radius: 8px !important;
                cursor: pointer !important;
                display: block !important;
                margin: 16px auto !important;
                max-width: 300px !important;
                text-align: center !important;
                font-size: 16px !important;
                z-index: 1000 !important;
                position: relative !important;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1) !important;
                transition: all 0.3s ease !important;
            `;

            // Add hover effects
            aiRecommendationButton.onmouseenter = () => {
                aiRecommendationButton.style.background = 'linear-gradient(135deg, var(--primary-dark), #d84315) !important';
                aiRecommendationButton.style.transform = 'translateY(-2px) !important';
                aiRecommendationButton.style.boxShadow = '0 6px 12px rgba(0, 0, 0, 0.15) !important';
            };

            aiRecommendationButton.onmouseleave = () => {
                aiRecommendationButton.style.background = 'linear-gradient(135deg, var(--primary-color), var(--primary-dark)) !important';
                aiRecommendationButton.style.transform = 'translateY(0) !important';
                aiRecommendationButton.style.boxShadow = '0 4px 6px rgba(0, 0, 0, 0.1) !important';
            };

            aiRecommendationButton.onclick = () => {
                console.log("AI recommendation button clicked.");
                requestCategorySummary();
                aiRecommendationButton.remove();
            };

            console.log("Adding AI recommendation button to chat history");
            if (chatHistoryElement) {
                chatHistoryElement.appendChild(aiRecommendationButton);
                chatHistoryElement.scrollTop = chatHistoryElement.scrollHeight;
                console.log("AI recommendation button added successfully");
            } else {
                console.error("chatHistoryElement not found!");
            }
        }
    }

    function processUserInput() {
        console.log("processUserInput called.");
        if (!userInputElement) {
            console.error("userInputElement not found for processUserInput.");
            return;
        }
        const answer = userInputElement.value.trim();
        if (answer && !userInputElement.disabled) {
            displayMessageInChat(answer, 'user');
            userAnswersForCurrentCategory.push(answer);
            userInputElement.value = '';
            currentQuestionIndex++;
            displayNextQuestion();
        }
    }

    function hideQuestionConsole() {
        console.log("hideQuestionConsole called.");
        if (questionConsoleElement) questionConsoleElement.classList.add('hidden');
    }

    async function requestCategorySummary() {
        console.log("requestCategorySummary called for category:", currentCategoryLabel);
        // Show enhanced typing indicator
        const typingId = showTypingIndicator(`AI sedang menganalisis jawaban Anda untuk ${currentCategoryLabel}...`);

        try {
            const response = await fetch("{{ route('ai.mate.categorySummary') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    categoryId: currentCategoryId,
                    numQuestions: userAnswersForCurrentCategory.length,
                    answers: userAnswersForCurrentCategory
                })
            });

            // Remove typing indicator
            removeTypingIndicator(typingId);

            const data = await response.json();
            console.log("Category summary response data:", data);

            if (!response.ok) {
                displayErrorMessageInChat(data.error || `Gagal mendapatkan summary (Status: ${response.status}).`);
                if (data.new_coin_balance !== undefined) updateCoinBalanceUI(data.new_coin_balance);
                return;
            }

            if (data.summary) {
                // Create message element for typewriter effect
                const messageDiv = document.createElement('div');
                messageDiv.classList.add('chatbot-message', 'bot-message', 'summary-title');
                chatHistoryElement.appendChild(messageDiv);

                // Apply simple typewriter effect that renders HTML properly (faster speed)
                await simpleHTMLTypewriter(messageDiv, data.summary, 8);

                // Scroll to bottom
                chatHistoryElement.scrollTop = chatHistoryElement.scrollHeight;

                // Store answers for overall summary
                allUserAnswers[currentCategoryLabel] = {
                    questions: questionsToAsk,
                    answers: userAnswersForCurrentCategory
                };
                console.log("Updated allUserAnswers:", allUserAnswers);

                // Add suggestion to try more categories or get overall summary
                setTimeout(() => {
                    const suggestionDiv = document.createElement('div');
                    suggestionDiv.className = 'chatbot-message bot-message mt-4 p-4 bg-blue-50 border border-blue-200 rounded-lg';
                    suggestionDiv.innerHTML = `
                        <p class="text-blue-800 mb-3">
                            <strong>💡 Saran:</strong> Untuk mendapatkan rekomendasi jurusan yang lebih akurat,
                            coba selesaikan minimal 2-3 kategori lagi, atau langsung lihat rekomendasi final!
                        </p>
                        <div class="flex gap-2 justify-center">
                            <button onclick="hideQuestionConsole()"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm transition-colors">
                                📚 Coba Kategori Lain
                            </button>
                            <button onclick="document.getElementById('request-overall-summary-button').scrollIntoView({behavior: 'smooth'}); document.getElementById('request-overall-summary-button').style.animation = 'pulse 1s ease-in-out 3 alternate';"
                                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm transition-colors">
                                🎯 Lihat Rekomendasi Final
                            </button>
                        </div>
                    `;
                    chatHistoryElement.appendChild(suggestionDiv);
                    chatHistoryElement.scrollTop = chatHistoryElement.scrollHeight;
                }, 1000);
            }

            if (data.new_coin_balance !== undefined) updateCoinBalanceUI(data.new_coin_balance);
        } catch (error) {
            removeTypingIndicator(typingId);
            console.error('Error fetching category summary:', error);
            displayErrorMessageInChat("Terjadi masalah koneksi saat meminta summary kategori.");
        }
    }

    async function requestOverallSummary() {
        console.log("requestOverallSummary called.");
        if (Object.keys(allUserAnswers).length < 1) {
            alert("Selesaikan minimal satu kategori dulu.");
            return;
        }
        const overallSummaryCost = 5;
        if (currentUserCoins < overallSummaryCost) {
            alert(`Koin (${currentUserCoins}) tidak cukup. Butuh ${overallSummaryCost} koin.`);
            return;
        }
        if (requestOverallSummaryButton) requestOverallSummaryButton.disabled = true;
        const overallLoadingSpan = document.createElement('span');
        overallLoadingSpan.innerHTML =
            `<i>Sedang memproses rekomendasi final... <span class="spinner" style="border-top-color: var(--primary);"></span></i>`;
        if (overallSummaryTextElement) {
            overallSummaryTextElement.innerHTML = '';
            overallSummaryTextElement.appendChild(overallLoadingSpan);
        }
        if (overallSummaryContentElement) overallSummaryContentElement.classList.remove('hidden');
        try {
            const response = await fetch("{{ route('ai.mate.overallSummary') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    allUserAnswers: allUserAnswers
                })
            });
            overallLoadingSpan.remove();
            if (requestOverallSummaryButton) requestOverallSummaryButton.disabled = false;
            const data = await response.json();
            console.log("Overall summary response data:", data);
            if (!response.ok) {
                if (overallSummaryTextElement) overallSummaryTextElement.innerHTML =
                    `<p class="text-red-600 font-semibold">Error: ${data.error || `Gagal (Status: ${response.status}).`}</p>`;
                if (data.new_coin_balance !== undefined) updateCoinBalanceUI(data.new_coin_balance);
                return;
            }
            if (data.summary && overallSummaryTextElement) {
                // Apply typewriter effect for overall summary too (faster speed)
                await simpleHTMLTypewriter(overallSummaryTextElement, data.summary, 8);

                // Show direct major selection immediately after typing is done
                console.log('🎯 AI response completed, showing major selection');
                setTimeout(() => {
                    showDirectMajorSelection(data.summary, data.user_answers);
                }, 300);
            }
            if (data.new_coin_balance !== undefined) updateCoinBalanceUI(data.new_coin_balance);
        } catch (error) {
            overallLoadingSpan.remove();
            if (requestOverallSummaryButton) requestOverallSummaryButton.disabled = false;
            console.error('Error fetching overall summary:', error);
            if (overallSummaryTextElement) overallSummaryTextElement.innerHTML =
                `<p class="text-red-600 font-semibold">Masalah koneksi saat meminta rekomendasi final.</p>`;
        }
    }

    function hideOverallSummaryContainer() {
        console.log("hideOverallSummaryContainer called.");
        if (overallSummaryContentElement) overallSummaryContentElement.classList.add('hidden');

        // Also hide simulation prompt if it exists
        const simulationPromptSection = document.getElementById('simulation-prompt-section');
        if (simulationPromptSection) {
            simulationPromptSection.remove();
        }
    }

    // --- DOMContentLoaded HANYA UNTUK INISIALISASI ELEMEN DOM DAN EVENT LISTENER AWAL ---
    document.addEventListener('DOMContentLoaded', function () {
        console.log("DOMContentLoaded: Initializing DOM elements and Typed.js");

        coinBalanceElement = document.getElementById('user-coin-balance');
        categorySelectionModal = document.getElementById('category-selection-modal');
        selectionTitleElement = document.getElementById('selection-title');
        questionOptionsContainer = document.getElementById('question-options-container');
        questionConsoleElement = document.getElementById('question-console');
        consoleTitleElement = document.getElementById('console-title');
        chatHistoryElement = document.getElementById('chat-history');
        userInputElement = document.getElementById('user-input');
        sendButton = document.getElementById('send-button');
        overallSummaryContentElement = document.getElementById('overall-summary-content');
        overallSummaryTextElement = document.getElementById('overall-summary-text');
        requestOverallSummaryButton = document.getElementById('request-overall-summary-button');

        // Progress elements
        progressContainer = document.getElementById('progress-container');
        progressFill = document.getElementById('progress-fill');
        progressText = document.getElementById('progress-text');
        currentQuestionSpan = document.getElementById('current-question');
        totalQuestionsSpan = document.getElementById('total-questions');

        // Ensure modal is hidden on page load
        if (categorySelectionModal) {
            categorySelectionModal.classList.add('hidden');
        }

        // Add event delegation for category cards (only once)
        if (!window.categoryEventListenerAdded) {
            document.addEventListener('click', function (event) {
                // Handle category card clicks - DISABLED (using onclick handler instead)
                // This event listener is disabled to prevent double modal issue
                // Categories now use onclick="selectCategory(...)" directly
                /*
                if (event.target.closest('.category-card')) {
                    event.preventDefault();
                    event.stopPropagation();

                    const card = event.target.closest('.category-card');
                    const categoryId = card.dataset.categoryId;
                    const categoryLabel = card.dataset.categoryLabel;
                    const totalQuestions = parseInt(card.dataset.totalQuestions);
                    const costPerQuestion = parseInt(card.dataset.costPerQuestion);

                    console.log("Category card clicked:", categoryId);
                    showCategorySelection(categoryId, categoryLabel, totalQuestions, costPerQuestion);
                }
                */

                // LEGACY modal close handlers - DISABLED (modal is disabled)
                /*
                // Handle modal close button clicks
                if (event.target.closest('.modal-close-button') || event.target.dataset.action === 'close-category-modal') {
                    event.preventDefault();
                    event.stopPropagation();
                    console.log("Close modal button clicked");
                    hideCategorySelection();
                }

                // Handle modal overlay clicks (close modal when clicking outside)
                if (event.target.id === 'category-selection-modal' && !event.target.closest('.modal-content')) {
                    event.preventDefault();
                    event.stopPropagation();
                    console.log("Modal overlay clicked");
                    hideCategorySelection();
                }
                */
            });
            window.categoryEventListenerAdded = true;
        }

        // Verifikasi apakah semua elemen penting ditemukan
        if (!categorySelectionModal) console.error("CRITICAL: categorySelectionModal NOT FOUND on DOM load!");
        if (!questionOptionsContainer) console.error(
            "CRITICAL: questionOptionsContainer NOT FOUND on DOM load!");
        if (!selectionTitleElement) console.error("CRITICAL: selectionTitleElement NOT FOUND on DOM load!");


        if (userInputElement) {
            userInputElement.addEventListener('keypress', function (event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    processUserInput(); // Pastikan processUserInput ada di global scope
                }
            });
        } else {
            console.warn("User input element (user-input) not found on DOMContentLoaded");
        }

        const userName = "{{ Auth::user()->name ?? '' }}";
        const greeting = userName ? `Hai ${userName}!` : "Hai!";
        try {
            new Typed("#typed-welcome", {
                strings: [
                    `${greeting} Aku AI MATE yang siap membantu kamu memilih jurusan yang tepat. Yuk, pilih kategori yang ingin kamu coba dulu!`
                ],
                typeSpeed: 30,
                backSpeed: 10,
                startDelay: 500,
                loop: false,
                showCursor: true,
                cursorChar: '|',
                onComplete: function (self) {
                    if (self.cursor) self.cursor.style.display = 'none';
                }
            });
        } catch (e) {
            console.error("Typed.js initialization failed:", e);
            const typedWelcomeElement = document.getElementById('typed-welcome');
            if (typedWelcomeElement) typedWelcomeElement.textContent =
                `${greeting} Aku AI MATE yang siap membantu kamu memilih jurusan yang tepat. Yuk, pilih kategori yang ingin kamu coba dulu!`;
        }
        console.log("DOMContentLoaded: Setup complete.");
    });
</script>
@endsection