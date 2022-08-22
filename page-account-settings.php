<?php
/**
 * Template Name: Account Settings
 *
 */


include(locate_template('extra-codes/login-control.php'));
	

    
get_header('dashboard'); ?>



<div class="clear site-content-area dashboard">
<div class="clear site-contents dashboard">


<div id="primary" class="content-area">
	<main id="main" class="site-main dashboard" role="main">

		
		
		<div class="dashboard-container">
		
		<?php include(locate_template('extra-codes/dashboard-navigation.php')); ?>
		
		<div class="dashboard-contents">
			
			
			<div class="page-contents account-settings">

<h1>Account Settings</h1>

<div class="text-container"><div class="icon"><i class="fa fa-edit"></i></div><div class="text"><p>Update Profile Information, including your name, email, and phone number.</p>
<p><a href="https://www.propatiz.com/update-information/">Update Information</a></p></div></div>



<div class="text-container"><div class="icon"><i class="fa fa-photo"></i></div><div class="text"><p>Change your profile picture. (Please ensure that the picture is less than or exactly 250KB.)</p>
<p><a href="https://www.propatiz.com/update-profile-picture/">Update Profile Picture</a></p></div></div>



<div class="text-container"><div class="icon"><i class="fa fa-lock"></i></div><div class="text"><p>Update password. (It's a great idea to use hard-to-guess passwords.)</p>
<p><a href="https://www.propatiz.com/password-reset/">Reset Password</a></p></div></div>



<div class="text-container"><div class="icon"><i class="fa fa-window-close"></i></div><div class="text"><p>You can delete your account if you feel the need to.</p>
<p><a href="https://www.propatiz.com/delete-account/">Delete Account</a></p></div></div>



</div>
			
			
      
	   	</div>
		
		
		</div>
		

	</main><!-- .site-main -->


</div><!-- .content-area -->

</div>
</div>



<?php get_footer(); ?>
