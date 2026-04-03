<?php get_header(); ?>
<section class="event-page-wrap">
    <div class="container">
        <?php if(has_post_thumbnail()):?>
            <img src="<?php the_post_thumbnail_url('blog-small');?>" alt="<?php the_title();?>" class="img-fluid img-thumbnail">
        <?php endif;?>

        <h1><?php the_title(); ?></h1>

        <div class="event-content-wrapper">
            <?php get_template_part('includes/section', 'blogcontent');?>
            <?php wp_link_pages();?>
        </div>
        <div class="event-custom-field-wrapper">
            <ul>
                <li>Name: <?php the_field('name');?></li>
                <li>Starts: <?php the_field('start_date');?></li>
                <li>Ends: <?php the_field('end_date');?></li>
            </ul>
        </div>
    </div>
</section>
<?php get_footer(); ?>