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
            /* Digunakan juga sebagai --success-color */
            --success-light: #a8c778;
            --background: #f8f1e5;
            --background-light: #fffdf9;
            --surface: #ffffff;
            /* Digunakan juga sebagai --card-bg */
            --surface-elevated: #fafafa;

            /* Text Colors */
            --text-primary: #2d3748;
            --text-secondary: #64748b;
            --text-muted: #94a3b8;
            --text-inverse: #ffffff;

            /* Border & Shadow */
            --border-light: #e2e8f0;
            /* Digunakan juga sebagai --border-color */
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

            /* Digunakan oleh .category-card dan #simulation-prompt-section */
            0%,
            100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(253, 114, 5, 0.4);
                /* Default untuk .category-card */
            }

            50% {
                transform: scale(1.05);
                box-shadow: 0 0 0 10px rgba(253, 114, 5, 0);
                /* Default untuk .category-card */
            }
        }

        /* Pulse animation for simulation prompt (override) */
        #simulation-prompt-section {
            /* Selector lebih spesifik */
            animation: pulse-simulation 2s infinite;
            /* Nama animasi berbeda untuk menghindari konflik */
        }

        @keyframes pulse-simulation {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.7);
            }

            50% {
                box-shadow: 0 0 0 10px rgba(59, 130, 246, 0);
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
            /* ID unik: chat-history */
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
            /* ID unik: user-input */
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
            /* ID unik: send-button */
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
            /* Pastikan properti ini ada */
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

        .category-card.completed {
            border-color: var(--success);
            background-color: #f0fff4;
            opacity: 0.85;
        }

        .category-card.completed:hover {
            opacity: 1;
            transform: translateY(-4px) scale(1.01);
        }

        .category-card .completion-checkmark {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 2rem;
            color: var(--success);
            background-color: white;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow-sm);
            animation: bounce 1s;
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

        /* !important dipertahankan karena seringkali perlu override kuat */
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
            background: rgba(0, 0, 0, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-content {
            background: var(--surface);
            border-radius: var(--radius-2xl);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            border: 1px solid var(--border-light);
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
            align-items: center;
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

        .ai-typing-text {
            color: var(--text-secondary);
            font-style: italic;
            font-size: 0.9rem;
        }

        .spinner {
            border: 3px solid var(--border-light);
            border-radius: 50%;
            border-top-color: var(--primary);
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

        .hidden {
            display: none !important;
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

            .category-card:hover {
                transform: translateY(-4px) scale(1.01);
            }

            .chat-container {
                height: 500px;
            }

            .message {
                max-width: 95%;
            }
        }

        @media (max-width: 480px) {

            .chatbot-header {
                padding: var(--space-lg) var(--space-md);
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

        .recommendation-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: var(--space-xl);
            row-gap: 2rem;
            margin-top: var(--space-lg);
        }

        .recommendation-card {
            background: var(--surface);
            border-radius: var(--radius-xl);
            border: 1px solid var(--border-light);
            box-shadow: var(--shadow-md);
            padding: var(--space-xl);
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
            animation: fadeInUp 0.5s ease-out;
        }

        .recommendation-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary);
        }

        .recommendation-card h4 {
            font-family: var(--font-primary);
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: var(--space-md);
            line-height: 1.3;
        }

        .recommendation-card .card-section {
            margin-bottom: var(--space-lg);
        }

        .recommendation-card .card-section-title {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: var(--space-sm);
            font-size: 1rem;
        }

        .recommendation-card p,
        .recommendation-card ul {
            font-family: var(--font-secondary);
            color: var(--text-secondary);
            line-height: 1.6;
            font-size: 0.95rem;
        }

        .recommendation-card ul {
            list-style-position: inside;
            padding-left: 5px;
        }

        .recommendation-card li {
            margin-bottom: var(--space-xs);
        }

        /* ... CSS Anda yang sudah ada ... */


        /* ===== SIMULATION MODAL CONTENT STYLING ===== */

        /* Memberi padding dan scrollbar jika kontennya panjang */
        /* ... CSS Anda yang sudah ada ... */

        /* ========================================================== */
        /* ===== PERBAIKAN: MODAL SIMULASI RESPONSIVE & SCROLLABLE ===== */
        /* ========================================================== */

        /* Overlay untuk modal */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(18, 25, 38, 0.8);
            /* Warna lebih gelap untuk kontras lebih baik */
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            padding: var(--space-md);
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        /* Konten utama modal */
        .modal-content {
            background: var(--surface);
            border-radius: var(--radius-2xl);
            box-shadow: var(--shadow-xl);
            border: 1px solid var(--border-light);
            max-width: 700px;
            /* Sedikit lebih lebar untuk konten yang panjang */
            width: 100%;
            max-height: 90vh;
            /* Menggunakan 90% dari tinggi viewport */
            display: flex;
            /* Menggunakan flexbox untuk layout header-body-footer */
            flex-direction: column;
            overflow: hidden;
            /* Mencegah konten keluar dari radius sudut */
            transform: scale(0.95) translateY(20px);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .modal-overlay.active .modal-content {
            transform: scale(1) translateY(0);
        }

        /* Header Modal */
        .modal-header {
            background: linear-gradient(135deg, var(--secondary), var(--secondary-dark));
            color: var(--text-inverse);
            padding: var(--space-lg) var(--space-xl);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            flex-shrink: 0;
            /* Mencegah header menyusut */
        }

        .modal-title {
            font-family: var(--font-primary);
            font-size: 1.35rem;
            font-weight: 700;
            margin: 0;
        }

        .modal-close {
            background: transparent;
            border: 2px solid rgba(255, 255, 255, 0.5);
            color: var(--text-inverse);
            width: 36px;
            height: 36px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            line-height: 1;
            transition: all 0.2s ease;
        }

        .modal-close:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: rotate(90deg);
        }

        /* Body Modal (Area yang bisa di-scroll) */
        .modal-body {
            padding: var(--space-xl);
            overflow-y: auto;
            /* INI KUNCINYA: scroll hanya di bagian body */
            flex: 1;
            /* Membuat body mengisi ruang yang tersisa */
            -webkit-overflow-scrolling: touch;
            /* Scroll lebih mulus di mobile */
        }

        /* Styling untuk #simulation-content dan elemen di dalamnya */
        #simulation-content {
            animation: fadeInUp 0.5s ease-out;
        }

        /* Styling untuk blok skenario/pertanyaan */
        .simulation-scenario-block {
            background-color: var(--surface-elevated);
            padding: var(--space-lg);
            border-radius: var(--radius-lg);
            margin-bottom: var(--space-lg);
            border-left: 4px solid var(--primary);
        }

        .simulation-step-info {
            font-size: 0.8rem;
            color: var(--text-muted);
            font-weight: 500;
            margin-bottom: var(--space-sm);
            text-transform: uppercase;
        }

        .simulation-scenario-text {
            font-size: 1.1rem;
            color: var(--text-primary);
            line-height: 1.6;
        }

        /* Styling untuk grup tombol pilihan */
        .simulation-options {
            display: grid;
            grid-template-columns: 1fr;
            gap: var(--space-sm);
            margin-top: var(--space-lg);
        }

        /* Tombol pilihan di dalam simulasi */
        .simulation-options .btn {
            width: 100%;
            justify-content: flex-start;
            text-align: left;
            background: var(--surface);
            color: var(--secondary);
            border: 2px solid var(--border-medium);
            font-weight: 500;
            transition: all 0.2s ease-in-out;
        }

        .simulation-options .btn:hover {
            background: var(--secondary-light);
            color: var(--text-inverse);
            border-color: var(--secondary);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        /* ===== STYLING KHUSUS UNTUK KESIMPULAN AKHIR ===== */
        .simulation-final-summary {
            /* overflow-y tidak diperlukan lagi di sini, karena parent (.modal-body) sudah handle */
            padding: var(--space-lg);
            border: 2px dashed var(--success);
            border-radius: var(--radius-xl);
            background: linear-gradient(135deg, #f0fff4, #e6f7ff);
        }

        .simulation-final-summary h4 {
            font-family: var(--font-primary);
            font-size: 1.75rem;
            color: var(--success);
            text-align: center;
            margin-bottom: var(--space-lg);
        }

        .simulation-final-summary p,
        .simulation-final-summary li {
            color: var(--text-secondary);
            font-size: 1rem;
            /* Sedikit lebih besar agar mudah dibaca */
            line-height: 1.7;
            word-wrap: break-word;
            /* Mencegah teks panjang merusak layout */
        }

        .simulation-final-summary strong {
            color: var(--text-primary);
            display: block;
            margin-top: var(--space-lg);
            margin-bottom: var(--space-xs);
            font-size: 1.1rem;
        }

        .simulation-final-summary ul {
            list-style-type: '✓ ';
            list-style-position: outside;
            padding-left: 20px;
        }

        .simulation-final-summary ul li {
            padding-left: 10px;
            margin-bottom: var(--space-sm);
        }

        .simulation-final-summary .btn-container {
            text-align: center;
            margin-top: var(--space-xl);
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
                        Halo, <strong>{{ Auth::user()->name ?? 'Pengguna' }}</strong>! Temukan jurusan yang tepat untuk
                        masa
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
                        {{-- Categories will be loaded here dynamically by JavaScript --}}
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
                            <button onclick="hideChatInterface()" class="btn btn-outline btn-sm"
                                style="margin-left: auto; background-color:white">
                                ← Kembali
                            </button>
                        </div>

                        <div class="chat-messages" id="chat-history">
                            {{-- Messages will appear here --}}
                        </div>

                        <div class="chat-input-container">
                            <textarea id="user-input" class="chat-input" placeholder="Ketik jawabanmu di sini..." rows="1"></textarea>
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
                                <div class="progress-stats" id="progress-text-sidebar">0/0</div>
                            </div>
                            <div class="progress-bar-container">
                                <div class="progress-bar" id="progress-bar-sidebar" style="width: 0%"></div>
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

    {{-- Overall Summary Area (Akan muncul di bawah kategori) --}}
    <div id="overall-summary-container" class="hidden"
        style="margin-top: var(--space-xl); padding: var(--space-lg); background: var(--surface); border-radius: var(--radius-xl); box-shadow: var(--shadow-md);">
        <h2
            style="font-family: var(--font-primary); font-size: 1.75rem; font-weight: 700; color: var(--text-primary); margin-bottom: var(--space-md); text-align:center;">
            Rekomendasi Jurusan Final Untukmu
        </h2>
        <div id="overall-summary-text" style="color: var(--text-secondary); line-height: 1.6;">
            {{-- Summary keseluruhan akan muncul di sini --}}
        </div>
        <button onclick="hideOverallSummaryContainer()" class="btn btn-outline"
            style="display: block; margin: var(--space-lg) auto 0;">
            Tutup Rekomendasi Final
        </button>
    </div>


    {{-- Simulation Modal --}}
    {{-- GANTI SELURUH BLOK INI --}}
    {{-- Simulation Modal --}}
    <div id="simulation-modal" class="modal-overlay">
        <div class="modal-content" id="simulation-modal-content">
            {{-- Modal Header --}}
            <div class="modal-header">
                <h2 id="simulation-title" class="modal-title">🎯 Simulasi Interaktif</h2>
                <button onclick="closeSimulation()" class="modal-close" aria-label="Tutup Modal">&times;</button>
            </div>

            {{-- Modal Body (Bagian ini yang akan scroll) --}}
            <div class="modal-body" id="simulation-modal-body">
                {{-- Progress Bar --}}
                <div id="simulation-progress" class="progress-container" style="display: none;">
                    <div class="progress-header">
                        <div class="progress-title">Progress Simulasi</div>
                        <div class="progress-stats" id="progress-text-sim">0/0</div>
                    </div>
                    <div class="progress-bar-container">
                        <div class="progress-bar" id="progress-bar-sim" style="width: 0%;"></div>
                    </div>
                </div>

                {{-- Dynamic Content (Skenario, Pilihan, atau Kesimpulan) --}}
                <div id="simulation-content">
                    {{-- Konten akan dimuat di sini oleh JavaScript --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
    {{-- AOS Fallback script --}}
    <script>
        window.addEventListener('error', function(e) {
            if (e.message && e.message.includes('AOS')) {
                console.log('🔧 AOS library not found, creating fallback');
                window.AOS = {
                    init: function() {},
                    refresh: function() {}
                };
            }
        });
        if (typeof AOS === 'undefined') {
            window.AOS = {
                init: function() {},
                refresh: function() {}
            };
        }
    </script>
    <script>
        // =================================================================
        // BAGIAN 1: SETUP & INISIALISASI VARIABEL GLOBAL
        // =================================================================

        const categoriesData = @json($categories);
        const userProgressData = @json($userProgress ?? []);
        let currentUserCoins = {{ $userCoins ?? 0 }};
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        console.log('🔍 Categories data received:', categoriesData);
        console.log('📊 User progress received:', userProgressData);

        // State Aplikasi
        let currentCategorySlug = null;
        let currentCategoryLabel = '';
        let currentCategoryQuestions = [];
        let questionsToAsk = [];
        let currentQuestionIndex = 0;
        let userAnswersForCurrentCategory = [];
        let allUserAnswers = userProgressData;
        let currentSimulationSession = null;
        let simulationData = null;

        // DOM Elements
        let categoriesContainer, categoriesSection, chatSection, chatHistoryElement, userInputElement, sendButton;
        let progressCardSidebar, progressCategorySidebar, progressBarSidebar, progressTextSidebar;
        let overallSummaryContainer, overallSummaryTextElement;

        // =================================================================
        // BAGIAN 2: FUNGSI UTAMA YANG DIJALANKAN SAAT HALAMAN DIMUAT
        // =================================================================

        document.addEventListener('DOMContentLoaded', function() {
            console.log('🚀 DOMContentLoaded - Starting initialization');

            // Inisialisasi semua elemen dari DOM
            categoriesContainer = document.getElementById('categories-container');
            categoriesSection = document.getElementById('categories-section');
            chatSection = document.getElementById('chat-section');
            chatHistoryElement = document.getElementById('chat-history');
            userInputElement = document.getElementById('user-input');
            sendButton = document.getElementById('send-button');
            progressCardSidebar = document.getElementById('progress-card');
            progressCategorySidebar = document.getElementById('progress-category');
            progressBarSidebar = document.getElementById('progress-bar-sidebar');
            progressTextSidebar = document.getElementById('progress-text-sidebar');
            overallSummaryContainer = document.getElementById('overall-summary-container');
            overallSummaryTextElement = document.getElementById('overall-summary-text');

            if (categoriesContainer) {
                loadCategories();
            } else {
                console.error("categoriesContainer not found!");
            }
            updateCoinDisplay();
            initializeModernChatEventListeners();
            initializeTypedWelcome();

            console.log('✅ Modern UI initialization complete');
        });

        // =================================================================
        // BAGIAN 3: FUNGSI PEMBANTU & TAMPILAN (UTILITY & UI HELPERS)
        // =================================================================

        function updateCoinDisplay(newBalance) {
            if (newBalance !== undefined) {
                currentUserCoins = newBalance;
            }
            const coinElements = document.querySelectorAll('#user-coin-balance');
            coinElements.forEach(element => {
                if (element) element.textContent = currentUserCoins;
            });
        }

        function displayMessageInModernChat(message, type, isHTML = false) {
            if (!chatHistoryElement) return null;
            const messageWrapper = document.createElement('div');
            messageWrapper.className = `message ${type}`;
            const avatar = document.createElement('div');
            avatar.className = 'message-avatar';
            avatar.textContent = type === 'user' ? '👤' : '🤖';
            const content = document.createElement('div');
            content.className = 'message-content';
            if (type === 'bot' && message.toLowerCase().includes('error')) {
                content.classList.add('error-message');
            }
            if (isHTML) {
                content.innerHTML = message;
            } else {
                content.textContent = message;
            }
            messageWrapper.appendChild(avatar);
            messageWrapper.appendChild(content);
            chatHistoryElement.appendChild(messageWrapper);
            chatHistoryElement.scrollTop = chatHistoryElement.scrollHeight;
            return messageWrapper;
        }

        let currentTypingIndicatorId = null;

        function showModernTypingIndicator(text = "AI sedang mengetik...") {
            if (currentTypingIndicatorId) removeModernTypingIndicator();
            const typingId = 'typing-' + Date.now();
            currentTypingIndicatorId = typingId;
            const typingHTML = `
                <div id="${typingId}" class="message bot typing-indicator" style="max-width: fit-content;">
                    <div class="message-avatar">🤖</div>
                    <div class="message-content" style="background: var(--surface-elevated);">
                        <span class="ai-typing-text">${text}</span>
                        <div class="typing-dots">
                            <div class="typing-dot"></div><div class="typing-dot"></div><div class="typing-dot"></div>
                        </div>
                    </div>
                </div>`;
            if (chatHistoryElement) {
                chatHistoryElement.insertAdjacentHTML('beforeend', typingHTML);
                chatHistoryElement.scrollTop = chatHistoryElement.scrollHeight;
            }
        }

        function removeModernTypingIndicator() {
            if (!currentTypingIndicatorId) return;
            const el = document.getElementById(currentTypingIndicatorId);
            if (el) el.remove();
            currentTypingIndicatorId = null;
        }

        function extractMajorsFromAIResponse(aiResponseText) {
            const majors = new Set();
            const cleanedText = aiResponseText.replace(/<[^>]*>/g, '\n');
            const patterns = [
                /(?:^|\n)\s*(?:\d+\.|-|\*)\s*([A-Za-zÀ-ú\s,&/-]+?)(?=\s*:(?:\s+Alasan|\s+Penjelasan|$)|(?:\s*\n\s*(?:Alasan|Penjelasan|$))|\s*\n\s*(?:\d+\.|-|\*)|$)/gim,
                /(?:(?:Jurusan yang direkomendasikan|Pilihan teratas)\s*:\s*)([A-Za-zÀ-ú\s,&/-]+)/gim
            ];
            for (const pattern of patterns) {
                let match;
                while ((match = pattern.exec(cleanedText)) !== null) {
                    let major = match[1].trim().replace(/\s*:\s*$/, '').replace(/\s*-\s*$/, '').trim();
                    if (major.length > 3 && major.length < 70) {
                        majors.add(major);
                    }
                }
            }
            console.log('🔍 Extracted majors:', Array.from(majors));
            return Array.from(majors).slice(0, 5);
        }

        function initializeModernChatEventListeners() {
            if (userInputElement) {
                userInputElement.addEventListener('input', function() {
                    this.style.height = 'auto';
                    this.style.height = Math.min(this.scrollHeight, 120) + 'px';
                });
                userInputElement.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' && !e.shiftKey) {
                        e.preventDefault();
                        processModernUserInput();
                    }
                });
            }
            if (sendButton) {
                sendButton.addEventListener('click', processModernUserInput);
            }
        }

        // =================================================================
        // BAGIAN 4: ALUR APLIKASI UTAMA (CORE APPLICATION FLOW)
        // =================================================================

        function initializeTypedWelcome() {
            const userName = "{{ Auth::user()->name ?? '' }}";
            const greeting = userName ? `Hai ${userName}!` : "Hai!";
            const typedWelcomeElement = document.getElementById('typed-welcome');
            if (typedWelcomeElement && typeof Typed !== 'undefined') {
                try {
                    new Typed("#typed-welcome", {
                        strings: [
                            `${greeting} Aku AI MATE yang siap membantu kamu memilih jurusan yang tepat. Yuk, pilih kategori yang ingin kamu coba dulu!`
                        ],
                        typeSpeed: 30,
                        startDelay: 500,
                        loop: false,
                        showCursor: true,
                        cursorChar: '|',
                        onComplete: (self) => {
                            if (self.cursor) self.cursor.style.display = 'none';
                        }
                    });
                } catch (e) {
                    console.error("Typed.js initialization failed:", e);
                    typedWelcomeElement.textContent = `${greeting} Aku AI MATE...`;
                }
            } else if (typedWelcomeElement) {
                typedWelcomeElement.textContent = `${greeting} Aku AI MATE...`;
            }
        }

        function loadCategories() {
            console.log('🔄 Loading categories...');
            if (!categoriesContainer) return;
            categoriesContainer.innerHTML = '';
            if (!categoriesData || Object.keys(categoriesData).length === 0) {
                categoriesContainer.innerHTML = `<p>Gagal memuat kategori. Silakan refresh halaman.</p>`;
                return;
            }
            Object.entries(categoriesData).forEach(([slug, category]) => {
                const categoryCard = createCategoryCard(slug, category);
                categoriesContainer.appendChild(categoryCard);
            });
            console.log('✅ Categories loaded and rendered.');
            updateCategoryCardVisuals();
        }

        function createCategoryCard(slug, category) {
            const card = document.createElement('div');
            card.className = 'category-card';
            card.dataset.categorySlug = slug;
            card.style.animationDelay = `${Math.random() * 0.3}s`;
            const icon = category.icon_identifier || '📋';
            const questionCount = Array.isArray(category.questions) ? category.questions.length : 0;
            card.innerHTML = `
                <div class="category-icon">${icon}</div>
                <h3 class="category-title">${category.label}</h3>
                <p class="category-description">${category.description || `Eksplorasi ${category.label.toLowerCase()} untuk menentukan jurusan.`}</p>
                <div class="category-meta">
                    <div class="category-questions"><span>📝</span> <span>${questionCount} soal</span></div>
                    <div class="category-cost"><span>🪙</span> <span>${category.cost_per_question} koin/soal</span></div>
                </div>`;
            card.addEventListener('click', () => {
                console.log(`🖱️ Category clicked: ${slug}`);
                selectCategory(slug, category.label, questionCount, category.cost_per_question);
            });
            return card;
        }

        function updateCategoryCardVisuals() {
            if (!categoriesContainer || !allUserAnswers) return;
            const completedSlugs = Object.values(allUserAnswers).map(item => item.categoryIdKey);
            const categoryCards = categoriesContainer.querySelectorAll('.category-card');
            categoryCards.forEach(card => {
                const slug = card.dataset.categorySlug;
                if (completedSlugs.includes(slug)) {
                    card.classList.add('completed');
                    if (!card.querySelector('.completion-checkmark')) {
                        const checkmark = document.createElement('span');
                        checkmark.className = 'completion-checkmark';
                        checkmark.innerHTML = '✓';
                        card.appendChild(checkmark);
                    }
                } else {
                    card.classList.remove('completed');
                    const checkmark = card.querySelector('.completion-checkmark');
                    if (checkmark) checkmark.remove();
                }
            });
        }

        function selectCategory(slug, categoryLabel, totalQuestions, costPerQuestion) {
            currentCategorySlug = slug;
            currentCategoryLabel = categoryLabel;
            if (categoriesData && categoriesData[slug] && Array.isArray(categoriesData[slug].questions)) {
                currentCategoryQuestions = categoriesData[slug].questions;
                totalQuestions = currentCategoryQuestions.length;
                if (totalQuestions > 0) {
                    showModernQuestionSelectionModal(slug, categoryLabel, totalQuestions, costPerQuestion);
                }
            } else {
                alert(`Tidak ada pertanyaan yang tersedia untuk kategori ${categoryLabel}.`);
            }
        }

        function showModernQuestionSelectionModal(slug, categoryLabel, totalQuestions, costPerQuestion) {
            const existingModal = document.getElementById('question-selection-overlay');
            if (existingModal) existingModal.remove();

            const modalOverlay = document.createElement('div');
            modalOverlay.className = 'modal-overlay';
            modalOverlay.id = 'question-selection-overlay';
            const modalContent = document.createElement('div');
            modalContent.className = 'modal-content';

            modalContent.innerHTML = `
                <div class="modal-header">
                    <h3 class="modal-title">📋 ${categoryLabel}</h3>
                    <button class="modal-close" onclick="closeModernQuestionSelectionModal()">×</button>
                </div>
                <div class="modal-body">
                    <div style="text-align: center; margin-bottom: var(--space-lg);">
                        <div style="font-size: 4rem; margin-bottom: var(--space-md);">🎯</div>
                        <p style="font-size: 1.125rem; color: var(--text-secondary); line-height: 1.6;">
                            Pilih berapa banyak soal yang ingin Anda jawab untuk kategori <strong>${categoryLabel}</strong> (Total: ${totalQuestions} soal)
                        </p>
                    </div>
                    <div style="display: flex; flex-direction: column; gap: var(--space-sm); max-width: 400px; margin: 0 auto; max-height: 300px; overflow-y: auto;">
                        ${generateModernQuestionOptions(totalQuestions, costPerQuestion)}
                    </div>
                    <div style="margin-top: var(--space-lg); padding: var(--space-md); background: var(--surface-elevated); border-radius: var(--radius-md); text-align: center;">
                        <p style="font-size: 0.875rem; color: var(--text-muted); margin: 0;">
                            💰 Biaya: ${costPerQuestion} koin per soal<br>
                            🪙 Koin Anda: <span id="modal-coin-display">${currentUserCoins}</span>
                        </p>
                    </div>
                </div>`;
            modalOverlay.appendChild(modalContent);
            document.body.appendChild(modalOverlay);
            setTimeout(() => modalOverlay.classList.add('active'), 10);
        }

        function generateModernQuestionOptions(totalQuestions, costPerQuestion) {
            let questionCounts = (totalQuestions <= 5) ? Array.from({
                length: totalQuestions
            }, (_, i) => i + 1) : [3, 5, totalQuestions];
            questionCounts = [...new Set(questionCounts)].sort((a, b) => a - b);
            return questionCounts.map(count => {
                const cost = count * costPerQuestion;
                const canAfford = currentUserCoins >= cost;
                return `
                <button onclick="startModernCategoryQuestions(${count})" class="btn ${canAfford ? 'btn-primary' : 'btn-outline'}" ${!canAfford ? 'disabled' : ''} style="padding: var(--space-lg); text-align: left; display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--space-sm);">
                    <div>
                        <div style="font-weight: 600; margin-bottom: 4px;">${count} Soal</div>
                        <div style="font-size: 0.875rem; opacity: 0.8;">Biaya: ${cost} koin</div>
                    </div>
                    <div style="font-size: 1.5rem;">${canAfford ? '✅' : '❌'}</div>
                </button>`;
            }).join('');
        }

        function closeModernQuestionSelectionModal() {
            const modalOverlay = document.getElementById('question-selection-overlay');
            if (modalOverlay) {
                modalOverlay.classList.remove('active');
                setTimeout(() => modalOverlay.remove(), 300);
            }
        }

        function showChatInterface() {
            categoriesSection.style.display = 'none';
            overallSummaryContainer.classList.add('hidden');
            chatSection.style.display = 'block';
            progressCardSidebar.style.display = 'block';
            userInputElement.focus();
        }

        function hideChatInterface() {
            categoriesSection.style.display = 'block';
            chatSection.style.display = 'none';
            progressCardSidebar.style.display = 'none';
            chatHistoryElement.innerHTML = '';
            resetCategoryState();
        }

        function resetCategoryState() {
            currentCategorySlug = null;
            currentCategoryLabel = '';
            currentCategoryQuestions = [];
            questionsToAsk = [];
            currentQuestionIndex = 0;
            userAnswersForCurrentCategory = [];
        }

        function startModernCategoryQuestions(numQuestions) {
            closeModernQuestionSelectionModal();
            questionsToAsk = currentCategoryQuestions.slice(0, numQuestions);
            currentQuestionIndex = 0;
            userAnswersForCurrentCategory = [];
            userInputElement.disabled = false;
            userInputElement.value = '';
            userInputElement.style.height = 'auto';
            sendButton.disabled = false;
            showChatInterface();
            updateModernProgress();
            displayNextModernQuestion();
        }

        function updateModernProgress() {
            const progress = questionsToAsk.length > 0 ? (currentQuestionIndex / questionsToAsk.length) * 100 : 0;
            progressBarSidebar.style.width = `${progress}%`;
            progressTextSidebar.textContent = `${currentQuestionIndex}/${questionsToAsk.length}`;
            progressCategorySidebar.textContent = currentCategoryLabel;
        }

        function displayNextModernQuestion() {
            updateModernProgress();
            if (currentQuestionIndex < questionsToAsk.length) {
                displayMessageInModernChat(questionsToAsk[currentQuestionIndex], 'bot');
                userInputElement.focus();
            } else {
                userInputElement.disabled = true;
                sendButton.disabled = true;
                displayMessageInModernChat(
                    "🎉 Semua pertanyaan untuk kategori ini telah selesai! Klik tombol di bawah untuk mendapatkan analisis AI.",
                    'bot', true);
                const aiRecButtonContainer = document.createElement('div');
                aiRecButtonContainer.style.textAlign = 'center';
                aiRecButtonContainer.style.padding = 'var(--space-md) 0';
                const aiRecButton = document.createElement('button');
                aiRecButton.innerHTML = '<span>🤖</span> Berikan Rekomendasi';
                aiRecButton.className = 'btn btn-primary';
                aiRecButton.onclick = () => {
                    requestModernCategorySummary();
                    aiRecButtonContainer.remove();
                };
                aiRecButtonContainer.appendChild(aiRecButton);
                chatHistoryElement.appendChild(aiRecButtonContainer);
                chatHistoryElement.scrollTop = chatHistoryElement.scrollHeight;
            }
        }

        function processModernUserInput() {
            const answer = userInputElement.value.trim();
            if (answer && !userInputElement.disabled) {
                displayMessageInModernChat(answer, 'user');
                userAnswersForCurrentCategory.push(answer);
                userInputElement.value = '';
                userInputElement.style.height = 'auto';
                currentQuestionIndex++;
                displayNextModernQuestion();
            }
        }

        // =================================================================
        // BAGIAN 5: KOMUNIKASI DENGAN BACKEND (AJAX REQUESTS)
        // =================================================================

        async function requestModernCategorySummary() {
            showModernTypingIndicator(`AI sedang menganalisis jawaban Anda untuk ${currentCategoryLabel}...`);
            try {
                const response = await fetch("{{ route('ai.mate.categorySummary') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        categoryId: currentCategorySlug,
                        numQuestions: userAnswersForCurrentCategory.length,
                        answers: userAnswersForCurrentCategory
                    })
                });
                removeModernTypingIndicator();
                const data = await response.json();
                if (!response.ok) throw new Error(data.error || `HTTP error! status: ${response.status}`);

                if (data.summary) {
                    const messageContainer = displayMessageInModernChat('', 'bot', true);
                    const contentElement = messageContainer.querySelector('.message-content');
                    new Typed(contentElement, {
                        strings: [data.summary],
                        typeSpeed: 10,
                        showCursor: false,
                        onComplete: () => {
                            const suggestionHTML = `...`; // suggestion HTML here
                            displayMessageInModernChat(suggestionHTML, 'bot', true);
                        }
                    });
                    allUserAnswers[currentCategoryLabel] = {
                        categoryIdKey: currentCategorySlug,
                        questions: questionsToAsk,
                        answers: userAnswersForCurrentCategory,
                        summary: data.summary
                    };
                    updateCategoryCardVisuals();

                    setTimeout(() => {
                        const suggestionHTML = `
                        <p class="text-blue-800 mb-3" style="font-size: 0.9em;">
                            <strong>💡 Saran:</strong> Untuk rekomendasi yang lebih akurat, coba selesaikan 2-3 kategori, atau langsung lihat rekomendasi final!
                        </p>
                        <div class="flex gap-2 justify-center">
                            <button onclick="hideChatInterface()" class="btn btn-secondary btn-sm">📚 Kategori Lain</button>
                            <button onclick="document.getElementById('request-overall-summary-button').click(); document.getElementById('request-overall-summary-button').scrollIntoView({behavior: 'smooth'});" class="btn btn-success btn-sm">🎯 Rekomendasi Final</button>
                        </div>`;
                        displayMessageInModernChat(suggestionHTML, 'bot', true);
                    }, 500);
                }
                if (data.new_coin_balance !== undefined) updateCoinDisplay(data.new_coin_balance);
            } catch (error) {
                removeModernTypingIndicator();
                displayMessageInModernChat(`Terjadi masalah saat meminta summary: ${error.message}`, 'bot', true);
            }
        }

        async function requestOverallSummary() {
            // PERBAIKAN: Ubah syarat minimal dari 1 menjadi 2
            if (Object.keys(allUserAnswers).length < 2) {
                console.log('count all user answers:', allUserAnswers);

                alert("Selesaikan minimal DUA kategori dulu untuk mendapatkan rekomendasi final.");
                return;
            }
            const overallSummaryCost = 5;
            if (currentUserCoins < overallSummaryCost) {
                alert(`Koin Anda (${currentUserCoins}) tidak cukup. Butuh ${overallSummaryCost} koin.`);
                return;
            }

            const overallSummaryButton = document.getElementById('request-overall-summary-button');
            if (overallSummaryButton) overallSummaryButton.disabled = true;

            if (overallSummaryContainer && overallSummaryTextElement) {
                overallSummaryTextElement.innerHTML =
                    `<div style="text-align:center; padding: 20px;"><div class="spinner"></div><i> Sedang memproses rekomendasi final...</i></div>`;
                overallSummaryContainer.classList.remove('hidden');
                overallSummaryContainer.scrollIntoView({
                    behavior: 'smooth'
                });
            }

            try {
                const response = await fetch("{{ route('ai.mate.overallSummary') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        allUserAnswers: allUserAnswers,
                        cost: overallSummaryCost
                    })
                });
                const data = await response.json();
                if (overallSummaryButton) overallSummaryButton.disabled = false;

                if (!response.ok) {
                    if (overallSummaryTextElement) overallSummaryTextElement.innerHTML =
                        `<p style="color: red; text-align:center;">Error: ${data.error || `Gagal mendapatkan rekomendasi (Status: ${response.status})`}</p>`;
                    if (data.new_coin_balance !== undefined) updateCoinBalanceUI(data.new_coin_balance);
                    return;
                }

                // Cek jika ada rekomendasi
                if (data.recommendations && data.recommendations.length > 0) {
                    overallSummaryTextElement.innerHTML = '';
                    overallSummaryTextElement.className = 'recommendation-grid';
                    // Loop melalui setiap rekomendasi dan buat kartunya
                    data.recommendations.forEach((rec, index) => {
                        // Buat elemen div untuk kartu
                        const card = document.createElement('div');
                        card.className = 'recommendation-card';
                        // Tambahkan delay animasi agar muncul satu per satu
                        card.style.animationDelay = `${index * 0.15}s`;

                        // Buat HTML untuk daftar tingkat kecocokan
                        let compatibilityHtml = rec.tingkat_kecocokan.map(item => `
                <li>
                    <strong>${item.kategori} (${item.persentase}):</strong> ${item.detail_alasan}
                </li>
            `).join('');

                        // Isi konten kartu dengan data dari JSON
                        card.innerHTML = `
                <h4>${rec.nama_jurusan}</h4>
                
                <div class="card-section">
                    <div class="card-section-title">Alasan Rekomendasi</div>
                    <p>${rec.alasan}</p>
                </div>

                <div class="card-section">
                    <div class="card-section-title">Analisis Tingkat Kecocokan</div>
                    <ul>${compatibilityHtml}</ul>
                </div>
            `;

                        // Tambahkan kartu ke dalam container
                        overallSummaryTextElement.appendChild(card);
                    });

                    // Tampilkan tombol untuk simulasi setelah kartu dibuat
                    if (data.overall_summary_id) {
                        // Kita perlu cara baru untuk mengekstrak nama jurusan karena tidak ada teks HTML lagi
                        const majorsForSimulation = data.recommendations.map(r => r.nama_jurusan);
                        showDirectMajorSelectionButtons(majorsForSimulation, data.overall_summary_id);
                    }

                } else {
                    overallSummaryTextElement.innerHTML =
                        '<p style="text-align:center;">Maaf, kami tidak dapat menghasilkan rekomendasi saat ini. Coba lagi nanti.</p>';
                }

                if (data.new_coin_balance !== undefined) updateCoinDisplay(data.new_coin_balance);
            } catch (error) {
                console.error('Error fetching overall summary:', error);
                overallSummaryTextElement.innerHTML =
                    `<p style="color: red; text-align:center;">Gagal mendapatkan rekomendasi: ${error.message}</p>`;
            } finally {
                overallSummaryButton.disabled = false;
            }
        }

        function hideOverallSummaryContainer() {
            overallSummaryContainer.classList.add('hidden');
            const majorSelectionSection = document.getElementById('major-selection-section');
            if (majorSelectionSection) majorSelectionSection.remove();
        }
        // =================================================================
        // SIMULATION FLOW
        // =================================================================

        function showDirectMajorSelectionButtons(majors, overallSummaryId) {
            if (!majors || majors.length === 0) {
                console.log("Tidak ada jurusan yang bisa disimulasikan.");
                return;
            }

            const existingSelection = document.getElementById('major-selection-section');
            if (existingSelection) existingSelection.remove();

            const majorSelectionDiv = document.createElement('div');
            majorSelectionDiv.id = 'major-selection-section';
            majorSelectionDiv.className =
                'mt-6 p-6 bg-gradient-to-r from-blue-50 to-purple-50 rounded-lg border-2 border-blue-200 shadow-lg';
            majorSelectionDiv.style.animation = 'fadeInUp 0.5s ease-out';

            // Loop dari array 'majors' yang diterima langsung
            let buttonsHtml = majors.map(major => `
        <button 
            onclick="handleDirectMajorSelection('${major.replace(/'/g, "\\'")}', ${overallSummaryId})"
            class="btn w-full p-4 mb-3" 
            style="justify-content: space-between; background: white; color: var(--text-primary); border: 1px solid var(--border-light); transition: all 0.2s ease;">
            <span class="font-bold text-left">${major}</span>
            <span class="text-2xl">🎓</span>
        </button>`).join('');

            majorSelectionDiv.innerHTML = `
        <div class="text-center">
            <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--text-primary); margin-bottom: var(--space-sm);">Pilih Jurusan untuk Simulasi</h3>
            <p style="color: var(--text-secondary); margin-bottom: var(--space-lg);">AI merekomendasikan beberapa jurusan. Pilih satu untuk merasakan pengalaman singkat di jurusan tersebut.</p>
            <div class="grid gap-3 max-w-2xl mx-auto">${buttonsHtml}</div>
        </div>`;

            overallSummaryContainer.appendChild(majorSelectionDiv);
            majorSelectionDiv.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        }

        function showDirectMajorSelectionButtons(majors, overallSummaryId) {
            if (!majors || majors.length === 0) {
                console.log("Tidak ada jurusan yang bisa disimulasikan.");
                return;
            }

            const existingSelection = document.getElementById('major-selection-section');
            if (existingSelection) existingSelection.remove();

            const majorSelectionDiv = document.createElement('div');
            majorSelectionDiv.id = 'major-selection-section';
            majorSelectionDiv.className =
                'mt-6 p-6 bg-gradient-to-r from-blue-50 to-purple-50 rounded-lg border-2 border-blue-200 shadow-lg';
            majorSelectionDiv.style.animation = 'fadeInUp 0.5s ease-out';

            // Loop dari array 'majors' yang diterima langsung
            let buttonsHtml = majors.map(major => `
        <button 
            onclick="handleDirectMajorSelection('${major.replace(/'/g, "\\'")}', ${overallSummaryId})"
            class="btn w-full p-4 mb-3" 
            style="justify-content: space-between; background: white; color: var(--text-primary); border: 1px solid var(--border-light); transition: all 0.2s ease;">
            <span class="font-bold text-left">${major}</span>
            <span class="text-2xl">🎓</span>
        </button>`).join('');

            majorSelectionDiv.innerHTML = `
        <div class="text-center">
            <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--text-primary); margin-bottom: var(--space-sm);">Pilih Jurusan untuk Simulasi</h3>
            <p style="color: var(--text-secondary); margin-bottom: var(--space-lg);">AI merekomendasikan beberapa jurusan. Pilih satu untuk merasakan pengalaman singkat di jurusan tersebut.</p>
            <div class="grid gap-3 max-w-2xl mx-auto">${buttonsHtml}</div>
        </div>`;

            overallSummaryContainer.appendChild(majorSelectionDiv);
            majorSelectionDiv.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        }

        function handleDirectMajorSelection(selectedMajor, overallSummaryId) {
            console.log(`🎯 User selected major: ${selectedMajor}, using summary ID: ${overallSummaryId}`);
            const majorSelectionSection = document.getElementById('major-selection-section');
            if (majorSelectionSection) {
                // Sembunyikan tombol pilihan agar tidak bisa diklik lagi
                majorSelectionSection.style.display = 'none';
            }
            startSimulation(selectedMajor, overallSummaryId);
        }

        async function startSimulation(selectedMajor, overallSummaryId) {
            const simulationModal = document.getElementById('simulation-modal');
            const simulationTitle = document.getElementById('simulation-title');
            const simulationContent = document.getElementById('simulation-content');
            const simulationProgress = document.getElementById('simulation-progress');

            simulationTitle.textContent = `🎯 Simulasi: ${selectedMajor}`;
            simulationProgress.style.display = 'none';
            simulationModal.classList.remove('hidden');
            // Tambahkan class 'active' untuk memicu animasi fade-in
            setTimeout(() => simulationModal.classList.add('active'), 10);

            simulationContent.innerHTML =
                `<div style="text-align:center; padding:20px;"><div class="spinner"></div><p style="margin-top:1rem; font-style:italic; color:var(--text-secondary);">AI sedang merancang cerita simulasimu...</p></div>`;

            try {
                const response = await fetch("{{ route('simulation.start') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        selected_major: selectedMajor,
                        overall_summary_id: overallSummaryId
                    })
                });

                const data = await response.json();
                if (!response.ok) {
                    throw new Error(data.error || 'Gagal memulai sesi simulasi.');
                }

                // Simpan ID sesi dan data langkah pertama
                currentSimulationSession = data.session_id;
                simulationData = data; // simpan seluruh respons awal

                displaySimulationStep(simulationData.current_step);

            } catch (error) {
                console.error('Error starting simulation:', error);
                simulationContent.innerHTML =
                    `<div class="p-4 text-center" style="color:red;">Gagal memulai simulasi: ${error.message}. Coba tutup dan ulangi.</div>`;
            }
        }

        async function submitSimulationAnswer(answerValue) {
            const simulationContent = document.getElementById('simulation-content');
            // Tampilkan spinner di dalam modal
            simulationContent.innerHTML =
                `<div style="text-align:center; padding:20px;"><div class="spinner"></div><p style="margin-top:1rem; font-style:italic; color:var(--text-secondary);">Memproses pilihanmu...</p></div>`;

            try {
                const response = await fetch("{{ route('simulation.submitAnswer') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    // Di dalam fungsi async function submitSimulationAnswer(answerValue)

                    // ...
                    body: JSON.stringify({
                        session_id: currentSimulationSession,
                        answer: answerValue,
                        current_step_id: simulationData.current_step.id,
                        options: simulationData.current_step.options
                    })
                });

                const data = await response.json();
                if (!response.ok) {
                    throw new Error(data.error || 'Gagal mengirim jawaban simulasi.');
                }

                // Update state simulasi dengan data langkah berikutnya
                simulationData = data;
                displaySimulationStep(simulationData.current_step);

            } catch (error) {
                console.error('Error submitting simulation answer:', error);
                simulationContent.innerHTML =
                    `<div class="p-4 text-center" style="color:red;">Gagal memproses jawaban: ${error.message}.</div>`;
            }
        }

        // GANTI SELURUH FUNGSI INI
        function displaySimulationStep(stepData) {
            const simulationContent = document.getElementById('simulation-content');
            const simulationProgress = document.getElementById('simulation-progress');
            const progressBarSim = document.getElementById('progress-bar-sim');
            const progressTextSim = document.getElementById('progress-text-sim');

            // Selalu hapus konten lama untuk menghindari penumpukan
            simulationContent.innerHTML = '';

            if (!stepData) {
                simulationContent.innerHTML =
                    `<div class="p-4 text-center">Simulasi telah selesai atau terjadi kesalahan.</div>`;
                simulationProgress.style.display = 'none';
                return;
            }

            // ==========================================================
            // ===== INI ADALAH BAGIAN YANG DIPERBAIKI (KODE DIGABUNG) =====
            // ==========================================================
            if (stepData.is_final_step) {
                // --- A. JIKA INI LANGKAH TERAKHIR (KESIMPULAN) ---

                // 1. Sembunyikan progress bar
                simulationProgress.style.display = 'none';

                // 2. Buat elemen untuk menampung kesimpulan
                const summaryDiv = document.createElement('div');
                summaryDiv.className = 'simulation-final-summary'; // Terapkan style kesimpulan

                // 3. Masukkan HTML kesimpulan dari AI (scenario_text sudah berisi HTML)
                summaryDiv.innerHTML = stepData.scenario_text;

                // 4. Buat tombol "Selesai & Tutup"
                const buttonContainer = document.createElement('div');
                buttonContainer.className = 'btn-container';
                buttonContainer.innerHTML =
                    `<button onclick="closeSimulation()" class="btn btn-success">Selesai & Tutup</button>`;

                // 5. Gabungkan tombol ke dalam div kesimpulan
                summaryDiv.appendChild(buttonContainer);

                // 6. Tampilkan kesimpulan di modal
                simulationContent.appendChild(summaryDiv);

            } else {
                // --- B. JIKA INI LANGKAH SIMULASI BIASA ---

                // 1. Tampilkan dan update progress bar
                simulationProgress.style.display = 'block';
                const progressPercentage = (stepData.total_steps > 0 && stepData.current_step_number <= stepData
                        .total_steps) ?
                    ((stepData.current_step_number - 1) / stepData.total_steps) * 100 :
                    0;
                progressBarSim.style.width = `${progressPercentage}%`;
                progressTextSim.textContent = `Langkah ${stepData.current_step_number || ''} dari ${stepData.total_steps}`;

                // 2. Tampilkan skenario/pertanyaan
                const scenarioBlock = document.createElement('div');
                scenarioBlock.className = 'simulation-scenario-block';
                scenarioBlock.innerHTML = `<div class="simulation-scenario-text">${stepData.scenario_text || "..."}</div>`;

                // 3. Tampilkan tombol pilihan jawaban
                const optionsDiv = document.createElement('div');
                optionsDiv.className = 'simulation-options';
                if (stepData.options && stepData.options.length > 0) {
                    stepData.options.forEach(opt => {
                        const button = document.createElement('button');
                        button.className = 'btn';
                        button.innerHTML = opt.text;
                        button.onclick = () => submitSimulationAnswer(opt.value);
                        optionsDiv.appendChild(button);
                    });
                }

                // 4. Tampilkan semua elemen ke dalam modal
                simulationContent.appendChild(scenarioBlock);
                simulationContent.appendChild(optionsDiv);
            }
        }

        function closeSimulation() {
            const simulationModal = document.getElementById('simulation-modal');
            if (simulationModal) {
                simulationModal.classList.remove('active');
                // Tunggu animasi selesai sebelum menyembunyikan
                setTimeout(() => simulationModal.classList.add('hidden'), 300);
            }

            // Reset state
            currentSimulationSession = null;
            simulationData = null;

            // Tampilkan kembali tombol pilihan jurusan
            const majorSelectionSection = document.getElementById('major-selection-section');
            if (majorSelectionSection) {
                majorSelectionSection.style.display = 'block';
            }
        }
    </script>
@endsection
