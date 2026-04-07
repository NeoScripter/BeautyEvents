<?php get_header(); ?>
<?php get_template_part('includes/section', 'reg.popup'); ?>
<?php get_template_part('includes/home/popup'); ?>

<div class="wrapper" id="banner">
    <div class="banner banner-blog">
        <div class="banner-content">
            <h1 class="main-heading">
                BLOG
                <br>
                <span class="main-heading-span-large"> BEAUTY <span class="pink-font-color">EVENTS</span>
                </span>
            </h1>
        </div>
    </div>
</div>

<main class="px-6 py-12 max-w-7xl mx-auto">

    <!-- Back link -->
    <a href="<?php echo get_post_type_archive_link('post'); ?>"
       class="inline-flex items-center gap-2 text-sm text-pink-600 hover:text-pink-800 mb-8 transition-colors">
        &larr; Back to Blog
    </a>

    <article class="bg-white rounded-3xl prose prose-sm max-w-full shadow-lg overflow-hidden">

        <!-- Thumbnail -->
        <?php if (has_post_thumbnail()) : ?>
            <figure class="w-full h-72 overflow-hidden">
                <?php the_post_thumbnail('large', ['class' => 'w-full h-full object-cover']); ?>
            </figure>
        <?php endif; ?>

        <div class="p-8 flex flex-col gap-6">

            <!-- Meta -->
            <div class="flex items-center gap-4 text-sm text-gray-400">
                <span><?php echo get_the_date(); ?></span>
            </div>

            <!-- Title -->
            <h1 class="text-3xl font-bold text-gray-900 leading-tight">
                <?php the_title(); ?>
            </h1>

            <!-- Divider -->
            <hr class="border-pink-100">

            <!-- Content -->
            <div class="max-w-none text-gray-700 leading-relaxed">
                <?php get_template_part('includes/section', 'blogcontent'); ?>
            </div>

            <!-- Page links (for multi-page posts) -->
            <?php wp_link_pages([
                'before'    => '<div class="flex gap-2 flex-wrap pt-4 border-t border-gray-100">',
                'after'     => '</div>',
                'link_before' => '<span class="px-3 py-1 rounded-lg border border-pink-300 text-pink-600 text-sm hover:bg-pink-50">',
                'link_after'  => '</span>',
            ]); ?>

        </div>
    </article>

    <!-- Prev / Next navigation -->
    <nav class="mt-10 grid grid-cols-2 gap-4">
        <?php
        $prev = get_previous_post();
        $next = get_next_post();
        ?>
        <?php if ($prev) : ?>
            <a href="<?php echo get_permalink($prev); ?>"
               class="flex flex-col gap-1 bg-white rounded-2xl shadow p-5 hover:shadow-md transition-shadow">
                <span class="text-xs text-gray-400">&larr; Previous</span>
                <span class="text-sm font-medium text-gray-800"><?php echo get_the_title($prev); ?></span>
            </a>
        <?php else : ?>
            <div></div>
        <?php endif; ?>

        <?php if ($next) : ?>
            <a href="<?php echo get_permalink($next); ?>"
               class="flex flex-col gap-1 bg-white rounded-2xl shadow p-5 hover:shadow-md transition-shadow text-right">
                <span class="text-xs text-gray-400">Next &rarr;</span>
                <span class="text-sm font-medium text-gray-800"><?php echo get_the_title($next); ?></span>
            </a>
        <?php endif; ?>
    </nav>

</main>

<?php get_footer(); ?>
