jQuery(document).ready(function ($) {
    if (!popupData.is_user_logged_in) {
        // $('.event-join').on('click', (event) => {
        //     event.preventDefault();
        //     $('#reg-popup').fadeIn();
        //     $('.signup-form').fadeIn();
        // });

        // $('#see-more-button').on('click', event => {
        //     event.preventDefault();
        //     $('#reg-popup').fadeIn();
        //     $('.signup-form').fadeIn();
        // });

        $('#reg-popup').on('click', (event) => {
            event.stopPropagation();
            $('#reg-popup').fadeOut();
            $('.signup-form').fadeOut();
        });

        $('#login-popup').on('click', (event) => {
            event.stopPropagation();
            $('#login-popup').fadeOut();
            $('.login-form').fadeOut();
        });

        $(document).on('keydown', function (e) {
            if (e.key === 'Escape') {
                $('#login-popup').fadeOut();
                $('.login-form').fadeOut();
                $('#reg-popup').fadeOut();
                $('.signup-form').fadeOut();
            }
        });

        $('.signup-form').on('click', (event) => {
            event.stopPropagation();
        });

        $('.login-form').on('click', (event) => {
            event.stopPropagation();
        });

        $('.custom-dropdown-button').on('click', (event) => {
            event.preventDefault();
            $('#reg-popup').fadeIn();
            $('.signup-form').fadeIn();
        });

        $('.view-all-button').on('click', (event) => {
            event.preventDefault();
            $('#reg-popup').fadeIn();
            $('.signup-form').fadeIn();
        });

        $('#login-btn').on('click', function () {
            $('.signup-form').fadeOut();
            $('.login-form').fadeIn();
            $('.error-messages').text('');
        });

        $('#signup-btn').on('click', function () {
            $('.login-form').fadeOut();
            $('.signup-form').fadeIn();
            $('.error-messages').text('');
        });

        $('#header-login-btn').on('click', function () {
            $('#reg-popup').fadeIn();
            $('.signup-form').fadeOut();
            $('.login-form').fadeIn();
            $('.close-reg').show();
        });

        $('#header-signup-btn').on('click', function () {
            $('#reg-popup').fadeIn();
            $('.login-form').fadeOut();
            $('.signup-form').fadeIn();
            $('.close-reg').show();
        });

        $('.close-reg').on('click', function () {
            $('#reg-popup').fadeOut();
        });
    }
});
