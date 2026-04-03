<div class="event-custom-field-wrapper">
    <?php
    $args = array(
        'post_type' => 'events',
        'posts_per_page' => -1,
    );
    $custom_query = new WP_Query($args);

    if ($custom_query->have_posts()) :
        while ($custom_query->have_posts()) : $custom_query->the_post();
    ?>
            <ul>
                <li class="event-title">Name: <?php echo get_field('name'); ?></li>
                <li class="event-start">Starts: <?php echo get_field('start_date'); ?></li>
                <li class="event-end">Ends: <?php echo get_field('end_date'); ?></li>
            </ul>
    <?php
        endwhile;
    else :
        echo '<li>No events found.</li>';
    endif;

    wp_reset_postdata();
    ?>
</div>
