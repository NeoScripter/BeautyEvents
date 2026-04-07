<?php

get_header();
?>

<?php get_template_part('includes/section', 'reg.popup'); ?>
<?php get_template_part('includes/home/popup'); ?>
<?php get_template_part('includes/home/hero'); ?>

<main class="main centering">
    <section class="event-list" id="events">
        <form method="get" action="<?php echo esc_url(home_url("/") . '#events'); ?>" class="event-filter-form">
            <?php include get_template_directory() . "/includes/filter-content.php"; ?>
        </form>
        <?php
        $total_events = 12;
        $top_events_count = 6;
        $bottom_events_count = $total_events - $top_events_count;
        $increment_step = 12;
        ?>
        <div class="event-grid-group" id='event-grid-top'>
            <?php echo render_events($top_events_count); ?>
        </div>
        <?php get_template_part('includes/home/partners'); ?>

        <div class="event-grid-group" id='event-grid-bottom'>
            <?php echo render_events($bottom_events_count, $top_events_count); ?>
        </div>
        <button
            id="see-more-button"
            data-total="<?php echo $total_events; ?>"
            data-top="<?php echo $top_events_count; ?>"
            data-bottom="<?php echo $bottom_events_count; ?>"
            data-increment="<?php echo $increment_step; ?>">
            See More 
            <?php include get_template_directory() . "/assets/images/svgs/top-right-corner-arrow.svg"; ?>
        </button>
    </section>



    <div class="mt-8">
        <div
            class="px-2 xs:px-7 sm:px-10 md:px-3 lg:px-10 bg-white py-4 md:py-8 max-w-[1616px] mx-auto text-primary-black">
            <h3
                class="font-headings text-2xl text-center text-balance lg:text-4xl 2xl:text-5xl mb-8 sm:mb-4 text-primary-black">
                READY-MADE TRAINING MATERIALS FOR BEAUTY TRANERS:
            </h3>

            <h2
                class="font-headings text-primary-pink uppercase font-bold text-2xl text-center text-balance lg:text-4xl 2xl:text-6xl mb-8">
                Stylish Training That Brings Profit
            </h2>

            <?php get_template_part('includes/home/materials'); ?>

            <a
                href="#contact-form-bottom"
                class="flex mx-auto w-max text-lg items-center justify-center gap-2 my-12 lg:my-16 xl:mt-20 rounded-full border border-primary-pink py-3 px-6 font-medium uppercase text-primary-pink transition-colors duration-300 ease-in-out hover:bg-primary-pink hover:text-white">
                <span>free consultation</span>
                <img
                    src="<?php echo get_template_directory_uri() .
                                "/assets/images/svgs/arrow-btn.svg"; ?>"
                    class="w-3 h-3"
                    alt="pink arrow" />
            </a>

            <?php get_template_part('includes/home/benefits'); ?>


            <div
                class="overflow-x-auto mt-8 lg:mt-14 2xl:mt-20 scrollbar-hidden select-none">
                <div
                    class="flex gap-4 w-[1300px] xl:w-[1400px] xl:gap-6 mx-auto"
                    id="benefits-grid">
                    <?php if (have_rows('result_slider')): while (have_rows('result_slider')): the_row(); ?>
                            <div
                                class="p-6 rounded-2xl border border-gray-200 w-70 lg:w-100">
                                <span
                                    class="font-medium uppercase mb-4 flex items-end justify-center gap-2">
                                    <span class="benefits-prefix block"><?php echo get_sub_field('prefix'); ?></span>
                                    <span
                                        class="text-primary-pink text-6xl font-bold benefits-number"><?php echo get_sub_field('number'); ?></span>
                                </span>
                                <div
                                    class="text-center text-balance text-sm benefits-content"><?php echo get_sub_field('content'); ?></div>
                            </div>
                    <?php endwhile;
                    endif; ?>
                </div>
            </div>
            <div
                class="flex items-center gap-2 mt-8 mx-auto w-max xl:hidden">
                <img
                    src="<?php echo get_template_directory_uri() .
                                "/assets/images/svgs/card-scroll-left.svg"; ?>"
                    alt="scroll to the left"
                    class="w-8 h-5" />
                <img
                    src="<?php echo get_template_directory_uri() .
                                "/assets/images/svgs/card-scroll-right.svg"; ?>"
                    alt="scroll to the right"
                    class="w-8 h-5" />
            </div>

            <a
                href="#contact-form-bottom"
                class="flex mx-auto text-lg items-center justify-center gap-2 my-12 lg:my-16 xl:mt-20 text-balance text-center lg:w-max md:max-w-max rounded-full border border-primary-pink py-3 px-6 font-medium uppercase text-primary-pink transition-colors duration-300 ease-in-out hover:bg-primary-pink hover:text-white">
                <span>Start TRAIN with the best training materials now</span>
                <img
                    src=" <?php echo get_template_directory_uri() .
                                "/assets/images/svgs/arrow-btn.svg"; ?>"
                    class="w-3 h-3"
                    alt="pink arrow" />
            </a>

            <h3
                class="font-headings text-2xl text-center uppercase text-balance lg:text-4xl 2xl:text-5xl lg:my-12 mb-6 text-primary-black">
                Our clients
            </h3>

            <?php get_template_part('includes/home/logo-wall'); ?>

            <?php get_template_part('includes/home/reviews'); ?>
        </div>
    </div>

    <?php get_template_part('includes/home/webform'); ?>

</main>


<?php get_footer(); ?>
