<div class="popup-menu-overlay">
    <div class="popup-menu">
        <div class="popup-menu__logo-wrapper">
            <img src="http://nextbeautyevent.com/wp-content/uploads/2024/07/logo.webp" alt="logo" class="logo-small">
            <img src="<?php echo get_template_directory_uri() .
                            "/assets/images/svgs/burger-menu-open.svg"; ?>" alt="burger-menu" class="close-burger-menu">
        </div>
        <nav class="nav nav-secondary">
            <ul class="flex-sb">
                <li><a href="/#events">Events</a></li>
                <li><a href="/#about-us">About us</a></li>
                <li><a href="/#partners">Our partners</a></li>
                <li><a href="/#contacts">Contacts</a></li>
            </ul>
        </nav>
        <div class="popup-menu__btn-wrapper">
            <div class="flex-sb">
                <?php if (! is_user_logged_in()) : ?>
                    <button class="btn-header signup-btn" id="header-signup-btn-mobile">Newsletter</button>
                <?php endif; ?>
            </div>
            <a href="/#contacts" class="btn-header host-event-btn">
                Host your event <?php include get_template_directory() . "/assets/images/svgs/top-right-corner-arrow.svg"; ?>
            </a>
        </div>
        <div>
            <div class="popup-menu-bottom">
                <div>
                    <h3>Reach out to us</h3>
                    <p>and share details about your project.</p>
                </div>
                <div>
                    <h4>E-mail:</h4>
                    <p>beautytd2022@gmail.com</p>
                </div>
                <div class="flex-sb svg-group">
                    <a class="header-svg-link" href="https://t.me/beauty_training_design">
                        <?php include get_template_directory() . "/assets/images/svgs/telegram.svg"; ?>
                    </a>
                    <a class="header-svg-link insta" href="https://www.instagram.com/beauty4online?igsh=MW53bW96djlmam9pZQ==">
                        <?php include get_template_directory() . "/assets/images/svgs/insta.svg"; ?>
                    </a>
                    <a class="header-svg-link" href="https://www.facebook.com/profile.php?id=100088276970688&mibextid=LQQJ4d">
                        <?php include get_template_directory() . "/assets/images/svgs/fb.svg"; ?>
                    </a>
                    <a class="header-svg-link" href="https://pin.it/2xZ05rpes">
                        <?php include get_template_directory() . "/assets/images/svgs/pininterest.svg"; ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
