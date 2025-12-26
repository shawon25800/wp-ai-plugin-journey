<?php
/**
 * Plugin Name: AI Wine Rater
 * Plugin URI: https://github.com/shawon25800/wp-ai-plugin-journey
 * Description: আমার AI-পাওয়ার্ড ওয়ার্ডপ্রেস প্লাগিন – Grok-এর সাথে ডেভেলপমেন্ট শেখা চলছে 🍷
 * Version: 1.0
 * Author: Shawon
 * Author URI: https://github.com/shawon25800
 * License: GPL2
 * Text Domain: ai-wine-rater
 */

// সিকিউরিটি: ডাইরেক্ট অ্যাক্সেস ব্লক করা
if (!defined('ABSPATH')) {
    exit;
}

// Day 1: ফুটারে পার্সোনাল মেসেজ
function ai_wine_rater_footer_message() {
    ?>
    <div style="text-align:center; background:#5f9ea0; color:white; padding:20px; margin-top:40px; font-size:18px;">
        (test to push in github) Hey Grok lets build something.. 🍷 IT's my day 2 🚀<br>
        <small>Lets make a better plugin</small>
    </div>
    <?php
}
add_action('wp_footer', 'ai_wine_rater_footer_message');

// Day 2: অ্যাডমিন নোটিস
function ai_wine_rater_day2_admin_notice() {
    ?>
    <div class="notice notice-success is-dismissible">
        <p>🍷 <strong>Day 2 শুরু!</strong> তুমি এখন hooks শিখছো – WordPress-এর সবচেয়ে পাওয়ারফুল টুল! 🚀</p>
    </div>
    <?php
}
add_action('admin_notices', 'ai_wine_rater_day2_admin_notice');

// Day 2: Head-এ মেটা ট্যাগ
function ai_wine_rater_custom_meta() {
    echo '<meta name="author" content="Shawon - Learning with Grok AI 🍷">';
    echo '<meta name="description" content="AI Wine Rater Plugin - Day 2 Hooks Practice">';
}
add_action('wp_head', 'ai_wine_rater_custom_meta');

// Day 2: কন্টেন্ট ফিল্টার
function ai_wine_rater_add_footer_to_content($content) {
    if (is_single()) {
        $extra_content = '<div style="margin-top: 30px; padding: 20px; background: #f8f8f8; border-left: 5px solid #722f37;">';
        $extra_content .= '<p><strong>Day 2 Filter Hook Test:</strong></p>';
        $extra_content .= '<p>এই কন্টেন্টটা WordPress filter hook দিয়ে অটো অ্যাড করা হয়েছে। 🍷</p>';
        $extra_content .= '<p>– AI Wine Rater Plugin (Learning Hooks with Grok)</p>';
        $extra_content .= '</div>';
        $content .= $extra_content;
    }
    return $content;
}
add_filter('the_content', 'ai_wine_rater_add_footer_to_content');

// Day 2: টাইটেল প্রিফিক্স
function ai_wine_rater_prefix_title($title) {
    if (is_single()) {
        $title = '[Day 2] ' . $title;
    }
    return $title;
}
add_filter('the_title', 'ai_wine_rater_prefix_title');

// Day 3 & 4: অ্যাডমিন মেনু
function ai_wine_rater_admin_menu() {
    add_menu_page(
        'AI Wine Rater Settings',
        'Wine Rater',
        'manage_options',
        'ai-wine-rater-settings',
        'ai_wine_rater_settings_page',
        'dashicons-star-filled',
        80
    );
}
add_action('admin_menu', 'ai_wine_rater_admin_menu');

// Day 3 & 4: সেটিংস পেজ
function ai_wine_rater_settings_page() {
    ?>
    <div class="wrap">
        <h1>🍷 AI Wine Rater Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('ai_wine_rater_settings_group');
            do_settings_sections('ai-wine-rater-settings');
            submit_button('Save Changes');
            ?>
        </form>
    </div>
    <?php
}

// Day 3 & 4: সেটিংস রেজিস্টার
function ai_wine_rater_register_settings() {
    // গ্রুপ + অপশন রেজিস্টার
    register_setting('ai_wine_rater_settings_group', 'ai_wine_rater_default_score');
    register_setting('ai_wine_rater_settings_group', 'ai_wine_rater_box_color');

    // সেকশন
    add_settings_section(
        'ai_wine_rater_main_section',
        'Main Settings',
        null,
        'ai-wine-rater-settings'
    );

    // ডিফল্ট স্কোর ফিল্ড
    add_settings_field(
        'default_score',
        'Default Rating Score',
        'ai_wine_rater_default_score_field',
        'ai-wine-rater-settings',
        'ai_wine_rater_main_section'
    );

    // কালার ফিল্ড
    add_settings_field(
        'box_color',
        'Rating Box Background Color',
        'ai_wine_rater_box_color_field',
        'ai-wine-rater-settings',
        'ai_wine_rater_main_section'
    );
}
add_action('admin_init', 'ai_wine_rater_register_settings');

// ডিফল্ট স্কোর ফিল্ড
function ai_wine_rater_default_score_field() {
    $score = get_option('ai_wine_rater_default_score', '5');
    echo '<input type="number" step="0.1" min="0" max="5" name="ai_wine_rater_default_score" value="' . esc_attr($score) . '" />';
    echo '<p class="description">শর্টকোডে score না দিলে এই ভ্যালু ব্যবহার হবে (0-5)</p>';
}

