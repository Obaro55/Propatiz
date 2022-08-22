<?php
/**
 * Template Name: Password Reset 
 *
 */

 

 
if (isset($_POST['reset']))  {
	
	
if (!isset($_POST['password_reset_form']) || !wp_verify_nonce($_POST['password_reset_form'],'password_reset')){
        exit('No Access!'); 
}

	
$propatiz_user = get_user_by('id', $userID);

$user_password = sanitize_text_field($_POST['user_password']);

if(!wp_check_password($user_password, $propatiz_user->data->user_pass, $propatiz_user->ID)){
        $password_error = "The password you entered doesn't match the old one.";
}


$new_user_password = sanitize_text_field($_POST['new_user_password']);

if(wp_check_password($user_password, $propatiz_user->data->user_pass, $propatiz_user->ID)) {
	
	wp_set_password($new_user_password, $propatiz_user->ID);
	
	wp_set_auth_cookie($propatiz_user->ID);
	wp_set_current_user($propatiz_user->ID);
	wp_redirect(esc_url(home_url('/password-reset-successful/')));
	exit();

}


}
    
get_header('dashboard'); ?>



<div class="clear site-content-area dashboard">
<div class="clear site-contents dashboard">


<div id="primary" class="content-area">
	<main id="main" class="site-main dashboard" role="main">

		
		
		<div class="dashboard-container">
		
		<?php include(locate_template('extra-codes/dashboard-navigation.php')); ?>
		
		<div class="dashboard-contents">
		
		    
            <div class="reset-password-form">
			
			<h1 class="page-top-heading signup">Reset Your Password</h1>
			
			 
            <form action="<?php the_permalink(); ?>"  method="post" enctype="multipart/form-data">
			
			<?php wp_nonce_field('password_reset', 'password_reset_form'); ?>
		
		
			<?php if($password_error) { echo '<div class="custom-form-error">' . esc_html($password_error) . '</div>'; }  ?>
				
			
			<p class="password-reset">Enter Old Password</p>
						
			<div class="clear field-group password-reset-overflow">
						
			<div class="field-left">
                    <label for="user_password">Password <span class="required">*</span></label>
                    <input id="user_password" type="password" name="user_password" value="" placeholder="Password" required>
					<div class="password-error"></div>
            </div>
                 
			<div class="field-right">
                    <label for="confirmation_password">Retype password <span class="required">*</span></label>
                    <input id="confirmation_password" type="password" name="confirmation_password" value="" placeholder="Retype password" required>
					<div class="confirmation-password-error"></div>
                </div>
				
			
			</div>
			
			
			<p class="password-reset">Enter New Password</p>
						
			<div class="clear field-group password-reset-overflow">
						
			<div class="field-left">
                    <label for="new_user_password">New password <span class="required">*</span></label>
                    <input id="new_user_password" type="password" name="new_user_password" value="" placeholder="Password" required>
					<div class="new-password-error"></div>
            </div>
                 
			<div class="field-right">
                    <label for="new_confirmation_password">Retype new password <span class="required">*</span></label>
                    <input id="new_confirmation_password" type="password" name="new_confirmation_password" value="" placeholder="Retype new password" required>
					<div class="new-confirmation-password-error"></div>
                </div>
				
			
			</div>
			
			
					
			
			<div class="form-button registration">
				<input type="submit" id="reset" name="reset" value="Reset Password">
            </div>
				
			
			
		   <div class="google-recaptcha-policy"><p class="google-policy-text">This site is protected by reCAPTCHA and the Google <a href="https://policies.google.com/privacy">Privacy Policy</a> and <a 
href="https://policies.google.com/terms">Terms of Service</a> apply.</p></div>
			 
		</form> 
 
   		   
	   	</div>
	   
      
      
	   	</div>
		
		
		</div>
		

	</main><!-- .site-main -->


</div><!-- .content-area -->

</div>
</div>



<?php get_footer(); ?>
