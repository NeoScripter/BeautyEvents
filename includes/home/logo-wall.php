<div class="mb-8">
    <?php
    $clients = get_field('client_images');

    if ($clients): ?>
        <div
            class="grid gap-2 lg:gap-4 grid-cols-2 md:grid-cols-[repeat(auto-fit,minmax(22rem,1fr))] place-content-center place-items-center">
            <?php foreach ($clients as $image): ?>

                <div class="lg:w-88 overflow-clip aspect-video">
                    <img
                        src="<?= esc_url(is_array($image) ? $image['url'] : $image); ?>"
                        alt="<?= esc_attr(is_array($image) ? $image['alt'] : ''); ?>"
                        class="object-center object-cover h-full w-full" />
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div
        class="hidden lg:flex items-center gap-2 mt-8 mx-auto w-max xl:hidden">
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
