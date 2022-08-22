<?php
/**
 * Template Name: Signup 
 *
 */
 

if(is_user_logged_in()) {   
    wp_redirect(esc_url(home_url('/')));
	exit();
} 

include(locate_template('extra-codes/google-recaptcha.php')); 


 
if (isset($_POST['submit']))  {
	
	
if (!isset($_POST['user_signup_form']) || !wp_verify_nonce($_POST['user_signup_form'],'user_signup')){
        exit('No Access!'); 
}
	

$user_name = sanitize_text_field($_POST['user_name']);
$first_name = sanitize_text_field($_POST['first_name']);
$last_name = sanitize_text_field($_POST['last_name']);
$email_address = sanitize_email($_POST['email_address']); 
$phone_number = sanitize_text_field($_POST['phone_number']);

$checkbox = sanitize_text_field($_POST['yes']);

$company_name = sanitize_text_field($_POST['company_name']);
$website = sanitize_text_field($_POST['website']);

$user_password = sanitize_text_field($_POST['user_password']);

$personal_corporate_description = sanitize_textarea_field($_POST['personal_corporate_description']);

$full_name = $first_name . " " . $last_name;



if (username_exists($user_name))
    {
		
		 $username_error = "The username you have entered is already in use.";
		
	}


if (email_exists($email_address))
    {
		
		 $email_error = "The email you have entered is already in use.";
		
	}
	


if(!$username_error && !$email_error) {

	$user_id = wp_insert_user(
	array(
    'user_login'  => $user_name,
    'user_pass' => $user_password,
    'first_name'  => $first_name,
    'last_name' => $last_name,
    'user_email' => $email_address,
    'display_name' => $full_name,
    'nickname' => $full_name,
    'role' => 'propatiz_pending_user'
  )
);


	

	update_user_meta($user_id, 'full_name', $full_name);
	update_user_meta($user_id, 'email_address', $email_address);
	update_user_meta($user_id, 'phone_number', $phone_number);
	update_user_meta($user_id, 'company_name', $company_name);
	
	if(!empty($website)) {
	update_user_meta($user_id, 'website', $website);
	}
	
	update_user_meta($user_id, 'personal_corporate_description', $personal_corporate_description);


		
	if($checkbox == 'yes') {
	
	update_user_meta($user_id, 'user_status', 'agent');
	
	} else {
		
	update_user_meta($user_id, 'user_status', 'regular_user');
	
	}
	
	update_user_meta($user_id, 'registration_status', 'registered');
	update_user_meta($user_id, 'profile_picture_status', 'pending');
	
	
	update_user_meta($user_id, 'propatiz_plan', 'regular');
	update_user_meta($user_id, 'propatiz_listing_count', 0);
	update_user_meta($user_id, 'propatiz_plan_status', 'pending');	
	update_user_meta($user_id, 'unlimited_listings_start_date', 0);
	
	

	
	
	
}


if($user_id) {
    
	 wp_set_current_user($user_id);
    wp_set_auth_cookie($user_id);
	wp_redirect(esc_url(home_url('/picture-uploads/')));
 	
}
      

}


    
get_header('signup'); ?>

<div class="clear site-content-area registration">
<div class="clear site-contents registration">


