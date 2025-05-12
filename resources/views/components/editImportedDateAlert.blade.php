<div id="editImportedDateAlert" style="display: none;" class="fixed inset-0 bg-black/50 z-50 flex justify-center items-center">
    <div class="backdrop-blur-sm bg-slate-800 p-8 rounded-xl w-96 space-y-6 shadow-lg">
        <h3 class="text-2xl font-semibold text-white">Edit Imported Date</h3>

        <form id="editImportedDateForm" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="edit_import_id" value="">
            <div class="space-y-4">
                <label for="imported_date" class="block text-sm font-medium text-white/80">New Imported Date</label>
                <input type="date" name="imported_date" id="imported_date" required class="w-full p-4 border border-white/30 rounded-md bg-white/15 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400">
            </div>

            <div class="flex justify-end mt-3 space-x-4">
                <button type="button" onclick="closeEditImportedDateAlert()" class="px-6 py-3 text-sm bg-gray-600 text-white rounded-lg hover:bg-gray-500 transition">Cancel</button>
                <button type="submit" class="px-6 py-3 text-sm bg-indigo-600 text-white rounded-lg hover:bg-indigo-500 transition">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Function to close the modal
    function closeEditImportedDateAlert() {
        document.getElementById('editImportedDateAlert').style.display = 'none';
    }

    // Function to open the modal and set the furniture_id
function openEditImportedDateAlert(import_id) {
    const form = document.getElementById('editImportedDateForm');
    form.action = '/imports/' + import_id;
    document.getElementById('editImportedDateAlert').style.display = 'flex';
}
</script>
