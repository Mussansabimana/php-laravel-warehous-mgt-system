<div id="exportModal" style="display: none;" class="fixed inset-0 bg-black/50 z-50 flex justify-center items-center">
    <div class="backdrop-blur-sm bg-slate-800 p-8 rounded-xl w-96 space-y-6 shadow-lg">
        <h3 class="text-2xl font-semibold text-white">Export Furniture</h3>

        <!-- Form to export -->
        <form action="{{ route('exports.store') }}" method="POST">
            @csrf
            <input type="hidden" name="furniture_id" id="furniture_id" value="">

            <!-- Imported Date -->
            <div class="space-y-4">
                <label for="imported_date" class="block text-sm font-medium text-white/80">Exported Date</label>
                <input type="date" name="exported_date" id="imported_date" required class="w-full p-4 border border-white/30 rounded-md bg-white/15 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400">
            </div>

            <!-- Quantity -->
            <div class="space-y-4">
                <label for="quantity" class="block text-sm font-medium text-white/80">Quantity</label>
                <input type="number" name="quantity" id="quantity" required min="1" class="w-full p-4 border border-white/30 rounded-md bg-white/15 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400">
            </div>

            <div class="flex justify-end mt-3 space-x-4">
                <button type="button" onclick="closeExportModal()" class="px-6 py-3 text-sm bg-gray-600 text-white rounded-lg hover:bg-gray-500 transition">Cancel</button>
                <button type="submit" class="px-6 py-3 text-sm bg-indigo-600 text-white rounded-lg hover:bg-indigo-500 transition">Submit</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Function to close the export modal
    function closeExportModal() {
        document.getElementById('exportModal').style.display = 'none';
    }

    // Function to open the export modal and set the furniture_id
    function openExportModal(furniture_id) {
        document.getElementById('furniture_id').value = furniture_id;
        document.getElementById('exportModal').style.display = 'flex';
    }
</script>
