$(function () {
    var $carousel = $("#hero-carousel");
    var slides = $carousel.children().length;
    var index = 0;
    var interval;

    function showSlide(i) {
        $carousel.css("transform", "translateX(-" + i * 100 + "%)");
    }

    $("#prev-slide").on("click", function () {
        index = (index - 1 + slides) % slides;
        showSlide(index);
    });

    $("#next-slide").on("click", function () {
        index = (index + 1) % slides;
        showSlide(index);
    });

    function startAutoSlide() {
        interval = setInterval(function () {
            index = (index + 1) % slides;
            showSlide(index);
        }, 5000);
    }

    function stopAutoSlide() {
        clearInterval(interval);
    }

    // Pause on hover
    $carousel.parent().hover(stopAutoSlide, startAutoSlide);

    showSlide(index);
    startAutoSlide();
});

$(document).ready(function () {
    let container = $("#all-products");
    let fetchUrl = container.data("href");
    let nextPageUrl = fetchUrl;
    let loading = false;

    // Loader element
    let loader = $(
        '<div id="product-loader" class="text-center py-4"><span class="loader"></span></div>'
    );
    // Simple loader CSS (you can move this to your CSS file)
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

    function loadProducts() {
        if (!nextPageUrl || loading) return;

        loading = true;
        showLoader();

        $.ajax({
            url: nextPageUrl,
            method: "GET",
            dataType: "json",
            success: function (res) {
                if (res.success) {
                    container.append(res.products);
                    nextPageUrl = res.next_page_url;
                }
            },
            complete: function () {
                loading = false;
                hideLoader();
            },
        });
    }

    // Initial load
    loadProducts();

    // Infinite scroll
    $(window).on("scroll", function () {
        if (
            $(window).scrollTop() + $(window).height() >=
            $(document).height() - 200
        ) {
            loadProducts();
        }
    });

    // Optional swipe down to load
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
