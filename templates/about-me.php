<?php
/*
Template Name: About Me
*/

get_header();
?>

<?php get_template_part('includes/section', 'reg.popup'); ?>
<?php get_template_part('includes/home/popup'); ?>

<div class="wrapper" id="banner">
    <div class="banner banner-about">
        <div class="banner-content">
        </div>
    </div>
</div>

<main class="px-3 md:px-6 py-6 md:py-12 max-w-7xl mx-auto">

    <article class="bg-white rounded-3xl shadow-lg overflow-hidden">

        <!-- Two column layout: image + intro -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-0">

            <!-- Left: portrait / extra image via ACF -->
            <div class="relative bg-pink-50 flex items-center justify-center p-10">
                <?php if (get_field('portrait')) : ?>
                    <img src="<?php the_field('portrait'); ?>"
                        alt="<?php the_title(); ?>"
                        class="rounded-2xl shadow-lg max-h-[480px] object-cover w-full">
                <?php else : ?>
                    <?php the_post_thumbnail('large', ['class' => 'rounded-2xl shadow-lg max-h-[480px] object-cover w-full']); ?>
                <?php endif; ?>

                <!-- Decorative blob -->
                <div class="absolute -top-10 -left-10 w-40 h-40 bg-pink-200 rounded-full opacity-30 blur-3xl"></div>
                <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-pink-300 rounded-full opacity-20 blur-3xl"></div>
            </div>

            <!-- Right: name + intro text -->
            <div class="flex flex-col justify-center gap-6 p-10">
                <span class="text-xs uppercase tracking-widest text-pink-400 font-semibold">About me</span>
                <h1 class="text-2xl md:text-4xl font-bold text-gray-900 leading-tight">
                    <?php the_title(); ?>
                </h1>
                <hr class="border-pink-100 w-16">
                <div class="text-gray-600 leading-relaxed md:text-lg">
                    <?php the_excerpt(); ?>
                </div>

                <!-- Social links via ACF (optional) -->
                <?php if (get_field('instagram')) : ?>
                    <a href="<?php the_field('instagram'); ?>" target="_blank"
                        class="inline-flex items-center gap-2 text-sm text-pink-600 hover:text-pink-800 transition-colors font-medium">
                        &#x2192; Follow on Instagram
                    </a>
                <?php endif; ?>
            </div>

        </div>

        <!-- Full content below -->
        <div class="px-10 py-12 border-t border-pink-50">
            <div class="max-w-5xl mx-auto">

                <span class="text-xs uppercase tracking-widest text-pink-400 font-semibold">My Story</span>
                <div class="mt-6 text-gray-700 leading-relaxed prose prose-sm md:prose-lg max-w-none">
                    <?php the_content(); ?>
                </div>

            </div>
        </div>

    </article>

</main>

<?php get_footer(); ?>
