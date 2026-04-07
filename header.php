<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-M85XCNT5');</script>
    <!-- End Google Tag Manager -->
     <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M85XCNT5"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <title><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>
<body>
<header class="header header-primary flex-sb centering">
    <img src="http://nextbeautyevent.com/wp-content/uploads/2024/07/logo.webp" alt="logo" class="primary-logo">
    <nav class="nav nav-primary">
        <ul class="flex-sb">
            <li><a href="/#events">Events</a></li>
            <li><a href="/#about-us">About us</a></li>
            <li><a href="/#partners">Our partners</a></li>
            <li><a href="/#contacts">Contacts</a></li>
        </ul>
    </nav>
    <div class="header-btn-group flex-sb">
        <a href="/#contacts" class="btn-header host-event-btn">Host your event<?php include get_template_directory() . '/assets/images/svgs/top-right-corner-arrow.svg'; ?></a>
        <?php if ( ! is_user_logged_in() ) : ?>
            <button class="btn-header signup-btn" id="header-signup-btn">Newsletter</button>
        <?php endif; ?>
    </div>
    <img src="<?php echo get_template_directory_uri() . '/assets/images/svgs/burger-menu-closed.svg';?>" alt="burger-menu" class="burger-menu" tabindex="0">
</header>
