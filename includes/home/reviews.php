<section>
    <h3
        class="font-headings text-2xl text-center uppercase text-balance lg:text-4xl 2xl:text-5xl mb-6 lg:my-12 text-primary-pink">
        Reviews
    </h3>

    <div>
        <?php
        $reviews = get_field('review_images');

        if ($reviews): ?>
            <div
                class="grid gap-2 lg:gap-4 grid-flow-col overflow-x-auto scrollbar-hidden justify-start">
                <?php foreach ($reviews as $image): ?>

                    <div class="w-92 lg:w-88 overflow-clip h-125 lg:h-145">
                        <img
                            src="<?= esc_url(is_array($image) ? $image['url'] : $image); ?>"
                            alt="<?= esc_attr(is_array($image) ? $image['alt'] : ''); ?>"
                            class="object-center object-contain h-full w-full" />
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>


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
    </div>

</section>
