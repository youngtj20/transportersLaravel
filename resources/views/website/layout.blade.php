<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Transporters for Tinubu 2027')</title>
    <meta name="description" content="@yield('description', 'Official website for the Transporters for Tinubu 2027 movement and campaign')">
    <meta name="keywords" content="@yield('keywords', 'transporters, tinubu, 2027, nigeria, campaign, politics')">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo/logo.png') }}">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts - Geist Sans and Geist Mono -->
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@300;400;500;600;700&family=Geist+Mono:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --radius: 0.625rem;
            --background: oklch(1 0 0);
            --foreground: oklch(0.145 0 0);
            --card: oklch(1 0 0);
            --card-foreground: oklch(0.145 0 0);
            --popover: oklch(1 0 0);
            --popover-foreground: oklch(0.145 0 0);
            --primary: oklch(0.205 0 0);
            --primary-foreground: oklch(0.985 0 0);
            --secondary: oklch(0.97 0 0);
            --secondary-foreground: oklch(0.205 0 0);
            --muted: oklch(0.97 0 0);
            --muted-foreground: oklch(0.556 0 0);
            --accent: oklch(0.97 0 0);
            --accent-foreground: oklch(0.205 0 0);
            --destructive: oklch(0.577 0.245 27.325);
            --border: oklch(0.922 0 0);
            --input: oklch(0.922 0 0);
            --ring: oklch(0.708 0 0);
            --chart-1: oklch(0.646 0.222 41.116);
            --chart-2: oklch(0.6 0.118 184.704);
            --chart-3: oklch(0.398 0.07 227.392);
            --chart-4: oklch(0.828 0.189 84.429);
            --chart-5: oklch(0.769 0.188 70.08);
            --sidebar: oklch(0.985 0 0);
            --sidebar-foreground: oklch(0.145 0 0);
            --sidebar-primary: oklch(0.205 0 0);
            --sidebar-primary-foreground: oklch(0.985 0 0);
            --sidebar-accent: oklch(0.97 0 0);
            --sidebar-accent-foreground: oklch(0.205 0 0);
            --sidebar-border: oklch(0.922 0 0);
            --sidebar-ring: oklch(0.708 0 0);
        }
        
        body {
            font-family: 'Geist', sans-serif;
            background-color: var(--background);
            color: var(--foreground);
        }
        
        .font-mono {
            font-family: 'Geist Mono', monospace;
        }
        
        .hero-gradient {
            background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
        }
        
        .nigeria-flag {
            background: linear-gradient(to bottom, #008751 33.33%, #ffffff 33.33% 66.66%, #ce1126 66.66%);
        }
        
        * {
            border-color: var(--border);
        }
        
        .bg-card {
            background-color: var(--card);
        }
        
        .text-card-foreground {
            color: var(--card-foreground);
        }
        
        .border-border {
            border-color: var(--border);
        }
        
        .outline-ring {
            outline-color: var(--ring);
        }
    </style>
</head>
<body class="bg-background text-foreground">
    <!-- Navigation -->
    <nav class="fixed top-0 w-full z-50 transition-all duration-300 bg-white/80 backdrop-blur-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center">
                        <img src="{{ asset('images/logo/logo.png') }}" alt="Transporters for Tinubu 2027" class="w-10 h-10 object-contain rounded-full shadow-lg">
                        <div class="ml-3 hidden sm:block">
                            <span class="text-xl font-bold text-gray-900">Transporters for Tinubu</span>
                            <span class="block text-sm text-green-600 font-semibold">2027</span>
                        </div>
                    </div>
                    
                    <!-- Desktop Navigation -->
                    <div class="hidden lg:ml-10 lg:flex lg:space-x-8">
                        @if(isset($menuItems) && $menuItems->count() > 0)
                            @foreach($menuItems as $menuItem)
                                <a href="{{ $menuItem->url }}" class="text-gray-700 hover:text-green-600 px-3 py-2 text-sm font-medium transition-colors duration-200 relative group">
                                    {{ $menuItem->title }}
                                    <span class="absolute bottom-0 left-0 w-full h-0.5 bg-green-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-200"></span>
                                </a>
                            @endforeach
                        @else
                            <!-- Fallback menu items if none are defined -->
                            <a href="{{ url('/') }}" class="text-gray-700 hover:text-green-600 px-3 py-2 text-sm font-medium transition-colors duration-200 relative group">
                                Home
                                <span class="absolute bottom-0 left-0 w-full h-0.5 bg-green-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-200"></span>
                            </a>
                            <a href="{{ url('/about') }}" class="text-gray-700 hover:text-green-600 px-3 py-2 text-sm font-medium transition-colors duration-200 relative group">
                                About
                                <span class="absolute bottom-0 left-0 w-full h-0.5 bg-green-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-200"></span>
                            </a>
                            <a href="{{ url('/vision') }}" class="text-gray-700 hover:text-green-600 px-3 py-2 text-sm font-medium transition-colors duration-200 relative group">
                                Vision
                                <span class="absolute bottom-0 left-0 w-full h-0.5 bg-green-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-200"></span>
                            </a>
                            <a href="{{ url('/mission') }}" class="text-gray-700 hover:text-green-600 px-3 py-2 text-sm font-medium transition-colors duration-200 relative group">
                                Mission
                                <span class="absolute bottom-0 left-0 w-full h-0.5 bg-green-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-200"></span>
                            </a>
                            <a href="{{ url('/events') }}" class="text-gray-700 hover:text-green-600 px-3 py-2 text-sm font-medium transition-colors duration-200 relative group">
                                Events
                                <span class="absolute bottom-0 left-0 w-full h-0.5 bg-green-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-200"></span>
                            </a>
                            <a href="{{ url('/blog') }}" class="text-gray-700 hover:text-green-600 px-3 py-2 text-sm font-medium transition-colors duration-200 relative group">
                                Blog
                                <span class="absolute bottom-0 left-0 w-full h-0.5 bg-green-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-200"></span>
                            </a>
                            <a href="{{ url('/gallery') }}" class="text-gray-700 hover:text-green-600 px-3 py-2 text-sm font-medium transition-colors duration-200 relative group">
                                Gallery
                                <span class="absolute bottom-0 left-0 w-full h-0.5 bg-green-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-200"></span>
                            </a>
                            <a href="{{ url('/contact') }}" class="text-gray-700 hover:text-green-600 px-3 py-2 text-sm font-medium transition-colors duration-200 relative group">
                                Contact
                                <span class="absolute bottom-0 left-0 w-full h-0.5 bg-green-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-200"></span>
                            </a>
                        @endif
                    </div>
                </div>
                
                <!-- Mobile menu button -->
                <div class="lg:hidden flex items-center">
                    <button id="mobile-menu-button" class="text-gray-700 hover:bg-green-50 p-2 rounded-md transition-colors duration-200">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile Navigation -->
        <div id="mobile-menu" class="lg:hidden hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white border-t border-gray-200">
                <div class="flex items-center justify-between mb-6 mt-2 px-2">
                    <div class="flex items-center space-x-3">
                        <img src="{{ asset('images/logo/logo.png') }}" alt="Transporters for Tinubu 2027" class="w-10 h-10 object-contain rounded-full shadow-lg">
                        <div>
                            <span class="text-lg font-bold text-gray-900">Transporters</span>
                            <span class="block text-sm text-green-600 font-semibold">2027</span>
                        </div>
                    </div>
                    <button id="mobile-menu-close" class="text-gray-500 hover:text-gray-700 p-1">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                
                <a href="{{ url('/') }}" class="group flex items-center justify-between p-4 rounded-xl hover:bg-green-50 transition-all duration-200 border border-transparent hover:border-green-100">
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-gray-100 group-hover:bg-green-100 transition-colors duration-200">
                            <i class="fas fa-home text-gray-600 group-hover:text-green-600 transition-colors duration-200"></i>
                        </div>
                        <span class="text-gray-900 font-medium group-hover:text-green-600 transition-colors duration-200">Home</span>
                    </div>
                    <i class="fas fa-chevron-right h-4 w-4 text-gray-400 group-hover:text-green-600 transition-colors duration-200"></i>
                </a>
                
                <a href="{{ url('/about') }}" class="group flex items-center justify-between p-4 rounded-xl hover:bg-green-50 transition-all duration-200 border border-transparent hover:border-green-100">
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-gray-100 group-hover:bg-green-100 transition-colors duration-200">
                            <i class="fas fa-info-circle text-gray-600 group-hover:text-green-600 transition-colors duration-200"></i>
                        </div>
                        <span class="text-gray-900 font-medium group-hover:text-green-600 transition-colors duration-200">About</span>
                    </div>
                    <i class="fas fa-chevron-right h-4 w-4 text-gray-400 group-hover:text-green-600 transition-colors duration-200"></i>
                </a>
                
                <a href="{{ url('/vision') }}" class="group flex items-center justify-between p-4 rounded-xl hover:bg-green-50 transition-all duration-200 border border-transparent hover:border-green-100">
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-gray-100 group-hover:bg-green-100 transition-colors duration-200">
                            <i class="fas fa-bullseye text-gray-600 group-hover:text-green-600 transition-colors duration-200"></i>
                        </div>
                        <span class="text-gray-900 font-medium group-hover:text-green-600 transition-colors duration-200">Vision</span>
                    </div>
                    <i class="fas fa-chevron-right h-4 w-4 text-gray-400 group-hover:text-green-600 transition-colors duration-200"></i>
                </a>
                
                <a href="{{ url('/mission') }}" class="group flex items-center justify-between p-4 rounded-xl hover:bg-green-50 transition-all duration-200 border border-transparent hover:border-green-100">
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-gray-100 group-hover:bg-green-100 transition-colors duration-200">
                            <i class="fas fa-rocket text-gray-600 group-hover:text-green-600 transition-colors duration-200"></i>
                        </div>
                        <span class="text-gray-900 font-medium group-hover:text-green-600 transition-colors duration-200">Mission</span>
                    </div>
                    <i class="fas fa-chevron-right h-4 w-4 text-gray-400 group-hover:text-green-600 transition-colors duration-200"></i>
                </a>
                
                <a href="{{ url('/events') }}" class="group flex items-center justify-between p-4 rounded-xl hover:bg-green-50 transition-all duration-200 border border-transparent hover:border-green-100">
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-gray-100 group-hover:bg-green-100 transition-colors duration-200">
                            <i class="fas fa-calendar-alt text-gray-600 group-hover:text-green-600 transition-colors duration-200"></i>
                        </div>
                        <span class="text-gray-900 font-medium group-hover:text-green-600 transition-colors duration-200">Events</span>
                    </div>
                    <i class="fas fa-chevron-right h-4 w-4 text-gray-400 group-hover:text-green-600 transition-colors duration-200"></i>
                </a>
                
                <a href="{{ url('/blog') }}" class="group flex items-center justify-between p-4 rounded-xl hover:bg-green-50 transition-all duration-200 border border-transparent hover:border-green-100">
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-gray-100 group-hover:bg-green-100 transition-colors duration-200">
                            <i class="fas fa-blog text-gray-600 group-hover:text-green-600 transition-colors duration-200"></i>
                        </div>
                        <span class="text-gray-900 font-medium group-hover:text-green-600 transition-colors duration-200">Blog</span>
                    </div>
                    <i class="fas fa-chevron-right h-4 w-4 text-gray-400 group-hover:text-green-600 transition-colors duration-200"></i>
                </a>
                
                <a href="{{ url('/gallery') }}" class="group flex items-center justify-between p-4 rounded-xl hover:bg-green-50 transition-all duration-200 border border-transparent hover:border-green-100">
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-gray-100 group-hover:bg-green-100 transition-colors duration-200">
                            <i class="fas fa-images text-gray-600 group-hover:text-green-600 transition-colors duration-200"></i>
                        </div>
                        <span class="text-gray-900 font-medium group-hover:text-green-600 transition-colors duration-200">Gallery</span>
                    </div>
                    <i class="fas fa-chevron-right h-4 w-4 text-gray-400 group-hover:text-green-600 transition-colors duration-200"></i>
                </a>
                
                <a href="{{ url('/contact') }}" class="group flex items-center justify-between p-4 rounded-xl hover:bg-green-50 transition-all duration-200 border border-transparent hover:border-green-100">
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-gray-100 group-hover:bg-green-100 transition-colors duration-200">
                            <i class="fas fa-envelope text-gray-600 group-hover:text-green-600 transition-colors duration-200"></i>
                        </div>
                        <span class="text-gray-900 font-medium group-hover:text-green-600 transition-colors duration-200">Contact</span>
                    </div>
                    <i class="fas fa-chevron-right h-4 w-4 text-gray-400 group-hover:text-green-600 transition-colors duration-200"></i>
                </a>
                <!-- Footer Info -->
                <div class="mt-6 p-4 bg-gray-50 rounded-xl">
                    <div class="text-center">
                        <p class="text-xs text-gray-500 mb-2">
                            Supporting progressive leadership
                        </p>
                        <div class="flex items-center justify-center space-x-2">
                            <div class="w-2 h-2 bg-green-600 rounded-full animate-pulse"></div>
                            <span class="text-xs text-gray-600">Active Movement</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-4 gap-8">
                <!-- About Section -->
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <img src="{{ asset('images/logo/logo.png') }}" alt="Transporters for Tinubu 2027" class="w-10 h-10 object-contain rounded-full">
                        <div>
                            <span class="text-lg font-bold">Transporters for Tinubu</span>
                            <span class="block text-sm text-green-400">2027</span>
                        </div>
                    </div>
                    <p class="text-gray-400 mb-6">
                        Supporting progressive leadership for Nigeria's transportation future.
                    </p>
                    
                    <!-- Social Media Links -->
                    <div>
                        <p class="text-sm font-semibold text-gray-300 mb-4">Follow Us</p>
                        <div class="flex flex-wrap gap-3">
                            <a href="#" class="group flex items-center justify-center w-10 h-10 rounded-full bg-gray-800 hover:bg-green-600 transition-all duration-300 transform hover:scale-110" title="Follow us on Facebook">
                                <i class="fab fa-facebook-f h-5 w-5 text-gray-400 group-hover:text-white transition-colors"></i>
                            </a>
                            <a href="#" class="group flex items-center justify-center w-10 h-10 rounded-full bg-gray-800 hover:bg-blue-500 transition-all duration-300 transform hover:scale-110" title="Follow us on Twitter">
                                <i class="fab fa-twitter h-5 w-5 text-gray-400 group-hover:text-white transition-colors"></i>
                            </a>
                            <a href="#" class="group flex items-center justify-center w-10 h-10 rounded-full bg-gray-800 hover:bg-pink-600 transition-all duration-300 transform hover:scale-110" title="Follow us on Instagram">
                                <i class="fab fa-instagram h-5 w-5 text-gray-400 group-hover:text-white transition-colors"></i>
                            </a>
                            <a href="#" class="group flex items-center justify-center w-10 h-10 rounded-full bg-gray-800 hover:bg-blue-700 transition-all duration-300 transform hover:scale-110" title="Follow us on LinkedIn">
                                <i class="fab fa-linkedin-in h-5 w-5 text-gray-400 group-hover:text-white transition-colors"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ url('/about') }}" class="text-gray-400 hover:text-white transition-colors">About Us</a></li>
                        <li><a href="{{ url('/vision') }}" class="text-gray-400 hover:text-white transition-colors">Vision</a></li>
                        <li><a href="{{ url('/mission') }}" class="text-gray-400 hover:text-white transition-colors">Mission</a></li>
                        <li><a href="{{ url('/contact') }}" class="text-gray-400 hover:text-white transition-colors">Contact</a></li>
                    </ul>
                </div>

                <!-- Get Involved -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Get Involved</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ url('/structure') }}" class="text-gray-400 hover:text-white transition-colors">Our Structure</a></li>
                        <li><a href="{{ url('/timeline') }}" class="text-gray-400 hover:text-white transition-colors">Timeline</a></li>
                        <li><a href="{{ url('/admin') }}" class="text-gray-400 hover:text-white transition-colors">Admin Portal</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Contact Info</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-center">
                            <i class="fas fa-map-marker-alt h-4 w-4 mr-2"></i>
                            Abuja, Nigeria
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope h-4 w-4 mr-2"></i>
                            info@transportersfortinubu.ng
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2025 Transporters for Tinubu 2027. All rights reserved.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')

    <!-- Mobile Menu Script -->
    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        });
        
        document.getElementById('mobile-menu-close').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.add('hidden');
        });
    </script>
</body>
</html>