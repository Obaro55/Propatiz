<?php
/**
 * Template Name: One-Listing Payment Form
 *
 */

 
include(locate_template('extra-codes/google-recaptcha.php')); 
include(locate_template('extra-codes/login-control.php'));

$reference_number = random_str();
 
if (isset($_POST['submit']))  {
	
	
if (!isset($_POST['payment_form_nonce']) || !wp_verify_nonce($_POST['payment_form_nonce'],'payment_form')){
        exit('No Access!'); 
}
	

$email_address = sanitize_email($_POST['email_address']); 
$amount = paystack_price_convert(1000);

$verification_url = "localhost/propatiz/one-listing-paystack-verification/";

$edit_url = add_query_arg('propatiz', $reference_number, $verification_url); 
$callback_url = add_query_arg('propatiz_url_nonce', wp_create_nonce( 'action' ), $edit_url);
 
$result = array();

$postdata =  array('email' => $email_address, 'amount' => $amount, "reference" => $reference_number, 'callback_url' => $callback_url);

$url = "https://api.paystack.co/transaction/initialize";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($postdata));  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$headers = [
  'Authorization: Bearer sk_test_4834163ab6dbbb1b49a5d83674a21d3ceefae183',
  'Content-Type: application/json',

];
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$request = curl_exec ($ch);

curl_close ($ch);

if ($request) {
  $result = json_decode($request, true);
  
  header('Location: ' . $result['data']['authorization_url']);
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
	
		

            <div class="form-container paystack-payment-form">
			
			<h1 class="page-top-heading payment">Payment Form</h1>
			<p class="paystack-initialization">This payment form supports MasterCard, Visa, and Verve, and is securely processed by <a href="https://www.paystack.com/">Paystack</a>.</p>
			
			 
            <form action=""  method="post" enctype="multipart/form-data">
			
			<?php wp_nonce_field('payment_form', 'payment_form_nonce'); ?>
			
			
			<div class="clear field-group">
			
            <div class="field-full-width">
                    <p class="paystack-amount">₦1,000</p>
            </div>
        
			</div>
			
			<div class="clear field-group">
			
            <div class="field-full-width">
                    <label for="email_address"><?php esc_html_e('Email', 'propatiz'); ?></label>
                    <input id="email_address" type="text" name="email_address" value="" placeholder="Email" required>
					<div class="email-error"></div>
            </div>
        
			</div>
								
			
			<div class="form-button registration">
				<input type="submit" id="submit" name="submit" value="Pay Now">
            </div>
					
			
			 
		</form> 
  

    	   
		   <div class="google-recaptcha-policy"><p class="google-policy-text">This site is protected by reCAPTCHA and the Google <a href="https://policies.google.com/privacy">Privacy Policy</a> and <a 
href="https://policies.google.com/terms">Terms of Service</a> apply.</p></div>
		   
	   	</div>
		
		
		</div>
	   
	   	</div>
		

	</main><!-- .site-main -->
</div><!-- .content-area -->


</div>
</div>


<?php get_footer(); ?>






