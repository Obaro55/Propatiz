<?php
/**
 * Template Name: One-Listing Paystack Verification
 *
 */


$current_user = wp_get_current_user();
$userID = $current_user->ID;

 		
$result = array();


$reference_number = $_GET['propatiz'];

$url = 'https://api.paystack.co/transaction/verify/' . $reference_number;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt(
  $ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer sk_test_4834163ab6dbbb1b49a5d83674a21d3ceefae183']
);

$request = curl_exec($ch);

if(curl_error($ch)){
 echo 'error:' . curl_error($ch);
 }
 
curl_close($ch);

if ($request) {
  $result = json_decode($request, true);
}

if (array_key_exists('data', $result) && array_key_exists('status', $result['data']) && ($result['data']['status'] === 'success')) {
  
	update_user_meta($userID, 'propatiz_listing_count', 1);
	update_user_meta($userID, 'propatiz_plan_status', 'confirmed');
	wp_redirect(esc_url(home_url('/submit-listing/')));
	exit(); 
   
} else {
  echo "Transaction was unsuccessful";
}
		
		

get_header(); ?>



<div class="clear site-content-area">
<div class="clear site-contents">

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		

	</main><!-- .site-main -->


</div><!-- .content-area -->

</div>
</div>



<?php get_footer(); ?>
