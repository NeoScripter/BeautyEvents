jQuery(document).ready(function ($) {
    function showForm() {
        $('#reg-popup').fadeIn();
        $('.signup-form').fadeIn();
        $('.close-reg').show();
        $('.error-messages').text('');
        document.documentElement.style.overflow = 'hidden';
    }

    function closeForm() {
        $('#reg-popup').fadeOut();
        $('.signup-form').fadeOut();
        $('.close-reg').hide();
        document.documentElement.style.overflow = 'auto';
    }

    $('#reg-popup').on('click', (event) => {
        event.stopPropagation();
        closeForm();
    });

    $(document).on('keydown', function (e) {
        if (e.key === 'Escape') {
            closeForm();
        }
    });

    $('.signup-form').on('click', (event) => {
        event.stopPropagation();
    });

    $('#signup-btn').on('click', function () {
        showForm();
    });

    $('#header-signup-btn-mobile').on('click', function () {
        showForm();
    });

    $('#header-signup-btn').on('click', function () {
        showForm();
    });

    $('.close-reg').on('click', function () {
        closeForm();
    });
});
