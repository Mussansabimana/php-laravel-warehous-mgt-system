@extends('layouts.app')

@section('title', 'Furnitures')

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

        <!-- Header with Report Button -->
        <div class="flex justify-between items-center">
            <div class="backdrop-blur-sm bg-white/5 p-4 rounded-xl border border-white/10">
                <h2 class="text-xl font-semibold">Furniture Inventory</h2>
                <p class="text-sm text-white/60">All available furniture in warehouse</p>
            </div>
            @if($furnitures->count())
            <form action="{{ route('reports.store')}}" method="POST">
                @csrf
                <input type="text" name="report_type" value="furniture" class="hidden">
                <button type="submit"
                class="flex items-center space-x-2 backdrop-blur-sm bg-indigo-500/20 hover:bg-indigo-500/30 px-4 py-2 rounded-lg border border-indigo-400/30 transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                </svg>
                <span>Generate Report</span>
            </button>
            </form>
            @endif
        </div>

        <!-- Table Container -->
        <div class="backdrop-blur-sm bg-white/5 rounded-xl border border-white/10 overflow-hidden">
            <table class="w-full">
                <thead class="border-b border-white/10">
                    <tr class="text-left">
                        <th class="p-4 font-medium">Furniture</th>
                        <th class="p-4 font-medium">Owner</th>
                        <th class="p-4 font-medium">Image</th>
                        <th class="p-4 font-medium">Quantity</th>
                        <th class="p-4 font-medium">Status</th>
                        <th class="p-4 font-medium text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @foreach ($furnitures as $furniture)
                        <tr class="hover:bg-white/5 transition">
                            <td class="p-4">{{ $furniture->furniture_name }}</td>
                            <td class="p-4">{{ $furniture->furniture_ouner }}</td>
                            <td class="p-4">
                                <div
                                    class="w-10 h-10 rounded-md bg-white/10 flex items-center justify-center overflow-hidden">
                                    @if ($furniture->furniture_image)
                                        <img src="{{ asset('images/' . $furniture->furniture_image) }}" alt="image"
                                            class="w-full h-full object-cover">
                                    @else
                                        <span class="text-white/60 text-xs">N/A</span>
                                    @endif
                                </div>
                            </td>
                            <td class="p-4">{{ $furniture->quantity }}</td>
                            <td class="p-4">
                                <div
                                    class="flex text-xs px-2 py-1 w-max bg-emerald-500/20 text-emerald-400 rounded-full border border-emerald-400/30">
                                    In Stock
                                </div>
                            </td>
                            <td class="p-4 flex justify-end space-x-2">

                                @if ($furniture->imports->isEmpty())
                                    <button onclick="openImportModal({{ $furniture->id }})"
                                        class="flex items-center space-x-1 backdrop-blur-sm bg-green-500/20 hover:bg-green-500/30 px-3 py-1 rounded-lg border border-green-400/30 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 3v12m0 0l-3.75-3.75M12 15l3.75-3.75M4.5 20.25h15" />
                                        </svg>
                                        <span class="text-sm">Import</span>
                                    </button>
                                @endif

                                <!-- Export button -->
                                <a href="javascript:void(0)" onclick="openExportModal({{ $furniture->id }})"
                                    class="flex items-center space-x-1 backdrop-blur-sm bg-amber-500/20 hover:bg-amber-500/30 px-3 py-1 rounded-lg border border-amber-400/30 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                                    </svg>
                                    <span class="text-sm">Export</span>
                                </a>

                                <!-- Edit button -->
                                <a href="{{ route('furnitures.edit', $furniture->id) }}"
                                    class="flex items-center space-x-1 backdrop-blur-sm bg-blue-500/20 hover:bg-blue-500/30 px-3 py-1 rounded-lg border border-blue-400/30 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zM19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                    <span class="text-sm">Edit</span>
                                </a>

                                <!-- Delete form -->
                                <form action="{{ route('furnitures.destroy', $furniture->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')"
                                        class="flex items-center space-x-1 backdrop-blur-sm bg-red-500/20 hover:bg-red-500/30 px-3 py-1 rounded-lg border border-red-400/30 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
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

    <!-- Include Import Modal Component -->
    @include('components.importAlert')

    <!-- Existing Export Modal -->
    @include('components.exportAlert')
@endsection
