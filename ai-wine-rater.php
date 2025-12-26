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

// সিকিউরিটি
if (!defined('ABSPATH')) {
    exit;
}

// Day 1: ফুটার মেসেজ
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

// Day 2: Head মেটা
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

// Day 3 & 4: প্রধান মেনু – হোম পেজ (Welcome message)
function ai_wine_rater_home_page() {
    ?>
    <div class="wrap">
        <h1>🍷 Welcome to AI Wine Rater Plugin</h1>
        <p style="font-size:18px;">তুমি এখন একটা পাওয়ারফুল ওয়াইন রিভিউ প্লাগিন বানাচ্ছো Grok-এর সাথে!</p>
        <p style="font-size:16px;">সাবমেনু থেকে “Wine Settings” এ যাও কালার, ফন্ট, ডিফল্ট রেটিং চেঞ্জ করতে।</p>
        <p style="font-size:16px;">“All Reviews” থেকে ওয়াইন রিভিউ ম্যানেজ করো।</p>
        <hr>
        <p>তুমি দারুণ করছো ভাই! চলো পরের লেভেলে যাই 🚀</p>
    </div>
    <?php
}

// Day 3 & 4: প্রধান মেনু + সাবমেনু
function ai_wine_rater_admin_menu() {
    // প্রধান মেনু – হোম পেজ (Welcome message)
    add_menu_page(
        'AI Wine Rater',
        'Wine Rater',
        'manage_options',
        'ai-wine-rater-home',
        'ai_wine_rater_home_page',
        'dashicons-star-filled',
        80
    );

    // সাবমেনু – Wine Settings (কালার পিকার + ডিফল্ট স্কোর + ফন্ট)
    add_submenu_page(
        'ai-wine-rater-home',
        'Wine Settings',
        'Wine Settings',
        'manage_options',
        'ai-wine-rater-settings',
        'ai_wine_rater_settings_page'
    );

    // সাবমেনু – All Reviews
    add_submenu_page(
        'ai-wine-rater-home',
        'All Reviews',
        'All Reviews',
        'manage_options',
        'edit.php?post_type=wine'
    );

    // সাবমেনু – Add New Review
    add_submenu_page(
        'ai-wine-rater-home',
        'Add New Review',
        'Add New Review',
        'manage_options',
        'post-new.php?post_type=wine'
    );
}
add_action('admin_menu', 'ai_wine_rater_admin_menu');

// ডুপ্লিকেট প্রধান মেনু হাইড
function ai_wine_rater_remove_duplicate_submenu() {
    remove_submenu_page('ai-wine-rater-home', 'ai-wine-rater-home');
}
add_action('admin_menu', 'ai_wine_rater_remove_duplicate_submenu', 999);

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
    register_setting('ai_wine_rater_settings_group', 'ai_wine_rater_default_score');
    register_setting('ai_wine_rater_settings_group', 'ai_wine_rater_box_color');
    register_setting('ai_wine_rater_settings_group', 'ai_wine_rater_text_font');

    add_settings_section(
        'ai_wine_rater_main_section',
        'Main Settings',
        null,
        'ai-wine-rater-settings'
    );

    add_settings_field(
        'default_score',
        'Default Rating Score',
        'ai_wine_rater_default_score_field',
        'ai-wine-rater-settings',
        'ai_wine_rater_main_section'
    );

    add_settings_field(
        'box_color',
        'Rating Box Background Color',
        'ai_wine_rater_box_color_field',
        'ai-wine-rater-settings',
        'ai_wine_rater_main_section'
    );

    add_settings_field(
        'text_font',
        'Rating Text Font Family',
        'ai_wine_rater_text_font_field',
        'ai-wine-rater-settings',
        'ai_wine_rater_main_section'
    );
}
add_action('admin_init', 'ai_wine_rater_register_settings');

// ফিল্ড ফাংশন
function ai_wine_rater_default_score_field() {
    $score = get_option('ai_wine_rater_default_score', '5');
    echo '<input type="number" step="0.1" min="0" max="5" name="ai_wine_rater_default_score" value="' . esc_attr($score) . '" />';
    echo '<p class="description">শর্টকোডে score না দিলে এই ভ্যালু ব্যবহার হবে (0-5)</p>';
}

function ai_wine_rater_box_color_field() {
    $color = get_option('ai_wine_rater_box_color', '#722f37');
    echo '<input type="text" name="ai_wine_rater_box_color" value="' . esc_attr($color) . '" class="my-color-field" />';
    echo '<p class="description">রেটিং বক্সের ব্যাকগ্রাউন্ড কালার (hex code, যেমন #722f37)</p>';
}

