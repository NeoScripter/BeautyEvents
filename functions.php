<?php

define('VITE_DEV_SERVER', 'https://localhost:5173');

// Stylesheets
function load_css() {
    wp_enqueue_style(
        'local-fonts',
        get_template_directory_uri() . '/assets/fonts/local-fonts.css',
        [],
        null
    );

    $dist_path = get_template_directory() . '/assets/dist/assets';
    wp_enqueue_style(
        'theme-style',
        get_template_directory_uri() . '/assets/dist/assets/style.css',
        [],
        file_exists( $dist_path . '/style.css' ) ? filemtime( $dist_path . '/style.css' ) : '1.0.0'
    );
}
add_action( 'wp_enqueue_scripts', 'load_css' );

// JavaScript
function load_js() {
    $dist_file  = get_template_directory() . '/assets/dist/assets/main.js';
    $dist_url   = get_template_directory_uri() . '/assets/dist/assets/main.js';
    $dev_url    = VITE_DEV_SERVER . '/assets/src/js/main.js';

    wp_enqueue_script( 'jquery' );

    if ( file_exists( $dist_file ) ) {
        // Production — load built file
        wp_enqueue_script(
            'theme-script',
            $dist_url,
            [ 'jquery' ],
            filemtime( $dist_file ),
            true
        );
    } else {
        // Dev — load from Vite dev server
        wp_enqueue_script( 'vite-client', VITE_DEV_SERVER . '/@vite/client', [], null, false );
        wp_enqueue_script( 'theme-script', $dev_url, [ 'jquery' ], null, true );
    }

    // Attach all localized data to theme-script
    wp_localize_script( 'theme-script', 'popupData', [
        'is_user_logged_in' => is_user_logged_in(),
    ]);

    wp_localize_script( 'theme-script', 'ajax_vars', [
        'ajax_url'           => admin_url( 'admin-ajax.php' ),
        'registration_nonce' => wp_create_nonce( 'ajax-registration-nonce' ),
        'login_nonce'        => wp_create_nonce( 'ajax-login-nonce' ),
    ]);
}
add_action( 'wp_enqueue_scripts', 'load_js' );

// Mark Vite scripts as type="module"
function add_module_type( $tag, $handle ) {
    if ( in_array( $handle, [ 'vite-client', 'theme-script' ] ) ) {
        return str_replace( 'text/javascript', 'module', $tag );
    }
    return $tag;
}
add_filter( 'script_loader_tag', 'add_module_type', 10, 2 );

// Theme Options
add_theme_support('menus');
add_theme_support('post-thumbnails');
add_theme_support('widgets');

// Custom image sizes
add_image_size('blog-large', 800, 600, true);
add_image_size('blog-small', 300, 200, true);

function add_custom_classes_to_paragraphs($content)
{
    if (is_single() && has_category('event')) {
        $paragraphs = explode('</p>', $content);

        foreach ($paragraphs as $index => $paragraph) {
            if (trim($paragraph)) {
                $paragraphs[$index] .= '</p>';
                $paragraphs[$index] = str_replace('<p', '<p class="custom-paragraph-class-' . ($index + 1) . '"', $paragraphs[$index]);
            }
        }

        $content = implode('', $paragraphs);
    }

    return $content;
}

// Creating a menu

function remove_menu_container($args = '')
{
    $args['container'] = false;
    return $args;
}
add_filter('wp_nav_menu_args', 'remove_menu_container');

function strip_ul_class($menu)
{
    $menu = preg_replace('/<ul[^>]*>/', '', $menu);
    $menu = preg_replace('/<\/ul>/', '', $menu);
    $menu = preg_replace('/<li[^>]*>/', '', $menu);
    $menu = preg_replace('/<\/li>/', '', $menu);
    return $menu;
}
add_filter('wp_nav_menu', 'strip_ul_class');

function register_menus()
{
    register_nav_menus(
        array(
            'top-menu' => 'Header Menu',
            'privacy-menu' => 'Footer Menu',
            'bottom-menu' => 'Bottom Menu'
        )
    );
}
add_action('init', 'register_menus');

