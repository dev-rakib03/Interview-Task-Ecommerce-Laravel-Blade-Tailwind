$(document).ready(function () {
    let container = $("#all-products");
    let fetchUrl = container.data("href");
    let nextPageUrl = fetchUrl;
    let loading = false;

    let loader = $(
        '<div id="product-loader" class="text-center py-4"><span class="loader"></span></div>'
    );

    if (!$("style#product-loader-style").length) {
        $("head").append(`<style id="product-loader-style">
                .loader {
                display: inline-block;
                width: 32px;
                height: 32px;
                border: 4px solid #f3f3f3;
                border-top: 4px solid #3498db;
                border-radius: 50%;
                animation: spin 1s linear infinite;
                }
                @keyframes spin {
                0% { transform: rotate(0deg);}
                100% { transform: rotate(360deg);}
                }
            </style>`);
    }

    function showLoader() {
        if (!$("#product-loader").length) {
            container.after(loader);
        }
    }

    function hideLoader() {
        $("#product-loader").remove();
    }

    function loadProducts(reset = false) {
        loading = true;
        showLoader();
        $('#mobile-filter').addClass('hidden');
        let selectedCategory =
            $(".category-filter.bg-gray-100").data("category") || "";
        let selectedPrice = $("#price-range").val() || "";

        let params = {
            category: selectedCategory,
            min: $("#min-price-input").val(),
            max: $("#max-price-input").val(),
        };

        let url = fetchUrl + "?" + $.param(params);

        if (reset) {
            container.empty();
            nextPageUrl = url;
        }

        $.ajax({
            url: reset ? url : nextPageUrl,
            method: "GET",
            dataType: "json",
            success: function (res) {
                if (res.success) {
                    if (res.products === "") {
                        container.append(
                            '<div class="col-span-full text-center text-gray-500 py-8">No product found.</div>'
                        );
                        nextPageUrl = null;
                    } else {
                        container.append(res.products);
                        nextPageUrl = res.next_page_url;
                    }
                }
            },
            complete: function () {
                loading = false;
                hideLoader();
            },
        });
    }

    $(document).on("click", ".category-filter", function () {
        $(".category-filter").removeClass("bg-gray-100");
        $(this).addClass("bg-gray-100");
        loadProducts(true);
    });

    $("#price-range").on("change", function () {
        loadProducts(true);
    });

    loadProducts();

    $(window).on("scroll", function () {
        if (!loading && nextPageUrl) {
            if (
                $(window).scrollTop() + $(window).height() >=
                $(document).height() - 200
            ) {
                loadProducts();
            }
        }
    });

    let touchStartY = 0;
    $(window).on("touchstart", function (e) {
        touchStartY = e.originalEvent.touches[0].clientY;
    });

    $(window).on("touchend", function (e) {
        let touchEndY = e.originalEvent.changedTouches[0].clientY;
        if (touchEndY - touchStartY > 100) {
            loadProducts();
        }
    });
});

$("#price-range").on("input", function () {
    let value = $(this).val();
    $("#max-price-input").val(value);
});

$("#min-price-input, #max-price-input").on("input", function () {
    let minInput = $("#min-price-input");
    let maxInput = $("#max-price-input");
    let min = parseInt(minInput.val());
    let max = parseInt(maxInput.val());
    let sliderMin = parseInt(minInput.attr("min"));
    let sliderMax = parseInt(maxInput.attr("max"));

    if (min < sliderMin) {
        min = sliderMin;
    }
    if (max > sliderMax || min > sliderMax) {
        max = sliderMax;
    }

    minInput.val(min);
    maxInput.val(max);

    let range = $("#price-range");
    range.attr("min", min);

    if (min <= max) {
        range.val(max);
    }
    loadProducts(true);
});
