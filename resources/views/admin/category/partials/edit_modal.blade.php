<div id="editCategoryModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-30 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
        <h2 class="text-xl font-semibold mb-4">Edit Category</h2>
        <form id="editCategoryForm" action="{{ route('admin.category.update', ':id') }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="editCategoryId">
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Name</label>
                <input type="text" name="name" id="editCategoryName" class="w-full border rounded px-3 py-2"
                    required>
            </div>
            <div class="flex justify-end">
                <button type="button" class="mr-2 px-4 py-2 rounded bg-gray-300"
                    onclick="closeEditModal()">Cancel</button>
                <button type="submit" class="px-4 py-2 rounded bg-blue-600 text-white">Update</button>
            </div>
        </form>
    </div>
</div>
