<script src="https://code.jquery.com/jquery-3.7.1.js" crossorigin="anonymous"></script>
<script>
    // Toggle Desktop Dropdown
    $('#categoryToggle').click(function() {
        $('#categoryDropdown').toggle();
    });

    // Toggle Mobile Menu
    $('#mobileMenuToggle').click(function() {
        $('#mobileMenu').slideToggle();
    });

    $(function() {
        var $modal = $('#categoriesModal');
        var $modalContent = $modal.find('> div');

        $('#openCategories').on('click', function() {
            $modal.removeClass('hidden');
            setTimeout(function() {
                $modalContent.css('transform', 'translateY(0)');
            }, 10);
        });

        $('#closeCategories, #categoriesModal').on('click', function(e) {
            if (e.target !== this) return;
            $modalContent.css('transform', 'translateY(100%)');
            setTimeout(function() {
                $modal.addClass('hidden');
            }, 300);
        });
    });

    // CSRF token setup for AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // Close dropdown when clicking outside
    $(document).click(function(e) {
        if (!$(e.target).closest('#categoryToggle').length && !$(e.target).closest('#categoryDropdown')
            .length) {
            $('#categoryDropdown').hide();
        }

        if (!$(e.target).closest('#categoriesModal').length && !$(e.target).closest('#openCategories').length) {
            $('#categoriesModal').find('> div').css('transform', 'translateY(100%)');
            setTimeout(function() {
                $('#categoriesModal').addClass('hidden');
            }, 300);
        }

    });
</script>
@yield('js')
