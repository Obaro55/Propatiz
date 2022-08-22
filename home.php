
<?php get_header(); ?>
		
		
		
		

		
		<div class="propatiz-background-picture">
		
		<div class="homepage-search-container">
		
		 <?php echo propatiz_search_form(); ?> 
		 
		</div>
		
		
		</div>
	
	
	
	
	
			
		<?php


			$args = array(
					'post_type' => 'property',
					'posts_per_page' => 4,
					'meta_query' => array(
                            array(
                                'key'       => 'property_listing_status',
                                'value'     => 'promoted',
                                'compare'   => '='
					)
					)
			);

		$query = new WP_Query($args);;
		
		
		if ( $query->have_posts() ) { ?>
		
		
		<div class="homepage-listings premium-listings">
		
		<div class="homepage-listings-container premium-listings">	
		
		<h2>Premium Listings</h2>
		
		<div class="clear"></div>
		
		<?php while ( $query->have_posts() ) { $query->the_post(); ?>
			
		
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
		
		
		<?php } // end while ?>
		
 
		<?php } // end if
 
		// Use reset to restore original query.

		wp_reset_postdata();

		?>

				
		</div>
		
		
		</div>
		
	
	
	
	
			
		<?php


			$args = array(
					'post_type' => 'property',
					'posts_per_page' => 4
			);

		$query = new WP_Query($args);;
		
		
		if ( $query->have_posts() ) { ?>
		
		
		<div class="homepage-listings recent-listings">
		
		<div class="homepage-listings-container recent-listings">	
		
		<h3>Recent Listings</h3>	
		
		
		<div class="clear"></div>
 
		<?php while ( $query->have_posts() ) {
		$query->the_post();
		?>
		
		
	<?php 
	
		$property_listing_status = get_post_meta(get_the_ID(), 'property_listing_status', true);
		
			if($property_listing_status !== 'promoted') { ?>	
			
		
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
				
		
		<?php } ?>
		
	
		<?php } // end while ?>
		
		
		<div class="clear"></div>			
		
		<p class="listings-button"><a href="https://www.propatiz.com/all-listings/">See All Listings</a></p>
		
				
		</div>
		
		
		</div>
 
 
		<?php } // end if
 
		// Use reset to restore original query.

		wp_reset_postdata();
		?>
		
		
	
		
		
		
		
		

	<?php get_footer(); ?>
