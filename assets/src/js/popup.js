jQuery(document).ready(function ($) {
    function showForm() {
        document.getElementById('reg-popup').classList.add('active');
        $('.signup-form').fadeIn();
        $('.close-reg').show();
        $('.error-messages').text('');
        document.documentElement.style.overflow = 'hidden';
    }

    function closeForm() {
        document.getElementById('reg-popup').classList.remove('active');
        $('.signup-form').fadeOut();
        $('.close-reg').hide();
        document.documentElement.style.overflow = 'auto';
    }

    if (!popupData.is_user_logged_in) {
        setTimeout(showForm, 1000 * 90);
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
