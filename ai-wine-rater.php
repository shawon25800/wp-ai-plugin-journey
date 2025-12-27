<?php
/**
 * Plugin Name: AI Wine Rater
 * Plugin URI: https://github.com/shawon25800/wp-ai-plugin-journey
 * Description: A powerful WordPress plugin for wine reviews with star ratings, comments, average calculation, and full admin control. Built with Grok AI 🍷
 * Version: 1.0
 * Author: Shawon
 * Author URI: https://github.com/shawon25800
 * License: GPL2
 * Text Domain: ai-wine-rater
 */

// Security
if (!defined('ABSPATH')) {
    exit;
}

// Day 1: Footer message
function ai_wine_rater_footer_message() {
    ?>
    <div style="text-align:center; background:#5f9ea0; color:white; padding:20px; margin-top:40px; font-size:18px;">
        (test to push in github) Hey Grok lets build something.. 🍷 IT's my day 2 🚀<br>
        <small>Lets make a better plugin</small>
    </div>
    <?php
}
add_action('wp_footer', 'ai_wine_rater_footer_message');

// Day 2: Admin notice
function ai_wine_rater_day2_admin_notice() {
    ?>
    <div class="notice notice-success is-dismissible">
        <p>🍷 </p>
    </div>
    <?php
}
add_action('admin_notices', 'ai_wine_rater_day2_admin_notice');

// Day 2: Head meta
function ai_wine_rater_custom_meta() {
    echo '<meta name="author" content="Shawon - Learning with Grok AI 🍷">';
    echo '<meta name="description" content="AI Wine Rater Plugin - Learning WordPress Development">';
}
add_action('wp_head', 'ai_wine_rater_custom_meta');

// Day 2: Content filter
function ai_wine_rater_add_footer_to_content($content) {
    if (is_single()) {
        $extra_content = '<div style="margin-top: 30px; padding: 20px; background: #f8f8f8; border-left: 5px solid #722f37;">';
        $extra_content .= '<p><strong>Day 2 Filter Hook Test:</strong></p>';
        $extra_content .= '<p>This content was automatically added using WordPress filter hook. 🍷</p>';
        $extra_content .= '<p>– AI Wine Rater Plugin (Learning Hooks with Grok)</p>';
        $extra_content .= '</div>';
        $content .= $extra_content;
    }
    return $content;
}
add_filter('the_content', 'ai_wine_rater_add_footer_to_content');

// Day 2: Title prefix
function ai_wine_rater_prefix_title($title) {
    if (is_single()) {
        $title = '[Day 2] ' . $title;
    }
    return $title;
}
add_filter('the_title', 'ai_wine_rater_prefix_title');

// Day 3 & 4: Main menu – Home page (Welcome message)
function ai_wine_rater_home_page() {
    ?>
    <div class="wrap">
        <h1>🍷 Welcome to AI Wine Rater Plugin</h1>
        <p style="font-size:18px;">You are building a powerful wine review plugin with Grok AI!</p>
        <p style="font-size:16px;">Go to “Wine Settings” from submenu to change color, font, default rating.</p>
        <p style="font-size:16px;">Manage wine reviews from “All Reviews”.</p>
        <hr>
        <p>You are doing great! Let's go to the next level 🚀</p>
    </div>
    <?php
}

// Day 3 & 4: Main menu + submenu
function ai_wine_rater_admin_menu() {
    add_menu_page(
        'AI Wine Rater',
        'Wine Rater',
        'manage_options',
        'ai-wine-rater-home',
        'ai_wine_rater_home_page',
        'dashicons-star-filled',
        80
    );

    add_submenu_page(
        'ai-wine-rater-home',
        'Wine Settings',
        'Wine Settings',
        'manage_options',
        'ai-wine-rater-settings',
        'ai_wine_rater_settings_page'
    );

    add_submenu_page(
        'ai-wine-rater-home',
        'All Reviews',
        'All Reviews',
        'manage_options',
        'edit.php?post_type=wine'
    );

    add_submenu_page(
        'ai-wine-rater-home',
        'Add New Review',
        'Add New Review',
        'manage_options',
        'post-new.php?post_type=wine'
    );
}
add_action('admin_menu', 'ai_wine_rater_admin_menu');

