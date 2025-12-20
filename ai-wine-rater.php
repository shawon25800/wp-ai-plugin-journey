<?php
/**
 * Plugin Name: AI Wine Rater
 * Plugin URI: https://github.com/yourusername/ai-wine-rater
 * Description: my_plugin_v0.1
 * Version: 1.0
 * Author: ( Shawon)
 * Author URI: https://yourprofile.com
 * License: GPL2
 * Text Domain: ai-wine-rater
 */

// সিকিউরিটি: ডাইরেক্ট অ্যাক্সেস ব্লক করা
if (!defined('ABSPATH')) {
    exit;
}

// ফুটারে মেসেজ দেখানোর ফাংশন
function ai_wine_rater_footer_message() {
    ?>
    <div style="text-align:center; background:#722f37; color:white; padding:20px; margin-top:40px; font-size:18px;">
        🍷 Powered by AI Wine Rater Plugin – Day 1 Complete! 🚀<br>
        <small>Built with love & learning</small>
    </div>
    <?php
}
add_action('wp_footer', 'ai_wine_rater_footer_message');