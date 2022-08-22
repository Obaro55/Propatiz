<?php
/**
 * Template Name: Function test New
 *
 */


if (!is_user_logged_in() || !$current_user) {   

	$propatiz_redirect_url = "http://localhost/propatiz/login";
	$propatiz_redirect_url = add_query_arg('redirect_to', 'localhost/propatiz/contact-us/', $propatiz_redirect_url);
	$propatiz_redirect_url = add_query_arg('access', 'pass', $propatiz_redirect_url);
    wp_redirect($propatiz_redirect_url);
	exit();
} 
	

    
get_header(); ?>



<div class="clear site-content-area dashboard">
<div class="clear site-contents dashboard">


<div id="primary" class="content-area">
	<main id="main" class="site-main dashboard" role="main">

	<p>Echo site name: <?php echo site_url(); ?>
		

	</main><!-- .site-main -->


</div><!-- .content-area -->

</div>
</div>



<?php get_footer(); ?>
