<?php
/**
 * Template Name: Listing Guidelines
 *
 */



get_header(); ?>



<div class="clear site-content-area">
<div class="clear site-contents">

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		
		
		
		<div class="page-contents listing-guidelines">

<h1>Listing Guidelines</h1>

<p class="page-paragraph-spacing">Follow these listing tips to understand how the listing process works.</p>

<ul class="ul-spacing custom-ul-list">

<?php

if(!is_user_logged_in()) {

echo '<li><p>You must <a href="https://www.propatiz.com/signup/">sign up</a> for an account and be logged in to submit listings.</p></li>';

}

?>

<li><p>To start submitting listing, pick a <a href="https://www.propatiz.com/pricing/">plan</a>.</p></li>
<li><p>Provide as much information as possible when filling out the listing form. You want to market your properties, so the more information you make available the easier it is for the buyer to make a decision.</p></li>
<li><p>Make sure that the quality of pictures you upload is high and properly sized.</p></li>
<li><p>You can only upload five (5) pictures per listing, and these pictures shouldn't exceed 200KB each.</p></li>
<li><p>Expected picture orientation is landscape, and the optimal picture dimension is 840px by 550px (that is, width 840px and height 550px).</p></li>

</ul>

</div>
	
	
	
<footer class="entry-footer">
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'propatiz' ),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
		?>
</footer><!-- .entry-footer -->	
		
		
		

	</main><!-- .site-main -->


</div><!-- .content-area -->

</div>
</div>



<?php get_footer(); ?>
