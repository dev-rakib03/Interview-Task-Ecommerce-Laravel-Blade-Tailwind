function closeDeleteModal() {
    $("#deleteProductModal").addClass("hidden");
}
$(function () {
    var ProductTable = $("#products-table").DataTable({
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
                data: "thumbnail",
                name: "thumbnail",
                orderable: false,
                searchable: false,
            },
            {
                data: "name",
                name: "name",
            },
            {
                data: "price",
                name: "price",
            },
            {
                data: "sku",
                name: "sku",
            },
            {
                data: "categories",
                name: "categories",
                orderable: false,
                searchable: false,
            },
            {
                data: "status",
                name: "status",
            },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
    });

    // Delete button click
    $(document).on("click", ".delete-product", function () {
        $("#deleteProductId").val($(this).data("id"));
        $("#deleteProductModal").removeClass("hidden");
    });

    $("#deleteProductForm").on("submit", function (e) {
        e.preventDefault();
        var $form = $(this);
        var id = $("#deleteProductId").val();
        var url = $form.attr("action").replace(":id", id);
        $.ajax({
            url: url,
            method: "POST",
            data: $form.serialize(),
            success: function (res) {
                if (res.success) {
                    closeDeleteModal();
                    ProductTable.ajax.reload();
                    toastr.success(
                        res.message && res.message[0]
                            ? res.message[0]
                            : "Product deleted successfully!"
                    );
                } else {
                    toastr.error(
                        res.message && res.message[0]
                            ? res.message[0]
                            : "Failed to delete product."
                    );
                }
            },
            error: function (xhr) {
                toastr.error("Failed to delete product.");
            },
        });
    });
});
