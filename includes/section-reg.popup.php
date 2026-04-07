<div class="reg-overlay" id="reg-popup">
    <div class="reg-wrapper signup-form">
        <div class="reg-top justify-between">
            <h4>Plan your <?php echo date('Y') ?> schedule</h4>
            <img class="close-reg" src="<?php echo get_template_directory_uri() . '/assets/images/svgs/form-close.svg'; ?>" alt="Close">
        </div>
        <p class="text-lg mb-2">Join our list to get notified first to book Early bird tickets.</p>

        <div class="reg-content">
            <div class="reg-form-holder">
                <div class="reg-floating-form">
                    <h2>Sign up</h2>
                    <form id="registration-form" class="reg-form">
                        <input type="text" name="user_login" placeholder="Name" required>
                        <input type="email" name="user_email" placeholder="Email" required>

                        <div class="error-messages" style="display: none;"></div>

                        <label for="privacy-policy" class="privacy-policy-label mt-4">
                            <input type="checkbox" name="privacy_policy" required>
                            By clicking the button, you agree to the <a href="https://nextbeautyevent.com/privacy-policy/">Privacy Policy</a>
                        </label>
                        <input type="hidden" name="custom_registration_form" value="1">
                        <input type="hidden" name="security" value="<?php echo wp_create_nonce('ajax-registration-nonce'); ?>">
                        <input type="submit" value="Keep me updated">
                    </form>
                </div>
            </div>
            <div class="reg-bg-img-wrapper">
                <img class="reg-bg-img" src="<?php echo get_template_directory_uri() . '/assets/images/signup-img.png'; ?>" alt="Sign Up Image">
            </div>
        </div>
    </div>
</div>
