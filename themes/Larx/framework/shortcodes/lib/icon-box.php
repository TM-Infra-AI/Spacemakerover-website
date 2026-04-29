<?php

// Icon Box Shortcode

function th_icon_box($atts, $content = null) {
    extract(shortcode_atts(array(
        "icon" => 'heart-o',
        "title" => '',
        "text" => '',
    ), $atts));

    $icon = str_replace('fa-','',$icon);


$output = '<div class="about-caption text-left">
                <div class="col-sm-2">
                    <i class="fa fa-'.$icon.' fa-2x"></i>
                </div>
                <div class="col-sm-10">
                    <h3>'.$title.'</h3>
                    <p>'.$text.'</p>
                </div>
            </div>';

        return $output;
}

remove_shortcode('icon_box');
add_shortcode('icon_box', 'th_icon_box');