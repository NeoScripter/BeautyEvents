<section class="mb-20 mt-10 md:mb-30 md:mt-15">
    <h2 class="ads-heading flex-sb">Broaden your network
        <div class="arrow-holder flex-sb">
            <div class="carousel-arrow prev"><?php include get_template_directory() . "/assets/images/svgs/carousel-arrow-left.svg"; ?></div>
            <div class="carousel-arrow next"><?php include get_template_directory() . "/assets/images/svgs/carousel-arrow-right.svg"; ?></div>
        </div>
    </h2>
    <div class="carousel-wrapper" id="partners">
        <div class="carousel-track-container">
            <ul class="carousel-track">
                <?php
                $num_ads = 20;
                $ads_found = false;

                for ($i = 1; $i <= $num_ads; $i++) {

                    $image = get_field("partner_ad_image_" . $i);
                    $link = get_field("partner_ad_link_" . $i);

                    if (!$image || !$link) {
                        break;
                    }

                    $ads_found = true;
                ?>
                    <li class="carousel-slide">
                        <a href="<?php echo esc_url($link); ?>">
                            <img src="<?php echo esc_url(is_array($image) ? $image["url"] : $image); ?>"
                                alt="<?php echo esc_attr(is_array($image) ? $image["alt"] : ""); ?>">
                        </a>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>
</section>
