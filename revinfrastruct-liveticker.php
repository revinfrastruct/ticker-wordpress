<?php
/*
Plugin Name: revInfrastruct live-ticker
Plugin URI: https://github.com/revinfrastruct
Description: Adds a live-ticker post type for managing news during demos etc.
Version: 0.1.0
Author: revInfrastruct
Author URI: https://github.com/revinfrastruct
*/

if (!defined('ABSPATH')) {
    exit();
}

define('REVINFRASTRUCT_LIVETICKER_PATH', plugin_dir_path(__FILE__));
define('REVINFRASTRUCT_LIVETICKER_URL', plugins_url('', __FILE__));

require REVINFRASTRUCT_LIVETICKER_PATH . '/src/LiveTicker.php';
new RevInfrastruct\LiveTicker\LiveTicker();
