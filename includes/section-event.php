<?php
    $args = array(
        'post_type' => 'event',
        'posts_per_page' => -1
    );
    $query = new WP_Query($args);
    if ($query->have_posts()) : ?>
        <div class="events-grid">
            <?php while ($query->have_posts()) : $query->the_post(); ?>
                <div class="event-item">
                    <div class="event-image">
                        <img src="<?php echo get_field('image'); ?>" alt="<?php the_title(); ?>">
                    </div>
                    <div class="event-content">
                        <div class="event-format"><?php echo get_field('format'); ?></div>
                        <h3 class="event-title"><?php the_title(); ?></h3>
                        <div class="event-description"><?php the_content(); ?></div>
                        <div class="event-details">
                            <span class="event-date"><?php echo get_field('date'); ?></span>
                            <span class="event-time-zone"><?php echo get_field('time_zone'); ?></span>
                            <span class="event-venue"><?php echo get_field('venue'); ?></span>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else : ?>
        <p>No events found</p>
    <?php endif;
    wp_reset_postdata(); ?>

<!-- get_template_part('includes/section','event'); -->