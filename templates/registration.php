<?php
/*
Template Name: Registration
*/

get_header('policy');
?>
<div class="reg-outer-wrapper">
    <div class="reg-overlay" id="signup-popup">
        <div class="reg-wrapper signup-form">
            <div class="reg-top">
                <h4>Log in or sign up to get full access to our resources</h4>
                <img class="close-reg" src="<?php echo get_template_directory_uri() . "/assets/images/svgs/form-close.svg"; ?>" alt="Surreal digital collage of a person's face with vibrant pink and red hues, featuring disjointed facial features such as lips and eyes arranged in an abstract and artistic manner.">
            </div>
            <div class="reg-content">
                <div class="reg-form-holder">
                    <div class="reg-floating-form">
                        <?php if (!empty($errors)): ?>
                            <div class="error-messages">
                                <?php foreach ($errors as $error): ?>
                                    <p><?php echo esc_html($error); ?></p>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <h2>Sign up</h2>
                        <div class="form-switch-wrapper">
                            <h3>Already have an account?</h3>
                            <button class="login-switch-btn" id="login-btn">Log in</button>
                        </div>
                        <form method="post" action="" class="reg-form">
                            <input type="text" name="user_login" placeholder="Full name *" required>
                            <input type="email" name="user_email" placeholder="Email *" required>
                            <input type="email" name="user_phone" placeholder="Phone number">
                            <input type="password" name="user_pass" placeholder="Password *" required>
                            <input type="password" name="confirm_pass" placeholder="Confirm Password *" required>
                            <p class="required-fields-notice">*Required fields</p>
                            <label for="privacy-policy" class="privacy-policy-label">
                                <input type="checkbox" name="privacy-policy" required>
                                By clicking the button, you agree to the <a href="https://nextbeautyevent.com/privacy-policy/">Privacy Policy</a>
                            </label>
                            <input type="hidden" name="custom_registration_form" value="1">
                            <input type="submit" value="sign up">
                        </form>
                        <p class="reg-method-divider">or</p>
                        <div class="nextend-social-login-buttons">
                            <?php echo do_shortcode('[nextend_social_login]'); ?>
                        </div>
                    </div>
                </div>
                <div class="reg-bg-img-wrapper"><img class="reg-bg-img" src="<?php echo get_template_directory_uri() . "/assets/images/signup-img.png"; ?>" alt="Surreal digital collage of a person's face with vibrant pink and red hues, featuring disjointed facial features such as lips and eyes arranged in an abstract and artistic manner."></div>
            </div>
        </div>
    </div>
    <div class="reg-overlay">
        <div class="reg-wrapper login-form">
            <div class="reg-top">
                <h4>Log in or sign up to get full access to our resources</h4>
                <img class="close-reg" src="<?php echo get_template_directory_uri() . "/assets/images/svgs/form-close.svg"; ?>" alt="Surreal digital collage of a person's face with vibrant pink and red hues, featuring disjointed facial features such as lips and eyes arranged in an abstract and artistic manner.">
            </div>
            <div class="reg-content">
                <div class="reg-form-holder">
                    <div class="reg-floating-form">
                        <h2>Sign up</h2>
                        <div class="form-switch-wrapper">
                            <h3>Already have an account?</h3>
                            <button class="login-switch-btn" id="signup-btn">Sign up</button>
                        </div>
                        <form method="post" action="<?php echo wp_login_url(); ?>" class="reg-form">
                            <input type="email" name="log" placeholder="Email *" required>
                            <input type="password" name="pwd" placeholder="Password *" required>
                            <p class="required-fields-notice">*Required fields</p>
                            <label for="privacy-policy" class="privacy-policy-label">
                                <input type="checkbox" name="privacy-policy" required>
                                By clicking the button, you agree to the <a href="https://nextbeautyevent.com/privacy-policy/">Privacy Policy</a>
                            </label>
                            <input type="submit" value="Log in">
                        </form>
                        <p class="reg-method-divider">or</p>
                        <div class="nextend-social-login-buttons">
                            <?php echo do_shortcode('[nextend_social_login]'); ?>
                        </div>
                    </div>
                </div>
                <div class="reg-bg-img-wrapper"><img class="reg-bg-img" src="<?php echo get_template_directory_uri() . "/assets/images/login-img.png"; ?>" alt="Surreal digital collage of a person's face with vibrant pink and red hues, featuring disjointed facial features such as lips and eyes arranged in an abstract and artistic manner."></div>
            </div>
        </div>
    </div>
</div>

<!-- Surreal digital collage of a woman's face with multiple overlapping elements including pink flower petals and disjointed facial features, creating an artistic and abstract visual effect. -->
<?php
get_footer('policy');
?>
