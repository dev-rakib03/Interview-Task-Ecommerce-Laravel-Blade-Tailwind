$(function () {
    // Thumbnail preview
    $("#thumbnailInput").on("change", function (e) {
        let file = e.target.files[0];
        if (file) {
            let reader = new FileReader();
            reader.onload = function (e) {
                $("#thumbnailPreview").attr("src", e.target.result).show();
            };
            reader.readAsDataURL(file);
        } else {
            $("#thumbnailPreview").hide();
        }
    });

    // Images preview
    $("#imagesInput").on("change", function (e) {
        let files = e.target.files;
        $("#imagesPreview").empty();
        if (files.length) {
            Array.from(files).forEach((file) => {
                let reader = new FileReader();
                reader.onload = function (e) {
                    $("#imagesPreview").append(
                        '<img src="' +
                            e.target.result +
                            '" class="h-16 rounded border" />'
                    );
                };
                reader.readAsDataURL(file);
            });
        }
    });

    // AJAX form submit
    $("#productForm").on("submit", function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        $(".error-text").text("");
        $("input, textarea, select").removeClass("border-red-500");

        $.ajax({
            url: $(this).attr("action"),
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if (res.success) {
                    toastr.success(
                        res.message[0] || "Product created successfully!"
                    );
                    $("#productForm")[0].reset();
                    $("#thumbnailPreview").hide();
                    $("#imagesPreview").empty();
                    if (res.redirect) {
                        setTimeout(function () {
                            window.location.href = res.redirect;
                        }, 2000);
                    }
                } else {
                    toastr.error(res.message[0] || "Something went wrong!");
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessages = [];
                    $.each(errors, function (key, val) {
                        let input = $(
                            '[name="' + key + '"], [name="' + key + '[]"]'
                        );
                        input.addClass("border-red-500");
                        $('.error-text[data-error="' + key + '"]').text(val[0]);
                        errorMessages.push(val[0]);
                    });
                    toastr.error(errorMessages.join("<br>"));
                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    toastr.error(
                        xhr.responseJSON.message[0] || "Something went wrong!"
                    );
                } else {
                    toastr.error("Something went wrong!");
                }
            },
        });
    });
});
