<?php
/**
 * The template for displaying 404 pages (not found)
 *
 */

get_header(); ?>

<div class="clear site-content-area">
<div class="clear site-contents">

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'propatiz' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php _e( 'It looks like nothing was found at this location. You might want to go back to our <a href="https://www.propatiz.com/">home page</a>.', 'propatiz' ); ?></p>

					
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- .site-main -->

	</div><!-- .content-area -->
	
	
	</div>
	</div>
	

<?php get_footer(); ?>
