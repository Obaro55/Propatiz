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
		
		$categories = get_the_category();

		foreach ($categories as $category) {
			
			 echo '<h1 class="post-category">All Posts in ' . ucfirst($category->name) . '</h1>';
			
		}
		
		 ?>
		
		
		</div>
		
		
		
 
 
		<?php while ( have_posts() ) {  the_post();		?> 
		
		
		
		<div id="post-<?php the_ID(); ?>" class="post-section default-archive">
		
		<a href="<?php the_permalink(); ?>">
		
		<?php the_post_thumbnail('post_section_thumbnail'); ?>
		
		<div class="post-section-border">
		
		</a>
		
		<a href="<?php the_permalink(); ?>">
		
		<h2> <?php the_title(); ?> </h2>
		
		</a>
		
		
		</div>
		
		</div>
		
	
	
	<?php } 	?> 
		
		<div class="clear"></div>
	
	<?php 
	
		
	// Previous/next page navigation.
			the_posts_pagination( array(
				'mid_size' => 2,
				'prev_text' => __( '<i class="fa fa-caret-left"></i>', 'aspaya' ),
				'next_text' => __( '<i class="fa fa-caret-right"></i>', 'aspaya' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( '', 'aspaya' ) . ' </span>',
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
