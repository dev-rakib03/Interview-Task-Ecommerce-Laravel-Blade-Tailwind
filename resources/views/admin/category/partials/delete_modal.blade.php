<div id="deleteCategoryModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-30 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-sm p-6">
        <h2 class="text-xl font-semibold mb-4">Delete Category</h2>
        <p class="mb-6">Are you sure you want to delete this category?</p>
        <form id="deleteCategoryForm" action="{{ route('admin.category.destroy', ':id') }}" method="POST">
            @csrf
            @method('DELETE')
            <input type="hidden" name="id" id="deleteCategoryId">
            <div class="flex justify-end">
                <button type="button" class="mr-2 px-4 py-2 rounded bg-gray-300"
                    onclick="closeDeleteModal()">Cancel</button>
                <button type="submit" class="px-4 py-2 rounded bg-red-600 text-white">Delete</button>
            </div>
        </form>
    </div>
</div>
