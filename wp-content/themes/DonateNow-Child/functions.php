<?php

add_action('template_redirect', 'remove_shop_breadcrumbs' );
function remove_shop_breadcrumbs(){

	if ( is_single( array( 869, 872, 937, 964 ) ) )
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

}

// remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);
add_filter( 'woocommerce_breadcrumb_defaults', 'jk_change_breadcrumb_delimiter' );
function jk_change_breadcrumb_delimiter( $defaults ) {
	// Change the breadcrumb delimeter from '/' to '>'
	$defaults['delimiter'] = ' <strong>/</strong> ';
	return $defaults;
}

add_filter( 'woocommerce_breadcrumb_defaults', 'jk_change_breadcrumb_home_text' );
function jk_change_breadcrumb_home_text( $defaults ) {
    // Change the breadcrumb home text from 'Home' to 'Appartment'
	$defaults['home'] = 'Gifts of Hope';
	return $defaults;
}

add_filter( 'woocommerce_breadcrumb_home_url', 'woo_custom_breadrumb_home_url' );
function woo_custom_breadrumb_home_url() {
	
	global $post;
	$terms = get_the_terms( $post->ID, 'product_cat' );
	foreach ($terms as $term) {
    $product_cat_id = $term->slug;
    break;
	}
    
	$homeurl_a = '/gifts-of-hope/?filter=';
	$homrulr_b = $product_cat_id;
	$homeurl = $homeurl_a . $homrulr_b;
	return $homeurl;
}

add_filter('Add to Cart', 'woo_custom_cart_button_text');
 
function woo_custom_cart_button_text() {
 
                    return __('Add to Cart', 'woocommerce');
 
            }
add_filter( 'add_to_cart_text', 'woo_custom_cart_button_text2' );
 
function woo_custom_cart_button_text2() {
        return __( 'Add to Cart', 'woocommerce' );
}

// add user title to checkout - gfh
add_filter( 'woocommerce_checkout_fields' , 'add_field_user_title' );

function add_field_user_title( $fields ) {
      $fields['billing']['billing_user_title'] = array(
            'label'     => __('Title', 'woocommerce'),
            'placeholder'   => _x('Mr., Mrs., Dr., etc', 'placeholder', 'woocommerce'),
            'required'  => true,
            'class'     => array('form-row-first'),
            'clear'     => true
      );

      return $fields;
}

// modify checkout fields order - gfh
add_filter("woocommerce_checkout_fields", "custom_field_order");

function custom_field_order($fields) {

      $order = array(
            "billing_user_title",
            "billing_first_name", 
            "billing_last_name", 
            "billing_company", 
            "billing_address_1", 
            "billing_address_2", 
            "billing_state", 
            "billing_postcode", 
            "billing_country", 
            "billing_email"
      );
      foreach($order as $field) {
            $ordered_fields[$field] = $fields["billing"][$field];
      }

      $fields["billing"] = $ordered_fields;
      return $fields;
}

 
/* smc run only one version of jquery fix */
if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
function my_jquery_enqueue() {
   wp_deregister_script('jquery');
   wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js", false, null);
   wp_enqueue_script('jquery');
}
/* end smc run only one version of jquery fix */

/**
 * Proper way to enqueue scripts and styles
 */
 
function theme_name_scripts() {
	if ( ! is_home() ) {
	$handle = 'js_composer_front-css';
	wp_deregister_style( $handle );
	wp_enqueue_style( 'js_composer_smc', '/wp-content/themes/DonateNow/wpbakery/js_composer/assets/css/js_composer_front.css?ver=3.5.5' );
	}
}

add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );

/* smc basic excerpt control */
function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function new_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');



/* end smc basic excerpt control */

/* gfh allow excerpt/content to have custom limit set 

 //Seemed like we had two functions for the excerpt smc 

function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}

function content($limit) {
  $content = explode(' ', get_the_content(), $limit);
  if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'...';
  } else {
    $content = implode(" ",$content);
  }
  $content = preg_replace('/[.+]/','', $content);
  $content = apply_filters('the_content', $content);
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}
/* end gfh allow excerpt/content to have custom limit set */

/* gfh add alternative category display shortcode */
function altCategory( $atts ) {
   extract( shortcode_atts( array(
      'cat' => 9,
      'col' => 3,
      'num' => null
   ), $atts ));
   
   $col = ( $col <= 1 ) ? 1 : $col;
   $col = ( $col >= 4 ) ? 4 : $col;
   $posts = ( !$num ) ? $col : $num;
   
   switch( $col ) {
      case 1:
	 $colW = "12";
	 $imgW = '960';
	 $imgH = '350';
	 break;
      case 2:
	 $colW = "12";
	 $imgW = '700';
	 $imgH = '350';
	 break;
      case 3:
	 $colW = "4";
	 $imgW = '480';
	 $imgH = '240';
	 break;
      case 4:
	 $colW = "12";
	 $imgW = '360';
	 $imgH = '200';
	 break;
      default:
	 $colW = "4";
	 $imgW = '480';
	 $imgH = '240';
   } // end switch
   
   ob_start();

   $args = array(
      'post_type'		=> 'post',
      'order'			=> 'DESC',
      'orderby'			=> 'date',
      'cat' 			=> $cat,
      'posts_per_page'		=> $num
   );
   remove_filter('the_excerpt', 'wpautop');
   
   $wpQuery = new WP_Query( $args );
   if ($wpQuery->have_posts()) {
   
   $i = 0;
   ?>
<div class="wpb_row vc_row-fluid multi-row"> 
	    <?php while ( $wpQuery->have_posts() ) : $wpQuery->the_post(); ?>
	    <?php if ( $i % $col == 0 ) {
	       if ( $i != 0 ) {
	    ?>
	 </div>
      </div>
   </div>
	    <?php } ?>
   <div class="vc_span12 wpb_column column_container">
      <div class="wpb_wrapper">
	 <div class="wpb_row">
	    <?php } ?>
	    <div class="vc_span<?php echo $colW; ?>">
	       <div class="port port-file-3 portfolio-portfolio_<?php echo $col; ?>_column">
		  <div class="viewport<?php echo $col; ?>column">
		     <a href="<?php the_permalink(); ?>">
			<span class="dark-background-2"></span>
			<?php
			   $src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), array( 999,999 ), false, '' );
			   echo aq_resize( $src[0], $imgW, $imgH, 'false', 'true'); ?>
		     </a>
		     <div class="mt_isotope_text">
			<a href="<?php the_permalink(); ?>"><h3 class="widget_h_2"><?php the_title(); ?></h3></a>
			<p><?php the_excerpt() ?></p><?php echo "<a href='".get_permalink()."' class='more-link'><span>Read more</span></a>"; ?>
			<div class="clear"></div>
		     </div>      
		  </div>
	       </div>
	    </div>
	    <?php $i++; ?>
	    <?php endwhile; ?>
	 </div>
      </div>
   </div>
</div>
   
   <?php
   
   return ob_get_clean();

   }
}

add_shortcode( 'alt_category', 'altCategory' );
/* end gfh add alternative category display shortcode */

?>