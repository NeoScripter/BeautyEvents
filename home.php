<?php

get_header();
?>

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

<main class="main centering px-6 py-10 max-w-7xl mx-auto">
    <ul class="grid grid-cols-[repeat(auto-fit,minmax(300px,1fr))] gap-6">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <li class="flex flex-col rounded-2xl overflow-hidden shadow-md bg-white">

                    <?php if (has_post_thumbnail()) : ?>
                        <figure class="w-full h-56 overflow-hidden">
                            <?php the_post_thumbnail('medium_large', ['class' => 'w-full h-full object-cover']); ?>
                        </figure>
                    <?php endif; ?>

                    <div class="flex flex-col flex-1 p-5 gap-3">
                        <h2 class="text-xl font-bold text-gray-900"><?php the_title(); ?></h2>

                        <div class="text-gray-600 text-sm leading-relaxed line-clamp-3">
                            <?php the_excerpt(); ?>
                        </div>

                        <div class="mt-auto pt-4">
                            <a href="<?php the_permalink(); ?>"
                               class="inline-block bg-pink-600 text-white text-sm font-medium px-5 py-2 rounded-lg hover:bg-pink-700 transition-colors">
                                Read more
                            </a>
                        </div>
                    </div>

                </li>
            <?php endwhile; ?>
        <?php else : ?>
            <p class="text-gray-500 col-span-full text-center">No posts found</p>
        <?php endif; ?>
    </ul>

</main>

<?php
get_footer();
?>
