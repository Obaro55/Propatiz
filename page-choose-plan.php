
<?php
/**
 * Template Name: Dashboard - Choose A Plan
 *
 */

include(locate_template('extra-codes/google-recaptcha.php'));
include(locate_template('extra-codes/login-control.php'));


if (isset($_POST['submit']))  { 
 

if (!isset($_POST['choose_plan_nonce']) || !wp_verify_nonce($_POST['choose_plan_nonce'],'choose_plan') ){
        exit('No Access!'); 
 }


$one_listing_plan = sanitize_text_field($_POST['one_listing_plan']);
$three_listings_plan = sanitize_text_field($_POST['three_listings_plan']);
$unlimited_listings_plan = sanitize_text_field($_POST['unlimited_listings_plan']);

if((!empty($one_listing_plan)) && $one_listing_plan == 'true') {
	
	update_user_meta($userID, 'propatiz_plan', 'one_listing_plan');
	
	wp_redirect(esc_url(home_url('/one-listing-payment-form/')));
	exit();
}

if((!empty($three_listings_plan)) && $three_listings_plan == 'true') {
	
	update_user_meta($userID, 'propatiz_plan', 'three_listings_plan');
	
	wp_redirect(esc_url(home_url('/three-listings-payment-form/')));
	exit();
}

if((!empty($unlimited_listings_plan)) && $unlimited_listings_plan == 'true') {
	
	update_user_meta($userID, 'propatiz_plan', 'unlimited');
	
	wp_redirect(esc_url(home_url('/unlimited-listings-payment-form/')));
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
		
		    <div class="choose-plan-form">
			
			 
            <form action="<?php the_permalink(); ?>"  method="post" enctype="multipart/form-data">
		
		    <?php wp_nonce_field('choose_plan', 'choose_plan_nonce'); ?>
		
		
			<h1>Choose a Plan</h1>
			
			<p class="selection">(To deselect a choice you've aready made, click on the selected choice again.)</p>
			
			<table>
				<tr>					
						<th class="border"><h2>Plan</h2></th>
						<th><h2>Price<h2></th>
				</tr>


				<tr>
					<td class="border"><input type="checkbox" id="checkbox1" class="checkbox" name="one_listing_plan" value="true"><label for="checkbox1"> One Listing</label></td>
                                        <td>₦1,000</td>
                    
				</tr>


				<tr>
					
					<td class="border"><input type="checkbox" id="checkbox2" class="checkbox" name="three_listings_plan" value="true"><label for="checkbox2"> Three Listings</label></td>
					<td>₦2,000</td>
					
				</tr>
				
				
				<tr>
					
					<td class="border no-bottom-border"><input type="checkbox" id="checkbox3" class="checkbox" name="unlimited_listings_plan" value="true"><label for="checkbox3" class="unlimited-listing-plan"> Unlimited Listings (30 days)</label></td>
					<td class="no-bottom-border">₦5,000</td>
					
				</tr>
				
				
				
		</table>
			
			
			<p class="promoted-listings">Would you prefer to promote your listings instead? Find out more about <a href="https://www.propatiz.com/promoted-listings/">promoted listings</a>.
			
			
								
			<div class="form-button">
					<input type="submit" id="listing-submit" name="submit" value="Submit">
            </div>
			
			
			 <div class="google-recaptcha-policy"><p class="google-policy-text">This site is protected by reCAPTCHA and the Google <a href="https://policies.google.com/privacy">Privacy Policy</a> and <a 
href="https://policies.google.com/terms">Terms of Service</a> apply.</p></div>
		   
	   	</div>
	   
						 
			</form> 
      
      
	   	</div>
		
		
		</div>
		
		</div>

	</main><!-- .site-main -->


</div><!-- .content-area -->

</div>
</div>



<?php get_footer(); ?>
