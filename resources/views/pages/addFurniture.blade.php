@extends('layouts.app')

@section('title', $s == 'u' ? 'Update Furniture' : 'Add Furniture')

@section('content')
    <div class="space-y-6 max-w-xl mx-auto">

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
        <div class="backdrop-blur-sm bg-white/5 p-6 rounded-xl border border-white/10 shadow-lg text-center">
            <h1 class="text-3xl font-bold text-white">{{ $s == 'u' ? 'Update Furniture' : 'Add New Furniture' }}</h1>
            <p class="text-white/60 mt-2">Upload furniture details to your collection.</p>
        </div>

        <!-- Add Furniture Form -->
        <div class="backdrop-blur-sm bg-white/5 p-6 rounded-xl border border-white/10 shadow-lg">
            <form action="{{ $s == 'u' ? route('furnitures.update', $furniture->id) : route('furnitures.store') }}"
                method="POST" enctype="multipart/form-data" class="space-y-5">

                @csrf
                @if ($s == 'u')
                    @method('PUT')
                @endif

                <!-- Furniture Image -->
                <div>
                    <label class="block text-white/80 text-sm mb-1">Furniture Image</label>
                    <input type="file" name="image"
                        class="w-full px-4 py-2 rounded-lg bg-white/10 text-white border border-white/20 focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                    <img id="preview-image" src="{{ $s == 'u' ? asset('images/' . $furniture->furniture_image) : '' }}"
                        alt="Selected Image" class="mt-3 rounded-lg {{ $s == 'u' ? '' : 'hidden' }} max-h-48">
                </div>

                <!-- Furniture Name -->
                <div>
                    <label class="block text-white/80 text-sm mb-1">Furniture Name</label>
                    <input type="text" name="name" value="{{ $s == 'u' ? $furniture->furniture_name : '' }}" required
                        class="w-full px-4 py-2 rounded-lg bg-white/10 text-white border border-white/20 focus:ring-2 focus:ring-indigo-400 focus:outline-none"
                        placeholder="Enter Furniture Name">
                </div>

                <!-- Furniture Owner -->
                <div>
                    <label class="block text-white/80 text-sm mb-1">Furniture Owner</label>
                    <input type="text" name="owner" value="{{ $s == 'u' ? $furniture->furniture_ouner : '' }}" required
                        class="w-full px-4 py-2 rounded-lg bg-white/10 text-white border border-white/20 focus:ring-2 focus:ring-indigo-400 focus:outline-none"
                        placeholder="Enter Owner Name">
                </div>

                <!-- Furniture Quantity -->
                <div>
                    <label class="block text-white/80 text-sm mb-1">Quantity</label>
                    <input type="number" name="quantity" min="1" value="{{ $s == 'u' ? $furniture->quantity : '' }}"
                        required
                        class="w-full px-4 py-2 rounded-lg bg-white/10 text-white border border-white/20 focus:ring-2 focus:ring-indigo-400 focus:outline-none"
                        placeholder="Enter Quantity">
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                        class="w-full py-2 px-4 rounded-lg bg-indigo-500 hover:bg-indigo-600 text-white font-semibold focus:outline-none focus:ring-2 focus:ring-indigo-400 transition">
                        {{ $s == 'u' ? 'Update Furniture' : 'Add Furniture' }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Image Preview Script -->
    <script>
        const imageInput = document.querySelector('input[name="image"]');
        const previewImage = document.getElementById('preview-image');

        imageInput.addEventListener('change', e => {
            const file = e.target.files[0];
            if (file) {
                previewImage.src = URL.createObjectURL(file);
                previewImage.classList.remove('hidden');
            }
        });
    </script>
@endsection
