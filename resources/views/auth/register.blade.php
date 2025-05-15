<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Manager Account</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 min-h-screen flex items-center justify-center text-white">

        <!-- Toast Alert -->
    @if ($errors->any())
        <div id="toast"
            class="fixed top-5 right-5 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg transition duration-300 z-50">
            {{ $errors->first() }}
        </div>
    @endif


<div class="space-y-6 max-w-xl mx-auto px-4">
    <!-- Glassmorphism Header -->
    <div class="backdrop-blur-sm bg-white/5 p-6 rounded-xl border border-white/10 shadow-lg text-center">
        <h1 class="text-3xl font-bold">Create Manager Account</h1>
        <p class="text-white/60 mt-2">Fill in the details to create a new manager profile.</p>
    </div>

    <!-- Registration Form -->
    <div class="backdrop-blur-sm bg-white/5 p-6 rounded-xl border border-white/10 shadow-lg">
        <form method="POST" action="{{ route("register") }}" class="space-y-5">
            @csrf

            <div>
                <label for="username" class="block text-white/80 text-sm mb-1">Username</label>
                <input id="username" name="name" type="text" required
                    class="w-full px-4 py-2 rounded-lg bg-white/10 focus:bg-white/10 text-white border border-white/20 focus:ring-2 focus:ring-indigo-400 focus:outline-none"
                    placeholder="Enter Username">
            </div>

            <div>
                <label for="password" class="block text-white/80 text-sm mb-1">Password</label>
                <input id="password" name="password" type="password" required
                    class="w-full px-4 py-2 rounded-lg bg-white/10 focus:bg-white/10 text-white border border-white/20 focus:ring-2 focus:ring-indigo-400 focus:outline-none"
                    placeholder="Enter Password">
            </div>

            <div>
                <label for="password_confirmation" class="block text-white/80 text-sm mb-1">Confirm Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required
                    class="w-full px-4 py-2 rounded-lg bg-white/10 focus:bg-white/10 text-white border border-white/20 focus:ring-2 focus:ring-indigo-400 focus:outline-none"
                    placeholder="Confirm Password">
            </div>

            <div>
                <button type="submit"
                    class="w-full py-2 px-4 rounded-lg bg-indigo-500 hover:bg-indigo-600 text-white font-semibold focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
                    Register
                </button>
            </div>
            <div class="text-center text-white/70 text-sm mt-4">
                <span>Already have an account? </span>
                <a href="{{ url('/login') }}" class="text-indigo-400 hover:text-indigo-300 font-semibold transition">
                    Login
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
