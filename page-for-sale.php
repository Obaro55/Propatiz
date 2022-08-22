<?php
/**
 * Template Name: For Sale
 *
 */
 
 


 
get_header(); ?>




<div class="clear site-content-area">
<div class="clear site-contents">

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		
		
	<?php 
 
 
 
		$args = array(
					'post_type' => 'property',
					
					'meta_query' => array( array(
						'key' => 'property_classification',
						'value' => 'sale',
						'compare' => '='
					)),
					
					'meta_query' => array(
					'relation' => 'OR',
					
					array( 
					'key' => 'property_listing_status',
					'value' => 'regular',
					'compare' => '='
					),
					
					array( 
					'key' => 'property_listing_status',
					'value' => 'promoted',
					'compare' => '='
					)),
					
					
					
					'orderby', array(
					'meta_value'=>'ASC',
					'date' =>'DESC',
					),
					
					'order' => 'DESC',
					'paged' => $paged,
					
					'posts_per_page' => 16,
			);

		$sale_query = new WP_Query($args);
 
 
 
		if ($sale_query->have_posts() ) { ?> 
		
			
		<div class="post-header">
		
		<h1>
		
		<?php  
		
		
			
			 echo '<p class="property-classification">All listings for Sale</p>';
			
		
		 ?>
		
		</h1>
		
		</div>
		 
 
		<?php while ($sale_query->have_posts() ) {  $sale_query->the_post();		?> 
		
		
		
		<div id="post-<?php the_ID(); ?>" class="post-section">
		
		<a href="<?php the_permalink(); ?>">
		
		<?php the_post_thumbnail('post_section_thumbnail'); ?>
		
		<h2>
		
		<?php 
		
		$property_classification = get_post_meta($post->ID, 'property_classification', true);
		echo '<span class="listing-classification">' . $property_classification . '</span>';
		
		?>
			
		
		<?php the_title(); ?>
        
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
				
		</h2>
		
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
