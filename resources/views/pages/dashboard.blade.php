@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="space-y-6">

        @if (session('success') || session('error'))
            <div id="alert-message"
                class="fixed top-5 right-5 z-50 max-w-xs w-full backdrop-blur-md rounded-xl border border-white/10 px-4 py-3 flex items-center space-x-3 
            @if (session('success')) bg-emerald-500/20 border-emerald-400/30 text-emerald-300 
            @else bg-red-500/20 border-red-400/30 text-red-300 @endif
            transition-opacity duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5 flex-shrink-0">
                    @if (session('success'))
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    @else
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    @endif
                </svg>
                <span class="text-sm">
                    {{ session('success') ?? session('error') }}
                </span>
            </div>

            <script>
                setTimeout(() => {
                    const alertBox = document.getElementById('alert-message');
                    if (alertBox) {
                        alertBox.classList.add('opacity-0');
                        setTimeout(() => alertBox.remove(), 500);
                    }
                }, 3000);
            </script>
        @endif

        <!-- Glassmorphism Header -->
        <div class="backdrop-blur-sm bg-white/5 p-6 rounded-xl border border-white/10 shadow-lg">
            <h1 class="text-2xl font-bold mb-2">Welcome back, <span class="text-indigo-400">John</span>!</h1>
            <p class="text-white/80">Here's what's happening with your cargo operations today.</p>
        </div>

        <!-- Stats Cards (Glassmorphism) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Card 1 -->
            <div class="backdrop-blur-sm bg-white/5 p-6 rounded-xl border border-white/10 hover:bg-white/10 transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-white/60">Total Furnitures</p>
                        <h3 class="text-2xl font-bold">{{ $furnitureCount }}</h3>
                    </div>
                    <div class="p-3 rounded-lg bg-indigo-500/20">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 text-indigo-400">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M20.25 14.25v3.375c0 .621-.504 1.125-1.125 1.125H4.875A1.125 1.125 0 013.75 17.625V14.25m16.5 0v-4.5a2.25 2.25 0 00-2.25-2.25H6.75A2.25 2.25 0 004.5 9.75v4.5m16.5 0H3.75" />
                        </svg>
                    </div>

                </div>
            </div>

            <!-- Card 2 -->
            <div class="backdrop-blur-sm bg-white/5 p-6 rounded-xl border border-white/10 hover:bg-white/10 transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-white/60">Total Imports</p>
                        <h3 class="text-2xl font-bold">{{ $importCount }}</h3>
                    </div>
                    <div class="p-3 rounded-lg bg-green-500/20">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 text-green-400">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 4.5v15m0 0l-7.5-7.5m7.5 7.5l7.5-7.5" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="backdrop-blur-sm bg-white/5 p-6 rounded-xl border border-white/10 hover:bg-white/10 transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-white/60">Total Exports</p>
                        <h3 class="text-2xl font-bold">{{ $exportCount }}</h3>
                    </div>
                    <div class="p-3 rounded-lg bg-amber-500/20">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 text-amber-400">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 19.5V4.5m0 0l7.5 7.5M12 4.5l-7.5 7.5" />
                        </svg>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
