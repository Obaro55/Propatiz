<?php
/**
 * Template Name: All Listings 
 *
 */
 
get_header(); ?>

<div class="clear site-content-area">
<div class="clear site-contents">

	<div id="primary" class="content-area">
		<main id="main" class="site-main all-listings" role="main">
		
		
		
	<?php
	
	
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	$args = array(
	'post_type' => 'property',
	'paged'=> $paged,
	'post_status' => 'publish',
	'posts_per_page' => 16,
	'orderby'   => array(
        'meta_value'=>'ASC',
        'date' =>'DESC',
    ),
	'meta_query' => array(
       'relation' => 'OR',
        array( 
                'key' => 'property_listing_status',
				'value' => 'regular'
            ),
          array( 
                'key' => 'property_listing_status',
				'value' => 'promoted'
            )
        ),
	
);


	$regular_listings = new WP_Query($args);



if ($regular_listings->have_posts()) {  ?> 


		
		<div class="post-header">
		
		<h1><?php esc_html_e('All Listings', 'propatiz'); ?></h1>
		
		<p class="intro">These are the current real estate and property listings across all categories, locations, and prices. Each listing entry contains as much information as possible to help buyers, renters, and lessees make error-free rental or purchase decisions. An exhaustive analysis also makes selling properties much, much easier.</p>
		
		<span class="design-line"></span>
		
		</div>

	<?php while($regular_listings->have_posts()) { $regular_listings->the_post(); ?>
				
		
		<div id="post-<?php the_ID(); ?>" class="post-section regular">
		    
		 <?php 
		
		global $post;
		
		$youtube_videos = get_post_meta($post->ID, 'youtube_links', true);
		
		if(!empty($youtube_videos)) {
			
			echo '<i class="fa fa-video-camera"></i>';
			
		}
		
		?>
		
		<a href="<?php the_permalink(); ?>">
		
		<?php the_post_thumbnail('post_section_thumbnail'); ?>
		
		<h2>
		
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

		<?php } wp_reset_postdata();  ?>
		
		
		
	  
	  <div class="clear"></div> 
	
	
<?php	
	
	$total_pages = $regular_listings->max_num_pages;
			
			if($total_pages > 1) {
			$current_page = max(1, get_query_var('paged'));
			
			echo paginate_links(array(
			'base' => get_pagenum_link(1) . '%_%',
			'format' => '/page/%#%',
			'current' => $current_page,
			'total' => $total_pages,
			'prev_text' => __( '<i class="fa fa-caret-left"></i>', 'propatiz' ),
			'next_text' => __( '<i class="fa fa-caret-right"></i>', 'propatiz' ),
			));
			
			}
	
	} else {
	
	get_template_part( 'template-parts/content', 'none' );
	
	?>
	
	 
	<?php } 
	
		
		
		?> 
		


		</main><!-- .site-main -->
	</div><!-- .content-area -->



</div>
</div>


<?php get_footer(); ?>
