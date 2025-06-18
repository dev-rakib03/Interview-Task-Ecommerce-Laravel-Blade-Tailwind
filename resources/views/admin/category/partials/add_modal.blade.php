<div id="addCategoryModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-30 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
        <h2 class="text-xl font-semibold mb-4">Add Category</h2>
        <form id="addCategoryForm" action="{{ route('admin.category.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">Name</label>
                <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="flex justify-end">
                <button type="button" class="mr-2 px-4 py-2 rounded bg-gray-300"
                    onclick="closeAddModal()">Cancel</button>
                <button type="submit" class="px-4 py-2 rounded bg-blue-600 text-white">Save</button>
            </div>
        </form>
    </div>
</div>
