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

// Day 1: ফুটারে পার্সোনাল মেসেজ (তোমার লেটেস্ট ভার্সন)
function ai_wine_rater_footer_message() {
    ?>
    <div style="text-align:center; background:#5f9ea0; color:white; padding:20px; margin-top:40px; font-size:18px;">
        (test to push in github) Hey Grok lets build something.. 🍷 IT's my day 2 🚀<br>
        <small>Lets make a better plugin</small>
    </div>
    <?php
}
add_action('wp_footer', 'ai_wine_rater_footer_message');

// Day 2: Action Hook - অ্যাডমিনে ওয়েলকাম নোটিস
function ai_wine_rater_day2_admin_notice() {
    ?>
    <div class="notice notice-success is-dismissible">
        <p>🍷 <strong>Day 2 শুরু!</strong> তুমি এখন hooks শিখছো – WordPress-এর সবচেয়ে পাওয়ারফুল টুল! 🚀</p>
    </div>
    <?php
}
add_action('admin_notices', 'ai_wine_rater_day2_admin_notice');

// Day 2: Action Hook - সাইটের head-এ কাস্টম মেটা ট্যাগ
function ai_wine_rater_custom_meta() {
    echo '<meta name="author" content="Shawon - Learning with Grok AI 🍷">';
    echo '<meta name="description" content="AI Wine Rater Plugin - Day 2 Hooks Practice">';
}
add_action('wp_head', 'ai_wine_rater_custom_meta');

// Day 2: Filter Hook - পোস্ট কন্টেন্টের শেষে অটো বক্স অ্যাড করা
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

// Day 2: Filter Hook - পোস্ট টাইটেলে prefix অ্যাড করা
function ai_wine_rater_prefix_title($title) {
    if (is_single()) {
        $title = '[Day 2] ' . $title;
    }
    return $title;
}
add_filter('the_title', 'ai_wine_rater_prefix_title');

// Day 3: অ্যাডমিন মেনু যোগ করা
function ai_wine_rater_admin_menu() {
    add_menu_page(
        'AI Wine Rater Settings',     // পেজ টাইটেল
        'Wine Rater',                 // মেনু নাম
        'manage_options',             // কে দেখতে পারবে (অ্যাডমিন)
        'ai-wine-rater-settings',     // স্লাগ
        'ai_wine_rater_settings_page', // কলব্যাক ফাংশন
        'dashicons-star-filled',      // আইকন
        80                            // পজিশন
    );
}
add_action('admin_menu', 'ai_wine_rater_admin_menu');

// Day 3: সেটিংস পেজের HTML
function ai_wine_rater_settings_page() {
    ?>
    <div class="wrap">
        <h1>🍷 AI Wine Rater Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('ai_wine_rater_settings_group');
            do_settings_sections('ai-wine-rater-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Day 3: সেটিংস রেজিস্টার করা
function ai_wine_rater_register_settings() {
    register_setting('ai_wine_rater_settings_group', 'ai_wine_rater_default_score');

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
}
add_action('admin_init', 'ai_wine_rater_register_settings');

// Day 3: ইনপুট ফিল্ড
function ai_wine_rater_default_score_field() {
    $score = get_option('ai_wine_rater_default_score', '5'); // ডিফল্ট 5
    echo '<input type="number" step="0.1" min="0" max="5" name="ai_wine_rater_default_score" value="' . esc_attr($score) . '" />';
    echo '<p class="description">শর্টকোডে score না দিলে এই ভ্যালু ব্যবহার হবে (0-5)</p>';
}

// Day 2 + Day 3: Shortcode - Wine Rating দেখানো (ডিফল্ট স্কোর সেটিংস থেকে নেয়া)
function ai_wine_rater_shortcode($atts) {
    $default_score = get_option('ai_wine_rater_default_score', '5'); // সেটিংস থেকে ডিফল্ট

    $atts = shortcode_atts(array(
        'score' => $default_score,
        'text' => 'Excellent Wine!',
    ), $atts, 'wine_rating');

    $score = floatval($atts['score']);
    $text = esc_html($atts['text']);

    $stars = '';
    for ($i = 1; $i <= 5; $i++) {
        if ($i <= $score) {
            $stars .= '★';
        } else {
            $stars .= '☆';
        }
    }

    $output = '<div style="background:#722f37; color:white; padding:20px; border-radius:10px; text-align:center; margin:30px 0; font-family:Arial;">';
    $output .= '<p style="margin:0; font-size:24px;"><strong>Wine Rating:</strong> ' . $stars . ' ' . $score . '/5</p>';
    $output .= '<p style="margin:15px 0 0; font-size:18px;">' . $text . '</p>';
    $output .= '</div>';

    return $output;
}
add_shortcode('wine_rating', 'ai_wine_rater_shortcode');