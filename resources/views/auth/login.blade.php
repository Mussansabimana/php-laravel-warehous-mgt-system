<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warehouse Manager Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 min-h-screen flex items-center justify-center">

    <!-- Toast Alert -->
    @if (session('message'))
        <div id="toast"
            class="fixed top-5 right-5 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transition duration-300 z-50">
            {{ session('message') }}
        </div>
    @elseif ($errors->any())
        <div id="toast"
            class="fixed top-5 right-5 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg transition duration-300 z-50">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="space-y-6 max-w-md w-full px-4">

        <!-- Glassmorphism Header -->
        <div class="backdrop-blur-sm bg-white/5 p-6 rounded-xl border border-white/10 shadow-lg text-center">
            <h2 class="text-3xl font-bold text-white">Warehouse Manager Login</h2>
            <p class="text-white/60 mt-2">Access your management dashboard.</p>
        </div>

        <!-- Login Form -->
        <div class="backdrop-blur-sm bg-white/5 p-6 rounded-xl border border-white/10 shadow-lg">
            <form class="space-y-5" method="POST" action="{{ route("login") }}">
                @csrf

                <div>
                    <label for="username" class="block text-white/80 text-sm mb-1">Username</label>
                    <input id="username" name="name" type="text" required
                        class="w-full px-4 py-2 rounded-lg bg-white/10 text-white border border-white/20 focus:ring-2 focus:ring-indigo-400 focus:bg-white/10 focus:outline-none"
                        placeholder="Enter Username">
                </div>

                <div>
                    <label for="password" class="block text-white/80 text-sm mb-1">Password</label>
                    <input id="password" name="password" type="password" required
                        class="w-full px-4 py-2 rounded-lg bg-white/10 focus:bg-white/10 text-white border border-white/20 focus:ring-2 focus:ring-indigo-400 focus:outline-none"
                        placeholder="Enter Password">
                </div>

                <div>
                    <button type="submit"
                        class="w-full py-2 px-4 rounded-lg bg-indigo-500 hover:bg-indigo-600 text-white font-semibold focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
                        Sign in
                    </button>
                </div>
                <div class="text-center text-white/70 text-sm mt-4">
                    <span>Don't have an account? </span>
                    <a href="{{ url('/register') }}" class="text-indigo-400 hover:text-indigo-300 font-semibold transition">
                        Register
                    </a>
                </div>                
            </form>
        </div>

    </div>

    <script>
        // Auto hide toast after 4 seconds
        const toast = document.getElementById('toast');
        if (toast) {
            setTimeout(() => {
                toast.classList.add('opacity-0', 'translate-y-2');
                setTimeout(() => {
                    toast.remove();
                }, 300);
            }, 4000);
        }
    </script>

</body>

</html>
