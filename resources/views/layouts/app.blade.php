<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PetPGSI')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="//unpkg.com/alpinejs" defer></script>
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .nav-gradient {
            background: linear-gradient(90deg, #4f46e5 0%, #7c3aed 100%);
        }
        
        .card-hover {
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .notification-slide {
            animation: slideIn 0.5s ease-out;
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .active-nav-item {
            position: relative;
        }
        
        .active-nav-item::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: #ffffff;
            border-radius: 2px;
        }
        
        .logo-text {
            background: linear-gradient(90deg, #ffffff, #e0e7ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-blue-50 min-h-screen flex flex-col">

    <!-- Navigation -->
    <nav class="nav-gradient shadow-xl sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-3">
                <!-- Logo and Brand -->
                <div class="flex items-center space-x-3">
                    <div class="flex items-center justify-center w-10 h-10 bg-white rounded-full">
                        <i class="fas fa-paw text-purple-600 text-xl"></i>
                    </div>
                    <h1 class="text-xl font-bold logo-text">PetPGSI</h1>
                </div>
                
                <!-- Desktop Navigation -->
                @auth
                <div class="hidden md:flex space-x-1">
                    <a href="{{ route('mascotas.index') }}" 
                       class="flex items-center px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('mascotas.*') ? 'bg-white bg-opacity-20 text-white active-nav-item' : 'text-blue-100 hover:bg-white hover:bg-opacity-10 hover:text-white' }}">
                        <i class="fas fa-paw mr-2"></i>Mascotas
                    </a>
                    <a href="{{ route('servicios.index') }}" 
                       class="flex items-center px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('servicios.*') ? 'bg-white bg-opacity-20 text-white active-nav-item' : 'text-blue-100 hover:bg-white hover:bg-opacity-10 hover:text-white' }}">
                        <i class="fas fa-concierge-bell mr-2"></i>Servicios
                    </a>
                    <a href="{{ route('citas.index') }}" 
                       class="flex items-center px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('citas.*') ? 'bg-white bg-opacity-20 text-white active-nav-item' : 'text-blue-100 hover:bg-white hover:bg-opacity-10 hover:text-white' }}">
                        <i class="fas fa-calendar-alt mr-2"></i>Citas
                    </a>
                </div>
                @endauth

                <!-- User Menu -->
                <div class="flex items-center space-x-4">
                    @auth
                    <div class="relative" x-data="{ open: false }">
                        <!-- User Button -->
                        <button @click="open = !open" 
                                class="flex items-center space-x-2 bg-white bg-opacity-20 hover:bg-opacity-30 backdrop-blur-sm px-4 py-2 rounded-xl transition-all duration-200 border border-white border-opacity-20">
                            <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-md">
                                <i class="fas fa-user text-purple-600 text-sm"></i>
                            </div>
                            <span class="text-white font-medium hidden sm:block max-w-32 truncate">
                                {{ auth()->user()->name }}
                            </span>
                            <i class="fas fa-chevron-down text-white text-xs transition-transform duration-200" :class="{'rotate-180': open}"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open" 
                             @click.away="open = false" 
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-xl py-2 z-50 border border-gray-200 overflow-hidden">
                            
                            <!-- User Info -->
                            <div class="px-4 py-3 bg-gradient-to-r from-purple-50 to-indigo-50 border-b border-gray-100">
                                <p class="text-sm font-semibold text-gray-900 truncate">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-gray-600 truncate mt-1">{{ auth()->user()->email }}</p>
                                <div class="flex items-center mt-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 capitalize">
                                        {{ auth()->user()->role ?? 'usuario' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Menu Options -->
                            <div class="py-2">
                                <a href="{{ route('user.profile') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-purple-50 transition-colors duration-150">
                                    <i class="fas fa-user-circle mr-3 text-purple-500 w-5"></i>
                                    Mi Perfil
                                </a>
                                <a href="{{ route('user.settings') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-purple-50 transition-colors duration-150">
                                    <i class="fas fa-cog mr-3 text-purple-500 w-5"></i>
                                    Configuración
                                </a>
                            </div>

                            <!-- Separator -->
                            <div class="border-t border-gray-100"></div>

                            <!-- Logout -->
                            <div class="py-2">
                                <form method="POST" action="{{ route('auth.logout') }}">
                                    @csrf
                                    <button type="submit" 
                                            class="flex items-center w-full px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors duration-150">
                                        <i class="fas fa-sign-out-alt mr-3 w-5"></i>
                                        Cerrar Sesión
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endauth
                    
                    @guest
                    <div class="flex space-x-3">
                        <a href="{{ route('auth.login') }}" 
                           class="bg-white text-purple-600 px-4 py-2 rounded-lg hover:bg-opacity-90 transition duration-200 flex items-center font-medium shadow-md">
                            <i class="fas fa-sign-in-alt mr-2"></i>Iniciar Sesión
                        </a>
                        <a href="{{ route('auth.register') }}" 
                           class="bg-gradient-to-r from-emerald-500 to-green-500 text-white px-4 py-2 rounded-lg hover:opacity-90 transition duration-200 flex items-center font-medium shadow-md">
                            <i class="fas fa-user-plus mr-2"></i>Registro
                        </a>
                    </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Navigation -->
    @auth
    <div class="bg-white shadow-lg md:hidden sticky top-16 z-40 border-t border-gray-100">
        <div class="flex justify-around py-3">
            <a href="{{ route('mascotas.index') }}" 
               class="flex flex-col items-center px-3 py-2 rounded-lg transition-all duration-200 {{ request()->routeIs('mascotas.*') ? 'text-purple-600 bg-purple-50' : 'text-gray-600 hover:text-purple-600 hover:bg-purple-50' }}">
                <i class="fas fa-paw text-lg mb-1"></i>
                <span class="text-xs font-medium">Mascotas</span>
            </a>
            <a href="{{ route('servicios.index') }}" 
               class="flex flex-col items-center px-3 py-2 rounded-lg transition-all duration-200 {{ request()->routeIs('servicios.*') ? 'text-purple-600 bg-purple-50' : 'text-gray-600 hover:text-purple-600 hover:bg-purple-50' }}">
                <i class="fas fa-concierge-bell text-lg mb-1"></i>
                <span class="text-xs font-medium">Servicios</span>
            </a>
            <a href="{{ route('citas.index') }}" 
               class="flex flex-col items-center px-3 py-2 rounded-lg transition-all duration-200 {{ request()->routeIs('citas.*') ? 'text-purple-600 bg-purple-50' : 'text-gray-600 hover:text-purple-600 hover:bg-purple-50' }}">
                <i class="fas fa-calendar-alt text-lg mb-1"></i>
                <span class="text-xs font-medium">Citas</span>
            </a>
            <a href="{{ route('user.profile') }}" 
               class="flex flex-col items-center px-3 py-2 rounded-lg transition-all duration-200 {{ request()->routeIs('user.*') ? 'text-purple-600 bg-purple-50' : 'text-gray-600 hover:text-purple-600 hover:bg-purple-50' }}">
                <i class="fas fa-user text-lg mb-1"></i>
                <span class="text-xs font-medium">Perfil</span>
            </a>
        </div>
    </div>
    @endauth

    <!-- Main Content -->
    <main class="flex-grow py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Notifications -->
            @if(session('success'))
                <div class="notification-slide mb-6 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-md">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-check-circle text-green-500 text-xl"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium">{{ session('success') }}</p>
                        </div>
                        <div class="ml-auto pl-3">
                            <div class="-mx-1.5 -my-1.5">
                                <button class="inline-flex rounded-md p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-green-50 focus:ring-green-600">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="notification-slide mb-6 bg-gradient-to-r from-red-50 to-pink-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-md">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-circle text-red-500 text-xl"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium">{{ session('error') }}</p>
                        </div>
                        <div class="ml-auto pl-3">
                            <div class="-mx-1.5 -my-1.5">
                                <button class="inline-flex rounded-md p-1.5 text-red-500 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-red-50 focus:ring-red-600">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="notification-slide mb-6 bg-gradient-to-r from-red-50 to-pink-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-md">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-triangle text-red-500 text-xl"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium">Por favor corrige los siguientes errores:</p>
                            <ul class="mt-2 list-disc list-inside text-sm">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="ml-auto pl-3">
                            <div class="-mx-1.5 -my-1.5">
                                <button class="inline-flex rounded-md p-1.5 text-red-500 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-red-50 focus:ring-red-600">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Page Content -->
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-gray-800 to-gray-900 text-white mt-12">
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center mb-4">
                        <div class="flex items-center justify-center w-10 h-10 bg-white rounded-full mr-3">
                            <i class="fas fa-paw text-purple-600 text-xl"></i>
                        </div>
                        <h2 class="text-xl font-bold">PetPGSI</h2>
                    </div>
                    <p class="text-gray-300 mb-4 max-w-md">
                        Tu centro de confianza para el cuidado de mascotas. Ofrecemos servicios profesionales de veterinaria, peluquería y cuidado animal.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-300 hover:text-white transition-colors duration-200">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition-colors duration-200">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition-colors duration-200">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Enlaces rápidos</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors duration-200">Inicio</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors duration-200">Servicios</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors duration-200">Sobre Nosotros</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors duration-200">Contacto</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Contacto</h3>
                    <ul class="space-y-2 text-gray-300">
                        <li class="flex items-center">
                            <i class="fas fa-map-marker-alt mr-2 text-purple-400"></i>
                            <span>Av. Principal 123, Bógota</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone mr-2 text-purple-400"></i>
                            <span>+1 234 567 890</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-2 text-purple-400"></i>
                            <span>info@petpgsi.com</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-8 pt-6 text-center text-gray-400">
                <p>&copy; 2025 PetPGSI. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <script>
        // Auto-hide notifications
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-hide notifications after 5 seconds
            setTimeout(function() {
                const messages = document.querySelectorAll('.notification-slide');
                messages.forEach(function(message) {
                    message.style.transition = 'all 0.5s ease';
                    message.style.opacity = '0';
                    message.style.transform = 'translateY(-10px)';
                    setTimeout(() => {
                        if (message.parentNode) {
                            message.parentNode.removeChild(message);
                        }
                    }, 500);
                });
            }, 5000);

            // Close notifications on button click
            document.addEventListener('click', function(e) {
                if (e.target.closest('button') && e.target.closest('.notification-slide')) {
                    const notification = e.target.closest('.notification-slide');
                    notification.style.transition = 'all 0.5s ease';
                    notification.style.opacity = '0';
                    notification.style.transform = 'translateY(-10px)';
                    setTimeout(() => {
                        if (notification.parentNode) {
                            notification.parentNode.removeChild(notification);
                        }
                    }, 500);
                }
            });
        });
    </script>
</body>
</html>