function allow_html_in_menu_items($title, $item, $args, $depth)
{
    return $item->post_title;
}
add_filter('nav_menu_item_title', 'allow_html_in_menu_items', 10, 4);

// Adding svgs

function cc_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

add_filter('the_content', 'add_custom_classes_to_paragraphs');

function add_event_post_type()
{
    $args = [
        'labels' => [
            'name' => 'Events',
            'singular_name' => 'Event'
        ],
        'hierarchical' => true,
        'public' => true,
        'has_archive' => true,
        'show_in_rest' => true,
        'rest_base' => 'events',
        'menu_icon' => 'dashicons-calendar-alt',
        'supports' => ['title', 'editor', 'thumbnail', 'custom-fields'],
        'rewrite' => ['slug' => 'events']
    ];

    register_post_type('events', $args);
}

add_action('init', 'add_event_post_type');

function add_past_event_post_type()
{
    $args = [
        'labels' => [
            'name' => 'Past Events',
            'singular_name' => 'Past Event'
        ],
        'hierarchical' => true,
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-table-row-delete',
        'supports' => ['title', 'editor', 'thumbnail', 'custom-fields'],
        'rewrite' => ['slug' => 'past-events']
    ];

    register_post_type('past_events', $args);
}
add_action('init', 'add_past_event_post_type');

function add_event_taxonomy()
{
    $args = [
        'labels' => [
            'name' => 'Venues',
            'singular_name' => 'Venue'
        ],
        'public' => true,
        'hierarchical' => true,
    ];
    register_taxonomy('venues', ['events'], $args);
}
add_action('init', 'add_event_taxonomy');


function hide_admin_bar()
{
    add_filter('show_admin_bar', '__return_false');
}

add_action('after_setup_theme', 'hide_admin_bar');
function move_past_events_to_new_post_type()
{
    $current_date = date('Y-m-d');

    $query = new WP_Query([
        'post_type' => 'events',
        'posts_per_page' => -1,
        'meta_query' => [
            [
                'key' => 'event_date',
                'value' => $current_date,
                'compare' => '<',
                'type' => 'DATE'
            ]
        ],
        'fields' => 'ids'
    ]);

    if ($query->have_posts()) {
        foreach ($query->posts as $post_id) {
            wp_update_post([
                'ID' => $post_id,
                'post_type' => 'past_events'
            ]);
        }
    }
}

function schedule_past_events_mover()
{
    if (!wp_next_scheduled('move_past_events')) {
        wp_schedule_event(time(), 'daily', 'move_past_events');
    }
}
add_action('wp', 'schedule_past_events_mover');

add_action('move_past_events', 'move_past_events_to_new_post_type');

