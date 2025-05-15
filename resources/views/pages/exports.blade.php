@extends('layouts.app')

@section('title', 'Exports')

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
                <h2 class="text-xl font-semibold">Exports Management</h2>
                <p class="text-sm text-white/60">All outgoing furniture shipments</p>
            </div>
            @if ($exports->count())
                <form action="{{ route('reports.store')}}" method="POST">
                @csrf
                <input type="text" name="report_type" value="exports" class="hidden">
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
                        <th class="p-4 font-medium">Client</th>
                        <th class="p-4 font-medium">Image</th>
                        <th class="p-4 font-medium">Export Date</th>
                        <th class="p-4 font-medium">Qty</th>
                        <th class="p-4 font-medium text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @foreach ($exports as $export)
                        <tr class="hover:bg-white/5 transition">
                            <td class="p-4">{{ $export->furniture->furniture_name }}</td>
                            <td class="p-4">{{ $export->furniture->furniture_ouner }}</td>
                            <td class="p-4">
                                <div
                                    class="w-10 h-10 rounded-md bg-white/10 flex items-center justify-center overflow-hidden">
                                    @if ($export->furniture->furniture_image)
                                        <img src="{{ asset('images/' . $export->furniture->furniture_image) }}"
                                            alt="Furniture Image" class="object-cover w-full h-full">
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white/60">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                        </svg>
                                    @endif
                                </div>
                            </td>
                            <td class="p-4">{{ $export->exported_date }}</td>
                            <td class="p-4">{{ $export->quantity }}</td>
                            <td class="p-4 flex justify-end space-x-2">
                                <button type="button" onclick="openEditExportedDateAlert({{ $export->id }})"
                                    class="flex items-center space-x-1 backdrop-blur-sm bg-yellow-500/20 hover:bg-yellow-500/30 px-3 py-1 rounded-lg border border-yellow-400/30 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8 7V3m8 4V3m-9 9h10m-12 8h14a2 2 0 002-2V7a2 2 0 00-2-2H4a2 2 0 00-2 2v11a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-sm">Change Exported Date</span>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('components.editExportedDateAlert')
@endsection
