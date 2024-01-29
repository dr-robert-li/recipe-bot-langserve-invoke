<?php

/**
 * Plugin Name:       Recipe Bot
 * Description:       A recipe bot!
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * License:           MIT
 * Text Domain:       recipe-bot
 *
 * @package           recipe-bot
 */

// ─── Prevent Direct Access ───────────────────────────────────────────────────
if (!defined('ABSPATH')) exit;


// ─── Constants ───────────────────────────────────────────────────────────────
define('RBP_VER', '1.0.0');
define('RBP_PATH', plugin_dir_path(__FILE__));
define('RBP_URL', plugin_dir_url(__FILE__));


// ─── Modules ─────────────────────────────────────────────────────────────────
require RBP_PATH . 'app/loader.php';
require RBP_PATH . 'vendor/meta-box/meta-box.php';
require RBP_PATH . 'vendor/mb-blocks/mb-blocks.php';