// কালার ফিল্ড
function ai_wine_rater_box_color_field() {
    $color = get_option('ai_wine_rater_box_color', '#722f37');
    echo '<input type="text" name="ai_wine_rater_box_color" value="' . esc_attr($color) . '" class="my-color-field" />';
    echo '<p class="description">রেটিং বক্সের ব্যাকগ্রাউন্ড কালার (hex code, যেমন #722f37)</p>';
}

// Day 4: কালার পিকার + CSS লোড
function ai_wine_rater_enqueue_admin_scripts($hook) {
    if ('toplevel_page_ai-wine-rater-settings' !== $hook) {
        return;
    }
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('wp-color-picker');
    wp_add_inline_script('wp-color-picker', 'jQuery(document).ready(function($){ $(".my-color-field").wpColorPicker(); });');
}
add_action('admin_enqueue_scripts', 'ai_wine_rater_enqueue_admin_scripts');

// Day 6: শর্টকোড – মেটা থেকে রেটিং নেয়া + ডিফল্ট সাপোর্ট
function ai_wine_rater_shortcode($atts) {
    global $post;

    $default_score = get_option('ai_wine_rater_default_score', '5');
    $box_color = get_option('ai_wine_rater_box_color', '#722f37');

    // CPT 'wine' হলে মেটা থেকে রেটিং নেয়া
    $meta_score = '';
    if (get_post_type() == 'wine' && $post) {
        $meta_score = get_post_meta($post->ID, '_wine_rating_score', true);
    }

    $atts = shortcode_atts(array(
        'score' => $meta_score ?: $default_score, // মেটা > ডিফল্ট
        'text'  => 'Excellent Wine!',
    ), $atts, 'wine_rating');

    $score = floatval($atts['score']);
    $text = esc_html($atts['text']);

    $stars = '';
    for ($i = 1; $i <= 5; $i++) {
        $stars .= ($i <= $score) ? '★' : '☆';
    }

    $output = '<div style="background:' . esc_attr($box_color) . '; color:white; padding:20px; border-radius:10px; text-align:center; margin:30px 0;">';
    $output .= '<p style="margin:0; font-size:24px;"><strong>Wine Rating:</strong> ' . $stars . ' ' . $score . '/5</p>';
    $output .= '<p style="margin:15px 0 0; font-size:18px;">' . $text . '</p>';
    $output .= '</div>';

    return $output;
}
add_shortcode('wine_rating', 'ai_wine_rater_shortcode');
// Day 5: Custom Post Type - Wines
function ai_wine_rater_register_cpt() {
    $labels = array(
        'name'               => 'Wines',
        'singular_name'      => 'Wine',
        'menu_name'          => 'Wines',
        'name_admin_bar'     => 'Wine',
        'add_new'            => 'Add New Wine',
        'add_new_item'       => 'Add New Wine Review',
        'new_item'           => 'New Wine',
        'edit_item'          => 'Edit Wine',
        'view_item'          => 'View Wine',
        'all_items'          => 'All Wines',
        'search_items'       => 'Search Wines',
        'not_found'          => 'No wines found.',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => array('slug' => 'wines'),
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'comments'),
        'show_in_menu'       => 'ai-wine-rater-settings', // আমাদের মেনুর নিচে সাবমেনু হিসেবে
        'menu_icon'          => 'dashicons-food',
    );

    register_post_type('wine', $args);
}
add_action('init', 'ai_wine_rater_register_cpt');
// Day 5: Meta Box - Wine Rating Score
function ai_wine_rater_add_meta_box() {
    add_meta_box(
        'wine_rating_meta',
        'Wine Rating Score',
        'ai_wine_rater_meta_box_callback',
        'wine',
        'side',
        'high'
    );
}
add_action('add_meta_boxes', 'ai_wine_rater_add_meta_box');

// Meta Box কন্টেন্ট
function ai_wine_rater_meta_box_callback($post) {
    $rating = get_post_meta($post->ID, '_wine_rating_score', true);
    $rating = $rating ? $rating : '5';
    ?>
    <p>
        <label for="wine_rating_score"><strong>Rating (0-5):</strong></label><br>
        <input type="number" step="0.1" min="0" max="5" id="wine_rating_score" name="wine_rating_score" value="<?php echo esc_attr($rating); ?>" style="width:100%;" />
    </p>
    <?php
}

// সেভ করা
function ai_wine_rater_save_meta($post_id) {
    if (array_key_exists('wine_rating_score', $_POST)) {
        update_post_meta(
            $post_id,
            '_wine_rating_score',
            sanitize_text_field($_POST['wine_rating_score'])
        );
    }
}
add_action('save_post', 'ai_wine_rater_save_meta');
// Day 6: সিঙ্গল ওয়াইন পেজে অটো রেটিং বক্স দেখানো
function ai_wine_rater_auto_rating_single($content) {
    if (is_singular('wine') && in_the_loop() && is_main_query()) {
        $content .= do_shortcode('[wine_rating text="Reviewed by AI Wine Rater"]');
    }
    return $content;
}
add_filter('the_content', 'ai_wine_rater_auto_rating_single');
// Day 6: Archive page-এ প্রতিটা ওয়াইনের রেটিং দেখানো
function ai_wine_rater_archive_display_rating() {
    global $post;
    if (get_post_type($post) === 'wine') {
        $rating = get_post_meta($post->ID, '_wine_rating_score', true);
        $rating = $rating ? $rating : 'Not rated yet';
        echo '<p style="font-weight:bold; color:#722f37;">Rating: ' . esc_html($rating) . '/5</p>';
    }
}
add_action('the_excerpt', 'ai_wine_rater_archive_display_rating');