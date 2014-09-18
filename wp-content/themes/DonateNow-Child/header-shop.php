<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="ie6 oldie no-js"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7 oldie no-js"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8 oldie no-js"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="ie9 no-js"> <![endif]-->
<html <?php language_attributes(); ?>>
<head>    
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); 
	
 global $page, $post, $paged;	
	
?>

</head>
<body <?php body_class(); ?> >

 
<?php
$title_bg=get_post_meta($post->ID, "m_title_backgrounds", true);
$title_sub=get_post_meta($post->ID, "m_title_sub", true);
$title=get_post_meta($post->ID, "m_title_on", true);
$header=get_post_meta($post->ID, "madza_header_type", true);
$headerp=get_post_meta($post->ID, "m_page_background", true); 
$_bacground_image_page=get_post_meta($post->ID, "m_page_background", true); 
$breadcrumbs = get_post_meta($post->ID, "m_title_bred", true);
$pagination_navigation = get_post_meta($post->ID, "madza_portfolio_navigation", true);



/*-----------------------------------------------------------------------------------*/
/*	BG IMAGE
/*-----------------------------------------------------------------------------------*/

$_background_exist = "no";
if ( $_bacground_image_page !="") { if (  $_bacground_image_page['background-image'] !="" ) { $_background_exist = "yes"; } }

$_background_exist_r = "no";
if ( $_bacground_image_page !="") { if ( $_bacground_image_page['background-repeat'] !="" ) { $_background_exist_r = "yes"; } }

$mt_homepage_bg = ot_get_option('mt_homepage_bg'); 
if (is_front_page()){  
	if ( ! empty( $mt_homepage_bg )) {  
		if ($mt_homepage_bg['background-repeat']=="" and $mt_homepage_bg['background-image']!=""){  
	
			$mt_homepage_bg = ot_get_option('mt_homepage_bg'); 
		
			?><img id="background" src="<?php echo $mt_homepage_bg['background-image']; ?>" alt=""  /><?php 
		
		}
	}
} else if ( $_background_exist == "yes" and $_background_exist_r ="no" ) {   

		?><img id="background" src="<?php echo $_bacground_image_page['background-image']; ?>" alt=""  /><?php 

	
} else if($_background_exist == "no" and $_background_exist_r ="no") {	

	$mt_homepage_bg = ot_get_option('mt_defaultpage_bg'); 
	
		if ( ! empty( $mt_homepage_bg )) { 
				if($mt_homepage_bg['background-repeat']=="") { 
					?><img id="background" src="<?php echo $mt_homepage_bg['background-image']; ?>" alt=""  /><?php 
		
				}
	 	}
	 	
}






function mt_logo() {

	$logo_image = ot_get_option("theme_logo");
	$logo_image_responsive = ot_get_option("responsive_logo");
	
	?>
	<a  class="visible-desktop" style="margin-top:<?php if(ot_get_option("logo_style_margin")!="") { echo ot_get_option("logo_style_margin"); } else { echo "20"; } ?>px" id="logo" href="<?php echo home_url();?>">
	
		<img width="<?php if(ot_get_option("logo_style_width")!="") { echo ot_get_option("logo_style_width"); } else { echo "225"; } ?>" height="<?php if(ot_get_option("logo_style_height")!="") { echo ot_get_option("logo_style_height"); } else { echo "40"; } ?>" src="<?php echo $logo_image; ?>"  alt="<?php bloginfo('name'); ?>" />
		
	</a>
	
	<a class="hidden-desktop" style="margin-top:<?php if(ot_get_option("logo_style_margin")!="") { echo ot_get_option("logo_style_margin"); } else { echo "20"; } ?>px" id="logo" href="<?php echo home_url();?>">
	
		
		<img  width="<?php if(ot_get_option("logo_style_width")!="") { echo ot_get_option("logo_style_width"); } else { echo "225"; } ?>" height="<?php if(ot_get_option("logo_style_height")!="") { echo ot_get_option("logo_style_height"); } else { echo "40"; } ?>" src="<?php echo $logo_image_responsive; ?>" alt="<?php bloginfo('name'); ?>" />
		
	</a>
	<?php
}

add_filter('mt_logo','mt_logo');