function render_events($count)
{
    $meta_query = ['relation' => 'AND'];

    if (!empty($_GET['filter-format'])) {
        $formats = array_map('sanitize_text_field', $_GET['filter-format']);
        foreach ($formats as $format) {
            $meta_query[] = [
                'key' => 'format',
                'value' => '"' . $format . '"',
                'compare' => 'LIKE'
            ];
        }
    }
    if (!empty($_GET['filter-category'])) {
        $categories = array_map('sanitize_text_field', $_GET['filter-category']);
        foreach ($categories as $category) {
            $meta_query[] = [
                'key' => 'category',
                'value' => '"' . $category . '"',
                'compare' => 'LIKE'
            ];
        }
    }
    if (!empty($_GET['filter-specialty'])) {
        $specialties = array_map('sanitize_text_field', $_GET['filter-specialty']);
        foreach ($specialties as $specialty) {
            $meta_query[] = [
                'key' => 'specialty',
                'value' => '"' . $specialty . '"',
                'compare' => 'LIKE'
            ];
        }
    }

    if (!empty($_GET['filter-month'])) {
        $months = array_map('sanitize_text_field', (array) $_GET['filter-month']);
        $meta_query[] = [
            'key' => 'event_month',
            'value' => $months,
            'compare' => 'IN'
        ];
    }

    if (!empty($_GET['filter-year'])) {
        $years = array_map('sanitize_text_field', (array) $_GET['filter-year']);
        $meta_query[] = [
            'key' => 'event_year',
            'value' => $years,
            'compare' => 'IN'
        ];
    }

    if (!empty($_GET['filter-country'])) {
        $meta_query[] = [
            'key' => 'venue',
            'value' => array_map('sanitize_text_field', $_GET['filter-country']),
            'compare' => 'IN'
        ];
    }

    $args = [
        'post_type' => 'events',
        'posts_per_page' => $count,
        'meta_query' => $meta_query,
        'meta_key' => 'event_date',
        'orderby' => 'meta_value',
        'order' => 'ASC',
        'post_status' => 'publish'
    ];

    $query = new WP_Query($args);
    ob_start();

    if ($query->have_posts()): ?>
        <?php while ($query->have_posts()): $query->the_post(); ?>
            <div class="event-wrapper rounded-2xl">
                <div class="event-content">
                    <img src="<?php echo get_field('image'); ?>" alt="<?php the_title(); ?>" class="event-img">
                    <ul class="event-ul">
                        <?php
                        $formats = get_field('format');
                        if (is_string($formats)) {
                            $formats = maybe_unserialize($formats);
                        }
                        if (is_array($formats)) {
                            foreach ($formats as $format) {
                                echo '<li class="' . (esc_html($format) == 'Online' ? 'green' : 'blue') . '">' . esc_html($format) . '</li>';
                            }
                        } else {
                            echo '<li>' . esc_html($formats) . '</li>';
                        }
                        ?>
                    </ul>
                    <h3 class="event-title"><?php the_title(); ?></h3>
                    <div class="event-desc"><?php the_content(); ?></div>
                    <div class="event-flex-group">
                        <ul class="event-details">
                            <li class="event-date"><?php echo get_field('event_month') . ' ' . get_field('event_day') . ', ' . get_field('event_year'); ?></li>
                            <li class="event-time-zone"><?php echo get_field('time_zone'); ?></li>
                            <li class="event-venue"><?php echo get_field('venue'); ?></li>
                        </ul>
                        <a href="<?php echo get_field('link'); ?>" target="_blank" class="event-join">Details</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p class="empty-search">No events found</p>
    <?php endif;

    wp_reset_postdata();
    return ob_get_clean();
}


function load_more_events()
{
    $count = isset($_GET['count']) ? intval($_GET['count']) : 18;

    echo render_events($count);
    wp_die();
}

add_action('wp_ajax_load_more_events', 'load_more_events');
add_action('wp_ajax_nopriv_load_more_events', 'load_more_events');


function password_mismatch_signup_errors($errors, $sanitized_user_login, $user_email)
{
    if (isset($_POST['user_pass']) && isset($_POST['confirm_pass'])) {
        if ($_POST['user_pass'] !== $_POST['confirm_pass']) {
            $errors->add('password_mismatch', __('The passwords do not match.'));
        }
    }
    return $errors;
}
add_filter('registration_errors', 'password_mismatch_signup_errors', 10, 3);

function custom_user_register($user_id)
{
    if (isset($_POST['user_pass'])) {
        wp_set_password($_POST['user_pass'], $user_id);
    }
}
add_action('user_register', 'custom_user_register');

function ajax_user_registration_handler()
{
    check_ajax_referer('ajax-registration-nonce', 'security');

    $errors = array();

    if (!isset($_POST['user_login'], $_POST['user_email'], $_POST['user_pass'], $_POST['confirm_pass'], $_POST['privacy_policy'])) {
        $errors[] = 'Please fill in all required fields.';
        wp_send_json_error($errors);
    }

    $user_login = sanitize_text_field($_POST['user_login']);
    $user_email = sanitize_email($_POST['user_email']);
    $user_phone = sanitize_text_field($_POST['user_phone']);
    $user_pass = $_POST['user_pass'];
    $confirm_pass = $_POST['confirm_pass'];

    if (username_exists($user_login) || email_exists($user_email)) {
        $errors[] = 'Username or Email already exists.';
    }

    if ($user_pass !== $confirm_pass) {
        $errors[] = 'Passwords do not match.';
    }

    if (empty($errors)) {
        $user_id = wp_create_user($user_login, $user_pass, $user_email);

        if (is_wp_error($user_id)) {
            $errors[] = $user_id->get_error_message();
        } else {
            update_user_meta($user_id, 'user_phone', $user_phone);
            wp_set_current_user($user_id);
            wp_set_auth_cookie($user_id);
            wp_new_user_notification($user_id, null, 'user');
            wp_send_json_success('Registration successful!');
        }
    }

    wp_send_json_error($errors);
}
add_action('wp_ajax_nopriv_ajax_user_registration', 'ajax_user_registration_handler');
add_action('wp_ajax_ajax_user_registration', 'ajax_user_registration_handler');


