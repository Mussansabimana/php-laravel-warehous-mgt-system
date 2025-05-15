@extends('layouts.app')

@section('title', 'Reports')

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

    <!-- Header with Generate Report button -->
    <div class="flex justify-between items-center">
        <div class="backdrop-blur-sm bg-white/5 p-4 rounded-xl border border-white/10">
            <h2 class="text-xl font-semibold">Reports</h2>
            <p class="text-sm text-white/60">Manage your generated reports here</p>
        </div>
    </div>

    <!-- Table Container -->
    <div class="backdrop-blur-sm bg-white/5 rounded-xl border border-white/10 overflow-hidden">
        <table class="w-full">
            <thead class="border-b border-white/10">
                <tr class="text-left">
                    <th class="p-4 font-medium">Status</th>
                    <th class="p-4 font-medium">Created At</th>
                    <th class="p-4 font-medium text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/10">
                @foreach ($files as $file)
                <tr class="hover:bg-white/5 transition">
                    <td class="p-4">{{ ucfirst(pathinfo($file, PATHINFO_FILENAME)) }}</td>
                    <td class="p-4">{{ date('Y-m-d H:i:s', File::lastModified($file)) }}</td>
                    <td class="p-4 flex justify-end space-x-2">
                        <!-- Download Button -->
                        <a href="{{ route('reports.show', ['report' => basename($file)]) }}" class="flex items-center space-x-1 backdrop-blur-sm bg-amber-500/20 hover:bg-amber-500/30 px-3 py-1 rounded-lg border border-amber-400/30 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                            </svg>
                            <span class="text-sm">Download</span>
                        </a>

                        <!-- Delete Button -->
                        <form action="{{ route('reports.destroy', ['report' => basename($file)]) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="flex items-center space-x-1 backdrop-blur-sm bg-red-500/20 hover:bg-red-500/30 px-3 py-1 rounded-lg border border-red-400/30 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>
                                <span class="text-sm">Delete</span>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