<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
	
		
       <?php if($username_error) { echo '<div class="propatiz-signup-errors"><div class="custom-form-error">' . esc_html($username_error) . '</div></div>'; }  ?>
	   <?php if($email_error) { echo '<div class="propatiz-signup-errors"><div class="custom-form-error">' . esc_html($email_error) . '</div></div>'; }  ?>

            <div class="form-container sign-up">
			
			<h1 class="page-top-heading signup">Sign Up and Start Submitting Listings</h1>
			
			 
            <form action="<?php the_permalink(); ?>"  method="post" enctype="multipart/form-data">
			
			<?php wp_nonce_field('user_signup', 'user_signup_form'); ?>
			
			
			<div class="clear field-group">
			
            <div class="field-full-width username">
                    <label for="user_name"><?php esc_html_e('Choose a unique username', 'propatiz'); ?></label>
                    <input id="user_name" type="text" name="user_name" value="" placeholder="Choose a unique username" required>
					<div class="user-name-error"></div>
            </div>
        
			</div>
			
			
			
			<div class="clear field-group">
			
            <div class="field-left">
                    <label for="first_name"><?php esc_html_e('First name', 'propatiz'); ?></label>
                    <input id="first_name" type="text" name="first_name" value="" placeholder="First name" required>
					<div class="first-name-error"></div>
            </div>
                 
			<div class="field-right">
                    <label for="last_name"><?php esc_html_e('Last name', 'propatiz'); ?></label>
                    <input id="last_name" type="text" name="last_name" value="" placeholder="Last name" required>
					<div class="last-name-error"></div>
                </div>
        
			</div>
			
			
			
			<div class="clear field-group">
			
			<div class="field-left">
                    <label for="email_address"><?php esc_html_e('Email', 'propatiz'); ?></label>
                    <input id="email_address" type="text" name="email_address" value="" placeholder="Email" required>
					<div class="email-error"></div>
            </div>
                 
			<div class="field-right">
                    <label for="phone_number"><?php esc_html_e('Phone number', 'propatiz'); ?></label>
                    <input id="phone_number" type="text" name="phone_number" value="" placeholder="Phone number" required>
					<div class="phone-error"></div>
                </div>
				
			
			</div>
			
			
						
			<div class="clear field-group agent">
			
			 
			<p>Are you an agent? Yes <input type="checkbox" id="yes" name="yes" value="yes">  No <input type="checkbox" id="no" name="no" value="no"></p>
           
			
			<div class="field-full-width agent">
			<input id="companyName" type="text" name="company_name" value="" placeholder="Name of company">
			<div class='company-name-error'></div>
			</div>
        
			</div>
			
			
			
			<div class="field-full-width">
                    <label for="website"><?php esc_html_e('Website', 'propatiz'); ?></label>
                    <input id="website" type="text" name="website" value="" placeholder="Website">
            </div>
        			
			
			
			<div class="clear field-group">
			
			 <div class="field-full-width">
                     <label for="personal_corporate_description"><?php esc_html_e('Personal or corporate description (about you or your company)', 'propatiz'); ?></label>
                    <textarea id="personal_corporate_description" name="personal_corporate_description" placeholder="Personal or corporate description (about you or your company)"></textarea>
            </div>
        
			</div>

			
						
			<div class="clear field-group">
						
			<div class="field-left">
                    <label for="user_password"><?php esc_html_e('Password', 'propatiz'); ?></label>
                    <input id="user_password" type="password" name="user_password" value="" placeholder="Password" required>
					<div class="password-error"></div>
            </div>
                 
			<div class="field-right">
                    <label for="confirmation_password"><?php esc_html_e('Retype password', 'propatiz'); ?></label>
                    <input id="confirmation_password" type="password" name="confirmation_password" value="" placeholder="Retype password" required>
					<div class="confirmation-password-error"></div>
                </div>
				
			
			</div>
			
			
			
			<p class="description"><?php echo wp_get_password_hint(); ?></p>
			
			
					
			<div class="form-button registration">
				<input type="submit" id="submit" class="signup-submit" name="submit" value="Register">
            </div>
				
			
			
			 
		</form>  

    	   
		   <div class="google-recaptcha-policy"><p class="google-policy-text">This site is protected by reCAPTCHA and the Google <a href="https://policies.google.com/privacy">Privacy Policy</a> and <a 
href="https://policies.google.com/terms">Terms of Service</a> apply.</p></div>
		   
	   	</div>
		
	
		

	</main><!-- .site-main -->
</div><!-- .content-area -->


</div>
</div>


<?php get_footer(); ?>