function ai_wine_rater_text_font_field() {
    $font = get_option('ai_wine_rater_text_font', 'Arial');
    echo '<input type="text" name="ai_wine_rater_text_font" value="' . esc_attr($font) . '" />';
    echo '<p class="description">যেমন: Arial, Georgia, "Times New Roman"</p>';
}

// Day 4: কালার পিকার লোড (সেটিংস পেজের জন্য)
function ai_wine_rater_enqueue_admin_scripts($hook) {
    if ('wine-rater_page_ai-wine-rater-settings' !== $hook) {
        return;
    }
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('wp-color-picker');
    wp_add_inline_script('wp-color-picker', 'jQuery(document).ready(function($){ $(".my-color-field").wpColorPicker(); });');
}
add_action('admin_enqueue_scripts', 'ai_wine_rater_enqueue_admin_scripts');

// Day 5: CPT - Wines
function ai_wine_rater_register_cpt() {
    $labels = array(
        'name'               => 'Wines',
        'singular_name'      => 'Wine',
        'add_new'            => 'Add New Review',
        'add_new_item'       => 'Add New Wine Review',
        'all_items'          => 'All Reviews',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => array('slug' => 'wines'),
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_menu'       => false,
    );

    register_post_type('wine', $args);
}
add_action('init', 'ai_wine_rater_register_cpt');

// Day 5: Meta Box + Save
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

function ai_wine_rater_meta_box_callback($post) {
    $rating = get_post_meta($post->ID, '_wine_rating_score', true) ?: '5';
    ?>
    <p>
        <label for="wine_rating_score"><strong>Rating (0-5):</strong></label><br>
        <input type="number" step="0.1" min="0" max="5" id="wine_rating_score" name="wine_rating_score" value="<?php echo esc_attr($rating); ?>" style="width:100%;" />
    </p>
    <?php
}

function ai_wine_rater_save_meta($post_id) {
    if (array_key_exists('wine_rating_score', $_POST)) {
        update_post_meta($post_id, '_wine_rating_score', sanitize_text_field($_POST['wine_rating_score']));
    }
}
add_action('save_post', 'ai_wine_rater_save_meta');

// Day 6: শর্টকোড – মেটা + ডিফল্ট + কালার + ফন্ট
function ai_wine_rater_shortcode($atts) {
    global $post;

    $default_score = get_option('ai_wine_rater_default_score', '5');
    $box_color = get_option('ai_wine_rater_box_color', '#722f37');
    $text_font = get_option('ai_wine_rater_text_font', 'Arial');

    $meta_score = (get_post_type() == 'wine' && $post) ? get_post_meta($post->ID, '_wine_rating_score', true) : '';

    $atts = shortcode_atts(array(
        'score' => $meta_score ?: $default_score,
        'text'  => 'Excellent Wine!',
    ), $atts, 'wine_rating');

    $score = floatval($atts['score']);
    $text = esc_html($atts['text']);

    $stars = '';
    for ($i = 1; $i <= 5; $i++) {
        $stars .= ($i <= $score) ? '★' : '☆';
    }

    $output = '<div style="background:' . esc_attr($box_color) . '; color:white; padding:20px; border-radius:10px; text-align:center; margin:30px 0; font-family:' . esc_attr($text_font) . ';">';
    $output .= '<p style="margin:0; font-size:24px;"><strong>Wine Rating:</strong> ' . $stars . ' ' . $score . '/5</p>';
    $output .= '<p style="margin:15px 0 0; font-size:18px;">' . $text . '</p>';
    $output .= '</div>';

    return $output;
}
add_shortcode('wine_rating', 'ai_wine_rater_shortcode');

// Day 6: সিঙ্গল পেজে অটো রেটিং
function ai_wine_rater_auto_rating_single($content) {
    if (is_singular('wine') && in_the_loop() && is_main_query()) {
        $content .= do_shortcode('[wine_rating text="Reviewed by AI Wine Rater"]');
    }
    return $content;
}
add_filter('the_content', 'ai_wine_rater_auto_rating_single');

// Day 6: Archive-এ রেটিং
function ai_wine_rater_archive_display_rating() {
    global $post;
    if (get_post_type($post) === 'wine') {
        $rating = get_post_meta($post->ID, '_wine_rating_score', true) ?: 'Not rated';
        echo '<p style="font-weight:bold; color:#722f37;">Rating: ' . esc_html($rating) . '/5</p>';
    }
}
add_action('the_excerpt', 'ai_wine_rater_archive_display_rating');