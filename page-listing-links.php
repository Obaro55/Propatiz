<?php
/**
 * Template Name: Listing Links
 *
 */



get_header(); ?>



<div class="clear site-content-area">
<div class="clear site-contents">

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		
		
	<div class="page-contents listing-guidelines">

	<h1>Listing Links</h1>

	<ul class="ul-spacing custom-ul-list">


	<?php

	$terms = get_terms([
    'taxonomy' => 'classification',
    'hide_empty' => false,
	]);

		foreach($terms as $term) {
		
			 echo "<li><p><a href=' " . get_term_link($term->slug, 'classification') . " '>" .  $term->name . "</a></li></p>";
	
		}

	?>

	</ul>

	</div>
	
			
	</main><!-- .site-main -->


</div><!-- .content-area -->

</div>
</div>



<?php get_footer(); ?>