// Hide duplicate main menu
function ai_wine_rater_remove_duplicate_submenu() {
    remove_submenu_page('ai-wine-rater-home', 'ai-wine-rater-home');
}
add_action('admin_menu', 'ai_wine_rater_remove_duplicate_submenu', 999);

// Day 3 & 4: Settings page – glassmorphism style
function ai_wine_rater_settings_page() {
    ?>
    <div class="wrap" style="background: url('https://images.unsplash.com/photo-1516594794599-4a5e4b9e9a5d?ixlib=rb-4.0.3&auto=format&fit=crop&q=80') no-repeat center center fixed; background-size: cover; min-height: 100vh;">
        <div style="max-width: 800px; margin: 40px auto; padding: 40px; background: rgba(255, 255, 255, 0.15); border-radius: 16px; box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.18);">
            <h1 style="text-align:center; color:black; text-shadow: 0 2px 10px rgba(0,0,0,0.5);">🍷 AI Wine Rater Settings</h1>
            <form method="post" action="options.php" style="background: rgba(255, 255, 255, 0.1); padding: 30px; border-radius: 12px;">
                <?php
                settings_fields('ai_wine_rater_settings_group');
                do_settings_sections('ai-wine-rater-settings');
                submit_button('Save Changes', 'primary', 'submit', true, array('style' => 'background:#722f37; border:none; padding:12px 30px; font-size:16px; border-radius:8px;'));
                ?>
            </form>
        </div>
    </div>
    <?php
}

// Day 3 & 4: Settings register
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

// Field functions
function ai_wine_rater_default_score_field() {
    $score = get_option('ai_wine_rater_default_score', '5');
    echo '<input type="number" step="0.1" min="0" max="5" name="ai_wine_rater_default_score" value="' . esc_attr($score) . '" />';
    echo '<p class="description">Default value used when no score is provided in shortcode (0-5)</p>';
}

function ai_wine_rater_box_color_field() {
    $color = get_option('ai_wine_rater_box_color', '#722f37');
    echo '<input type="text" name="ai_wine_rater_box_color" value="' . esc_attr($color) . '" class="my-color-field" />';
    echo '<p class="description">Background color of rating box (hex code, e.g. #722f37)</p>';
}

function ai_wine_rater_text_font_field() {
    $font = get_option('ai_wine_rater_text_font', 'Arial');
    $fonts = array(
        'Arial' => 'Arial',
        'Georgia' => 'Georgia',
        'Helvetica' => 'Helvetica',
        'Times New Roman' => '"Times New Roman", Times, serif',
        'Verdana' => 'Verdana',
        'Courier New' => '"Courier New", Courier, monospace',
        'Trebuchet MS' => '"Trebuchet MS", Helvetica, sans-serif',
        'Palatino' => 'Palatino, "Palatino Linotype", serif',
        'Lucida Sans' => '"Lucida Sans Unicode", "Lucida Grande", sans-serif',
        'Impact' => 'Impact, Charcoal, sans-serif',
    );
    echo '<select name="ai_wine_rater_text_font">';
    foreach ($fonts as $value => $label) {
        echo '<option value="' . esc_attr($value) . '" ' . selected($font, $value, false) . '>' . esc_html($label) . '</option>';
    }
    echo '</select>';
    echo '<p class="description">Choose font family for rating text</p>';
}

// Day 4: Color picker load
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

