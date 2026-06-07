<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Web Absensi')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            background-color: #f8fafc;
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* Sidebar Custom CSS */
        .sidebar {
            width: 260px;
            background-color: #0f172a;
            color: white;
            display: flex;
            flex-direction: column;
            padding: 0;
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.05);
            z-index: 1000;
        }

        .sidebar-header {
            padding: 2rem 1.5rem;
            font-size: 1.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            margin-bottom: 1rem;
            letter-spacing: -0.025em;
        }

        .nav-item {
            padding: 0.875rem 1.5rem;
            color: #94a3b8;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .nav-item:hover {
            background-color: #1e293b;
            color: #f1f5f9;
            padding-left: 1.75rem;
        }

        .nav-item.active {
            background-color: #1e293b;
            color: #3b82f6;
            border-right: 4px solid #3b82f6;
        }

        .logout-form {
            margin-top: auto;
            border-top: 1px solid #1e293b;
            padding: 1.5rem;
        }

        .logout-btn {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #ef4444;
            cursor: pointer;
            font-size: 0.875rem;
            font-weight: 600;
            padding: 0.75rem;
            width: 100%;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .logout-btn:hover {
            background-color: #ef4444;
            color: white;
        }

        /* Main Content Wrapper */
        .main-content {
            flex: 1;
            padding: 2.5rem;
            overflow-y: auto;
            background-color: #f8fafc;
        }

        /* Override Bootstrap Card for Premium Look */
        .card {
            background: white;
            padding: 1.5rem;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        /* Buttons Styling - Consistent Transparent/Outline Look */
        .btn {
            padding: 0.6rem 1.25rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.875rem;
            transition: all 0.25s ease;
            text-transform: none;
            letter-spacing: 0.01em;
        }

        .btn-primary {
            background-color: rgba(59, 130, 246, 0.1);
            border: 1px solid rgba(59, 130, 246, 0.3);
            color: #2563eb;
        }

        .btn-primary:hover {
            background-color: #2563eb;
            color: white;
            border-color: #2563eb;
            transform: translateY(-1px);
        }

        .btn-success {
            background-color: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #059669;
        }

        .btn-success:hover {
            background-color: #059669;
            color: white;
            border-color: #059669;
            transform: translateY(-1px);
        }

        .btn-warning {
            background-color: rgba(245, 158, 11, 0.1);
            border: 1px solid rgba(245, 158, 11, 0.3);
            color: #d97706;
        }

        .btn-warning:hover {
            background-color: #d97706;
            color: #ffffff;
            border-color: #d97706;
            transform: translateY(-1px);
        }

        .btn-danger {
            background-color: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #dc2626;
        }

        .btn-danger:hover {
            background-color: #dc2626;
            color: white;
            border-color: #dc2626;
            transform: translateY(-1px);
        }

        .btn-outline-dark {
            background-color: rgba(71, 85, 105, 0.05);
            border: 1px solid rgba(71, 85, 105, 0.2);
            color: #475569;
        }

        .btn-outline-dark:hover {
            background-color: #475569;
            color: white;
            transform: translateY(-1px);
        }

        input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
            outline: none;
        }

        /* Table Styling */
        .table {
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }

        .table th {
            background-color: #f1f5f9;
            color: #475569;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            padding: 1rem;
        }

        .table td {
            padding: 1rem;
            vertical-align: middle;
        }

        /* Toast Notification Styling */
        #toast-container {
            position: fixed;
            top: 24px;
            right: 24px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 12px;
            max-width: 380px;
            width: calc(100% - 48px);
        }

        .toast-custom {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(8px);
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08), 0 4px 12px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(226, 232, 240, 0.8);
            padding: 16px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            transform: translateX(120%);
            opacity: 0;
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            position: relative;
            overflow: hidden;
        }

        .toast-custom.show {
            transform: translateX(0);
            opacity: 1;
        }

        .toast-custom.hide {
            transform: translateX(120%);
            opacity: 0;
            transition: all 0.3s ease-in-out;
        }

        .toast-content-wrapper {
            display: flex;
            align-items: center;
            gap: 12px;
            flex: 1;
        }

        .toast-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .toast-message {
            font-size: 0.875rem;
            font-weight: 500;
            color: #1e293b;
            line-height: 1.4;
        }

        .toast-close {
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            transition: all 0.2s;
            font-size: 1.1rem;
            line-height: 1;
        }

        .toast-close:hover {
            background-color: #f1f5f9;
            color: #475569;
        }

        /* Progress Bar */
        .toast-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            width: 100%;
            transform-origin: left;
            transform: scaleX(1);
        }

        /* Toast Colors */
        .toast-success {
            border-left: 4px solid #10b981;
        }

        .toast-success .toast-progress {
            background: linear-gradient(to right, #10b981, #34d399);
        }

        .toast-error {
            border-left: 4px solid #ef4444;
        }

        .toast-error .toast-progress {
            background: linear-gradient(to right, #ef4444, #f87171);
        }

        .toast-warning {
            border-left: 4px solid #f59e0b;
        }

        .toast-warning .toast-progress {
            background: linear-gradient(to right, #f59e0b, #fbbf24);
        }

        .toast-info {
            border-left: 4px solid #3b82f6;
        }

        .toast-info .toast-progress {
            background: linear-gradient(to right, #3b82f6, #60a5fa);
        }

        /* Confirm Modal Styling */
        .confirm-modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(15, 23, 42, 0.4);
            backdrop-filter: blur(4px);
            z-index: 10000;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s ease-in-out;
        }

        .confirm-modal-backdrop.show {
            opacity: 1;
            pointer-events: auto;
        }

        .confirm-modal-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            max-width: 420px;
            width: calc(100% - 32px);
            padding: 32px 24px;
            text-align: center;
            transform: scale(0.9);
            transition: transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .confirm-modal-backdrop.show .confirm-modal-card {
            transform: scale(1);
        }

        .confirm-modal-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background-color: #fee2e2;
            color: #ef4444;
            margin-bottom: 18px;
        }

        .confirm-modal-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 8px;
            letter-spacing: -0.01em;
        }

        .confirm-modal-message {
            font-size: 0.925rem;
            color: #64748b;
            margin-bottom: 28px;
            line-height: 1.5;
            padding: 0 8px;
        }

        .confirm-modal-actions {
            display: flex;
            gap: 12px;
            justify-content: center;
        }

        .confirm-modal-btn {
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.875rem;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            flex: 1;
        }

        .confirm-modal-btn.btn-cancel {
            background-color: #f1f5f9;
            color: #475569;
            border: 1px solid #e2e8f0;
        }

        .confirm-modal-btn.btn-cancel:hover {
            background-color: #e2e8f0;
            color: #1e293b;
        }

        .confirm-modal-btn.btn-confirm {
            background-color: #ef4444;
            color: white;
            box-shadow: 0 4px 6px -1px rgba(239, 68, 68, 0.15);
        }

        .confirm-modal-btn.btn-confirm:hover {
            background-color: #dc2626;
            transform: translateY(-1px);
            box-shadow: 0 6px 12px -1px rgba(239, 68, 68, 0.25);
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <div class="sidebar-header">
            Web Absensi
        </div>

        <a href="{{ route('dashboard') }}" class="nav-item">Dashboard</a>
        <a href="{{ route('kelas.index') }}" class="nav-item">Daftar Kelas</a>
        <a href="{{ route('mahasiswa.index') }}" class="nav-item">Data Mahasiswa</a>

        <form method="POST" action="{{ route('logout') }}" class="logout-form">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>

    <div class="main-content">
        @yield('content')
    </div>

    <div id="toast-container"></div>

    <div id="confirm-modal-backdrop" class="confirm-modal-backdrop">
        <div class="confirm-modal-card">
            <div class="confirm-modal-icon">
                <svg width="28" height="28" viewBox="0 0 20 20" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10 13.5V10.5M10 6.5H10.01M10 18C14.4183 18 18 14.4183 18 10C18 5.58172 14.4183 2 10 2C5.58172 2 2 5.58172 2 10C2 14.4183 5.58172 18 10 18Z"
                        stroke="#EF4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
            <h3 class="confirm-modal-title">Konfirmasi Tindakan</h3>
            <p id="confirm-modal-message" class="confirm-modal-message">Apakah Anda yakin?</p>
            <div class="confirm-modal-actions">
                <button id="confirm-modal-cancel" class="confirm-modal-btn btn-cancel">Batal</button>
                <button id="confirm-modal-ok" class="confirm-modal-btn btn-confirm">Hapus</button>
            </div>
        </div>
    </div>

    <script>
        function showToast(message, type = 'success', duration = 4000) {
            const container = document.getElementById('toast-container');
            if (!container) return;

            // Create toast elements
            const toast = document.createElement('div');
            toast.className = `toast-custom toast-${type}`;

            // Select SVG icon based on type
            let icon = '';
            if (type === 'success') {
                icon = `<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="10" cy="10" r="10" fill="#DEF7EC" />
            <path d="M14 7.5L8.5 13L6 10.5" stroke="#0E9F6E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>`;
            } else if (type === 'error') {
                icon = `<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="10" cy="10" r="10" fill="#FDE8E8" />
            <path d="M12.5 7.5L7.5 12.5M7.5 7.5L12.5 12.5" stroke="#E02424" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>`;
            } else if (type === 'warning') {
                icon = `<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="10" cy="10" r="10" fill="#FEF3C7" />
            <path d="M10 6.5V10.5M10 13.5H10.01" stroke="#D97706" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>`;
            } else {
                icon = `<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="10" cy="10" r="10" fill="#EBF5FF" />
            <path d="M10 13.5V9.5M10 6.5H10.01" stroke="#1C64F2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>`;
            }

            toast.innerHTML = `
        <div class="toast-content-wrapper">
            <span class="toast-icon">${icon}</span>
            <div class="toast-message">${message}</div>
        </div>
        <button class="toast-close" aria-label="Close">&times;</button>
        <div class="toast-progress"></div>
    `;

            container.appendChild(toast);

            // Trigger reflow/animation
            setTimeout(() => {
                toast.classList.add('show');
            }, 10);

            // Progress bar animation
            const progressBar = toast.querySelector('.toast-progress');
            progressBar.style.transition = `transform ${duration}ms linear`;
            progressBar.style.transform = 'scaleX(0)';

            // Auto hide
            const autoHideTimeout = setTimeout(() => {
                dismissToast(toast);
            }, duration);

            // Close button click
            const closeBtn = toast.querySelector('.toast-close');
            closeBtn.addEventListener('click', () => {
                clearTimeout(autoHideTimeout);
                dismissToast(toast);
            });
        }

        function dismissToast(toast) {
            toast.classList.add('hide');
            toast.addEventListener('transitionend', () => {
                toast.remove();
            });
        }

        let confirmCallback = null;

        function showConfirmModal(message, callback) {
            const backdrop = document.getElementById('confirm-modal-backdrop');
            const messageEl = document.getElementById('confirm-modal-message');

            if (!backdrop || !messageEl) return;

            messageEl.textContent = message;
            confirmCallback = callback;

            backdrop.classList.add('show');
        }

        function hideConfirmModal() {
            const backdrop = document.getElementById('confirm-modal-backdrop');
            if (backdrop) {
                backdrop.classList.remove('show');
            }
            confirmCallback = null;
        }

        document.addEventListener('DOMContentLoaded', function() {
            // 1. Existing Toast notifications
            @if (session('success'))
                showToast({!! json_encode(session('success')) !!}, 'success');
            @endif
            @if (session('error'))
                showToast({!! json_encode(session('error')) !!}, 'error');
            @endif
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    showToast({!! json_encode($error) !!}, 'error');
                @endforeach
            @endif

            // 2. Custom Confirm Modal Setup
            const cancelBtn = document.getElementById('confirm-modal-cancel');
            const okBtn = document.getElementById('confirm-modal-ok');

            if (cancelBtn) {
                cancelBtn.addEventListener('click', hideConfirmModal);
            }

            if (okBtn) {
                okBtn.addEventListener('click', function() {
                    if (confirmCallback) {
                        confirmCallback();
                    }
                    hideConfirmModal();
                });
            }

            // Close modal on clicking backdrop
            const backdrop = document.getElementById('confirm-modal-backdrop');
            if (backdrop) {
                backdrop.addEventListener('click', function(e) {
                    if (e.target === backdrop) {
                        hideConfirmModal();
                    }
                });
            }

            // Intercept default confirm() on forms
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                const onsubmitAttr = form.getAttribute('onsubmit');
                if (onsubmitAttr && onsubmitAttr.includes('confirm(')) {
                    const match = onsubmitAttr.match(/confirm\(['"](.+?)['"]\)/);
                    if (match && match[1]) {
                        form.setAttribute('data-confirm-msg', match[1]);
                        form.removeAttribute('onsubmit');
                    }
                }
            });

            document.addEventListener('submit', function(e) {
                const form = e.target;
                const confirmMsg = form.getAttribute('data-confirm-msg');
                if (confirmMsg) {
                    if (!form.classList.contains('js-confirmed')) {
                        e.preventDefault(); // Stop the form submission
                        showConfirmModal(confirmMsg, () => {
                            form.classList.add('js-confirmed');
                            form.submit(); // submit the form programmatically
                        });
                    }
                }
            });
        });
    </script>

</body>

</html>
