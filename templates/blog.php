<?php
/*
Template Name: Blog Page
*/

get_header();
?>

<?php get_template_part('includes/section', 'reg.popup'); ?>
<?php get_template_part('includes/home/popup'); ?>
<?php get_template_part('includes/home/hero'); ?>

<main class="main centering">
    this is my blog

    <?php
    if (have_posts()) :
        while (have_posts()) : the_post(); ?>

            <div class="policy-header flex-sb">
                <h1><?php the_title(); ?></h1>
            </div>

    <?php endwhile;
    else :
        echo '<p>No content found</p>';
    endif;
    ?>

</main>

<?php
get_footer();
?>