function mt_social() {

	?> <ul id="header-socials" class="tt-wrapper"> <?php
	
		if(ot_get_option('soc_facebook')!="") {?><li class="tt-facebook header-social"><a class="facebook" href="<?php echo ot_get_option('soc_facebook'); ?>"><span>Facebook</span></a></li><?php } 
		if(ot_get_option('soc_twitter')!="") {?><li class=" header-social"><a class="twitter" href="<?php echo ot_get_option('soc_twitter'); ?>"><span>Twitter</span></a></li><?php } 
		if(ot_get_option('soc_vimeo')!="") {?><li class=" header-social"><a class="vimeo" href="<?php echo ot_get_option('soc_vimeo'); ?>"><span>Vimeo</span></a></li><?php } 
		if(ot_get_option('soc_youtube')!="") {?><li class=" header-social"><a class="youtube" href="<?php echo ot_get_option('soc_youtube'); ?>"><span>Youtube</span></a></li><?php } 
		if(ot_get_option('soc_linkedin')!="") {?><li class=" header-social"><a class="linkedin" href="<?php echo ot_get_option('soc_linkedin'); ?>"><span>LinkedIn</span></a></li><?php } 
		if(ot_get_option('soc_google')!="") {?><li class=" header-social"><a class="gplus" href="<?php echo ot_get_option('soc_google'); ?>"><span>GooglePlus</span></a></li><?php } 
		if(ot_get_option('soc_dribbble')!="") {?><li class=" header-social"><a class="dribbble" href="<?php echo ot_get_option('soc_dribbble'); ?>"><span>Dribble</span></a></li><?php } 
		if(ot_get_option('soc_skype')!="") {?><li class=" header-social"><a class="skype" href="<?php echo ot_get_option('soc_skype'); ?>"><span>Skype</span></a></li><?php }
		if(ot_get_option('soc_delicious')!="") {?><li class=" header-social"><a class="delicious" href="<?php echo ot_get_option('soc_delicious'); ?>"><span>Delicious</span></a></li><?php } 
		if(ot_get_option('soc_pinterest')!="") {?><li class=" header-social"><a class="pinterest" href="<?php echo ot_get_option('soc_pinterest'); ?>"><span>Pinterest</span></a></li><?php } 
		if(ot_get_option('soc_yahoo')!="") {?><li class=" header-social"><a class="yahoo" href="<?php echo ot_get_option('soc_yahoo'); ?>"><span>Yahoo</span></a></li><?php } 
		if(ot_get_option('soc_amazon')!="") {?><li class=" header-social"><a class="amazon" href="<?php echo ot_get_option('soc_amazon'); ?>"><span>Amazon</span></a></li><?php } 
		if(ot_get_option('soc_rss')!="") {?><li class=" header-social"><a class="rss" href="<?php echo ot_get_option('soc_rss'); ?>"><span>Rss</span></a></li><?php } 
		
	?> </ul> <?php
}

add_filter('mt_social','mt_social');


function mt_header_html() {

	?><div id="header_html_area"><?php echo ot_get_option('mt_top_html'); ?></div><?php
}

add_filter('mt_header_html','mt_header_html');



function mt_menu() {
	wp_nav_menu( array('theme_location'=>"header_menu", 'container' =>false,  'menu_class' => 'sf-menu',  'menu_id' => 'menu', 'echo' => true, 'depth' => 0)); 
    wp_nav_menu( array('theme_location'=>'select_menu', 'walker'=>new select_menu_walker(), 'items_wrap' => '<select class="select-menu" id="sec-selector" name="sec-selector" onchange="location.href = document.getElementById(\'sec-selector\').value;">%3$s</select>',  'container_id' => 'mobile_menu_secondary' ));
}

add_filter('mt_menu','mt_menu');



function mt_menu_html() {

	if(ot_get_option('right_area_search')=="html") { ?>
        
	    <div class="mt_menu_description"><?php echo ot_get_option('mt_menu_html'); ?></div>
	  
	<?php  } 
}

add_filter('mt_menu_html','mt_menu_html');

?>

