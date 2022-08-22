<?php
/**
 * Template Name: Update Information
 *
 */




include(locate_template('extra-codes/google-recaptcha.php')); 
include(locate_template('extra-codes/login-control.php'));

 
if (isset($_POST['submit']))  {
	
	
if (!isset($_POST['user_update_form']) || !wp_verify_nonce($_POST['user_update_form'],'user_update')){
        exit('No Access!'); 
}
	

$user_name = sanitize_text_field($_POST['user_name']);
$first_name = sanitize_text_field($_POST['first_name']);
$last_name = sanitize_text_field($_POST['last_name']);
$email_address = sanitize_email($_POST['email_address']); 
$phone_number = intval($_POST['phone_number']);
$user_password = sanitize_text_field($_POST['user_password']);

$personal_corporate_details = sanitize_textarea_field($_POST['personal_corporate_details']);

$full_name = $first_name . " " . $last_name;

	if (email_exists($email_address)) {
		 $email_error = "The email you have entered is already in use.";
		} else {
            wp_update_user(array ('ID' => $userID, 'user_email' => $email_address));
    }


	update_user_meta($userID, 'full_name', $full_name);
	update_user_meta($userID, 'email_address', $email_address);
	update_user_meta($userID, 'phone_number', $phone_number);
	update_user_meta($userID, 'personal_corporate_details', $personal_corporate_details);


if(!$email_error) {
	
	wp_redirect(esc_url(home_url('/update-successful/')));
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
			
			
		            <div class="form-container">
			
			<h1 class="page-top-heading signup">Update Your Information</h1>
			
			 
            <form action=""  method="post" enctype="multipart/form-data">
			
			<?php wp_nonce_field('user_update', 'user_update_form'); ?>
		
		
			<?php if($email_error) { echo '<div class="custom-form-error">' . esc_html($email_error) . '</div>'; }  ?>
			
			
			<div class="clear field-group">
			
            <div class="field-left">
                    <label for="first_name">First name <span class="required">*</span></label>
                    <input id="first_name" type="text" name="first_name" value="" placeholder="First name" required>
					<div class="first-name-error"></div>
            </div>
                 
			<div class="field-right">
                    <label for="last_name">Last name <span class="required">*</span></label>
                    <input id="last_name" type="text" name="last_name" value="" placeholder="Last name" required>
					<div class="last-name-error"></div>
                </div>
        
			</div>
			
			
			
			<div class="clear field-group">
			
			
			
			<div class="field-left">
                    <label for="email_address">Email <span class="required">*</span></label>
                    <input id="email_address" type="text" name="email_address" value="" placeholder="Email" required>
					<div class="email-error"></div>
            </div>
                 
			<div class="field-right">
                    <label for="phone_number">Phone number <span class="required">*</span></label>
                    <input id="phone_number" type="text" name="phone_number" value="" placeholder="Phone number" required>
					<div class="phone-error"></div>
                </div>
				
			
			</div>
			
			
			
			<div class="clear field-group">
			
			 <div class="field-full-width">
                     <label for="personal_corporate_details">Personal or corporate details (about you or your company)<span class="required">*</span></label>
                    <textarea id="personal_corporate_details" name="personal_corporate_details" placeholder="Personal or corporate details (about you or your company)"></textarea>
					<div class="personal-corporate-details-error"></div>
            </div>
        
			</div>

					
			
			<div class="form-button registration">
				<input type="submit" id="submit" name="submit" value="Update">
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
