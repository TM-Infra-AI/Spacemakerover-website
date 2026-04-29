<?php

/* Template Name: Interior Design Services */



function th_Interior_Design_Services($atts, $content = null) {
    extract(shortcode_atts(array(
        "icon" => 'heart-o',
        "title" => '',
        "text" => '',
        "el_class" => '',
		$excerpt = ''
    ), $atts));

    $icon = str_replace('fa-','',$icon);   ?>
   <div class="row" id="services">
    <?php   $output = '';
	 $my_query = new WP_Query('post_type=services&showposts=20');
while ($my_query->have_pages()) : $my_query->the_page();
              
			 $output .= '<div class="col-md-4 vc_custom"><div class="service-box"><div class="">
						<i class="fa fa-cubes fa-3x"></i>
		  <div class="service-title">'; 
			
			$title = get_the_title();
			$page_content = excerpt(15);
    
      $output .= '<h3>'.$title.'</h3>
       </div>
        <p class="servicecon">'.$page_content.'</p>
	   </div></div></div>';
				
	   endwhile;		
	    return $output;
	
}

remove_shortcode('Interior_Design_Services');
add_shortcode('Interior_Design_Services', 'th_Interior_Design_Services');
?>
