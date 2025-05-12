<div id="importAlert"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm hidden">
    <div class="bg-white/10 border border-white/20 rounded-xl p-6 w-full max-w-sm space-y-4">
        <h3 class="text-lg font-semibold text-white">Import Furniture Record</h3>
        <p class="text-sm text-white/60">Confirm the imported date for this furniture item.</p>

        <form id="importForm" method="POST" action="{{ route('imports.store') }}">
            @csrf
            <input type="hidden" name="furniture_id" id="importFurnitureId">
            <div class="space-y-3">
                <div>
                    <label class="block text-white text-sm mb-1">Imported Date</label>
                    <input type="date" name="imported_date" required
                        class="w-full rounded-lg border border-white/20 bg-white/10 text-white p-2 focus:outline-none focus:ring-2 focus:ring-emerald-400/50">
                </div>
            </div>

            <div class="flex justify-end space-x-2 pt-4">
                <button type="button" onclick="closeImportModal()"
                    class="px-4 py-2 text-sm rounded-lg border border-white/20 backdrop-blur-sm bg-white/10 hover:bg-white/20 text-white transition">Cancel</button>
                <button type="submit"
                    class="px-4 py-2 text-sm rounded-lg border border-emerald-400/30 backdrop-blur-sm bg-emerald-500/20 hover:bg-emerald-500/30 text-emerald-300 transition">Import</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openImportModal(furnitureId) {
        document.getElementById('importFurnitureId').value = furnitureId;
        document.getElementById('importAlert').classList.remove('hidden');
    }

    function closeImportModal() {
        document.getElementById('importAlert').classList.add('hidden');
    }
</script>
