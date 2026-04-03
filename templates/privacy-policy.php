<?php
/*
Template Name: Privacy Policy
*/

get_header('policy');
?>

<div class="policy-wrapper">
<?php
    if (have_posts()) :
        while (have_posts()) : the_post(); ?>
    
            <div class="policy-header flex-sb">
                <h1><?php the_title(); ?></h1>
                <?php wp_nav_menu(array(
                        'theme_location' => 'privacy-menu',
                        'items_wrap' => '%3$s',
                    ));?>
            </div>
            <div><?php the_content(); ?></div>
    
        <?php endwhile;
    else :
        echo '<p>No content found</p>';
    endif;
?>
</div>

<?php
get_footer('policy');
?>