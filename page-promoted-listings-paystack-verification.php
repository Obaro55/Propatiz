<?php
/**
 * Template Name: Promoted Listings Paystack Verification
 *
 */
 
 		
$result = array();


$reference_number = $_GET['propatiz'];

$url = 'https://api.paystack.co/transaction/verify/' . $reference_number;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt(
  $ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer sk_test_xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx']
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
  
	echo "Transaction was successful";
	wp_redirect(esc_url(home_url('/my-listings/')));
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
