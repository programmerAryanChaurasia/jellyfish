<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - @yield('title')</title>

        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #4f46e5;
            --primary-light: #818cf8;
            --primary-dark: #3730a3;
            --secondary-color: #10b981;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
            --dark-bg: #1f2937;
            --sidebar-bg: #111827;
            --sidebar-hover: #374151;
            --content-bg: #f9fafb;
            --card-bg: #ffffff;
            --border-color: #e5e7eb;
            --text-primary: #111827;
            --text-secondary: #6b7280;
            --text-light: #9ca3af;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --radius-sm: 0.375rem;
            --radius-md: 0.5rem;
            --radius-lg: 0.75rem;
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--content-bg);
            color: var(--text-primary);
            overflow-x: hidden;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-light);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-color);
        }

        /* Navbar Styles */
        .admin-navbar {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            padding: 0.75rem 1.5rem;
            box-shadow: var(--shadow-md);
            position: sticky;
            top: 0;
            z-index: 1030;
            transition: var(--transition);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: var(--transition);
        }

        .navbar-brand:hover {
            transform: translateY(-2px);
        }

        .navbar-brand i {
            font-size: 1.8rem;
            color: #fbbf24;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, var(--secondary-color) 0%, #059669 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 1rem;
            box-shadow: var(--shadow-sm);
        }

        .user-details {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-weight: 600;
            color: white;
            font-size: 0.95rem;
        }

        .user-role {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.8);
            background: rgba(255, 255, 255, 0.1);
            padding: 2px 8px;
            border-radius: 20px;
            display: inline-block;
            margin-top: 2px;
        }

        .btn-logout {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 0.4rem 1rem;
            border-radius: var(--radius-md);
            transition: var(--transition);
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .btn-logout:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-1px);
            box-shadow: var(--shadow-sm);
        }

        /* Sidebar Styles */
        .admin-sidebar {
            background: var(--sidebar-bg);
            min-height: calc(100vh - 70px);
            padding: 0;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1020;
            transition: var(--transition);
        }

        .sidebar-header {
            padding: 1.5rem 1rem 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 1rem;
        }

        .sidebar-title {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .nav-menu {
            list-style: none;
            padding: 0;
        }

        .nav-item {
            margin-bottom: 4px;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.7);
            padding: 0.85rem 1rem;
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            border-radius: var(--radius-md);
            transition: var(--transition);
            font-weight: 500;
            position: relative;
            overflow: hidden;
        }

        .nav-link i {
            font-size: 1.1rem;
            width: 24px;
            text-align: center;
            transition: var(--transition);
        }

        .nav-link:hover {
            color: white;
            background: var(--sidebar-hover);
            padding-left: 1.25rem;
        }

        .nav-link:hover i {
            transform: scale(1.1);
        }

        .nav-link.active {
            color: white;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            box-shadow: var(--shadow-md);
        }

        .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: white;
            border-radius: 0 4px 4px 0;
        }

        .badge-new {
            background: var(--secondary-color);
            color: white;
            font-size: 0.7rem;
            padding: 2px 8px;
            border-radius: 20px;
            margin-left: auto;
        }

        /* Main Content Area */
        .admin-content {
            padding: 2rem;
            min-height: calc(100vh - 70px);
            background-color: var(--content-bg);
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border-color);
        }

        .page-title h1 {
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.25rem;
            font-size: 1.8rem;
        }

        .page-subtitle {
            color: var(--text-secondary);
            font-size: 0.95rem;
        }

        .page-actions {
            display: flex;
            gap: 10px;
        }

        /* Cards */
        .admin-card {
            background: var(--card-bg);
            border-radius: var(--radius-lg);
            border: none;
            box-shadow: var(--shadow-md);
            transition: var(--transition);
            overflow: hidden;
            margin-bottom: 1.5rem;
        }

        .admin-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            border: none;
            padding: 1.25rem 1.5rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Buttons */
        .btn-admin {
            padding: 0.6rem 1.5rem;
            border-radius: var(--radius-md);
            font-weight: 600;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-admin-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            border: none;
            color: white;
        }

        .btn-admin-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            color: white;
        }

        .btn-admin-secondary {
            background: white;
            border: 1px solid var(--border-color);
            color: var(--text-primary);
        }

        .btn-admin-secondary:hover {
            background: var(--content-bg);
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .admin-sidebar {
                min-height: auto;
                height: auto;
            }

            .admin-content {
                padding: 1.5rem;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
        }

        @media (max-width: 768px) {
            .navbar-brand span {
                display: none;
            }

            .user-details {
                display: none;
            }

            .btn-logout span {
                display: none;
            }

            .admin-content {
                padding: 1rem;
            }
        }

        /* Animation for active menu */
        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .nav-link.active {
            animation: pulse 0.5s ease;
        }

        /* Statistics Cards */
        .stat-card {
            border-radius: var(--radius-lg);
            padding: 1.5rem;
            color: white;
            position: relative;
            overflow: hidden;
            min-height: 140px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 120px;
            height: 120px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .stat-card-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
        }

        .stat-card-success {
            background: linear-gradient(135deg, var(--secondary-color) 0%, #34d399 100%);
        }

        .stat-card-warning {
            background: linear-gradient(135deg, var(--warning-color) 0%, #fbbf24 100%);
        }

        .stat-card-danger {
            background: linear-gradient(135deg, var(--danger-color) 0%, #f87171 100%);
        }

        .stat-icon {
            position: absolute;
            top: 1rem;
            right: 1rem;
            font-size: 2.5rem;
            opacity: 0.3;
        }

        .stat-value {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            font-size: 0.95rem;
            opacity: 0.9;
        }

        /* Toggle Switch */
        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 26px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .toggle-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 34px;
        }

        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked+.toggle-slider {
            background-color: var(--primary-color);
        }

        input:checked+.toggle-slider:before {
            transform: translateX(24px);
        }

        /* Footer */
        .admin-footer {
            background: var(--dark-bg);
            color: white;
            padding: 1rem;
            text-align: center;
            margin-top: auto;
        }

        .footer-text {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
        }
    </style>

    @stack('styles')
</head>

<body>
    <!-- Navigation -->
    <nav class="admin-navbar">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <!-- Brand -->
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-crown"></i>
                <span>AdminHub</span>
            </a>

            <!-- User Info & Logout -->
            <div class="user-info">
                <div class="user-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="user-details">
                    <span class="user-name">{{ Auth::user()->name }}</span>
                    <span class="user-role">{{ ucfirst(Auth::user()->role) }}</span>
                </div>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 admin-sidebar">
                <div class="sidebar-header">
                    <div class="sidebar-title">Navigation</div>
                </div>

                <ul class="nav-menu">
                    <!-- Dashboard -->
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}"
                            class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <!-- Role Management (Admin Only) -->
                    @if(Auth::user()->role === 'admin')
                    <li class="nav-item">
                        <a href="{{ route('admin.roles.index') }}"
                            class="nav-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                            <i class="fas fa-user-shield"></i>
                            <span>Role Management</span>
                            <span class="badge-new">Admin</span>
                        </a>
                    </li>
                    @endif

                    <!-- Home Page Management (Admin & Editor) -->
                    @if(in_array(Auth::user()->role, ['admin', 'editor']))
                    <li class="nav-item">
                        <a href="{{ route('admin.home.manage') }}"
                            class="nav-link {{ request()->routeIs('admin.home.manage') ? 'active' : '' }}">
                            <i class="fas fa-home"></i>
                            <span>Home Page Management</span>
                            @if(Auth::user()->role === 'editor')
                            <span class="badge-new">Editor</span>
                            @endif
                        </a>
                    </li>
                    @endif

                    <!-- Additional Menu Items (Example) -->
                    
                </ul>

                <!-- Sidebar Footer -->
                <div class="sidebar-footer position-absolute bottom-0 start-0 end-0 p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <small class="text-muted">Status</small>
                            <div class="form-check form-switch">
                                <input class="form-check-input toggle-switch" type="checkbox" id="adminStatus" checked>
                                <label class="form-check-label text-white ms-2" for="adminStatus" style="font-size: 0.85rem;">
                                    Active
                                </label>
                            </div>
                        </div>
                        <div class="text-end">
                            <small class="text-muted d-block">v1.0.0</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 admin-content">
                <!-- Page Header -->


                <!-- Flash Messages -->
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <!-- Main Content -->
                <div class="main-content">
                    @yield('content')
                </div>

                <!-- Footer -->
                <!-- <footer class="admin-footer mt-4 rounded-lg">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="footer-text">
                                &copy; {{ date('Y') }} AdminHub. All rights reserved.
                            </span>
                        </div>
                        <div>
                            <span class="footer-text">
                                <i class="fas fa-server me-1"></i>
                                Server: {{ request()->server('SERVER_SOFTWARE') }}
                            </span>
                        </div>
                    </div>
                </footer> -->
                <footer class="admin-footer fixed-bottom text-light py-3" style="background-color: #111827;">
                    <div class="container-fluid d-flex justify-content-between align-items-center">
                        <div>
                            <small>&copy; {{ date('Y') }} AdminHub. All rights reserved.</small>
                        </div>
                        <div>
                            <small>
                                <i class="fas fa-server me-1"></i>
                                Server: {{ request()->server('SERVER_SOFTWARE') }}
                            </small>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <!-- Custom JavaScript -->
    <script>
        // Sidebar active link animation
        document.addEventListener('DOMContentLoaded', function() {
            const activeLinks = document.querySelectorAll('.nav-link.active');
            activeLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    if (this.classList.contains('active')) {
                        e.preventDefault();
                    }
                });
            });

            // Toggle switch functionality
            const toggleSwitch = document.getElementById('adminStatus');
            if (toggleSwitch) {
                toggleSwitch.addEventListener('change', function() {
                    const statusText = this.nextElementSibling;
                    if (this.checked) {
                        statusText.textContent = 'Active';
                        showToast('Status changed to Active', 'success');
                    } else {
                        statusText.textContent = 'Inactive';
                        showToast('Status changed to Inactive', 'warning');
                    }
                });
            }

            // Auto-dismiss alerts after 5 seconds
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });

            // Add smooth scrolling to anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Toast notification function
            function showToast(message, type = 'info') {
                // You can integrate a toast library here
                console.log(`${type.toUpperCase()}: ${message}`);
            }

            // Update current time in footer (optional)
            function updateTime() {
                const now = new Date();
                const timeString = now.toLocaleTimeString([], {
                    hour: '2-digit',
                    minute: '2-digit'
                });
                const timeElement = document.getElementById('current-time');
                if (timeElement) {
                    timeElement.textContent = timeString;
                }
            }

            // Update time every minute
            setInterval(updateTime, 60000);
            updateTime(); // Initial call
        });

        // Add active class to clicked nav items
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function() {
                document.querySelectorAll('.nav-link').forEach(item => {
                    item.classList.remove('active');
                });
                this.classList.add('active');
            });
        });
    </script>

    @stack('scripts')
</body>

</html>