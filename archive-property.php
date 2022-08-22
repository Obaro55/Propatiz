<?php
/**
 * The template for displaying archive pages
 *
 */
 
get_header(); ?>

<div class="clear site-content-area">
<div class="clear site-contents">

	<div id="primary" class="content-area">
		<main id="main" class="site-main role="main">
		
	
			
		<?php 
 
		if ( have_posts() ) { ?> 
		
			
		<div class="post-header">
		
		<?php  
		
		echo '<h1 class="property-classification">' . get_the_archive_title() . '</h1>';
		
		 ?>
		
		</div>
		 
 
		<?php while ( have_posts() ) {  the_post();		?> 
		
		
		
		<div id="post-<?php the_ID(); ?>" class="post-section">
		    
		 <?php 
		
		global $post;
		
		$youtube_videos = get_post_meta($post->ID, 'youtube_links', true);
		
		if(!empty($youtube_videos)) {
			
			echo '<i class="fa fa-video-camera"></i>';
			
		}
		
		?>
		
		<a href="<?php the_permalink(); ?>">
		
		<?php the_post_thumbnail('post_section_thumbnail'); ?>
		
		<p>
		
		<?php 
		
		$terms = get_the_terms($post->ID , 'classification');
		
		$core_terms = array(19, 20, 21);
		
		foreach($terms as $term) {
		    
		   $term->term_id;
			
			if(!in_array($term->term_id, $core_terms)) {
			continue;
		
		}
			
			 echo '<span class="listing-classification">' . ucfirst($term->name) . '</span>';
	
		}
		
		?>	
		
		<span class="listing-title"><?php the_title(); ?></span>
        
        <?php 
		
		$property_price = price_convert(get_post_meta($post->ID, 'property_price', true));
		$property_address = get_post_meta($post->ID, 'property_address', true);
		$property_city = get_post_meta($post->ID, 'property_city', true);
		$property_state = get_post_meta($post->ID, 'property_state', true);
		
		if(!empty($property_address)) {		
		
		echo '<span class="property-address">' . $property_address . '</span>';
		
		}
		
		if(!empty($property_city)) {	
		
		echo '<span class="property-city">' . $property_city . '</span>';

		}
		
		if(!empty($property_state)) {

		echo ', <span class="property-state">' . $property_state . '</span>';
		
		}
		
		if(!empty($property_price)) {
		
		echo '<span class="property-price">' . $property_price . '</span>';
		
		}
		
		?>
				
		</p>
		
		</a>
		
		</div>
		
	
	
	<?php } 	?> 
		
		<div class="clear"></div>
	
	<?php 
	
	
		
	// Previous/next page navigation.
			the_posts_pagination( array(
				'mid_size' => 2,
				'prev_text' => __( '<i class="fa fa-caret-left"></i>', 'propatiz' ),
				'next_text' => __( '<i class="fa fa-caret-right"></i>', 'propatiz' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( '', 'propatiz' ) . ' </span>',
			) );
	
		} else {
	
	get_template_part( 'template-parts/content', 'none' );
	
	?>
	
	 
	<?php  } 	?> 
		


		</main><!-- .site-main -->
	</div><!-- .content-area -->



</div>
</div>


<?php get_footer(); ?>
