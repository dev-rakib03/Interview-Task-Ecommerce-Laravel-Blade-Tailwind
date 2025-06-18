$(document).ready(function () {
    let main = $("#main-carousel");
    let thumbs = $("#thumb-carousel");

    // Initialize both carousels
    main.owlCarousel({
        items: 1,
        loop: false,
        nav: false,
        dots: false,
        smartSpeed: 500,
    });

    thumbs.owlCarousel({
        items: 5,
        margin: 10,
        nav: false,
        dots: false,
    });

    // Function to highlight thumbnail
    function highlightThumbnail(index) {
        $("#thumb-carousel .item").removeClass("ring ring-gray-800");
        $("#thumb-carousel .item").eq(index).addClass("ring ring-gray-800");
    }

    // Sync when main image changes
    main.on("changed.owl.carousel", function (event) {
        let index = event.item.index;
        thumbs.trigger("to.owl.carousel", [index, 300, true]);
        highlightThumbnail(index);
    });

    // Sync when thumbnail is clicked
    $("#thumb-carousel .item").each(function (index) {
        $(this).on("click", function () {
            main.trigger("to.owl.carousel", [index, 300, true]);
            highlightThumbnail(index);
        });
    });

    // Initial highlight
    highlightThumbnail(0);
});
