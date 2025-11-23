{{-- resources/views/admin/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="id" class="h-full scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') — Art Devata</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4361ee',
                        secondary: '#3f37c9',
                        accent: '#4895ef',
                        danger: '#f72585',
                        success: '#4cc9f0',
                        warning: '#ffc107',
                        info: '#17a2b8',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    
    <!-- Custom Style -->
    <style>
        .sidebar-hover:hover { 
            @apply bg-gradient-to-r from-primary/10 to-secondary/10 text-primary transform translate-x-1;
        }
        .sidebar-active { 
            @apply bg-gradient-to-r from-primary to-secondary text-white shadow-2xl font-bold;
        }
        .card-hover:hover { 
            @apply shadow-2xl transform -translate-y-2 transition-all duration-300;
        }
        .badge-pulse {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
    </style>
</head>
<body class="h-full bg-gray-50 text-gray-800 font-sans">

    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        <div id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-2xl transform -translate-x-full lg:translate-x-0 lg:static lg:inset-0 transition-transform duration-300 ease-in-out">
            <div class="flex items-center justify-between p-6 border-b border-gray-200">
                <h1 class="text-3xl font-black bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">
                    ART DEVATA
                </h1>
                <button id="close-sidebar" class="lg:hidden text-gray-500 hover:text-primary text-2xl">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <nav class="mt-8 px-4">
                <a href="/admin" class="flex items-center px-6 py-4 text-gray-700 sidebar-hover sidebar-active rounded-l-full mr-4 {{ request()->is('admin') || request()->is('admin/dashboard') ? 'sidebar-active' : '' }}">
                    <i class="fas fa-tachometer-alt mr-4 text-xl"></i> 
                    <span class="font-semibold">Dashboard</span>
                </a>
                <a href="/admin/settings" class="flex items-center px-6 py-4 text-gray-700 sidebar-hover rounded-l-full mr-4 {{ request()->is('admin/settings*') ? 'sidebar-active' : '' }}">
                    <i class="fas fa-cog mr-4 text-xl"></i> 
                    <span class="font-semibold">Pengaturan</span>
                </a>
                <a href="/admin/packages" class="flex items-center px-6 py-4 text-gray-700 sidebar-hover rounded-l-full mr-4 {{ request()->is('admin/packages*') ? 'sidebar-active' : '' }}">
                    <i class="fas fa-suitcase-rolling mr-4 text-xl"></i> 
                    <span class="font-semibold">Paket Wisata</span>
                </a>
                <a href="/admin/events" class="flex items-center px-6 py-4 text-gray-700 sidebar-hover rounded-l-full mr-4 {{ request()->is('admin/events*') ? 'sidebar-active' : '' }}">
                    <i class="fas fa-calendar-alt mr-4 text-xl"></i> 
                    <span class="font-semibold">Event</span>
                </a>
                <a href="/admin/gallery" class="flex items-center px-6 py-4 text-gray-700 sidebar-hover rounded-l-full mr-4 {{ request()->is('admin/gallery*') ? 'sidebar-active' : '' }}">
                    <i class="fas fa-images mr-4 text-xl"></i> 
                    <span class="font-semibold">Galeri</span>
                </a>
                <a href="/admin/testimonials" class="flex items-center px-6 py-4 text-gray-700 sidebar-hover rounded-l-full mr-4 {{ request()->is('admin/testimonials*') ? 'sidebar-active' : '' }}">
                    <i class="fas fa-comment-dots mr-4 text-xl"></i> 
                    <span class="font-semibold">Testimoni</span>
                </a>
                <a href="/admin/orders" class="flex items-center justify-between px-6 py-4 text-gray-700 sidebar-hover rounded-l-full mr-4 {{ request()->is('admin/orders*') ? 'sidebar-active' : '' }}">
                    <div class="flex items-center">
                        <i class="fas fa-shopping-cart mr-4 text-xl"></i>
                        <span class="font-semibold">Pesanan</span>
                    </div>
                    @if($newOrders = \App\Models\Order::where('status', 'baru')->count())
                        <span class="bg-danger text-white text-xs font-bold px-3 py-1 rounded-full badge-pulse">
                            {{ $newOrders }}
                        </span>
                    @endif
                </a>
            </nav>

            <!-- Logout -->
           <div class="mt-auto p-6 border-t border-gray-200">
    <form action="{{ route('admin.logout') }}" method="POST">
        @csrf
        <button type="submit" class="w-full flex items-center justify-center gap-4 px-8 py-5 
            bg-gradient-to-r from-red-600 to-red-700 
            hover:from-red-700 hover:to-red-800 
            text-white font-bold text-lg rounded-2xl 
            shadow-2xl hover:shadow-3xl 
            transform hover:scale-105 
            transition-all duration-300 
            border border-red-500 hover:border-red-400 
            backdrop-blur-sm">
            
            <i class="fas fa-sign-out-alt text-2xl"></i>
            <span class="tracking-wider">Logout</span>
        </button>
    </form>
</div>
        </div>

        <!-- Overlay Mobile -->
        <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden"></div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">

            <!-- Header -->
            <header class="bg-white shadow-lg">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center space-x-4">
                        <button id="open-sidebar" class="lg:hidden text-primary text-2xl">
                            <i class="fas fa-bars"></i>
                        </button>
                        <h2 class="text-2xl font-bold bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">
                            @yield('title', 'Dashboard')
                        </h2>
                    </div>
                    <div class="flex items-center space-x-6">
                        <!-- Notification -->
                        <button class="relative p-3 rounded-full hover:bg-gray-100 transition">
                            <i class="fas fa-bell text-xl text-gray-600"></i>
                            @if($newOrders = \App\Models\Order::where('status', 'baru')->count())
                                <span class="absolute -top-1 -right-1 bg-danger text-white text-xs font-bold px-2 py-1 rounded-full badge-pulse">
                                    {{ $newOrders }}
                                </span>
                            @endif
                        </button>
                        <!-- Profile -->
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-gradient-to-br from-primary to-secondary rounded-full flex items-center justify-center text-white font-bold text-xl shadow-lg">
                                {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                            </div>
                            <div>
                                <p class="font-semibold">{{ Auth::user()->name ?? 'Administrator' }}</p>
                                <p class="text-xs text-gray-500">Super Admin</p>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 overflow-y-auto p-6 lg:p-10 bg-gradient-to-br from-gray-50 to-blue-50">
                <div class="max-w-7xl mx-auto">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- Mobile Menu Script -->
    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const openBtn = document.getElementById('open-sidebar');
        const closeBtn = document.getElementById('close-sidebar');

        openBtn?.addEventListener('click', () => {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
        });

        closeBtn?.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });

        overlay?.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });
    </script>

    <!-- Success Alert -->
    @if(session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 4000,
                showConfirmButton: false,
                timerProgressBar: true
            });
        </script>
    @endif
</body>
</html>