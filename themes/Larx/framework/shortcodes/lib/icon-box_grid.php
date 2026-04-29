<?php

// Icon Box Grid

function th_icon_box_grid($atts, $content = null) {
    extract(shortcode_atts(array(
        "icon" => 'heart-o',
        "title" => '',
        "text" => '',
        "el_class" => '',
		"parent" => 0,
		$excerpt = ''
    ), $atts));

    $icon = str_replace('fa-','',$icon);   ?>
   <div class="row" id="services">
    <?php   $output = '';
	 $my_query = new WP_Query('post_type=services&showposts=20&post_parent='.$parent);
while ($my_query->have_posts()) : $my_query->the_post();
              
			 $output .= '<div class="col-md-4 vc_custom"><div class="service-box"><div class="">
						<a href="'.get_the_permalink(get_the_ID()).'"><i class="fa fa-cubes fa-3x"></i></a>
		  <div class="service-title">'; 
			
			$title = get_the_title();
			$post_content = excerpt(15);
    
      $output .= '<h3><a href="'.get_the_permalink(get_the_ID()).'">'.$title.'</a></h3>
       </div>
        <p class="servicecon">'.$post_content.'</p>
	   </div></div></div>';
				
	   endwhile;		
	    return $output;
	
}

remove_shortcode('icon_box_grid');
add_shortcode('icon_box_grid', 'th_icon_box_grid');

