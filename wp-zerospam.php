<?php

namespace Alpipego\ZeroSpam;

/**
 * Plugin Name: Zero Null Nada Spam
 * Plugin URI: https://github.com/alpipego/wp-zerospam
 * Description: A WordPress Plugin to get rid of comment spam as Akisment/Anti Spam Bee an alike all failed. Loosely based on a technique I have been using for years in contact forms and http://davidwalsh.name/wordpress-comment-spam
 * Author: alpipego
 * Version: 1.1.0
 * Author URI: http://alpipego.com/
*/

require_once(__DIR__ . '/WPZeroSpam.php');

add_action('init', new WPZeroSpam());