function ajax_user_login_handler()
{
    check_ajax_referer('ajax-login-nonce', 'security');

    $errors = array();

    if (!isset($_POST['log'], $_POST['pwd'])) {
        $errors[] = 'Please fill in all required fields.';
        wp_send_json_error($errors);
    }

    $user_login = sanitize_text_field($_POST['log']);
    $user_pass = $_POST['pwd'];

    if (is_email($user_login)) {
        $user = get_user_by('email', $user_login);
        if ($user) {
            $user_login = $user->user_login;
        } else {
            $errors[] = 'No user found with this email address.';
        }
    } else {
        $user = get_user_by('login', $user_login);
        if (!$user) {
            $errors[] = 'No user found with this username.';
        }
    }

    if (empty($errors)) {
        $user = wp_signon(array(
            'user_login' => $user_login,
            'user_password' => $user_pass,
            'remember' => true
        ));

        if (is_wp_error($user)) {
            $errors[] = $user->get_error_message();
        } else {
            wp_send_json_success('Login successful!');
        }
    }

    wp_send_json_error($errors);
}
add_action('wp_ajax_nopriv_ajax_user_login', 'ajax_user_login_handler');
add_action('wp_ajax_ajax_user_login', 'ajax_user_login_handler');

// Add phone number field to user profile
function add_custom_user_profile_fields($user)
{ ?>
    <h3><?php _e("Extra Profile Information", "blank"); ?></h3>

    <table class="form-table">
        <tr>
            <th><label for="user_phone"><?php _e("Phone"); ?></label></th>
            <td>
                <input type="text" name="user_phone" id="user_phone" value="<?php echo esc_attr(get_the_author_meta('user_phone', $user->ID)); ?>" class="regular-text" /><br />
                <span class="description"><?php _e("Please enter your phone number."); ?></span>
            </td>
        </tr>
    </table>
<?php }
add_action('show_user_profile', 'add_custom_user_profile_fields');
add_action('edit_user_profile', 'add_custom_user_profile_fields');


function save_custom_user_profile_fields($user_id)
{
    if (!current_user_can('edit_user', $user_id)) {
        return false;
    }
    update_user_meta($user_id, 'user_phone', sanitize_text_field($_POST['user_phone']));
}
add_action('personal_options_update', 'save_custom_user_profile_fields');
add_action('edit_user_profile_update', 'save_custom_user_profile_fields');


function add_user_phone_column($columns)
{
    $columns['user_phone'] = 'Phone';
    return $columns;
}
add_filter('manage_users_columns', 'add_user_phone_column');

function show_user_phone_column_content($value, $column_name, $user_id)
{
    if ($column_name == 'user_phone') {
        return get_user_meta($user_id, 'user_phone', true);
    }
    return $value;
}
add_action('manage_users_custom_column', 'show_user_phone_column_content', 10, 3);

// Custom 
// === CLAUDE META REGISTER ===
add_action('init', function () {
    foreach (['venue', 'link', 'event_day', 'event_month', 'event_year', 'event_date'] as $field) {
        register_post_meta('events', $field, [
            'show_in_rest' => true,
            'single' => true,
            'type' => 'string',
            'auth_callback' => function () {
                return current_user_can('edit_posts');
            }
        ]);
    }
    foreach (['format', 'specialty', 'category'] as $field) {
        register_post_meta('events', $field, [
            'show_in_rest' => [
                'schema' => [
                    'type' => 'array',
                    'items' => ['type' => 'string'],
                ]
            ],
            'single' => true,
            'type' => 'array',
            'auth_callback' => function () {
                return current_user_can('edit_posts');
            }
        ]);
    }
});
// === CLAUDE META REGISTER END ===
