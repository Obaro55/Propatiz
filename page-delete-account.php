
<?php
/**
 * Template Name: Delete Account 
 *
 */


include(locate_template('extra-codes/google-recaptcha.php')); 
include(locate_template('extra-codes/login-control.php'));


if (isset($_POST['delete']))  {
	
	
if (!isset($_POST['delete_account_form']) || !wp_verify_nonce($_POST['delete_account_form'],'delete_account')){
        exit('No Access!'); 
}


/*


	$args = array(
	
	'author' => $userID,
	'post_type' => 'property',
	'posts_per_page' => -1
	
	);
	
	$all_user_posts = get_posts($args);
	
	
	foreach($all_user_posts as $user_post) {
		
		wp_delete_post($user_post->ID);
	}

require_once(ABSPATH.'wp-admin/includes/user.php');
	
wp_delete_user($userID);
wp_redirect(esc_url(home_url('/account-deleted/')));
exit();

}

*/

} 
 
 
get_header('dashboard'); ?>



<div class="clear site-content-area dashboard">
<div class="clear site-contents dashboard">


<div id="primary" class="content-area">
	<main id="main" class="site-main dashboard" role="main">

		
		
		<div class="dashboard-container">
		
		<?php include(locate_template('extra-codes/dashboard-navigation.php')); ?>
		
		<div class="dashboard-contents">
		
		    <div class="listing-submission-form">
			
			 
			 
			 <div class="form-container upgrade">
			
			<h1 class="page-top-heading signup">Delete Account</h1>
			
			 
            <form action="<?php the_permalink(); ?>"  method="post" enctype="multipart/form-data">
			
			<?php wp_nonce_field('delete_account', 'delete_account_form'); ?>
		
			
			<p class="delete-account">Are you sure you want to delete your account? Here's what happens when you do: you won't be able to log into and access all the features of Propatiz.com. However, you can sign up again any time you want.</p>
			
			
			<div class="form-button registration">
				<input type="submit" id="delete" name="delete" value="Delete Account" onclick="return confirm('Are you sure you want to delete your account?')">
            </div>
				
			
			
    	   
		   <div class="google-recaptcha-policy"><p class="google-policy-text">This site is protected by reCAPTCHA and the Google <a href="https://policies.google.com/privacy">Privacy Policy</a> and <a 
href="https://policies.google.com/terms">Terms of Service</a> apply.</p></div>

			 
		</form> 
 
   

		   
	   	</div>
			 
           
		   
	   	</div>
	   
		
      
      
	   	</div>
		
		
		</div>
		

	</main><!-- .site-main -->


</div><!-- .content-area -->

</div>
</div>



<?php get_footer(); ?>
