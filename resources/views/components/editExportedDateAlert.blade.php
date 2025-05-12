<div id="editExportedDateAlert" style="display: none;"
    class="fixed inset-0 bg-black/50 z-50 flex justify-center items-center">
    <div class="backdrop-blur-sm bg-slate-800 p-8 rounded-xl w-96 space-y-6 shadow-lg">
        <h3 class="text-2xl font-semibold text-white">Edit Exported Date</h3>

        <form id="editExportedDateForm" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="export_id" id="edit_export_id" value="">
            <div class="space-y-4">
                <label for="exported_date" class="block text-sm font-medium text-white/80">New Exported Date</label>
                <input type="date" name="exported_date" id="exported_date" required
                    class="w-full p-4 border border-white/30 rounded-md bg-white/15 text-white focus:outline-none focus:ring-2 focus:ring-indigo-400">
            </div>

            <div class="flex justify-end mt-3 space-x-4">
                <button type="button" onclick="closeEditExportedDateAlert()"
                    class="px-6 py-3 text-sm bg-gray-600 text-white rounded-lg hover:bg-gray-500 transition">Cancel</button>
                <button type="submit"
                    class="px-6 py-3 text-sm bg-indigo-600 text-white rounded-lg hover:bg-indigo-500 transition">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Close the modal
    function closeEditExportedDateAlert() {
        document.getElementById('editExportedDateAlert').style.display = 'none';
    }

function openEditExportedDateAlert(export_id) {
    const form = document.getElementById('editExportedDateForm');
    form.action = '/exports/' + export_id;
    document.getElementById('editExportedDateAlert').style.display = 'flex';
}

</script>
