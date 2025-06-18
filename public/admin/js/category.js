function closeAddModal() {
    $("#addCategoryModal").addClass("hidden");
    $("#addCategoryForm")[0].reset();
}

function closeEditModal() {
    $("#editCategoryModal").addClass("hidden");
    $("#editCategoryForm")[0].reset();
}

function closeDeleteModal() {
    $("#deleteCategoryModal").addClass("hidden");
}
// Category Table
$(document).ready(function () {
    var categoriesTable = $("#categories-table").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: $(this).data("href"),
            type: "GET",
        },
        columns: [
            {
                data: "sl",
                name: "sl",
                orderable: false,
                searchable: false,
            },
            {
                data: "name",
                name: "name",
            },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
    });

    // Add Category Modal
    $("#addCategoryBtn").on("click", function () {
        $("#addCategoryModal").removeClass("hidden");
    });

    $("#addCategoryForm").on("submit", function (e) {
        e.preventDefault();
        var $form = $(this);
        var url = $form.attr("action");
        $.ajax({
            url: url,
            method: "POST",
            data: $form.serialize(),
            success: function (res) {
                if (res.success) {
                    closeAddModal();
                    categoriesTable.ajax.reload();
                    toastr.success(
                        res.message && res.message[0]
                            ? res.message[0]
                            : "Category added successfully!"
                    );
                } else {
                    toastr.error(
                        res.message && res.message[0]
                            ? res.message[0]
                            : "Failed to add category."
                    );
                }
            },
            error: function (xhr) {
                toastr.error("Failed to add category.");
            },
        });
    });

    // Edit Category Modal
    $(document).on("click", ".edit-category", function () {
        $("#editCategoryId").val($(this).data("id"));
        $("#editCategoryName").val($(this).data("name"));
        $("#editCategoryModal").removeClass("hidden");
    });

    $("#editCategoryForm").on("submit", function (e) {
        e.preventDefault();
        var $form = $(this);
        var id = $("#editCategoryId").val();
        var url = $form.attr("action").replace(":id", id);
        $.ajax({
            url: url,
            method: "POST",
            data: $form.serialize(),
            success: function (res) {
                if (res.success) {
                    closeEditModal();
                    categoriesTable.ajax.reload();
                    toastr.success(
                        res.message && res.message[0]
                            ? res.message[0]
                            : "Category updated successfully!"
                    );
                } else {
                    toastr.error(
                        res.message && res.message[0]
                            ? res.message[0]
                            : "Failed to update category."
                    );
                }
            },
            error: function (xhr) {
                toastr.error("Failed to update category.");
            },
        });
    });

    // Delete Category Modal
    $(document).on("click", ".delete-category", function () {
        $("#deleteCategoryId").val($(this).data("id"));
        $("#deleteCategoryModal").removeClass("hidden");
    });

    $("#deleteCategoryForm").on("submit", function (e) {
        e.preventDefault();
        var $form = $(this);
        var id = $("#deleteCategoryId").val();
        var url = $form.attr("action").replace(":id", id);
        $.ajax({
            url: url,
            method: "POST",
            data: $form.serialize(),
            success: function (res) {
                if (res.success) {
                    closeDeleteModal();
                    categoriesTable.ajax.reload();
                    toastr.success(
                        res.message && res.message[0]
                            ? res.message[0]
                            : "Category deleted successfully!"
                    );
                } else {
                    toastr.error(
                        res.message && res.message[0]
                            ? res.message[0]
                            : "Failed to delete category."
                    );
                }
            },
            error: function (xhr) {
                toastr.error("Failed to delete category.");
            },
        });
    });
});
