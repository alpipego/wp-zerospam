<?php
/*
Plugin Name: Zero Null Nada Spam
Plugin URI: https://github.com/alpipego/wp-zerospam
Description: A WordPress Plugin to get rid of comment spam as Akisment/Anti Spam Bee an alike all failed. Loosely based on a technique I have been using for years in contact forms and http://davidwalsh.name/wordpress-comment-spam
Author: Alex
Version: 0.1
Author URI: http://alpipego.com/
*/

class WPZeroSpam 
{

    public function __contstruct() 
    {
        
    }

    /**
     * get the stylesheet we're going to inject our styles into
     * @return string $handle stylesheet handle
     */
     
    private function _styles() 
    {        
        global $wp_styles;
        $queue = array_reverse($wp_styles->queue);
        foreach ($queue as $handle) {
            if (! array_key_exists('conditional', $wp_styles->registered[$handle]->extra)) {
                return $handle;
            }
        }
    }

}

function nospam() {
    $nospam = new WPZeroSpam();
    global $wp_styles;
    echo '<code><pre>';
        // var_dump($wp_styles->registered['colors']);
        var_dump($nospam->styles());
    echo '</pre></code>';
}
add_action('wp_footer', 'nospam');