// Day 8: Shortcode – average rating + half star
function ai_wine_rater_shortcode($atts) {
    global $post;
    $default_score = get_option('ai_wine_rater_default_score', '5');
    $box_color = get_option('ai_wine_rater_box_color', '#722f37');
    $text_font = get_option('ai_wine_rater_text_font', 'Arial');
    $user_reviews = (get_post_type() == 'wine' && $post) ? get_post_meta($post->ID, '_wine_user_reviews', true) : array();
    $user_reviews = is_array($user_reviews) ? $user_reviews : array();
    $average_score = count($user_reviews) > 0 ? round(array_sum(array_column($user_reviews, 'rating')) / count($user_reviews), 1) : $default_score;

    $atts = shortcode_atts(array(
        'score' => $average_score,
        'text'  => 'Average Rating from Users',
    ), $atts, 'wine_rating');

    $score = floatval($atts['score']);
    $text = esc_html($atts['text']);

    $stars = '';
    for ($i = 1; $i <= 5; $i++) {
        if ($score >= $i) {
            $stars .= '★';
        } elseif ($score >= $i - 0.5) {
            $stars .= '½';
        } else {
            $stars .= '☆';
        }
    }

    $output = '<div style="background:' . esc_attr($box_color) . '; color:white; padding:20px; border-radius:10px; text-align:center; margin:30px 0; font-family:' . esc_attr($text_font) . ';">';
    $output .= '<p style="margin:0; font-size:24px;"><strong>User Average Rating:</strong> ' . $stars . ' ' . $score . '/5</p>';
    $output .= '<p style="margin:15px 0 0; font-size:18px;">(' . count($user_reviews) . ' reviews)</p>';
    $output .= '<p style="margin:10px 0 0;">' . $text . '</p>';
    $output .= '</div>';

    return $output;
}
add_shortcode('wine_rating', 'ai_wine_rater_shortcode');

// Day 6: Auto rating on single page
function ai_wine_rater_auto_rating_single($content) {
    if (is_singular('wine') && in_the_loop() && is_main_query()) {
        $content .= do_shortcode('[wine_rating text="Reviewed by AI Wine Rater"]');
    }
    return $content;
}
add_filter('the_content', 'ai_wine_rater_auto_rating_single');

// Day 6: Archive rating
function ai_wine_rater_archive_display_rating() {
    global $post;
    if (get_post_type($post) === 'wine') {
        $rating = get_post_meta($post->ID, '_wine_rating_score', true) ?: 'Not rated';
        echo '<p style="font-weight:bold; color:#722f37;">Rating: ' . esc_html($rating) . '/5</p>';
    }
}
add_action('the_excerpt', 'ai_wine_rater_archive_display_rating');

// Day 9: Rating form with comment + nonce
function ai_wine_rater_frontend_rating_form($content) {
    if (is_singular('wine') && in_the_loop() && is_main_query()) {
        global $post;
        $post_id = $post->ID;

        $form = '<div style="margin:40px 0; padding:25px; background:#f8f8f8; border-radius:12px; text-align:center;">';
        $form .= '<h3>Rate this Wine</h3>';
        $form .= '<form id="wine-rating-form">';
        $form .= '<input type="hidden" name="post_id" value="' . $post_id . '" />';
        $form .= '<input type="hidden" name="nonce" value="' . wp_create_nonce('ai_wine_rater_nonce') . '" />';
        $form .= '<div class="rating-stars" style="font-size:40px; margin:15px 0;">';
        for ($i = 5; $i >= 1; $i--) {
            $form .= '<span class="star" data-value="' . $i . '" style="cursor:pointer; color:#ccc;">★</span>';
        }
        $form .= '</div>';
        $form .= '<textarea name="comment" placeholder="Your comment (optional)" style="width:100%; height:80px; margin:10px 0; padding:10px;"></textarea>';
        $form .= '<button type="submit" style="padding:10px 20px; background:#722f37; color:white; border:none; border-radius:5px; cursor:pointer;">Submit Rating</button>';
        $form .= '<p id="rating-response" style="margin-top:15px; font-weight:bold;"></p>';
        $form .= '</form>';
        $form .= '</div>';

        $content .= $form;
    }
    return $content;
}
add_filter('the_content', 'ai_wine_rater_frontend_rating_form');

