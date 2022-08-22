<?php
/**
 * Template Name: Payment Form
 *
 */

/* 

	Explanation: 

	If the person who clicks on the link is not logged in or is not a registered user on Propatiz.com, he/she gets redirected to the login page. When he/she logs in, they get redirected back to this same page. This is what I call a positive... good circle. 

*/


$amount = sanitize_text_field($_GET['amount']);
$encoded_amount = base64_encode($amount);
$decoded_amount = base64_decode($amount);

$listing_id = sanitize_text_field($_GET['propatiz']);
$encoded_listing_id = base64_encode($listing_id);

$propatiz_nonce = sanitize_text_field($_GET['propatiz_url_nonce']);
$encoded_propatiz_nonce = base64_encode($propatiz_nonce);
$decoded_propatiz_nonce = base64_decode($propatiz_nonce);

if (!is_user_logged_in() || !$current_user) {   


	$url = "localhost/propatiz/payment-form-2/?propatiz=" . $encoded_listing_id . "&propatiz_nonce=" . $encoded_propatiz_nonce . "&amount=" . $encoded_amount;

	$propatiz_redirect_url = "http://localhost/propatiz/login";
	$propatiz_redirect_url = add_query_arg('redirect_to', urlencode($url), $propatiz_redirect_url);
	$propatiz_redirect_url = add_query_arg('access', 'pass', $propatiz_redirect_url); // For redirecting to the login page. Check functions.php for how it works.
	
    wp_redirect(esc_url($propatiz_redirect_url));
	exit();
} 


if(!wp_verify_nonce($decoded_propatiz_nonce, 'payment_url_nonce')) {
    exit('No Access!'); 
} 





$reference_number = random_str();
 
if (isset($_POST['submit']))  {
	
	
if (!isset($_POST['payment_form_nonce']) || !wp_verify_nonce($_POST['payment_form_nonce'],'payment_form')){
        exit('No Access!'); 
}
	

$email_address = sanitize_email($_POST['email_address']); 
$propatiz_amount = paystack_price_convert($decoded_amount);

$verification_url = "https://www.propatiz.com/one-listing-paystack-verification/";

$payment_url = add_query_arg('propatiz', $reference_number, $verification_url); 
$callback_url = add_query_arg('propatiz_url_nonce', wp_create_nonce('propatiz_nonce'), $payment_url);
 
$result = array();

$postdata =  array('email' => $email_address, 'amount' => $propatiz_amount, "reference" => $reference_number, 'callback_url' => $callback_url);

$url = "https://api.paystack.co/transaction/initialize";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($postdata));  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$headers = [
  'Authorization: Bearer sk_test_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
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


$real_booking_post_id = 10;
$formated_price = 5000;

$payment_url = "https://www.propatiz.com/paystack-form/";
$payment_url = add_query_arg('propatiz', $real_booking_post_id, $payment_url); 
$payment_url = add_query_arg('amount', $formated_price, $payment_url); 
$payment_url = add_query_arg('propatiz_payment_nonce', wp_create_nonce('payment_url_nonce'), $payment_url);






$new_price = "N5,600";
$new_price = format_price($new_price);
$new_price = price_convert($new_price);





  
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
                    <p class="paystack-amount"><?php echo price_convert($decoded_amount); ?></p>
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






