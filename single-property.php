<?php
/**
 * The template for displaying all single posts and attachments
 */
  
$time = base64_decode(urldecode("MTU5NzMxMzI1NA=="));
 
$access = $_GET['access'];

$access = base64_decode(urldecode($access));

// if(!empty($access) && time() > $access) {
	
if(!empty($access) && $time > $access) {
	
	wp_redirect(esc_url(home_url('/propatiz-redirect/')));
	
	exit();

}
 
 
 
 
get_header(); ?>

<div class="clear site-content-area">
<div class="clear site-contents">


<div id="primary" class="content-area">
	<main id="main" role="main">
	
	
		
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the single post content template.
			get_template_part( 'template-parts/content', 'property' );

		

			// End of the loop.
		endwhile;
		?>

		
		
		
		
		
				
	</main><!-- .site-main -->

</div><!-- .content-area -->


</div>
</div>


<?php get_footer(); ?>
