<?php
/*
Plugin Name: Variable Fonts Effect WordPress
Description: Add a text effect to your site. [custom_text text="Hello World"]

Version: 1.0
Author: Hasan Naqvi
*/

// Enqueue scripts and styles
function text_effect_enqueue_scripts() {
    // Enqueue Dat.GUI library
    wp_enqueue_script('dat-gui', 'https://cdnjs.cloudflare.com/ajax/libs/dat-gui/0.7.5/dat.gui.min.js', array(), '0.7.5', true);

    // Enqueue your custom script
    wp_enqueue_script('text-effect-script', plugin_dir_url(__FILE__) . 'script.js', array('dat-gui'), '1.0', true);

    // Enqueue your custom styles
    wp_enqueue_style('text-effect-style', plugin_dir_url(__FILE__) . 'style.css', array(), '1.0');
}
add_action('wp_enqueue_scripts', 'text_effect_enqueue_scripts');

function custom_text_shortcode($atts) {
    // Extract shortcode attributes
    $atts = shortcode_atts(
        array(
            'text' => 'Custom Text',  // Default text
        ),
        $atts,
        'custom_text'
    );

    // Sanitize shortcode attribute
    $text = esc_html($atts['text']);

    // Generate a unique ID for this shortcode instance
    $unique_id = 'custom_text_' . uniqid();

    // Build the output HTML with the unique ID
    $output = "<div id='fit' class='$unique_id'>";
    $output .= "<h1 id='title' class='$unique_id'>$text</h1>";
    $output .= "</div>";

    return $output;
}

// Shortcode with text change option
add_shortcode('custom_text', 'custom_text_shortcode');
