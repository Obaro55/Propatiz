<?php
/**
 * The template for displaying all single posts and attachments
 */
 
include(locate_template('extra-codes/google-recaptcha.php'));


get_header(); ?>

<div class="clear site-content-area">
<div class="clear site-contents">


<div id="primary" class="content-area">
	<main id="main" role="main">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the single post content template.
			get_template_part( 'template-parts/content', 'single' );
			
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}

			
			// End of the loop.
		endwhile;
		?>

		
			
		
	</main><!-- .site-main -->

</div><!-- .content-area -->




</div>
</div>


<?php get_footer(); ?>