// Day 9: Frontend JS
function ai_wine_rater_enqueue_frontend_scripts() {
    if (is_singular('wine')) {
        wp_enqueue_script('jquery');
        wp_add_inline_script('jquery', '
            jQuery(document).ready(function($) {
                var selectedRating = 0;

                $(".star").on("click", function() {
                    selectedRating = $(this).data("value");
                    $(".star").css("color", "#ccc");
                    $(this).prevAll(".star").addBack().css("color", "#722f37");
                });

                $("#wine-rating-form").on("submit", function(e) {
                    e.preventDefault();

                    if (selectedRating == 0) {
                        $("#rating-response").html("Please select a rating!").css("color", "red");
                        return;
                    }

                    var data = {
                        action: "ai_wine_rater_submit",
                        post_id: $(this).find("input[name=\'post_id\']").val(),
                        rating: selectedRating,
                        comment: $(this).find("textarea[name=\'comment\']").val(),
                        nonce: $(this).find("input[name=\'nonce\']").val()
                    };

                    $.post("' . admin_url('admin-ajax.php') . '", data, function(response) {
                        if (response.success) {
                            $("#rating-response").html(response.data.message).css("color", "green");
                        } else {
                            $("#rating-response").html("Error: " + (response.data.message || "Something went wrong")).css("color", "red");
                        }
                    }, "json").fail(function() {
                        $("#rating-response").html("Server error. Try again.").css("color", "red");
                    });
                });
            });
        ');
    }
}
add_action('wp_enqueue_scripts', 'ai_wine_rater_enqueue_frontend_scripts');

// Day 9: AJAX handler
function ai_wine_rater_submit_rating() {
    check_ajax_referer('ai_wine_rater_nonce', 'nonce');

    $post_id = intval($_POST['post_id']);
    $rating = floatval($_POST['rating']);
    $comment = sanitize_text_field($_POST['comment'] ?? '');

    if ($rating < 1 || $rating > 5 || get_post_type($post_id) !== 'wine') {
        wp_send_json_error(array('message' => 'Invalid rating or post.'));
    }

    $reviews = get_post_meta($post_id, '_wine_user_reviews', true);
    $reviews = is_array($reviews) ? $reviews : array();

    $reviews[] = array(
        'rating'  => $rating,
        'comment' => $comment,
        'time'    => time()
    );

    update_post_meta($post_id, '_wine_user_reviews', $reviews);

    $average = count($reviews) > 0 ? round(array_sum(array_column($reviews, 'rating')) / count($reviews), 1) : 0;

    wp_send_json_success(array('message' => 'Thank you! Your rating ' . $rating . '/5 submitted. Average: ' . $average . '/5'));
}
add_action('wp_ajax_ai_wine_rater_submit', 'ai_wine_rater_submit_rating');
add_action('wp_ajax_nopriv_ai_wine_rater_submit', 'ai_wine_rater_submit_rating');

// Day 9: Display all reviews
function ai_wine_rater_display_reviews($content) {
    if (is_singular('wine') && in_the_loop() && is_main_query()) {
        global $post;
        $post_id = $post->ID;

        $reviews = get_post_meta($post_id, '_wine_user_reviews', true);
        $reviews = is_array($reviews) ? $reviews : array();

        if (!empty($reviews)) {
            $list = '<div style="margin:40px 0;">';
            $list .= '<h3>All Reviews (' . count($reviews) . ')</h3>';
            $list .= '<ul style="list-style:none; padding:0;">';
            foreach ($reviews as $review) {
                $stars = '';
                for ($i = 1; $i <= 5; $i++) {
                    $stars .= ($i <= $review['rating']) ? '★' : '☆';
                }
                $list .= '<li style="background:#f9f9f9; margin:10px 0; padding:15px; border-radius:8px;">';
                $list .= '<p><strong>Rating:</strong> ' . $stars . ' (' . $review['rating'] . '/5)</p>';
                if (!empty($review['comment'])) {
                    $list .= '<p><strong>Comment:</strong> ' . esc_html($review['comment']) . '</p>';
                }
                $list .= '<small>Reviewed on: ' . date('F j, Y', $review['time']) . '</small>';
                $list .= '</li>';
            }
            $list .= '</ul>';
            $list .= '</div>';

            $content .= $list;
        }
    }
    return $content;
}
add_filter('the_content', 'ai_wine_rater_display_reviews');

// Day 8: Admin column average
function ai_wine_rater_add_admin_column($columns) {
    $columns['user_rating'] = 'Average User Rating';
    return $columns;
}
add_filter('manage_wine_posts_columns', 'ai_wine_rater_add_admin_column');

function ai_wine_rater_admin_column_value($column, $post_id) {
    if ($column == 'user_rating') {
        $reviews = get_post_meta($post_id, '_wine_user_reviews', true);
        $reviews = is_array($reviews) ? $reviews : array();

        if (count($reviews) > 0) {
            $average = round(array_sum(array_column($reviews, 'rating')) / count($reviews), 1);
            echo esc_html($average) . '/5 (' . count($reviews) . ' reviews)';
        } else {
            echo 'No rating yet';
        }
    }
}
add_action('manage_wine_posts_custom_column', 'ai_wine_rater_admin_column_value', 10, 2);

// Day 9: Manage Reviews page with glassmorphism
function ai_wine_rater_manage_reviews_page() {
    ?>
    <div class="wrap" style="background: url('https://images.unsplash.com/photo-1516594794599-4a5e4b9e9a5d?ixlib=rb-4.0.3&auto=format&fit=crop&q=80') no-repeat center center fixed; background-size: cover; min-height: 100vh;">
        <div style="max-width: 1000px; margin: 40px auto; padding: 40px; background: rgba(255, 255, 255, 0.15); border-radius: 16px; box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.18);">
            <h1 style="text-align:center; color:black; text-shadow: 0 2px 10px rgba(0,0,0,0.5);">🍷 Manage User Reviews</h1>

            <?php
            $all_wines = get_posts(array(
                'post_type' => 'wine',
                'numberposts' => -1,
                'post_status' => 'publish'
            ));

            if (empty($all_wines)) {
                echo '<p style="color:white;">No wines found.</p>';
                return;
            }

            foreach ($all_wines as $wine) {
                $reviews = get_post_meta($wine->ID, '_wine_user_reviews', true);
                $reviews = is_array($reviews) ? $reviews : array();

                if (!empty($reviews)) {
                    echo '<h2 style="color:white;">' . esc_html($wine->post_title) . ' (ID: ' . $wine->ID . ')</h2>';
                    echo '<table class="widefat fixed" style="background:rgba(255,255,255,0.2); color:white;">';
                    echo '<thead><tr><th style="color:black;">Rating</th><th style="color:black;">Comment</th><th style="color:black;">Date</th><th style="color:black;">Action</th></tr></thead>';
                    echo '<tbody>';

                    foreach ($reviews as $index => $review) {
                        $stars = str_repeat('★', $review['rating']) . str_repeat('☆', 5 - $review['rating']);
                        echo '<tr style="background:rgba(255,255,255,0.1);">';
                        echo '<td>' . $stars . ' (' . $review['rating'] . '/5)</td>';
                        echo '<td>' . esc_html($review['comment'] ?: 'No comment') . '</td>';
                        echo '<td>' . date('F j, Y', $review['time']) . '</td>';
                        echo '<td>';
                        echo '<form method="post" style="display:inline;">';
                        echo '<input type="hidden" name="delete_review_post_id" value="' . $wine->ID . '" />';
                        echo '<input type="hidden" name="delete_review_index" value="' . $index . '" />';
                        wp_nonce_field('delete_review_nonce', 'delete_review_nonce');
                        echo '<button type="submit" class="button button-secondary" onclick="return confirm(\'Are you sure you want to delete this review?\')">Delete</button>';
                        echo '</form>';
                        echo '</td>';
                        echo '</tr>';
                    }

                    echo '</tbody></table><br>';
                }
            }

            // Delete handler
            if (isset($_POST['delete_review_post_id']) && wp_verify_nonce($_POST['delete_review_nonce'], 'delete_review_nonce')) {
                $post_id = intval($_POST['delete_review_post_id']);
                $index = intval($_POST['delete_review_index']);

                $reviews = get_post_meta($post_id, '_wine_user_reviews', true);
                $reviews = is_array($reviews) ? $reviews : array();

                if (isset($reviews[$index])) {
                    unset($reviews[$index]);
                    $reviews = array_values($reviews);
                    update_post_meta($post_id, '_wine_user_reviews', $reviews);
                    echo '<div class="notice notice-success"><p>Review deleted successfully!</p></div>';
                }
            }
            ?>
        </div>
    </div>
    <?php
}

// Add Manage Reviews submenu
function ai_wine_rater_add_manage_reviews_menu() {
    add_submenu_page(
        'ai-wine-rater-home',
        'Manage Reviews',
        'Manage Reviews',
        'manage_options',
        'ai-wine-rater-manage-reviews',
        'ai_wine_rater_manage_reviews_page'
    );
}
add_action('admin_menu', 'ai_wine_rater_add_manage_reviews_menu');