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

        /* ===== MODERN CATEGORY CARDS (Digunakan juga untuk Enhanced Category Cards) ===== */
        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: var(--space-lg);
            margin-bottom: var(--space-xl);
        }

        .category-card {
            /* Style utama untuk category card */
            background: var(--surface);
            /* Menggunakan var(--surface) sebagai pengganti --card-bg */
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border-light);
            /* Menggunakan var(--border-light) sebagai pengganti --border-color */
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
            /* Menggunakan var(--primary) & var(--secondary) */
            transform: scaleX(0);
            transition: transform 0.4s ease;
            transform-origin: left;
        }

        .category-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: var(--shadow-xl);
            border-color: var(--primary);
            /* Menggunakan var(--primary) */
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
            /* Digunakan oleh .category-card h3 */
            font-family: var(--font-primary);
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: var(--space-sm);
            line-height: 1.3;
        }

        .category-description {
            /* Digunakan oleh .category-card p */
            font-family: var(--font-secondary);
            font-size: 0.95rem;
            color: var(--text-secondary);
            line-height: 1.6;
            margin-bottom: var(--space-lg);
        }

        .category-card h2 {
            /* Untuk style dari "Enhanced Category Cards" h2 */
            font-size: 1.25rem;
            /* text-xl */
            font-weight: 600;
            /* semibold */
            color: var(--primary);
            /* Menggunakan var(--primary) */
            margin-bottom: 8px;
        }

        .category-card p {
            /* Style p dari "Enhanced Category Cards" - ini akan menimpa .category-description jika berada di dalam .category-card */
            color: var(--text-secondary);
            /* Menggunakan var(--text-secondary) */
            font-size: 0.875rem;
            /* text-sm */
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
        /* Progress Container di dalam .sidebar-card sudah diatur di sana */
        /* Style progress bar ini untuk progress-container di dalam .sidebar-content */
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
            /* Ini adalah .progress-bar untuk sidebar */
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

        /* Progress Indicator untuk Konsol Pertanyaan (Legacy/Separate) */
        #progress-container.progress-bar {
            /* ID progress-container dengan class .progress-bar */
            width: 100%;
            height: 4px;
            background: var(--border-light);
            /* Menggunakan var(--border-light) */
            border-radius: 2px;
            overflow: hidden;
            margin: 16px 0;
        }

        #progress-fill.progress-fill {
            /* ID progress-fill dengan class .progress-fill */
            height: 100%;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            /* Menggunakan var(--primary) dan var(--secondary) */
            border-radius: 2px;
            transition: width 0.3s ease;
        }


        /* ===== MODERN MODAL STYLING (Digunakan oleh JS untuk modal dinamis) ===== */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.85);
            /* !important dihilangkan, bisa ditambahkan di JS jika perlu override kuat */
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            /* !important dihilangkan */
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-content {
            /* Style utama untuk .modal-content yang dibuat JS */
            background: var(--surface);
            /* Menggunakan var(--surface) sebagai pengganti --card-bg dan #ffffff */
            border-radius: var(--radius-2xl);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            /* !important dihilangkan */
            border: 1px solid var(--border-light);
            /* Menggunakan var(--border-light) sebagai pengganti --border-color dan rgba(255,255,255,0.1) */
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

        /* Style untuk Modal dari "Enhanced Modal Design" (ID #category-selection-modal, #overall-summary-modal) */
        #category-selection-modal,
        #overall-summary-modal {
            /* Style untuk modal dengan ID spesifik */
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

        #category-selection-modal .modal-content,
        #overall-summary-modal .modal-content {
            /* Menargetkan .modal-content di dalam modal spesifik */
            background: var(--surface);
            /* Menggunakan var(--surface) */
            padding: 32px;
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-xl);
            width: 100%;
            max-width: 520px;
            border: 1px solid var(--border-light);
            /* Menggunakan var(--border-light) */
            animation: modalSlideIn 0.3s ease-out;
            position: relative;
            /* Sudah ada di .modal-content umum */
        }

        #category-selection-modal .modal-content h2,
        #overall-summary-modal .modal-content h2 {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 16px;
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


        /* ===== TYPING INDICATOR (Digunakan oleh Modern UI & Enhanced) ===== */
        /* Style utama untuk .typing-indicator */
        .typing-indicator {
            display: flex;
            align-items: center;
            gap: var(--space-sm);
            /* Menggunakan var(--space-sm) dari :root */
            padding: var(--space-md);
            /* Menggunakan var(--space-md) dari :root */
            background: var(--surface-elevated);
            /* Menggunakan var(--surface-elevated) */
            border-radius: var(--radius-lg);
            border: 1px solid var(--border-light);
            /* Menggunakan var(--border-light) */
            /* margin-bottom: 12px; /* Dihapus karena bisa diatur per instance jika perlu */
            animation: fadeInUp 0.3s ease-out;
            /* Menggunakan animasi yang sudah ada */
        }

        .typing-dots {
            display: flex;
            gap: 4px;
            align-items: center;
        }

        /* Disesuaikan gap jika perlu */
        .typing-dot {
            width: 8px;
            height: 8px;
            background: var(--primary);
            /* Menggunakan var(--primary) atau var(--text-secondary) */
            border-radius: 50%;
            animation: typingBounce 1.4s infinite ease-in-out;
            /* Animasi dari Modern UI */
        }

        .typing-dot:nth-child(1) {
            animation-delay: -0.32s;
        }

        /* Dari Modern UI */
        .typing-dot:nth-child(2) {
            animation-delay: -0.16s;
        }

        /* Dari Modern UI */
        .typing-dot:nth-child(3) {
            animation-delay: 0s;
        }

        /* Dari Modern UI */

        @keyframes typingBounce {

            /* Dari Modern UI */
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

        /* @keyframes typingDot { /* Animasi dari "Enhanced", bisa dipilih salah satu atau dikombinasikan */
        /* 0%, 60%, 100% { transform: scale(1); opacity: 0.5; } */
        /* 30% { transform: scale(1.2); opacity: 1; } */
        /* } */

        .ai-typing-text {
            color: var(--text-secondary);
            font-style: italic;
            font-size: 0.9rem;
        }

        /* ===== MISC STYLES FROM PROVIDED CODE ===== */
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
            background-color: var(--success-light);
            min-width: 280px;
            max-width: 400px;
            color: white;
            padding: 10px 15px;
            border-radius: 15px;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
            font-size: 0.95rem;
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

        /* Enhanced Buttons (Question Option Button) */
        .question-option-button {
            background: linear-gradient(135deg, var(--success), #059669);
            /* Menggunakan var(--success) */
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
            background: var(--border-light);
            color: var(--text-secondary);
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        /* Menggunakan var(--border-light) dan var(--text-secondary) */
        .question-option-button:disabled::before {
            display: none;
        }

        .question-option-button img {
            width: 20px;
            height: auto;
        }

        .modal-close-button {
            /* Style untuk tombol close modal legacy */
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

        .hidden {
            display: none !important;
        }

        /* !important dipertahankan untuk override kuat */
        .user-info {
            text-align: right;
            margin-bottom: 20px;
            font-size: 1rem;
            color: #4A5568;
        }

        .user-info strong {
            color: #2D3748;
        }

        .user-info img {
            width: 20px;
            height: auto;
            vertical-align: middle;
            margin-left: 5px;
        }

        #overall-summary-content {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            margin-top: 10px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .spinner {
            border: 3px solid var(--border-light);
            /* Menggunakan var(--border-light) */
            border-radius: 50%;
            border-top-color: var(--primary);
            /* Menggunakan var(--primary) */
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
            border: 2px solid var(--border-light);
            /* Menggunakan var(--border-light) */
            border-top-color: var(--primary);
            /* Menggunakan var(--primary) */
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }


        /* ===== RESPONSIVE DESIGN ===== */
        @media (max-width: 768px) {
            body {
                padding: 10px;
                /* Ditambahkan dari bagian responsive bawah */
            }

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

            .category-card:hover {
                transform: translateY(-4px) scale(1.01);
                /* Disesuaikan dari responsive bawah */
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

            /* Modal responsive dari bagian bawah */
            #category-selection-modal .modal-content,
            /* Menargetkan modal spesifik */
            #overall-summary-modal .modal-content,
            .modal-overlay .modal-content {
                /* Menargetkan modal dinamis juga */
                padding: 24px;
                margin: 10px;
            }

            /* Input area responsive dari bagian bawah */
            .input-area {
                /* Class dari konsol legacy, mungkin perlu disesuaikan jika digunakan di modern UI */
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

            #legacy-question-console {
                max-height: 400px;
                /* Target ID yang sudah diubah */
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
            .chatbot-container {
                padding: var(--space-sm);
            }

            .chatbot-header {
                padding: var(--space-lg) var(--space-md);
            }

            .category-card {
                padding: var(--space-md);
            }

            .category-card h2 {
                font-size: 1.1rem;
                /* Dari responsive bawah */
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

            /* Modal content responsive dari bagian bawah */
            #category-selection-modal .modal-content,
            #overall-summary-modal .modal-content,
            .modal-overlay .modal-content {
                padding: 20px;
            }

            .chatbot-message {
                /* Ini class dari mana? Jika message di modern UI, selectornya .message .message-content */
                max-width: 95%;
                padding: 10px 14px;
            }

            .typing-indicator {
                padding: 10px 14px;
            }
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
                        {{-- Categories will be loaded here dynamically by JavaScript --}}
                        {{-- Server-side categories loop is commented out as per original logic --}}
                        {{-- @forelse ($categories as $categoryId => $category) ... @empty ... @endforelse --}}
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
                        <div class="progress-container"> {{-- Ini adalah .progress-container untuk sidebar --}}
                            <div class="progress-header">
                                <div class="progress-title" id="progress-category">Kategori</div>
                                <div class="progress-stats" id="progress-text-sidebar">0/0</div> {{-- ID diubah agar unik jika ada progress-text lain --}}
                            </div>
                            <div class="progress-bar-container">
                                <div class="progress-bar" id="progress-bar-sidebar" style="width: 0%"></div>
                                {{-- ID diubah --}}
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
    {{-- This modal is replaced by the modern modal system in selectCategory() -> showQuestionSelectionModal() --}}
    {{--
<div id="category-selection-modal" class="hidden">
    <div class="modal-content">
        <h2 id="selection-title">Pilih Jumlah Pertanyaan</h2>
        <div id="question-options-container" class="grid gap-3 grid-cols-2 md:grid-cols-2">
        </div>
        <button class="modal-close-button" data-action="close-category-modal">Kembali</button>
    </div>
</div>
--}}

    {{-- Konsol Pertanyaan (Chatbox) - LEGACY / SEPARATE - ID diubah --}}
    <div id="legacy-question-console" class="bg-[#f0f4f8] p-4 rounded-lg mb-6 shadow-inner hidden">
        <h2 id="legacy-console-title" class="text-2xl font-semibold text-[#2d3748] mb-4 text-center"></h2>

        {{-- Progress Indicator untuk konsol legacy --}}
        <div id="legacy-progress-container" class="progress-bar hidden"> {{-- ID diubah --}}
            <div id="legacy-progress-fill" class="progress-fill" style="width: 0%"></div> {{-- ID diubah --}}
        </div>
        <div id="legacy-progress-text" class="text-center text-sm text-gray-600 mb-4 hidden"> {{-- ID diubah --}}
            Pertanyaan <span id="legacy-current-question">1</span> dari <span id="legacy-total-questions">5</span>
            {{-- ID diubah --}}
        </div>

        <div id="legacy-chat-history" class="flex-grow overflow-y-auto mb-4 p-2 space-y-3"> {{-- ID diubah --}}
            {{-- Riwayat chat akan muncul di sini --}}
        </div>
        <div class="input-area"> {{-- Jika ini class spesifik untuk legacy, biarkan --}}
            <input type="text" id="legacy-user-input" placeholder="Ketik jawabanmu di sini..." autocomplete="off">
            {{-- ID diubah --}}
            <button id="legacy-send-button" onclick="processUserInputLegacy()">Kirim</button> {{-- ID diubah, onclick mungkin perlu fungsi baru --}}
        </div>
        <button onclick="hideLegacyQuestionConsole()" class="modal-close-button w-full mt-4">Tutup Konsol Kategori</button>
        {{-- onclick mungkin perlu fungsi baru --}}
    </div>

    {{-- Area Summary Keseluruhan (Bagian dari UI Modern, muncul di bawah sidebar atau di tempat lain) --}}
    {{-- Strukturnya mungkin perlu diintegrasikan lebih baik dengan .chatbot-main jika ini adalah target utama --}}
    <div id="overall-summary-container" class="hidden"
        style="margin-top: var(--space-xl); padding: var(--space-lg); background: var(--surface); border-radius: var(--radius-xl); box-shadow: var(--shadow-md);">
        <h2
            style="font-family: var(--font-primary); font-size: 1.75rem; font-weight: 700; color: var(--text-primary); margin-bottom: var(--space-md); text-align:center;">
            Rekomendasi Jurusan Final Untukmu
        </h2>
        <div id="overall-summary-text" style="color: var(--text-secondary); line-height: 1.6;">
            {{-- Summary keseluruhan akan muncul di sini --}}
        </div>
        {{-- Container untuk tombol pilihan jurusan dari AI akan ditambahkan oleh JS di dalam overall-summary-text atau setelahnya --}}
        <button onclick="hideOverallSummaryContainer()" class="btn btn-outline"
            style="display: block; margin: var(--space-lg) auto 0;">
            Tutup Rekomendasi Final
        </button>
    </div>


    {{-- Simulation Modal --}}
    <div id="simulation-modal"
        class="fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-xl shadow-2xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 id="simulation-title" class="text-2xl font-bold text-gray-800">🎯 Simulasi Interaktif</h2>
                    <button onclick="closeSimulation()"
                        class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
                </div>
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
                <div id="simulation-content">
                    {{-- Content will be dynamically loaded here --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
    <script>
        // Fallback untuk AOS jika tidak ada
        window.addEventListener('error', function(e) {
            if (e.message && e.message.includes('AOS')) {
                console.log('🔧 AOS library not found, creating fallback');
                window.AOS = {
                    init: function() {
                        console.log('🔧 AOS fallback initialized');
                    },
                    refresh: function() {
                        console.log('🔧 AOS fallback refresh');
                    }
                };
            }
        });
        if (typeof AOS === 'undefined') {
            window.AOS = {
                init: function() {
                    console.log('🔧 AOS fallback initialized');
                },
                refresh: function() {
                    console.log('🔧 AOS fallback refresh');
                }
            };
        }
    </script>
    <script>
        // Data dari Backend (Global)
        const categoriesData =
        @json($categories); // Pastikan $categories selalu dikirim dari controller jika ini sumber utama
        let currentUserCoins = {{ $userCoins ?? 0 }};
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        console.log('🔍 Categories data received from server:', categoriesData);

        // State Aplikasi (Global)
        let currentCategoryId = null;
        let currentCategoryLabel = '';
        let currentCategoryQuestions = []; // Pertanyaan asli dari kategori yang dipilih
        let questionsToAsk = []; // Pertanyaan yang akan ditanyakan (subset dari currentCategoryQuestions)
        let currentQuestionIndex = 0;
        let userAnswersForCurrentCategory = [];
        let allUserAnswers = {}; // Menyimpan semua jawaban dari semua kategori yang diselesaikan

        // DOM elements (diinisialisasi di DOMContentLoaded)
        let categoriesContainer, categoriesSection, chatSection, chatHistoryElement, userInputElement, sendButton;
        let progressCardSidebar, progressCategorySidebar, progressBarSidebar, progressTextSidebar; // Untuk sidebar
        let overallSummaryContainer, overallSummaryTextElement; // Untuk summary final

        // Variabel untuk legacy console (jika masih akan digunakan)
        let legacyQuestionConsole, legacyConsoleTitle, legacyChatHistory, legacyUserInput, legacySendButton;
        let legacyProgressContainer, legacyProgressFill, legacyProgressText, legacyCurrentQuestionSpan,
            legacyTotalQuestionsSpan;


        document.addEventListener('DOMContentLoaded', function() {
            console.log('🚀 DOMContentLoaded - Starting initialization');

            // Initialize Modern UI DOM elements
            categoriesContainer = document.getElementById('categories-container');
            categoriesSection = document.getElementById('categories-section');
            chatSection = document.getElementById('chat-section');
            chatHistoryElement = document.getElementById('chat-history'); // Target modern chat history
            userInputElement = document.getElementById('user-input'); // Target modern user input
            sendButton = document.getElementById('send-button'); // Target modern send button

            progressCardSidebar = document.getElementById('progress-card');
            progressCategorySidebar = document.getElementById('progress-category');
            progressBarSidebar = document.getElementById('progress-bar-sidebar');
            progressTextSidebar = document.getElementById('progress-text-sidebar');

            overallSummaryContainer = document.getElementById('overall-summary-container');
            overallSummaryTextElement = document.getElementById('overall-summary-text');
            // requestOverallSummaryButton sudah ada di HTML dengan onclick

            // Initialize Legacy Console DOM elements (jika diperlukan)
            legacyQuestionConsole = document.getElementById('legacy-question-console');
            legacyConsoleTitle = document.getElementById('legacy-console-title');
            legacyChatHistory = document.getElementById('legacy-chat-history');
            legacyUserInput = document.getElementById('legacy-user-input');
            legacySendButton = document.getElementById('legacy-send-button');
            legacyProgressContainer = document.getElementById('legacy-progress-container');
            legacyProgressFill = document.getElementById('legacy-progress-fill');
            legacyProgressText = document.getElementById('legacy-progress-text');
            legacyCurrentQuestionSpan = document.getElementById('legacy-current-question');
            legacyTotalQuestionsSpan = document.getElementById('legacy-total-questions');


            // Hapus inisialisasi duplikat dari sini, karena sudah di atas.
            // Cukup panggil fungsi yang dibutuhkan.
            if (categoriesContainer) {
                loadCategories();
                updateCategoryCardVisuals();
            } else {
                console.error("categoriesContainer not found during DOMContentLoaded!");
            }
            updateCoinDisplay(); // Nama fungsi diubah agar lebih jelas
            initializeModernChatEventListeners(); // Nama fungsi diubah

            // Initialize Typed.js
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
                        backSpeed: 10,
                        startDelay: 500,
                        loop: false,
                        showCursor: true,
                        cursorChar: '|',
                        onComplete: function(self) {
                            if (self.cursor) self.cursor.style.display = 'none';
                        }
                    });
                } catch (e) {
                    console.error("Typed.js initialization failed:", e);
                    typedWelcomeElement.textContent =
                        `${greeting} Aku AI MATE yang siap membantu kamu memilih jurusan yang tepat. Yuk, pilih kategori yang ingin kamu coba dulu!`;
                }
            } else if (typedWelcomeElement) {
                typedWelcomeElement.textContent =
                    `${greeting} Aku AI MATE yang siap membantu kamu memilih jurusan yang tepat. Yuk, pilih kategori yang ingin kamu coba dulu!`;
            }


            // Pastikan modal legacy (jika ada HTMLnya) tersembunyi
            const legacyModal = document.getElementById('category-selection-modal'); // ID modal legacy
            if (legacyModal) {
                legacyModal.classList.add('hidden');
            }

            console.log('✅ Modern UI initialization complete');
        });

        function updateCategoryCardVisuals() {
            if (!categoriesContainer || !allUserAnswers) return;
            console.log("Updating card visuals based on allUserAnswers:", allUserAnswers);

            const categoryCards = categoriesContainer.querySelectorAll('.category-card');
            categoryCards.forEach(card => {
                const categoryIdFromCard = card.dataset.categoryId; // Ambil dari data-category-id
                const categoryLabelFromCard = card.querySelector('.category-title')?.textContent.trim() || '';

                // Cek apakah kategori ini ada di allUserAnswers
                // Kita bisa mengecek berdasarkan label atau categoryIdKey jika sudah disimpan di allUserAnswers
                let isCompleted = false;
                if (allUserAnswers[categoryLabelFromCard]) { // Cek berdasarkan label dulu
                    isCompleted = true;
                } else if (categoryIdFromCard) { // Jika tidak ada berdasarkan label, coba cek berdasarkan ID
                    for (const key in allUserAnswers) {
                        if (allUserAnswers[key].categoryIdKey === categoryIdFromCard) {
                            isCompleted = true;
                            break;
                        }
                    }
                }


                if (isCompleted) {
                    card.classList.add('completed');
                    let checkmark = card.querySelector('.completion-checkmark');
                    if (!checkmark) {
                        checkmark = document.createElement('span');
                        checkmark.className = 'completion-checkmark';
                        checkmark.innerHTML = '✓';
                        const titleElement = card.querySelector('.category-title');
                        if (titleElement && titleElement.parentNode) {
                            titleElement.parentNode.insertBefore(checkmark, titleElement.nextSibling);
                        } else {
                            card.appendChild(checkmark);
                        }
                    }
                    console.log(`Card ${categoryLabelFromCard || categoryIdFromCard} marked as completed.`);
                } else {
                    card.classList.remove('completed');
                    const checkmark = card.querySelector('.completion-checkmark');
                    if (checkmark) checkmark.remove();
                }
            });
        }

        function loadCategories() {
            console.log('🔄 Loading categories...');
            if (!categoriesContainer) {
                console.error('❌ Categories container not found!');
                return;
            }
            categoriesContainer.innerHTML = `
            <div id="categories-loading" style="grid-column: 1 / -1; text-align: center; padding: var(--space-xl); color: var(--text-secondary);">
                <div style="font-size: 3rem; margin-bottom: 1rem;">📋</div>
                <h3 style="margin-bottom: 0.5rem; color: var(--text-primary);">Memuat Kategori...</h3>
                <p>Kategori assessment sedang dimuat. Mohon tunggu sebentar.</p>
            </div>`;

            if (!categoriesData || Object.keys(categoriesData).length === 0) {
                console.warn('⚠️ No categories data available from server - showing fallback/error message.');
                categoriesContainer.innerHTML = `
                <div style="grid-column: 1 / -1; text-align: center; padding: var(--space-xl); color: var(--text-secondary);">
                    <div style="font-size: 3rem; margin-bottom: 1rem;">⚠️</div>
                    <h3 style="margin-bottom: 0.5rem; color: var(--text-primary);">Data kategori tidak ditemukan</h3>
                    <p>Menggunakan kategori fallback. Silakan refresh halaman untuk data terbaru atau coba gunakan kategori fallback.</p>
                    <button onclick="location.reload()" class="btn btn-primary" style="margin-top: 1rem;">🔄 Refresh Halaman</button>
                    <button onclick="loadFallbackCategoriesJs()" class="btn btn-secondary" style="margin-top: 1rem; margin-left: 1rem;">📋 Gunakan Kategori Fallback</button>
                </div>`;
                // Definisikan fallbackCategories di JS jika akan digunakan oleh loadFallbackCategoriesJs()
                window.fallbackCategoriesData = {
                    'bakat_minat': {
                        label: 'Bakat & Minat Fallback',
                        questions: Array(5).fill().map((_, i) => `Pertanyaan Fallback Bakat ${i + 1}`),
                        cost_per_question: 10
                    },
                    'kepribadian': {
                        label: 'Kepribadian Fallback',
                        questions: Array(5).fill().map((_, i) => `Pertanyaan Fallback Kepribadian ${i + 1}`),
                        cost_per_question: 10
                    },
                };
                return;
            }

            categoriesContainer.innerHTML = ''; // Clear loading
            Object.entries(categoriesData).forEach(([categoryId, category]) => {
                const categoryCard = createCategoryCard(categoryId, category);
                categoriesContainer.appendChild(categoryCard);
            });
            console.log('✅ Categories loaded successfully from server data');
        }

        // Fungsi untuk memuat fallback kategori jika dipanggil dari tombol
        function loadFallbackCategoriesJs() {
            console.log('🔧 Loading fallback categories from JS function...');
            if (!window.fallbackCategoriesData || Object.keys(window.fallbackCategoriesData).length === 0) {
                alert("Data kategori fallback tidak tersedia.");
                return;
            }
            if (!categoriesContainer) return;
            categoriesContainer.innerHTML = '';
            Object.entries(window.fallbackCategoriesData).forEach(([categoryId, category]) => {
                const categoryCard = createCategoryCard(categoryId, category);
                categoriesContainer.appendChild(categoryCard);
            });
            console.log('✅ Fallback categories loaded via JS function.');
        }


        function createCategoryCard(categoryId, category) {
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
            const questionCount = Array.isArray(category.questions) ? category.questions.length : 0;
            const costPerQuestion = category.cost_per_question || 15;
            const categoryLabel = category.label || 'Kategori Tanpa Nama';

            card.innerHTML = `
            <div class="category-icon">${icon}</div>
            <h3 class="category-title">${categoryLabel}</h3>
            <p class="category-description">Eksplorasi ${categoryLabel.toLowerCase()} untuk menentukan jurusan yang tepat</p>
            <div class="category-meta">
                <div class="category-questions"><span>📝</span> <span>${questionCount} soal</span></div>
                <div class="category-cost"><span>🪙</span> <span>${costPerQuestion} koin/soal</span></div>
            </div>`;
            card.addEventListener('click', () => {
                console.log(`🖱️ Category clicked: ${categoryId}`);
                selectCategory(categoryId, categoryLabel, questionCount, costPerQuestion);
            });
            return card;
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
                        processModernUserInput(); // Panggil fungsi spesifik untuk modern UI
                    }
                });
            }
            if (sendButton) {
                sendButton.addEventListener('click', processModernUserInput); // Panggil fungsi spesifik
            }
        }

        function updateCoinDisplay() {
            const coinElements = document.querySelectorAll('#user-coin-balance'); // Hanya target elemen modern UI
            coinElements.forEach(element => {
                if (element) element.textContent = currentUserCoins;
            });
        }

        function showChatInterface() {
            if (categoriesSection) categoriesSection.style.display = 'none';
            if (chatSection) chatSection.style.display = 'block';
            if (progressCardSidebar) progressCardSidebar.style.display = 'block';
            if (userInputElement) userInputElement.focus();
        }

        function hideChatInterface() { // Digunakan oleh tombol "Kembali" di chat modern
            if (categoriesSection) categoriesSection.style.display = 'block';
            if (chatSection) chatSection.style.display = 'none';
            if (progressCardSidebar) progressCardSidebar.style.display = 'none';
            if (chatHistoryElement) chatHistoryElement.innerHTML = ''; // Bersihkan chat history modern
            resetCategoryState();
        }

        function resetCategoryState() {
            currentCategoryId = null;
            currentCategoryLabel = '';
            currentCategoryQuestions = [];
            questionsToAsk = [];
            currentQuestionIndex = 0;
            userAnswersForCurrentCategory = [];
        }

        // Fungsi global untuk onclick dari category card
        window.selectCategory = function(categoryId, categoryLabel, totalQuestionsInCat, costPerQuestion) {
            console.log(`🎯 Selecting category: ${categoryId} (${categoryLabel})`);
            currentCategoryId = categoryId; // Set state global
            currentCategoryLabel = categoryLabel;

            // Ambil pertanyaan asli untuk kategori ini
            if (categoriesData && categoriesData[categoryId] && Array.isArray(categoriesData[categoryId].questions)) {
                currentCategoryQuestions = categoriesData[categoryId].questions;
            } else if (window.fallbackCategoriesData && window.fallbackCategoriesData[categoryId] && Array.isArray(
                    window.fallbackCategoriesData[categoryId].questions)) {
                // Jika menggunakan fallback data dari JS
                currentCategoryQuestions = window.fallbackCategoriesData[categoryId].questions;
            } else {
                console.error(`Tidak ada data pertanyaan untuk kategori ${categoryId}`);
                alert(`Tidak ada pertanyaan yang tersedia untuk kategori ${categoryLabel}.`);
                currentCategoryQuestions = []; // Kosongkan jika tidak ada
                // Fallback jika totalQuestionsInCat dari card tidak sesuai
                totalQuestionsInCat = 0;
                // return; // Jangan tampilkan modal jika tidak ada pertanyaan
            }
            // Pastikan totalQuestionsInCat sesuai dengan jumlah pertanyaan yang ada
            totalQuestionsInCat = currentCategoryQuestions.length;


            if (totalQuestionsInCat > 0) {
                showModernQuestionSelectionModal(categoryId, categoryLabel, totalQuestionsInCat, costPerQuestion);
            } else {
                alert(`Kategori "${categoryLabel}" belum memiliki pertanyaan. Silakan pilih kategori lain.`);
            }
        };

        function showModernQuestionSelectionModal(categoryId, categoryLabel, totalQuestions, costPerQuestion) {
            console.log(`📋 Showing modern question selection for: ${categoryLabel}`);
            const existingModal = document.getElementById('question-selection-overlay');
            if (existingModal) existingModal.remove(); // Hapus modal lama jika ada

            const modalOverlay = document.createElement('div');
            modalOverlay.className = 'modal-overlay'; // Class ini sudah di-style di CSS
            modalOverlay.id = 'question-selection-overlay';

            const modalContent = document.createElement('div');
            modalContent.className = 'modal-content'; // Class ini sudah di-style di CSS

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
            const options = [];
            // Opsi jumlah pertanyaan yang lebih fleksibel
            let questionCounts = [];
            if (totalQuestions <= 5) {
                for (let i = 1; i <= totalQuestions; i++) questionCounts.push(i);
            } else if (totalQuestions <= 10) {
                questionCounts = [1, 3, 5, Math.min(7, totalQuestions), totalQuestions];
            } else { // Lebih dari 10
                questionCounts = [1, 3, 5, 7, 10, totalQuestions];
            }
            questionCounts = [...new Set(questionCounts)].sort((a, b) => a - b); // Unik dan urutkan

            questionCounts.forEach(count => {
                if (count > totalQuestions) return; // Jangan tawarkan lebih dari yang tersedia
                const cost = count * costPerQuestion;
                const canAfford = currentUserCoins >= cost;
                options.push(`
                <button onclick="startModernCategoryQuestions(${count})" class="btn ${canAfford ? 'btn-primary' : 'btn-outline'}" ${!canAfford ? 'disabled' : ''}
                    style="padding: var(--space-lg); text-align: left; display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--space-sm);">
                    <div>
                        <div style="font-weight: 600; margin-bottom: 4px;">${count} Soal</div>
                        <div style="font-size: 0.875rem; opacity: 0.8;">Biaya: ${cost} koin</div>
                    </div>
                    <div style="font-size: 1.5rem;">${canAfford ? '✅' : '❌'}</div>
                </button>`);
            });
            return options.join('');
        }

        // Fungsi global untuk onclick tombol close modal
        window.closeModernQuestionSelectionModal = function() {
            const modalOverlay = document.getElementById('question-selection-overlay');
            if (modalOverlay) {
                modalOverlay.classList.remove('active');
                setTimeout(() => modalOverlay.remove(), 300);
            }
        };

        // Fungsi global untuk onclick tombol pilihan jumlah soal
        window.startModernCategoryQuestions = function(numQuestions) {
            console.log(`🚀 Starting ${numQuestions} questions for ${currentCategoryLabel}`);
            closeModernQuestionSelectionModal();

            if (!currentCategoryQuestions || currentCategoryQuestions.length === 0) {
                alert("Tidak ada pertanyaan yang bisa ditampilkan untuk kategori ini.");
                return;
            }
            // Ambil subset pertanyaan
            questionsToAsk = currentCategoryQuestions.slice(0, numQuestions);
            currentQuestionIndex = 0;
            userAnswersForCurrentCategory = [];
            if (userInputElement) {
                userInputElement.disabled = false;
                userInputElement.value = ''; // Opsional: bersihkan input sebelumnya
                userInputElement.style.height = 'auto'; // Reset tinggi textarea
            }
            if (sendButton) {
                sendButton.disabled = false;
            }
            showChatInterface();
            updateModernProgress();
            displayNextModernQuestion();
        };

        function updateModernProgress() {
            if (progressBarSidebar && progressTextSidebar && progressCategorySidebar) {
                const progress = questionsToAsk.length > 0 ? (currentQuestionIndex / questionsToAsk.length) * 100 : 0;
                progressBarSidebar.style.width = `${progress}%`;
                progressTextSidebar.textContent = `${currentQuestionIndex}/${questionsToAsk.length}`;
                progressCategorySidebar.textContent = currentCategoryLabel;
            }
        }

        function displayMessageInModernChat(message, type, isHTML = false) {
            if (!chatHistoryElement) return;
            const messageWrapper = document.createElement('div');
            messageWrapper.className = `message ${type}`; // user or bot
            const avatar = document.createElement('div');
            avatar.className = 'message-avatar';
            avatar.textContent = type === 'user' ? '👤' : '🤖';
            const content = document.createElement('div');
            content.className = 'message-content';
            if (type === 'bot' && (message.includes('🎉') || message.includes('Semua pertanyaan'))) content.classList.add(
                'summary-title');
            if (type === 'bot' && message.toLowerCase().includes('error')) content.classList.add('error-message');
            if (isHTML) content.innerHTML = message;
            else content.textContent = message;
            messageWrapper.appendChild(avatar);
            messageWrapper.appendChild(content);
            chatHistoryElement.appendChild(messageWrapper);
            chatHistoryElement.scrollTop = chatHistoryElement.scrollHeight;
        }

        let currentTypingIndicatorId = null;

        function showModernTypingIndicator(text = "AI sedang mengetik...") {
            if (currentTypingIndicatorId) removeModernTypingIndicator(); // Hapus yang lama jika ada
            const typingId = 'typing-' + Date.now();
            currentTypingIndicatorId = typingId;
            const typingHTML = `
            <div id="${typingId}" class="message bot typing-indicator" style="max-width: fit-content;">
                 <div class="message-avatar">🤖</div>
                 <div class="message-content" style="background: var(--surface-elevated);">
                    <span class="ai-typing-text">${text}</span>
                    <div class="typing-dots">
                        <div class="typing-dot"></div> <div class="typing-dot"></div> <div class="typing-dot"></div>
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


        async function simpleHTMLTypewriterEffect(element, htmlContent, speed = 15) {
            return new Promise(async (resolve) => {
                // Render HTML sementara untuk mendapatkan teks bersih & struktur dasar
                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = htmlContent;
                const allTextNodes = [];

                function getTextNodes(node) {
                    if (node.nodeType === Node.TEXT_NODE && node.textContent.trim() !== '') {
                        allTextNodes.push(node);
                    } else {
                        node.childNodes.forEach(getTextNodes);
                    }
                }
                getTextNodes(tempDiv);

                element.innerHTML = ''; // Kosongkan elemen target

                // Fungsi untuk mengetik per karakter dengan delay
                async function typeChar(textNode, charIndex = 0) {
                    if (charIndex < textNode.textContent.length) {
                        // Tambahkan karakter ke node teks yang sesuai di DOM nyata
                        // Ini adalah bagian yang disederhanakan; idealnya kita merekonstruksi HTML
                        // Untuk sekarang, kita akan buat elemen baru untuk setiap text node
                        if (charIndex === 0) {
                            const parentTag = textNode.parentNode.tagName.toLowerCase();
                            let wrapper;
                            if (parentTag !==
                                'div') { // Hindari div di dalam div jika textNode langsung di element
                                wrapper = document.createElement(parentTag);
                                element.appendChild(wrapper);
                            } else {
                                wrapper = element; // Atau tambahkan langsung jika parentnya div
                            }
                            wrapper.setAttribute('data-text-node-id', allTextNodes.indexOf(
                            textNode)); // Tandai
                        }
                        const currentWrapper = Array.from(element.childNodes).find(el => el.dataset &&
                            el.dataset.textNodeId == allTextNodes.indexOf(textNode)) || element;
                        currentWrapper.textContent += textNode.textContent[charIndex];

                        await new Promise(r => setTimeout(r, speed));
                        await typeChar(textNode, charIndex + 1);
                    }
                }

                // Iterasi melalui semua text node dan ketik mereka
                // Sederhana: kita akan gabungkan semua teks dan ketik sekali, lalu set HTML penuh
                let fullText = "";
                allTextNodes.forEach(node => fullText += node.textContent + (node.parentNode.tagName ===
                    'P' || node.parentNode.tagName === 'DIV' ? '\n' : ' '));
                fullText = fullText.replace(/\s+/g, ' ').trim(); // Normalisasi spasi

                let i = 0;

                function type() {
                    if (i < fullText.length) {
                        element.innerHTML = fullText.substring(0, i + 1)
                            .replace(/\n/g, '<br>') // Ganti newline dengan <br> untuk tampilan
                            .replace(/<br><br>/g, '<br>'); // Hindari <br> ganda
                        i++;
                        setTimeout(type, speed);
                    } else {
                        element.innerHTML = htmlContent; // Set HTML penuh setelah selesai
                        resolve();
                    }
                }
                type();
            });
        }


        function displayNextModernQuestion() {
            updateModernProgress();
            if (currentQuestionIndex < questionsToAsk.length) {
                displayMessageInModernChat(questionsToAsk[currentQuestionIndex], 'bot');
                if (userInputElement) userInputElement.focus();
            } else {
                if (userInputElement) userInputElement.disabled = true;
                if (sendButton) sendButton.disabled = true;
                displayMessageInModernChat(
                    "🎉 Semua pertanyaan untuk kategori ini telah selesai! Klik tombol di bawah untuk mendapatkan analisis AI.",
                    'bot', true);

                const aiRecButtonContainer = document.createElement('div');
                aiRecButtonContainer.style.textAlign = 'center';
                aiRecButtonContainer.style.padding = 'var(--space-md) 0';

                const aiRecButton = document.createElement('button');
                aiRecButton.innerHTML = '<span>🤖</span> Berikan Rekomendasi';
                aiRecButton.className = 'btn btn-primary'; // Gunakan class .btn yang sudah ada
                aiRecButton.onclick = () => {
                    requestModernCategorySummary();
                    aiRecButtonContainer.remove(); // Hapus tombol setelah diklik
                };
                aiRecButtonContainer.appendChild(aiRecButton);
                if (chatHistoryElement) {
                    chatHistoryElement.appendChild(aiRecButtonContainer);
                    chatHistoryElement.scrollTop = chatHistoryElement.scrollHeight;
                }
            }
        }

        function processModernUserInput() {
            if (!userInputElement || userInputElement.disabled) return;
            const answer = userInputElement.value.trim();
            if (answer) {
                displayMessageInModernChat(answer, 'user');
                userAnswersForCurrentCategory.push(answer);
                userInputElement.value = '';
                userInputElement.style.height = 'auto'; // Reset tinggi textarea
                currentQuestionIndex++;
                displayNextModernQuestion();
            }
        }

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
                        categoryId: currentCategoryId,
                        numQuestions: userAnswersForCurrentCategory
                        .length, // Jumlah pertanyaan yang dijawab
                        answers: userAnswersForCurrentCategory
                    })
                });
                removeModernTypingIndicator();
                const data = await response.json();
                if (!response.ok) {
                    displayMessageInModernChat(data.error || `Gagal mendapatkan summary (Error: ${response.status})`,
                        'bot', true);
                    if (data.new_coin_balance !== undefined) updateCoinBalanceUI(data
                    .new_coin_balance); // updateCoinBalanceUI perlu didefinisikan
                    return;
                }
                if (data.summary) {
                    const summaryMessageDiv = document.createElement('div'); // Kontainer untuk summary
                    displayMessageInModernChat('', 'bot', true); // Buat bubble message bot dulu
                    const botMessages = chatHistoryElement.querySelectorAll('.message.bot .message-content');
                    const lastBotMessageContent = botMessages[botMessages.length - 1];
                    if (lastBotMessageContent) {
                        await simpleHTMLTypewriterEffect(lastBotMessageContent, data.summary, 10);
                    }


                    allUserAnswers[currentCategoryLabel] = {
                        categoryIdKey: currentCategoryId,
                        questions: questionsToAsk,
                        answers: userAnswersForCurrentCategory,
                        summary: data.summary
                    };
                    console.log("Updated allUserAnswers:", allUserAnswers);

                    updateCategoryCardVisuals();
                    // Suggestion message
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
                if (data.new_coin_balance !== undefined) {
                    currentUserCoins = data.new_coin_balance; // Update state JS
                    updateCoinDisplay(); // Update UI
                }
            } catch (error) {
                removeModernTypingIndicator();
                console.error('Error fetching category summary:', error);
                displayMessageInModernChat("Terjadi masalah koneksi saat meminta summary kategori.", 'bot', true);
            }
        }

        function updateCoinBalanceUI(newBalance) { // Fungsi ini ditambahkan dari analisis
            currentUserCoins = newBalance;
            updateCoinDisplay(); // Panggil fungsi yang sudah ada untuk update UI
        }

        async function requestOverallSummary() {
            if (Object.keys(allUserAnswers).length < 1) {
                alert("Selesaikan minimal satu kategori dulu untuk mendapatkan rekomendasi final.");
                return;
            }
            const overallSummaryCost = 5; // Asumsi biaya
            if (currentUserCoins < overallSummaryCost) {
                alert(
                    `Koin Anda (${currentUserCoins}) tidak cukup. Butuh ${overallSummaryCost} koin untuk rekomendasi final.`);
                return;
            }

            const overallSummaryButton = document.getElementById('request-overall-summary-button');
            if (overallSummaryButton) overallSummaryButton.disabled = true;

            if (overallSummaryContainer && overallSummaryTextElement) {
                overallSummaryTextElement.innerHTML =
                    `<div style="text-align:center; padding: 20px;"><i>Sedang memproses rekomendasi final... <span class="spinner"></span></i></div>`;
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
                if (data.summary && overallSummaryTextElement) {
                    await simpleHTMLTypewriterEffect(overallSummaryTextElement, data.summary, 10);
                    if (data.user_answers_summary) { // Jika ada summary jawaban pengguna
                        // Anda bisa menambahkan ini ke overallSummaryTextElement juga
                    }
                    // Tampilkan pilihan jurusan setelah summary
                    setTimeout(() => {
                        showDirectMajorSelectionButtons(data.summary,
                        allUserAnswers); // Mengirim allUserAnswers
                    }, 300);
                }
                if (data.new_coin_balance !== undefined) updateCoinBalanceUI(data.new_coin_balance);

            } catch (error) {
                if (overallSummaryButton) overallSummaryButton.disabled = false;
                console.error('Error fetching overall summary:', error);
                if (overallSummaryTextElement) overallSummaryTextElement.innerHTML =
                    `<p style="color: red; text-align:center;">Masalah koneksi saat meminta rekomendasi final.</p>`;
            }
        }

        function hideOverallSummaryContainer() {
            if (overallSummaryContainer) overallSummaryContainer.classList.add('hidden');
            const majorSelectionSection = document.getElementById('major-selection-section');
            if (majorSelectionSection) majorSelectionSection.remove();
            const simulationPromptSection = document.getElementById('simulation-prompt-section');
            if (simulationPromptSection) simulationPromptSection.remove();

        }


        // ===== DIRECT MAJOR SELECTION SYSTEM (setelah Overall Summary) =====
        function extractMajorsFromAIResponse(aiResponseText) {
            const majors = new Set(); // Gunakan Set untuk menghindari duplikat
            // Pattern: "1. [Nama Jurusan]" atau "- [Nama Jurusan]" atau "* [Nama Jurusan]"
            // Diikuti oleh baris baru atau penjelasan seperti "Alasan:", "Penjelasan:"
            const patterns = [
                /(?:^|\n)\s*(?:\d+\.|-|\*)\s*([A-Za-zÀ-ú\s,&/-]+?)(?=\s*:(?:\s+Alasan|\s+Penjelasan|$)|(?:\s*\n\s*(?:Alasan|Penjelasan|$))|\s*\n\s*(?:\d+\.|-|\*)|$)/gim, // Lebih robust
                /(?:(?:Jurusan yang direkomendasikan|Pilihan teratas)\s*:\s*)([A-Za-zÀ-ú\s,&/-]+)/gim // Mencari setelah keyword
            ];

            for (const pattern of patterns) {
                let match;
                while ((match = pattern.exec(aiResponseText)) !== null) {
                    let major = match[1].trim();
                    // Bersihkan dari sisa numbering atau karakter tidak penting di akhir
                    major = major.replace(/\s*:\s*$/, '').replace(/\s*-\s*$/, '').trim();
                    if (major.length > 3 && major.length < 70) { // Batasan panjang wajar
                        majors.add(major);
                    }
                }
            }
            console.log('🔍 Extracted majors:', Array.from(majors));
            return Array.from(majors).slice(0, 5); // Ambil maks 5
        }

        function showDirectMajorSelectionButtons(aiSummaryHtml, userAnswersContext) { // Terima userAnswers
            const majors = extractMajorsFromAIResponse(
            aiSummaryHtml); // Ekstrak dari HTML summary, mungkin perlu dari teks bersih
            if (majors.length === 0) {
                console.log('❌ No majors found in AI summary for direct selection.');
                return;
            }

            // Hapus section pilihan sebelumnya jika ada
            const existingSelection = document.getElementById('major-selection-section');
            if (existingSelection) existingSelection.remove();

            const majorSelectionDiv = document.createElement('div');
            majorSelectionDiv.id = 'major-selection-section';
            majorSelectionDiv.className =
                'mt-6 p-6 bg-gradient-to-r from-blue-50 to-purple-50 rounded-lg border-2 border-blue-300 shadow-lg';
            majorSelectionDiv.style.animation = 'fadeInUp 0.5s ease-out';

            let buttonsHtml = majors.map(major => `
            <button onclick="handleDirectMajorSelection('${major.replace(/'/g, "\\'")}', '${btoa(encodeURIComponent(aiSummaryHtml))}', '${btoa(encodeURIComponent(JSON.stringify(userAnswersContext)))}')"
                class="w-full p-4 mb-3 bg-white border-2 border-green-200 rounded-lg hover:border-green-500 hover:bg-green-50 transition-all duration-300 transform hover:scale-105 shadow-md hover:shadow-lg text-left">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="font-bold text-gray-800 text-lg">${major}</div>
                        <div class="text-sm text-gray-600">Klik untuk analisis & simulasi mendalam</div>
                    </div>
                    <div class="text-3xl">🎯</div>
                </div>
            </button>`).join('');

            majorSelectionDiv.innerHTML = `
            <div class="text-center">
                <div class="text-4xl mb-4">🎓</div>
                <h3 class="text-xl font-bold text-gray-800 mb-4">Pilih Jurusan untuk Analisis & Simulasi</h3>
                <p class="text-gray-600 mb-6">AI merekomendasikan beberapa jurusan. Pilih salah satu untuk eksplorasi lebih lanjut:</p>
                <div class="grid gap-3 max-w-2xl mx-auto">${buttonsHtml}</div>
                <div class="mt-6 text-sm text-gray-500">💡 Tip: Memilih jurusan akan membuka opsi simulasi interaktif.</div>
            </div>`;

            if (overallSummaryTextElement) { // Tambahkan setelah teks summary
                overallSummaryTextElement.insertAdjacentElement('afterend', majorSelectionDiv);
                majorSelectionDiv.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            } else if (overallSummaryContainer) { // Atau di dalam container summary jika teks tidak ada
                overallSummaryContainer.appendChild(majorSelectionDiv);
            }
            console.log('✅ Major selection buttons created and displayed');
        }
        // Fungsi global untuk onclick tombol pilihan jurusan
        window.handleDirectMajorSelection = function(selectedMajor, encodedAiSummary, encodedUserAnswers) {
            console.log('🎯 User selected major for simulation:', selectedMajor);
            // Sembunyikan tombol pilihan jurusan
            const majorSelectionSection = document.getElementById('major-selection-section');
            if (majorSelectionSection) majorSelectionSection.style.display = 'none'; // Sembunyikan, jangan remove dulu

            // Mulai simulasi (buka modal simulasi)
            startSimulation(selectedMajor, encodedAiSummary, encodedUserAnswers);
        }

        // ===== SIMULATION SYSTEM (Placeholder, perlu implementasi backend) =====
        let currentSimulationSession = null;
        let simulationData = null; // Untuk menyimpan data/state simulasi

        // Dipanggil dari tombol "Ya, saya ingin mencoba simulasi" atau handleDirectMajorSelection
        async function startSimulation(selectedMajor, encodedAiResponse, encodedUserAnswers) {
            const simulationModal = document.getElementById('simulation-modal');
            const simulationTitle = document.getElementById('simulation-title');
            const simulationContent = document.getElementById('simulation-content');
            const simulationProgress = document.getElementById('simulation-progress');

            if (!simulationModal || !simulationTitle || !simulationContent || !simulationProgress) {
                console.error("Elemen modal simulasi tidak ditemukan!");
                return;
            }

            simulationTitle.textContent = `🎯 Simulasi Interaktif: ${selectedMajor}`;
            simulationProgress.classList.add('hidden'); // Sembunyikan progress bar awal
            simulationModal.classList.remove('hidden');
            simulationContent.innerHTML =
                `<div style="text-align:center; padding:20px;"><div class="spinner"></div> Mempersiapkan simulasi untuk <strong>${selectedMajor}</strong>...</div>`;

            try {
                // Decode data yang mungkin di-encode URI componentnya
                const aiResponse = decodeURIComponent(atob(encodedAiResponse));
                const userAnswers = JSON.parse(decodeURIComponent(atob(encodedUserAnswers)));

                // Panggil API untuk memulai sesi simulasi di backend
                const response = await fetch('/simulation/start', { // Ganti dengan URL API Anda
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        selected_major: selectedMajor,
                        ai_summary_context: aiResponse, // Konteks dari summary AI sebelumnya
                        user_answers_context: userAnswers // Konteks dari jawaban pengguna
                    })
                });
                const data = await response.json();

                if (!response.ok) throw new Error(data.error || 'Gagal memulai sesi simulasi.');

                currentSimulationSession = data.session_id;
                simulationData = data; // Simpan data sesi awal (misal, pertanyaan pertama)

                console.log("Simulasi dimulai, sesi:", currentSimulationSession, "Data awal:", simulationData);
                // Tampilkan pertanyaan pertama atau langkah simulasi awal
                displaySimulationStep(simulationData.current_step);

            } catch (error) {
                console.error('Error starting simulation:', error);
                simulationContent.innerHTML =
                    `<div class="text-red-500 p-4 text-center">Gagal memulai simulasi: ${error.message}. Silakan coba lagi.</div>
            <div class="text-center mt-4"><button onclick="closeSimulation()" class="btn btn-secondary btn-sm">Tutup</button></div>`;
            }
        }

        function displaySimulationStep(stepData) {
            const simulationContent = document.getElementById('simulation-content');
            const simulationProgress = document.getElementById('simulation-progress');
            const progressBarSim = document.getElementById('progress-bar-sim');
            const progressTextSim = document.getElementById('progress-text-sim');

            if (!stepData) {
                simulationContent.innerHTML =
                    `<div class="p-4 text-center">Simulasi telah selesai atau terjadi kesalahan.</div>
            <div class="text-center mt-4"><button onclick="closeSimulation()" class="btn btn-secondary btn-sm">Tutup</button></div>`;
                simulationProgress.classList.add('hidden');
                return;
            }

            simulationProgress.classList.remove('hidden');
            const progressPercentage = stepData.total_steps > 0 ? (stepData.current_step_number / stepData.total_steps) *
                100 : 0;
            if (progressBarSim) progressBarSim.style.width = `${progressPercentage}%`;
            if (progressTextSim) progressTextSim.textContent =
                `${Math.round(progressPercentage)}% (Langkah ${stepData.current_step_number}/${stepData.total_steps})`;

            let optionsHtml = '';
            if (stepData.options && stepData.options.length > 0) {
                optionsHtml = stepData.options.map(opt =>
                    `<button onclick="submitSimulationAnswer('${opt.value}')" class="w-full text-left p-4 my-2 border border-gray-300 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition-colors">
                    ${opt.text}
                 </button>`
                ).join('');
            } else if (stepData.is_final_step) {
                optionsHtml =
                    `<div class="text-center mt-6"><button onclick="closeSimulation()" class="btn btn-success">Selesai Simulasi</button></div>`;
            }


            simulationContent.innerHTML = `
            <div class="mb-4 p-4 bg-gray-50 rounded-lg">
                <p class="text-sm text-gray-500 mb-1">Langkah ${stepData.current_step_number} dari ${stepData.total_steps}</p>
                <h4 class="text-lg font-semibold text-gray-800">${stepData.question_text || stepData.scenario_text || "Analisis..."}</h4>
                ${stepData.details ? `<p class="text-sm text-gray-600 mt-2">${stepData.details}</p>` : ''}
            </div>
            <div class="simulation-options">${optionsHtml}</div>
        `;
        }

        // Fungsi global untuk submit jawaban simulasi
        window.submitSimulationAnswer = async function(answerValue) {
            const simulationContent = document.getElementById('simulation-content');
            simulationContent.innerHTML =
                `<div style="text-align:center; padding:20px;"><div class="spinner"></div> Memproses jawaban Anda...</div>`;

            try {
                const response = await fetch('/simulation/submit-answer', { // Ganti dengan URL API Anda
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        session_id: currentSimulationSession,
                        answer: answerValue,
                        current_step_id: simulationData.current_step.id // Kirim ID langkah saat ini
                    })
                });
                const data = await response.json();
                if (!response.ok) throw new Error(data.error || 'Gagal mengirim jawaban simulasi.');

                simulationData = data; // Update data sesi dengan langkah berikutnya
                displaySimulationStep(simulationData.current_step);

            } catch (error) {
                console.error('Error submitting simulation answer:', error);
                simulationContent.innerHTML =
                    `<div class="text-red-500 p-4 text-center">Gagal memproses jawaban: ${error.message}.</div>
             <div class="text-center mt-4"><button onclick="displaySimulationStep(simulationData.current_step)" class="btn btn-secondary btn-sm">Coba Lagi</button> <button onclick="closeSimulation()" class="btn btn-outline btn-sm">Tutup</button></div>`;
            }
        }

        // Fungsi global untuk menutup modal simulasi
        window.closeSimulation = function() {
            const simulationModal = document.getElementById('simulation-modal');
            if (simulationModal) simulationModal.classList.add('hidden');
            currentSimulationSession = null;
            simulationData = null;
            // Kembalikan tampilan tombol pilihan jurusan jika sebelumnya disembunyikan
            const majorSelectionSection = document.getElementById('major-selection-section');
            if (majorSelectionSection) majorSelectionSection.style.display = 'block';
        }


        // Fungsi-fungsi untuk legacy console (jika masih mau dipertahankan)
        // Perlu disesuaikan untuk menggunakan ID legacy
        function processUserInputLegacy() {
            /* ... implementasi untuk legacy console ... */
            console.log("Legacy user input processed");
        }

        function hideLegacyQuestionConsole() {
            if (legacyQuestionConsole) legacyQuestionConsole.classList.add('hidden');
        }
    </script>
@endsection