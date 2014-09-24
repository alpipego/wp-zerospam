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

    public function __construct() 
    {
        // prerequisites: styles and script
        $this->outputScriptStyle();

        // add comment form field
        $this->addCommentFormFieldFilter();

        // preprocess the comment data
        $this->preprocessCommentFilter();

    }

    /**
     * register the javascript
     */
    public function enqueueScript() 
    {
        wp_enqueue_script('wp-zerospam', plugins_url('/js/wp-zerospam.js', __FILE__), array('jquery'), false, true);
    }

    /**
     * add styles that will be injected into the header directly
     * echos the value
     */
    public function addHeaderStyles() 
    {
        echo '<style>#respond,.comment-reply-link{display:none;}</style>';

    }

    /**
     * enqueues the script and adds the styles to the header
     * @return void 
     */
    public function outputScriptStyle() 
    {
        add_action('wp_enqueue_scripts', array($this, 'enqueueScript'));
        add_action('wp_head', array($this, 'addHeaderStyles'));
    }

    /**
     * adds a field to the default comment form
     * @param array $fields comment form fields
     */
    public function addCommentFormField($fields)
    {
        $fields['verify_email'] = '<p class="comment-form-verify-email"><label>Verify your e-mail address<span class="required">*</span><input type="email" name="verify-email" placeholder="re-enter your e-mail address" required /></label></p>';

        return $fields;
    }

    /**
     * filter to inject the field into comment form
     * @return void
     */
    public function addCommentFormFieldFilter() 
    {
        add_filter('comment_form_default_fields', array($this, 'addCommentFormField'));
    }

    /**
     * check if the verify email field is present, if yes redirect to the same page and do nothing      
     * @param  array $commentdata commentdata for wordpress to process
     */
    public function preprocessComment($commentdata) 
    {
        global $post;
        if(isset($_POST['verify-email'])) {
            wp_redirect(get_permalink($post->ID) . '#respond');
            exit;
        }
        return $commentdata;
    }

    /**
     * filter the peprocessor
     * @return void
     */
    public function preprocessCommentFilter() 
    {
        add_filter('preprocess_comment', array($this, 'preprocessComment'));
    }

}

function nospam() {
    $nospam = new WPZeroSpam();
}

add_action('init', 'nospam');