
<div class="clear"></div>
</div>
</div>






<?php global $post; $section_id = $post->ID; ?>

<?php $args = array( 'post_type' => 'mt_section', 'meta_key' => 'mt_sorting', 'orderby' => 'meta_value_num', 'order' => 'ASC' ); ?>
	
<?php $query = new WP_Query( $args ); ?>
			
<?php while ( $query->have_posts() ) : $query->the_post(); ?>

	<?php global $post; ?>
	
	<?php $class = ""; if(get_post_meta($post->ID, "mt_class", true)!="") { $class = get_post_meta($post->ID, "mt_class", true); } ?>
	
	
	
	<?php if(is_front_page() and get_post_meta($post->ID, "mt_check_page_home", true) == "on") { ?>
		
		<section class="mt-style-<?php echo $post->ID; ?> <?php echo $class; ?>" ><div class="container"><div class="row"><div class="span12"><?php the_content(); ?></div></div></div></section>
		
	<?php } else if(get_post_meta($post->ID, "mt_check_page", true)==$section_id) { ?>
					
		<section class="mt-style-<?php echo $post->ID; ?> <?php echo $class; ?>" ><div class="container"><div class="row"><div class="span12"><?php the_content(); ?></div></div></div></section>
											
	<?php } ?>
	
	
										
<?php endwhile;  wp_reset_query();  ?>






<?php if  (ot_get_option('enable_footer') == 'on') { ?>
<footer id="footer">
<!--<?php if(is_page(738)){ ?><span style="margin-top:-4px;" id="gifts-of-hope-bar"></span><?php } ?>-->
   
        	<?php function_footer_widget_areas(); ?>
    


	<?php if  (ot_get_option('footer_buttom') == 'footer_buttom_on') { ?>
	
	<div class="container">
		<div class="row"><div class="span12 mt-subfooter-line"></div></div>
 		<div class="row" id="sub-footer">
			
			<div id="footer-left" class="span6">
			
		        <div><p>© <?php echo date("Y"); ?> <strong>Share Vancouver</strong> All Rights Reserved.
                </br><a id="edge-link" href="http://edgemm.com">Site Design by <strong>Edge Multimedia</strong></a></p>
                </div> 
                <p></p>
                <script type="text/javascript" src="https://seal.thawte.com/getthawteseal?host_name=sharevancouver.org&amp;size=S&amp;lang=en"></script>
				
		        
		    </div>    
		    
		    <div id="footer-right" class="span6">
		    
		        <div id="button-nav"><?php wp_nav_menu( array('theme_location'  => "footer_menu", 'container' =>false, 'menu_class' => 'bottom-menu', 'menu_id' => 'menu_footer','echo' => true, 'before' => '','after' => '', 'link_before' => '','link_after' => '', 'depth' => 0));  ?></div>
		        

                
		    </div> 

 		</div>    
		        
		    <?php if  (ot_get_option('bottom_footer_html')) { ?>
		    <div class="row">       
		        <div class="span12 footer_widget_midle"> <?php echo of_get_option('bottom_footer_html'); ?> </div>
		    </div>        
		    <?php } ?>
		
	</div>
	
	<?php } ?>   
	
</footer>     
   
<?php } ?>


<?php wp_footer(); ?>

</body>

</html>