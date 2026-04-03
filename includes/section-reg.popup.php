<div class="reg-overlay" id="reg-popup">
    <div class="reg-wrapper signup-form">
        <div class="reg-top">
            <h4>Log in or sign up to get full and free access to our resources</h4>
            <img class="close-reg" src="<?php echo get_template_directory_uri() . '/assets/images/svgs/form-close.svg'; ?>" alt="Close">
        </div>
        <div class="reg-content">
            <div class="reg-form-holder">
                <div class="reg-floating-form">
                    <h2>Sign up</h2>
                    <div class="form-switch-wrapper">
                        <h3>Already have an account?</h3>
                        <button class="login-switch-btn" id="login-btn">Log in</button>
                    </div>
                    <form id="registration-form" class="reg-form">
                        <input type="text" name="user_login" placeholder="Full name *" required>
                        <input type="email" name="user_email" placeholder="Email *" required>
                        <input type="tel" name="user_phone" placeholder="Phone number">
                        <input type="password" name="user_pass" placeholder="Password *" required>
                        <input type="password" name="confirm_pass" placeholder="Confirm Password *" required>
                        <p class="required-fields-notice">*Required fields</p>

                        <div class="error-messages" style="display: none;"></div>

                        <label for="privacy-policy" class="privacy-policy-label">
                            <input type="checkbox" name="privacy_policy" required>
                            By clicking the button, you agree to the <a href="https://nextbeautyevent.com/privacy-policy/">Privacy Policy</a>
                        </label>
                        <input type="hidden" name="custom_registration_form" value="1">
                        <input type="hidden" name="security" value="<?php echo wp_create_nonce('ajax-registration-nonce'); ?>">
                        <input type="submit" value="Sign Up">
                    </form>
                    <p class="reg-method-divider">or</p>
                    <div class="nextend-social-login-buttons">
                        <?php echo do_shortcode('[nextend_social_login]'); ?>
                    </div>
                </div>
            </div>
            <div class="reg-bg-img-wrapper"><img class="reg-bg-img" src="<?php echo get_template_directory_uri() . '/assets/images/signup-img.png'; ?>" alt="Sign Up Image"></div>
        </div>
    </div>

    <div class="reg-wrapper login-form">
        <div class="reg-top">
            <h4>Log in or sign up to get full and free access to our resources</h4>
            <img class="close-reg" src="<?php echo get_template_directory_uri() . '/assets/images/svgs/form-close.svg'; ?>" alt="Close">
        </div>
        <div class="reg-content">
            <div class="reg-form-holder">
                <div class="reg-floating-form">
                    <h2>Log in</h2>
                    <div class="form-switch-wrapper">
                        <h3>Don't have an account?</h3>
                        <button class="signup-switch-btn" id="signup-btn">Sign Up</button>
                    </div>
                    <form id="login-form" class="reg-form">
                        <input type="text" name="log" placeholder="Username or Email *" required>
                        <input type="password" name="pwd" placeholder="Password *" required>
                        <p class="required-fields-notice">*Required fields</p>

                        <div class="error-messages" style="display: none;"></div>

                        <label for="privacy-policy" class="privacy-policy-label">
                            <input type="checkbox" name="privacy_policy" required>
                            By clicking the button, you agree to the <a href="https://nextbeautyevent.com/privacy-policy/">Privacy Policy</a>
                        </label>
                        <input type="hidden" name="custom_login_form" value="1">
                        <input type="hidden" name="security" value="<?php echo wp_create_nonce('ajax-login-nonce'); ?>">
                        <input type="submit" value="Log In">
                    </form>
                    <p class="reg-method-divider">or</p>
                    <div class="nextend-social-login-buttons">
                        <?php echo do_shortcode('[nextend_social_login]'); ?>
                    </div>
                </div>
            </div>
            <div class="reg-bg-img-wrapper"><img class="reg-bg-img" src="<?php echo get_template_directory_uri() . '/assets/images/login-img.png'; ?>" alt="Log In Image"></div>
        </div>
    </div>
</div>