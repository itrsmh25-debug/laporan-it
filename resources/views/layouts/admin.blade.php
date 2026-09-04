<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'IT CORE - HOSPITAL')</title>

    <link rel="icon" type="image/png" href="{{ asset('image/logoit.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <style>
        :root {
            --bg-body: #f5f5f9;
            --sidebar-bg: #ffffff;
            --primary-color: #696cff;
            --primary-light: #e7e7ff;
            --text-main: #566a7f;
            --text-heading: #435971;
            --input-bg: #f5f5f9;
        }

        body {
            background-color: var(--bg-body);
            font-family: 'Public Sans', sans-serif;
            color: var(--text-main);
            overflow-x: hidden;
        }

        /* --- SIDEBAR --- */
        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: var(--sidebar-bg);
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.05);
            z-index: 1050;
            transition: all 0.3s ease;
            overflow-y: auto;
        }

        .sidebar-brand {
            padding: 1.5rem;
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary-color);
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 1px solid #f2f2f4;
        }

        .sidebar-menu {
            list-style: none;
            padding: 1rem 0.75rem;
            margin: 0;
        }

        .sidebar-menu .menu-header {
            font-size: 0.75rem;
            color: #a1acb8;
            text-transform: uppercase;
            font-weight: 600;
            margin: 1rem 0 0.5rem 1rem;
        }

        /* Styling Dasar Link Sidebar agar Elegan */
        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 0.75rem 1rem;
            color: var(--text-main);
            text-decoration: none;
            border-radius: 0.375rem;
            margin-bottom: 0.25rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .sidebar-menu a:hover {
            background-color: #f3f4f6;
            color: #1f2937;
        }

        /* --- STYLE MENU UTAMA (PARENT) DENGAN GARIS KIRI & BERSIH --- */
        .sidebar-menu>li.has-sub {
            position: relative;
        }

        .sidebar-menu>li.has-sub.open>a {
            background-color: transparent !important;
            color: var(--primary-color) !important;
            font-weight: 600;
        }

        /* Aksen garis vertikal kiri yang profesional pada induk menu yang terbuka */
        .sidebar-menu>li.has-sub.open::before {
            content: '';
            position: absolute;
            left: 0;
            top: 6px;
            bottom: 6px;
            width: 4px;
            background-color: var(--primary-color);
            border-radius: 0 4px 4px 0;
        }

        /* --- STYLE MENU ANAK (SUBMENU) --- */
        .sidebar-menu .sub-menu {
            list-style: none;
            padding-left: 1.5rem;
            margin: 4px 0;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-in-out;
        }

        .sidebar-menu .has-sub.open>.sub-menu {
            max-height: 500px;
        }

        /* Tampilan Lembut Khusus Submenu yang Sedang Aktif */
        .sidebar-menu .sub-menu li.active>a {
            background-color: var(--primary-light) !important;
            color: var(--primary-color) !important;
            font-weight: 600;
            box-shadow: inset 0 1px 2px rgba(105, 108, 255, 0.05);
        }

        /* Rotasi panah otomatis saat dropdown terbuka */
        .sidebar-menu .has-sub .menu-toggle .bx-chevron-down {
            transition: transform 0.3s ease;
        }

        .sidebar-menu .has-sub.open>.menu-toggle .bx-chevron-down {
            transform: rotate(180deg);
        }

        /* --- MAIN CONTENT --- */
        .main-content {
            margin-left: 260px;
            padding: 2rem;
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        .navbar-custom {
            background: #ffffff;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 2px 6px 0 rgba(67, 89, 113, 0.12);
            margin-bottom: 2rem;
        }

        .card-custom {
            background: #ffffff;
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 2px 6px 0 rgba(67, 89, 113, 0.12);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .icon-box {
            width: 48px;
            height: 48px;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .badge-success {
            background-color: #e8fadf;
            color: #71dd37;
        }

        .badge-warning {
            background-color: #fff2e2;
            color: #ffab00;
        }

        .badge-danger {
            background-color: #ffe5e5;
            color: #ff3e1d;
        }

        /* --- FORM STYLE --- */
        .form-group-custom {
            margin-bottom: 1.25rem;
        }

        .form-group-custom label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #697a8d;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .form-custom-input {
            background-color: var(--input-bg) !important;
            border: 1px solid transparent !important;
            border-radius: 8px !important;
            padding: 0.65rem 1rem;
            color: var(--text-heading);
        }

        .form-custom-input:focus {
            background-color: #fff !important;
            border-color: var(--primary-color) !important;
            box-shadow: 0 0 0 0.2rem rgba(105, 108, 255, 0.15) !important;
        }

        .dropdown-item:hover {
            background-color: var(--primary-light);
            color: var(--primary-color) !important;
        }

        @media (max-width: 992px) {
            .sidebar {
                left: -260px;
            }

            .main-content {
                margin-left: 0;
                padding: 1rem;
            }

            .sidebar.mobile-open {
                left: 0;
            }

            .sidebar-overlay {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.4);
                z-index: 1040;
                display: none;
            }

            .sidebar-overlay.show {
                display: block;
            }
        }

        /* Responsif untuk Mobile */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: -260px;
                top: 0;
                width: 260px;
                height: 100%;
                background: #ffffff;
                transition: left 0.3s ease;
                z-index: 1050;
                box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            }

            body.sidebar-show .sidebar {
                left: 0;
            }
        }
    </style>
    @stack('styles')
