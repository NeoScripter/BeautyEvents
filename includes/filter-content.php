<?php
function get_unique_meta_values($meta_key, $post_type = 'events')
{
    global $wpdb;
    $query = $wpdb->prepare(
        "
                SELECT DISTINCT meta_value 
                FROM {$wpdb->postmeta} 
                JOIN {$wpdb->posts} ON {$wpdb->postmeta}.post_id = {$wpdb->posts}.ID 
                WHERE meta_key = %s 
                AND post_type = %s 
                AND post_status = 'publish'",
        $meta_key,
        $post_type
    );
    $results = $wpdb->get_col($query);

    $unique_values = [];
    /* foreach ($results as $result) {
                $values = maybe_unserialize($result);
                if (is_array($values)) {
                    $unique_values = array_merge($unique_values, $values);
                } else {
                    $unique_values[] = $values;
                }
            } */

    foreach ($results as $result) {
        $values = maybe_unserialize($result);
        if (is_array($values)) {
            foreach ($values as $value) {
                $trimmed_value = trim($value);
                $unique_values[] = ucwords(strtolower($trimmed_value));
            }
        } else {
            $trimmed_value = trim($values);
            $unique_values[] = ucwords(strtolower($trimmed_value));
        }
    }

    $unique_values = array_unique($unique_values);

    if ($meta_key == 'venue') {
        sort($unique_values);
    }

    return $unique_values;
}

$filters = [
    'Format' => get_unique_meta_values('format'),
    'category' => get_unique_meta_values('category'),
    'specialty' => get_unique_meta_values('specialty'),
    'country' => get_unique_meta_values('venue')
];

$months = [
    'January' => '01',
    'February' => '02',
    'March' => '03',
    'April' => '04',
    'May' => '05',
    'June' => '06',
    'July' => '07',
    'August' => '08',
    'September' => '09',
    'October' => '10',
    'November' => '11',
    'December' => '12'
];
$years = range(date('Y'), date('Y') + 3);
?>
<div class="filters-mobile">
    <div class="small-screen-filters">
        <button type="submit" class="view-all-button">SEARCH</button>
        <div class="flex justify-center flex-col sm:flex-row gap-4 w-full sm:justify-start sm:w-120 items-center">
            <button type="button" class="display-filters-button" id="show-filters-btn">FILTERS</button>
            <button type="submit" class="clear-all-button">CLEAR ALL</button>
        </div>

    </div>
    <div class="filter-container">
        <button type="submit" class="clear-all-button">CLEAR ALL</button>
        <?php foreach ($filters as $category => $options) : ?>
            <div class="filter-group">
                <div class="custom-dropdown-wrapper">
                    <div class="custom-dropdown">
                        <button type="button" class="custom-dropdown-button" tabindex="0"><?php echo $category; ?><img src="<?php echo get_template_directory_uri() . "/assets/images/svgs/dropdown.svg"; ?>" alt="arrow down" class="dropdown-svg"></button>
                        <div class="custom-dropdown-content">
                            <?php foreach ($options as $option) : ?>
                                <label class="dropdown-label" tabindex="0">
                                    <input type="checkbox" name="filter-<?php echo trim(strtolower($category)); ?>[]" value="<?php echo trim(strtolower($option)); ?>"> <?php echo $option; ?>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="filter-group">
            <div class="custom-dropdown-wrapper">
                <div class="custom-dropdown">
                    <button type="button" class="custom-dropdown-button" tabindex="0">Date<img src="<?php echo get_template_directory_uri() . "/assets/images/svgs/dropdown.svg"; ?>" alt="arrow down" class="dropdown-svg"></button>
                    <div class="custom-dropdown-content">
                        <div class="nested-dropdown">
                            <label>Month <img src="<?php echo get_template_directory_uri() . "/assets/images/svgs/dropdown.svg"; ?>" alt="arrow down" class="dropdown-svg"></label>
                            <div class="custom-dropdown-content month">
                                <?php foreach ($months as $monthName => $monthValue) : ?>
                                    <label class="dropdown-label" tabindex="0">
                                        <input type="checkbox" name="filter-month[]" value="<?php echo $monthName; ?>"> <?php echo $monthName; ?>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="nested-dropdown">
                            <label>Year <img src="<?php echo get_template_directory_uri() . "/assets/images/svgs/dropdown.svg"; ?>" alt="arrow down" class="dropdown-svg"></label>
                            <div class="custom-dropdown-content year">
                                <?php foreach ($years as $year) : ?>
                                    <label class="dropdown-label" tabindex="0">
                                        <input type="checkbox" name="filter-year[]" value="<?php echo $year; ?>"> <?php echo $year; ?>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="view-all-button">SEARCH</button>
    </div>
</div>
<div class="selected-filters">
</div>