<?php if(get_post_meta($post->ID, "mt_style_header", true)!="style_default" and get_post_meta($post->ID, "mt_style_header", true)!="")  {?>

	<?php if(get_post_meta($post->ID, "mt_style_header", true)=="style_1") { ?>
    	

        
        <header id="header">
			<div class="container">
				<div class="row">
				
			    	<div class="span4"><?php mt_logo(); ?></div>	
			    	
			    	<div class="span8 header-right">
			    		
			    		<?php mt_header_html(); ?>
			    		<?php mt_social(); ?>
                        
			    		
				    </div>
				     
			    </div>
		    </div>
		    
		 </header>
		 
		 <div id="nav"> 
		 	
			<div class="container">
				<div class="row">
					
					<div class="<?php if(ot_get_option('right_area_search')=="search") { echo "span12"; } else { echo "span8"; } ?>"><?php mt_menu(); ?></div>
					<?php if(ot_get_option('right_area_search')=="search") { } else { ?><div class=""><?php mt_menu_html(); ?></div><?php } ?>
					
				</div>
			</div>		 
			      
		</div>
	
	<?php } ?>
	
	<?php if(get_post_meta($post->ID, "mt_style_header", true)=="style_4") { ?>
    
	
		<header id="header">
		
			<div class="container">
				
				<div class="row">
			    	<div class="span12"><?php mt_logo(); ?></div>	
			    	<div class="span12"><?php mt_menu_html(); ?></div>
			    	<div class="span12"><?php mt_header_html(); ?></div>
				</div>
				
		    </div>
		    
		 </header>
		 
		 <div id="nav"> 
		 
			<div class="container">
				<div class="row">
					
					<div class="span12"><?php mt_menu(); ?></div>
					
				</div>
			</div>		 
			      
		</div>
	
	<?php } ?>
	
	<?php if(get_post_meta($post->ID, "mt_style_header", true)=="style_2") { ?>
	
		<header id="header">
		
			<div class="container">
			
				<div class="row">
				
			    	<div class="span4"><?php mt_logo(); ?></div>	
			    	
			    	<div class="span8">
			    		
			    		<div id="nav"> <?php mt_menu(); ?></div>	
			    		
				    </div>
				     
			    </div>
			    
		    </div>
		    
		 </header>
	
	<?php } ?>
	
	<?php if(get_post_meta($post->ID, "mt_style_header", true)=="style_3") { ?>
	
		<header id="header">
		
			<div class="container">
			
				<div class="row">
				
			    	<div class="span4"><?php mt_logo(); ?></div>	
			    	
			    	<div class="span8">
			    		
			    		<div id="nav"> <?php mt_menu(); ?></div>	
			    		
				    </div>
				     
			    </div>
			    
		    </div>
		    
		 </header>
	
	<?php } ?>

<?php } else { ?>

	<?php if(ot_get_option("mt_style_header")=="style_1") { ?>
	
		<header id="header">
			<div class="container">
				<div class="row">
				
			    	<div class="span4"><?php mt_logo(); ?></div>	
			    	
			    	<div class="span8 header-right">
			    		
			    		<?php mt_header_html(); ?>
			    		<?php mt_social(); ?>	
                        

			    		
				    </div>
                          <div id="share-tagline">Serving The Hungry &amp; Homeless</div>

				     
			    </div>
		    </div>
		    
		 </header>
		 
		 <div id="nav"> 
		 	
			<div class="container">
				<div class="row">
					
					<div class="<?php echo "span12"; ?>"><?php mt_menu(); ?></div>
					<?php if(ot_get_option('right_area_search')=="search") { } else { ?><div class=""><?php mt_menu_html(); ?></div><?php } ?>

					
				</div>
			</div>		 
			      
		</div>
	
	<?php } ?>
	
	<?php if(ot_get_option("mt_style_header")=="style_4") { ?>
	
		<header id="header">
		
			<div class="container">
				
				<div class="row">
			    	<div class="span12"><?php mt_logo(); ?></div>	
			    	<div class="span12"><?php mt_menu_html(); ?></div>
			    	<div class="span12"><?php mt_header_html(); ?></div>
				</div>
				
		    </div>
		    
		 </header>
		 
		 <div id="nav"> 
		 
			<div class="container">
				<div class="row">
					
					<div class="span12"><?php mt_menu(); ?></div>
					
				</div>
			</div>		 
			      
		</div>
	
	<?php } ?>
	
	<?php if(ot_get_option("mt_style_header")=="style_2") { ?>
	
		<header id="header">
		
			<div class="container">
			
				<div class="row">
				
			    	<div class="span4"><?php mt_logo(); ?></div>	
			    	
			    	<div class="span8">
			    		
			    		<div id="nav"> <?php mt_menu(); ?></div>	
			    		
				    </div>
				     
			    </div>
			    
		    </div>
		    
		 </header>
	
	<?php } ?>
	
	<?php if(ot_get_option("mt_style_header")=="style_3") { ?>
	
		<header id="header">
		
			<div class="container">
			
				<div class="row">
				
			    	<div class="span4"><?php mt_logo(); ?></div>	
			    	
			    	<div class="span8">
			    		
			    		<div id="nav"> <?php mt_menu(); ?></div>	
			    		
				    </div>
				     
			    </div>
			    
		    </div>
		    
		 </header>
	
	<?php } ?>

<?php } ?>
	 	
