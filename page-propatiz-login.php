<?php
/**
 * Template Name: Propatiz Login
 *
 */
 
 
if(is_user_logged_in()) {   
    wp_redirect(esc_url(home_url('/')));
	exit();
} 

 
get_header('signup'); ?>




<div class="clear site-content-area login">
<div class="clear site-contents">

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		
		
	    <?php if($_REQUEST['username'] == 'blank' && $_REQUEST['password'] == 'blank') { echo '<div class="propatiz-login-errors"><div class="custom-form-error">Username and password required.</div></div>'; }  
		
		elseif($_REQUEST['username'] == 'blank') { echo '<div class="propatiz-login-errors"><div class="custom-form-error">Username required.</div></div>'; }
		
		elseif($_REQUEST['password'] == 'blank') { echo '<div class="propatiz-login-errors"><div class="custom-form-error">Password required.</div></div>'; }  
		
		?>
		
		<?php if($_REQUEST['login-attempt'] == 'failed') { echo '<div class="propatiz-login-errors"><div class="custom-form-error">Incorrect login details.</div></div>'; }  ?>
		<?php if($_REQUEST['loggedout'] == 'true') { echo '<div class="propatiz-login-errors"><div class="custom-form-error">You\'ve successfully logged out.</div></div>'; }  ?>
		<?php if($_REQUEST['checkemail'] == 'confirm') { echo '<div class="propatiz-login-errors"><div class="custom-form-error">A password reset link has been sent to your email.</div></div>'; }  ?>
		<?php if($_REQUEST['login'] == 'expiredkey') { echo '<div class="propatiz-login-errors"><div class="custom-form-error">The password reset key has expired.</div></div>'; }  ?>
		<?php if($_REQUEST['login'] == 'invalidkey') { echo '<div class="propatiz-login-errors"><div class="custom-form-error">The password reset key is invalid.</div></div>'; }  ?>
		<?php if($_REQUEST['password'] == 'changed') { echo '<div class="propatiz-login-errors"><div class="custom-form-error">Password sucessfully changed.</div></div>'; }  ?>
		
		
		
		
		<div class="propatiz-form-container login">
		
		
		<h1><?php esc_html_e('Login', 'propatiz'); ?></h1>
		
		
		<form action="<?php echo wp_login_url(); ?>"  id="propatiz-custom-login" method="post">		
			
			
			<div class="clear field-group">
			
            <div class="field-full-width">
                <label for="user_login"><?php esc_html_e('Username or Email', 'propatiz'); ?></label>
				<input type="text" name="log" id="user_login" placeholder="Username or email">
            </div>
        
			</div>
						
		
			
			<div class="clear field-group">
						
			<div class="field-full-width">
                    <label for="user_pass"><?php esc_html_e('Password', 'propatiz'); ?></label>
					<input type="password" name="pwd" id="user_pass" placeholder="Password">
            </div>
        
			</div>
					
			
			
			<div class="clear field-group">
			
			<div class="rememberme">
					<label for="rememberme">
					<input type="checkbox" name="rememberme" value="forever" id="rememberme" /> Remember me
					</label>
			</div>
				
				
			<div class="form-button login">
					<input type="submit" id="login-submit" name="user-submit" value="Log In" />
            </div>
			
			</div>
			
			
			<div class="signup-link">
					<p><a href="https://www.propatiz.com/signup/">Create an Account</a></p>
            </div>
			
			
			<div class="forgot-email">
					<p>Lost your password? Get a new one <a href="https://www.propatiz.com/wp-login.php?action=lostpassword">here</a>.</p>
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
