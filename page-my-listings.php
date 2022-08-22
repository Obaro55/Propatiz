<?php
/**
 * Template Name: Dashboard - My Listings
 *
 */

 
get_header('dashboard'); ?>



<div class="clear site-content-area dashboard">
<div class="clear site-contents dashboard">


<div id="primary" class="content-area">
	<main id="main" class="site-main dashboard" role="main">

		
		
		<div class="dashboard-container">
		
		<?php include(locate_template('extra-codes/dashboard-navigation.php')); ?>
		
		<div class="dashboard-contents">
		
		<?php
		
		
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
       
        $args = array(
                'post_type' => 'property',
				'post_author' => $userID,
                'post_status' => 'publish',
                'paged' => $paged,
                'posts_per_page' => 10,
                'order' => 'DESC',
            );

          
        $my_listings = new WP_Query($args);
			
		if ($my_listings->have_posts()) { ?>
		
		<div class="my-listings">
		
		<?php             
            
        while ($my_listings->have_posts()) { $my_listings->the_post(); 
					
		$listing_id = $post->ID;
			
		?> 
     
		<div class="my-listings-container">
	 
		<span class="my-listing-title">
		
		<?php 
		
		$listing_title = get_the_title($listing_id);
		$listing_title = strlen($listing_title) > 35 ? substr($listing_title, 0, 35)."..." : $listing_title;
		
		
		
		echo '<a href="'. get_permalink($listing_id) .'">' . esc_html($listing_title) . '</a>';
		
		?>
		
		</span><span class="my-listing-edit-delete"><span class="span-center"><span class="edit"><a href="<?php 
		
		$edit_url = add_query_arg('listing_id', get_the_ID(), get_permalink(626 + $_POST['_wp_http_referer'])); 
		$edit_url = add_query_arg('propatiz_url_nonce', wp_create_nonce( 'action' ), $edit_url);
		
		echo $edit_url; ?>">Edit</a></span><span class="delete">
		
		<?php if(!(get_post_status() == 'trash')) { ?>
		<a onclick="return confirm('Are you sure you want to delete listing: <?php echo get_the_title() ?>?')" href="<?php echo get_delete_post_link(get_the_ID(), "", true); ?>">Delete</a>
		<?php } ?>
		</span></span>
		
		</span>
		</span>
		
		</div>
		
		<?php	}  ?>    
			
			</div>
		
		<?php } 
 

		wp_reset_postdata();
		
		$total_pages = $my_listings->max_num_pages;
			
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
		
		?>
			
		
		  
	   	</div>
	   
	   	</div>
		

	</main><!-- .site-main -->


</div><!-- .content-area -->

</div>
</div>



<?php get_footer(); ?>
