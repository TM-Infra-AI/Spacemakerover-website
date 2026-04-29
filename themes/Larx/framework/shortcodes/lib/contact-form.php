<?php

// Contact form

function th_contact_form7($attrs,$content=false){
    extract(shortcode_atts(array(
        'title'=>'',
        "id" => '',
    ),$attrs));
function_exists('wpcf7_add_shortcodes') && wpcf7_add_shortcodes();
    $output = '<div id="contact">';
    $output .= do_shortcode('[contact-form-7 id="'.$id.'"]');
    $output .= '</div>';


    return $output;
}

remove_shortcode('th_contact_form7');
add_shortcode('th_contact_form7', 'th_contact_form7');