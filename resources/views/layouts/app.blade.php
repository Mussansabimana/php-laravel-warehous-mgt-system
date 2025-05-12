<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CARGO Ltd @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-slate-900 to-slate-800 text-white">
    <div class="flex h-screen overflow-hidden">
        <!-- Glass Sidebar -->
        <div class="fixed h-full w-64 backdrop-blur-lg bg-white/5 border-r border-white/10 shadow-lg">
            @include('components.sidebar')
        </div>
        
        <!-- Main Content -->
        <div class="flex-1 ml-64 flex flex-col">
            <!-- Glass Top Navigation -->
            <div class="sticky top-0 z-10 backdrop-blur-md bg-white/5 border-b border-white/10">
                @include('components.topnav')
            </div>
            
            <!-- Content Area with subtle glass effect -->
            <main class="flex-1 p-6 overflow-y-auto backdrop-blur-sm bg-white/3">
                @yield('content')
            </main>
            
            <!-- Glass Footer -->
            <footer class="backdrop-blur-md bg-white/5 border-t border-white/10 p-4 text-center">
                <p class="text-sm text-white/70"> 2025 CARGO Ltd. All rights reserved</p>
            </footer>
        </div>
    </div>
</body>
</html>