<?php
/*-----------------------------------------------------------------------------------*/
/*	Slider
/*-----------------------------------------------------------------------------------*/
if (is_front_page()){
	    
		if(ot_get_option('home_slider_type')=="home_slider_flex"){  
 
   			 	function_slider_flex(); 
 	
   		} 
   
	 	if(ot_get_option('home_slider_type')=="home_slider_shortcode"){
	 
	    		echo '<div id="mt-slider-frame">';  echo do_shortcode(ot_get_option('home_slider_shortcode_code')); echo "</div>"; 
    	}

} else {
	    
	    
	    if(get_post_meta($post->ID, "mt_page_slider_type", true)=="flex_slider"){ 
	    
	    		function_slider_flex(); 
	    } 
	    
		if(get_post_meta($post->ID, "mt_page_slider_type", true)=="shortcode_slider"){ 
		    
				echo '<div id="mt-slider-frame">'; ;  echo do_shortcode(get_post_meta($post->ID, "mt_page_slider_shortcode", true));  echo "</div>"; 
		
		}
}	   
?>
 	
<?php if ( !is_front_page() and $title=="on" or !is_front_page() and $title=="" ) { ?> 

	<div class="header-color-smc" id="header-title" <?php if( $title_bg != "" or ot_get_option("title_background") != "" ) {  ?>
		 style="background-image: url(<?php if( $title_bg == "" ) { echo ot_get_option("title_background"); } else { echo $title_bg; } ?>)!important; background: center; "<?php } ?>> 
					
		<div class="mt-shadow"> 
			<div class="container" > 
				<div class="row  mt-title">
							
					<?php if (is_singular("portfolio")) {  ?>
					
						<div class="span8"><h1><?php the_title(); ?></h1></div>
						<div class="span4"><?php next_post_link('%link','<div id="single-button-right"  class="icon-double-angle-right"></div>'); previous_post_link('%link','<div id="single-button-left"  class="icon-double-angle-left"></div>');  ?></div>
						
					   	               	
					<?php } else if (is_singular('causes')){ ?> 
						
						<div class="span8"><h1><?php the_title(); ?></h1></div>
						<div class="span4"><?php next_post_link('%link','<div id="single-button-right"  class="icon-double-angle-right"></div>'); previous_post_link('%link','<div id="single-button-left"  class="icon-double-angle-left"></div>');  ?></div>
					
					<?php } else if (is_single()){ ?> 
						
						<div class="span8"><h1><?php the_category(' // '); ?></h1></div>
						<div class="span4"><?php next_post_link('%link','<div id="single-button-right"  class="icon-double-angle-right"></div>'); previous_post_link('%link','<div id="single-button-left"  class="icon-double-angle-left"></div>');  ?></div> 
					
					<?php } else if (is_search()){ ?> 
						
						<div class="span8"><h1><?php printf( __( 'Search Results for: %s', "madza_translate"  ), '' . get_search_query() . '' ); ?></h1></div>
						<div class="span4"></div>
					    
					<?php } else if (is_404()){ ?> 
					
					    <div class="span8"><h1><?php printf( __( '404 page', "madza_translate"  ) ); ?></h1></div>
					    <div class="span4"></div>
					    
					<?php } else if (is_category()){ ?> 
						
						<div class="span8"><?php $category = get_the_category();  echo '<h1>'.$category[0]->cat_name.'</h1>'; ?></div>
						<div class="span4"><?php if ( ot_get_option('bredcrumb')=="on" AND $breadcrumbs == "on"){  dimox_breadcrumbs(); } ?></div>
					                   
					<?php } else { ?> 
					
						<div class="span8"><h1 class="page-title"><?php woocommerce_page_title(); ?></h1></div>
						<div class="span4"><?php if ( ot_get_option('bredcrumb')=="on" AND $breadcrumbs == "on"){  dimox_breadcrumbs(); } ?></div>
					
					<?php } ?>
				         	 
				</div>
			</div>
		</div>
	</div>  

<?php } ?>

<div id="mb-content"> <div class="container"> <?php 	