<section>
    <h3
        class="font-headings text-2xl text-center uppercase text-balance lg:text-4xl 2xl:text-5xl mb-8 sm:mb-4 text-primary-black">
        We empower beauty professionals to reach new heights
        <span class="text-primary-pink">in income and prestige</span>
    </h3>

    <div
        class="text-balance text-center uppercase font-medium whitespace-pre flex flex-wrap justify-center my-8 lg:my-10">
        <span>launch. packaging. </span>
        <span>branding. promotion. </span>
    </div>

    <?php
    $before_image = get_field("before_image");
    $after_image = get_field("after_image");; ?>
    <div
        class="flex flex-col items-center gap-10 lg:gap-0 my-8 lg:flex-row lg:my-40 2xl:w-4/5 mx-auto">
        <div class="w-4/5 md:w-92 md:mr-auto lg:w-auto">
            <p
                class="font-bold text-sm xs:text-base uppercase text-center mb-4 md:mb-8 lg:mb-12 md:text-xl">
                Trusted by the majority
            </p>
            <img
                src="<?php echo $before_image['url']; ?>"

                alt="<?php echo $before_image['alt']; ?>" />
        </div>
        <div class="w-4/5 md:w-92 md:ml-auto lg:w-auto relative">
            <p
                class="font-bold text-sm xs:text-base uppercase text-center mb-4 md:text-xl text-primary-pink tracking-wider md:absolute md:-top-14 md:left-1/2 md:-translate-x-1/2">
                OUR DOCUMENT
            </p>
            <img
                src="<?php echo $after_image['url']; ?>"
                alt="<?php echo $after_image['alt']; ?>" />
        </div>
    </div>
</section>
