<?php
/**
 * The template for displaying search results pages
 *
 */

get_header(); ?>

<div class="clear site-content-area">
<div class="clear site-contents">

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		
		
				
	<?php 	if(have_posts()) { ?> 
		
		
		
		<div class="post-header">
		
		<h1>
		
		<?php printf( __( 'Search results for: %s', 'propatiz' ), '<span>"' . esc_html( ucwords(get_search_query()) ) . '"</span>' ); ?>
		
		</h1>
		
		<p class="search-result-count">
		
		<?php
   
		global $wp_query;
		
		$search_results = $wp_query->found_posts > 1 ? 'results' : 'result'; 
		
		echo $wp_query->found_posts . " $search_results found";

		?>
		
		</p>
		
		</div>
		
 

	<?php while (have_posts()) {  the_post(); ?>
		
		
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
		

		
	<?php }  ?>
		
		
		<div class="clear"></div>
		
		
		<?php
		
		
			the_posts_pagination( array(
				'mid_size' => 2,
				'prev_text'          => __( '<i class="fa fa-caret-left"></i>', 'propatiz' ),
				'next_text'          => __( '<i class="fa fa-caret-right"></i>', 'propatiz' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( '', 'propatiz' ) . ' </span>',
			) );
		
		
	} else {
		
			get_template_part( 'template-parts/content', 'none' );

		
		}
		
		?>		

		</main><!-- .site-main -->
	</div><!-- .content-area -->

	
</div>
</div>


<?php get_footer(); ?>