</head>

<body>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <i class='bx bx-pulse fs-3'></i> <span>SIMITRA</span>
        </div>

        <ul class="sidebar-menu">
            <!-- Dashboard Utama -->
            <li class="{{ Request::is('/') ? 'active' : '' }}">
                <a href="/"><i class='bx bx-home-circle fs-4'></i> <span>Dashboard</span></a>
            </li>

            <!-- OPERASIONAL -->
            <li
                class="has-sub {{ Request::is('laporan*', 'laporan-handover*', 'laporan-kerusakan*', 'laporan-downtime*', 'form-permintaan*', 'hak-akses*') ? 'active open' : '' }}">
                <a href="#" class="menu-toggle"><i class='bx bx-layer fs-4'></i> <span>Operasional</span> <i
                        class='bx bx-chevron-down ms-auto'></i></a>
                <ul class="sub-menu">
                    <li class="{{ Request::is('laporan') ? 'active' : '' }}">
                        <a href="/laporan"><i class='bx bx-list-ul'></i> Log Laporan</a>
                    </li>
                    <li class="{{ Request::is('laporan-handover*') ? 'active' : '' }}">
                        <a href="/laporan-handover"><i class='bx bx-transfer-alt'></i> Operan Shift</a>
                    </li>
                    <li class="{{ Request::is('laporan-kerusakan*') ? 'active' : '' }}">
                        <a href="/laporan-kerusakan"><i class='bx bx-wrench'></i> Kerusakan Aset</a>
                    </li>
                    <li class="{{ Request::is('laporan-downtime*') ? 'active' : '' }}">
                        <a href="{{ route('laporan-downtime.index') }}"><i class='bx bx-time-five'></i> Laporan
                            Downtime</a>
                    </li>
                    <li class="{{ Request::is('form-permintaan*') ? 'active' : '' }}">
                        <a href="/form-permintaan-index"><i class='bx bx-git-pull-request'></i> Permintaan IT</a>
                    </li>
                    <li class="{{ Request::is('hak-akses*') ? 'active' : '' }}">
                        <a href="{{ route('hak-akses.index') }}"><i class='bx bx-id-card'></i> Permintaan Hak Akses</a>
                    </li>
                </ul>
            </li>

            <!-- INVENTARIS -->
            <li class="has-sub {{ Request::is('asset*', 'master-mapping*') ? 'active open' : '' }}">
                <a href="#" class="menu-toggle"><i class='bx bx-server fs-4'></i> <span>Inventaris</span> <i
                        class='bx bx-chevron-down ms-auto'></i></a>
                <ul class="sub-menu">
                    <li class="{{ Request::is('asset*') ? 'active' : '' }}">
                        <a href="/asset"><i class='bx bx-server'></i> Kelola Aset</a>
                    </li>
                    <li class="{{ Request::is('master-mapping*') ? 'active' : '' }}">
                        <a href="/master-mapping"><i class='bx bx-cog'></i> Konfigurasi</a>
                    </li>
                </ul>
            </li>

            <!-- ANALITIK & SDM -->
            <li class="has-sub {{ Request::is('laporan-kpi', 'laporan-bulanan', 'schedules*') ? 'active open' : '' }}">
                <a href="#" class="menu-toggle"><i class='bx bx-line-chart fs-4'></i> <span>Analitik & SDM</span>
                    <i class='bx bx-chevron-down ms-auto'></i></a>
                <ul class="sub-menu">
                    <li class="{{ Request::is('laporan-kpi') ? 'active' : '' }}">
                        <a href="/laporan-kpi"><i class='bx bx-line-chart'></i> KPI Kinerja</a>
                    </li>
                    <li class="{{ Request::is('laporan-bulanan') ? 'active' : '' }}">
                        <a href="/laporan-bulanan"><i class='bx bx-printer'></i> Cetak Laporan</a>
                    </li>
                    <li class="{{ Request::is('schedules*') ? 'active' : '' }}">
                        <a href="/schedules"><i class='bx bx-calendar'></i> Jadwal Dinas</a>
                    </li>
                </ul>
            </li>

            <!-- ADMINISTRASI -->
            <li class="has-sub {{ Request::is('users*') ? 'active open' : '' }}">
                <a href="#" class="menu-toggle"><i class='bx bx-user-pin fs-4'></i> <span>Administrasi</span> <i
                        class='bx bx-chevron-down ms-auto'></i></a>
                <ul class="sub-menu">
                    <li class="{{ Request::is('users*') ? 'active' : '' }}">
                        <a href="/users"><i class='bx bx-user-plus'></i> Manajemen User</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>

    <div class="main-content">
        <div class="navbar-custom d-flex justify-content-between align-items-center">
            <button class="btn d-lg-none p-0 text-dark" id="menuToggle"><i class='bx bx-menu fs-2'></i></button>
            <h5 class="m-0 d-none d-sm-block fw-bold" style="color: var(--text-heading);">IT Workspace</h5>

            <div class="dropdown">
                <div class="d-flex align-items-center gap-3" id="userProfileDropdown" data-bs-toggle="dropdown"
                    aria-expanded="false" style="cursor: pointer;">
                    <span class="text-end d-none d-md-block">
                        <small class="d-block fw-bold">IT Staff</small>
                        <small class="text-muted">IT RS MITRA HUSADA</small>
                    </span>
                    <img src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&w=80&h=80"
                        alt="Avatar" class="rounded-circle" width="40" height="40">
                </div>
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm mt-2"
                    style="border-radius: 8px; min-width: 180px;">
                    <li><a class="dropdown-item py-2" href="#"><i class='bx bx-user me-2'></i> Profil Saya</a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item py-2 text-danger" href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class='bx bx-log-out me-2'></i> Logout
                        </a>
                        <form id="logout-form" action="/logout" method="POST" class="d-none">@csrf</form>
                    </li>
                </ul>
            </div>
        </div>

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mobile Sidebar Logic
        document.getElementById('menuToggle').addEventListener('click', () => {
            document.getElementById('sidebar').classList.add('mobile-open');
            document.getElementById('sidebarOverlay').classList.add('show');
        });
        document.getElementById('sidebarOverlay').addEventListener('click', () => {
            document.getElementById('sidebar').classList.remove('mobile-open');
            document.getElementById('sidebarOverlay').classList.remove('show');
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // 1. Otomatis Handle Semua Tombol Hapus Global
            document.addEventListener('click', function(e) {
                // Mencari apakah yang diklik memiliki class .btn-delete-global
                const button = e.target.closest('.btn-delete-global');

                if (button) {
                    e.preventDefault();
                    const formId = button.getAttribute('data-form-id');
                    const customMessage = button.getAttribute('data-message') ||
                        "Data ini akan dihapus permanen!";

                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: customMessage,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#696cff', // Warna utama tema kamu
                        cancelButtonColor: '#8592a3',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal',
                        customClass: {
                            confirmButton: 'btn btn-primary me-2',
                            cancelButton: 'btn btn-outline-secondary'
                        },
                        buttonsStyling: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Submit form berdasarkan ID yang dikirim lewat atribut data-form-id
                            document.getElementById(formId).submit();
                        }
                    });
                }
            });

            // 2. Otomatis Handle Alert Sukses (Session Laravel) di Semua Menu
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 2000
                });
            @endif
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Dropdown Toggle
            const menuToggles = document.querySelectorAll(".sidebar-menu .menu-toggle");

            menuToggles.forEach(function(toggle) {
                toggle.addEventListener("click", function(e) {
                    e.preventDefault();
                    const parentLi = this.parentElement;

                    // Opsional: Tutup menu lain jika ingin mode accordion eksklusif
                    // document.querySelectorAll(".sidebar-menu .has-sub").forEach(item => {
                    //     if (item !== parentLi) item.classList.remove("open");
                    // });

                    parentLi.classList.toggle("open");
                });
            });

            // Toggle Sidebar untuk layar Mobile (Pastikan Anda punya tombol dengan id="sidebarToggle")
            const sidebarToggler = document.getElementById("sidebarToggle");
            if (sidebarToggler) {
                sidebarToggler.addEventListener("click", function() {
                    document.body.classList.toggle("sidebar-show");
                });
            }
        });
    </script>
    @stack('scripts')
</body>

</html>
