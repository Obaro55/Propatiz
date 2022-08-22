
<?php
/**
 * Template Name: Dashboard - Submit Promoted Listing
 *
 */


include(locate_template('extra-codes/google-recaptcha.php')); 
include(locate_template('extra-codes/login-control.php'));


if (isset($_POST['submit']))  { 
 

if (!isset($_POST['new_listing_nonce']) || !wp_verify_nonce($_POST['new_listing_nonce'],'new_listing') ){
        exit('No Access!'); 
 }


$current_user = wp_get_current_user();
$userID = $current_user->ID;
$userName = $current_user->display_name;
$userEmail = $current_user->user_email;
$userPhone = get_user_meta($userID, 'phone_number', true);
	

$upload_error = array();

$listing_title = uc_hyphenated_words(sanitize_text_field($_POST['listing_title']));	

$property_type = sanitize_text_field($_POST['property_type']);
$property_classification = sanitize_text_field($_POST['property_classification']);

$property_price = price_convert(sanitize_text_field($_POST['property_price']));
$property_size = strtolower(sanitize_text_field($_POST['property_size']));
$property_address = uc_hyphenated_words(sanitize_text_field($_POST['property_address']));
$property_city = ucfirst(sanitize_text_field($_POST['property_city']));
$property_state = ucfirst(sanitize_text_field($_POST['property_state']));
$bedrooms = sanitize_text_field($_POST['bedrooms']);
$bathrooms = sanitize_text_field($_POST['bathrooms']);
$property_details = sanitize_textarea_field($_POST['property_details']);


$amenities = array();
$amenities = array_filter($_POST['amenities']);
$amenities = array_map('esc_attr', $amenities);


$location_details = sanitize_textarea_field($_POST['location_details']);


$nearby_places = array();
$nearby_places = array_filter($_POST['nearby_places']);
$nearby_places = array_map('esc_attr', $nearby_places);


$nearby_schools = array();
$nearby_schools = array_filter($_POST['nearby_schools']);
$nearby_schools = array_map('esc_attr', $nearby_schools);


$property_documentation = array();
$property_documentation = array_filter($_POST['property_documentation']);
$property_documentation = array_map('esc_attr', $property_documentation);



$youtube_links = array();
$youtube_links = array_filter($_POST['youtube_links']);
$youtube_links = array_map('esc_attr', $youtube_links);



 $upload_error = array();		
	
    
   $to = "promoted_listings@propatiz.com";
   $subject = "New Promoted Listing Request";

 
   
   // Generate a random string to be used as the boundary marker
   $mime_boundary="==Multipart_Boundary_x".md5(mt_rand())."x";
   

   // Now we'll build the message headers
    $headers = "From: Propatiz.com <listings@propatiz.com>\r\n";
	$headers .= "Reply-To: " . $userEmail;
	$headers .= "Return-Path: Propatiz.com <listings@propatiz.com>\r\n";
	$headers .= "Organization: Propatiz.com\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "X-Priority: 1\r\n";
	$headers .= "X-Sender: Propatiz.com <listings@propatiz.com>\r\n";
	$headers .= "X-Mailer: PHP" . phpversion() . "\r\n";
	$headers .= "Content-Type: multipart/mixed;\r\n" .
	" boundary=\"{$mime_boundary}\"";
	  
 
	
$message = "User ID: $userID \r\n";
$message .= "User name: $userName \r\n";
$message .= "User phone: $userEmail \r\n";
$message .= "User phone: $userPhone \r\n";
$message .= "Listing title: $listing_title \r\n";
$message .= "Property type: $property_type \r\n";
$message .= "Property classification: $property_classification \r\n";
$message .= "Property price: $property_price \r\n";	
$message .= "Property size: $property_size \r\n";
$message .= "Property address: $property_address \r\n";	
$message .= "Property city: $property_city \r\n";	
$message .= "Property state: $property_state \r\n";	
$message .= "Bedrooms: $bedrooms \r\n";
$message .= "Bathrooms: $bathrooms \r\n \r\n";

$message .= "Property details:\r\n  $property_details \r\n \r\n";	


$message .= "Amenities:\r\n";

foreach($amenities as $amenity) {

$message .= "$amenity \r\n";

}

$message .= "\r\n";

$message .= "Location details: $location_details \r\n \r\n";

$message .= "Nearby places:\r\n";

foreach($nearby_places as $nearby_place) {

$message .= "$nearby_place \r\n";

}

$message .= "\r\n";

$message .= "Nearby schools:\r\n";

foreach($nearby_schools as $nearby_school) {

$message .= "$nearby_school \r\n";

}


$message .= "\r\n";


$message .= "Property documentation:\r\n";

foreach($property_documentation as $documentation) {

$message .= "$documentation \r\n";

}


$message .= "\r\n";


$message .= "Video links:\r\n";

foreach($youtube_links as $youtube_link) {

$message .= "$youtube_link \r\n";

}

	$message = "This is a multi-part message in MIME format.\n\n" .
      "--{$mime_boundary}\n" .
      "Content-Type: text/plain; charset=\"iso-8859-1\"\n" .
      "Content-Transfer-Encoding: 7bit\n\n" .
	$message . "\n\n";


	foreach($_FILES as $upload){
     	   
      $tmp_name = $upload['tmp_name'];
      $type = $upload['type'];
      $name = $upload['name'];
      $size = $upload['size'];
	  
	  
	  $allowed_file_extensions = array(
        "jpg",
        "jpeg",
		"png"
    );
	  	
	
	$file_extension = explode('.', $name = $upload['name']);
	$file_extension = strtolower(end($file_extension));
	
	
	if(in_array($file_extension,$allowed_file_extensions ) === false){
		$upload_error['file_error'] = "$name file type is not allowed.";
	}  
	
	
	
	if ($size > 1048576) {
		$upload_error['size_error'] = "$name is too large. File size shouldn't be bigger than 1MB.";
	};		

	

      if (file_exists($tmp_name)){
	
	
         if(is_uploaded_file($tmp_name)){

            $file = fopen($tmp_name,'rb');
            $data = fread($file,filesize($tmp_name));
            fclose($file);
            $data = chunk_split(base64_encode($data));
         }

         
         $message .= "--{$mime_boundary}\n" .
            "Content-Type: {$type};\n" .
            " name=\"{$name}\"\n" .
            "Content-Disposition: attachment;\n" .
            " filename=\"{$name}\"\n" .
            "Content-Transfer-Encoding: base64\n\n" .
         $data . "\n\n";
      }
   }
 
   $message.="--{$mime_boundary}--\n";
   
   
   

if(!$upload_error['upload_error'] && !$upload_error['size_error']) {

mail($to, $subject, $message, $headers, '-fmail@propatiz.com');

wp_redirect(esc_url( home_url('/promoted-listing-payment-form/')));
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
		
		<div class="listing-guidelines-header">
		<h1>Need your listings to get more views? Then try <a href="https://www.propatiz.com/promoted-listings/">Promoted listings</a>. To get started, kindly fill out the form below.</h1>
		</div>
		
		    <div class="listing-submission-form">
			
			 
            <form action="<?php the_permalink(); ?>"  method="post" enctype="multipart/form-data">
		
		    <?php wp_nonce_field('new_listing', 'new_listing_nonce'); ?>
		
		
			<?php if($upload_error['number_error']) { echo '<div class="custom-form-error">' . esc_html($upload_error['number_error']) . '</div>'; }  ?>
			<?php if($upload_error['file_error']) { echo '<div class="custom-form-error">' . esc_html($upload_error['file_error']) . '</div>'; }  ?>
			<?php if($upload_error['size_error']) { echo '<div class="custom-form-error">' . esc_html($upload_error['size_error']) . '</div>'; }  ?>
			
		
			
			<div class="clear field-group">
			
			 <div class="field-full-width title">
                    <label for="listing_title"><?php esc_html_e('Title', 'propatiz'); ?></label>
                    <input id="listing_title" type="text" name="listing_title" value="" placeholder="Title (for example, 'Apartment Building for Sale')" required>
					<div class="listing-title-error"></div>
            </div>
        
			</div>
			
			
			
			
			<div class="clear field-group">
			
			<div class="field-left select">
						
			<select class="form-select" id="select_property_type" name="property_type" required>
			<option disabled selected value=""><?php esc_html_e('Property type', 'propatiz'); ?></option>
			<option value="Houses">House</option>
			<option value="Serviced Apartments">Serviced Apartment</option>
			<option value="Flats">Flat</option>
			<option value="Office Space">Office Space</option>
			<option value="Office Buildings">Office Building</option>
			<option value="Co-Working Space">Co-Working Space</option>
			<option value="Shops">Shop</option>
			<option value="Warehouses">Warehouse</option>
			<option value="Lands">Land</option>
			<option value="Malls">Mall</option>
			<option value="Shopping Complexes">Shopping Complex</option>
			<option value="Commercial Properties">Commercial Property</option>
			</select> 
			
			<div class="property-type-error"></div>

			</div>
			
			<div class="field-right select">
			<select class="form-select" id="select_property_classification" name="property_classification" required>
			<option disabled selected value><?php esc_html_e('Classification', 'propatiz'); ?></option>
			<option value="For Sale">For Sale</option>
			<option value="For Rent">For Rent</option>
			<option value="For Lease">For Lease</option>
			</select>
			
			<div class="property-classification-error"></div>

			</div>
						
			</div>
		
			
			
			
			<div class="clear field-group overflow">
			
			<div class="field-left">
                    <label for="property_price"><?php esc_html_e('Property price', 'propatiz'); ?></label>
                    <input id="property_price" type="text" name="property_price" value="" placeholder="Property price" required>
					<div class="property-price-error"></div>
            </div>
                 
			<div class="field-right">
                    <label for="property_size"><?php esc_html_e('Property size', 'propatiz'); ?></label>
                    <input id="property_size" type="text" name="property_size" value="" placeholder="Property size">
                </div>
				
			</div>
					
			

			
			<div class="clear field-group">
			
			 <div class="field-full-width">
                    <label for="property_address"><?php esc_html_e('Address', 'propatiz'); ?></label>
                    <input id="property_address" type="text" name="property_address" value="" placeholder="Property address" required>
					<div class="property-address-error"></div>
            </div>
        
			</div>
			


			
			<div class="clear field-group overflow">
			
			<div class="field-left">
                    <label for="property_city"><?php esc_html_e('City', 'propatiz'); ?></label>
                    <input id="property_city" type="text" name="property_city" value="" placeholder="City" required>
					<div class="property-city-error"></div>
            </div>
                 
			<div class="field-right">
                    <label for="property_state"><?php esc_html_e('State', 'propatiz'); ?></label>
                    <input id="property_state" type="text" name="property_state" value="" placeholder="State" required>
					<div class="property-state-error"></div>
                </div>
				
			</div>
						


			
			<div class="clear field-group select">
						
			<div class="field-left select">
				<select class="form-select" name="bedrooms">
				<option hidden disabled selected value><?php esc_html_e('Bedrooms', 'propatiz'); ?></option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="More than seven">More than Seven</option>
				</select>
            </div>
                 
			<div class="field-right select">
				<select class="form-select" name="bathrooms">
				<option hidden disabled selected value><?php esc_html_e('Bathrooms', 'propatiz'); ?></option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="More than seven">More than Seven</option>
				</select>
                </div>
						
			</div>
						
			
			
			
			<div class="clear field-group">
			
			 <div class="field-full-width">
                     <label for="property_details"><?php esc_html_e('Property details', 'propatiz'); ?>></label>
                    <textarea id="property_details" name="property_details" placeholder="Property details" required></textarea>
					<div class="property-details-error"></div>
            </div>
        
			</div>
			
			
			
			
			<div class="clear field-group">
			
			 <div class="field-full-width location">
                     <label for="location_details"><?php esc_html_e('Location details', 'propatiz'); ?></label>
                    <textarea id="location_details" class="location-details" name="location_details" placeholder="Location details"></textarea>
            </div>
        
			</div>
			
			
			
			
			<div id="amenities-container">
			
			<p>For the following, add one answer per space. To add more, click on the "Add more..." link</p>
			
			<div class="clear field-group amenities">
			
			 <div class="field-full-width">
                    <label for="amenities"><?php esc_html_e('Amenities', 'propatiz'); ?></label>
                    <input id="amenities" type="text" name="amenities[]" value="" placeholder="Amenity">
            </div>
        
			</div>

			</div>
			
			
			
			
			<div class="clear field-group">
			
			<input type="button" id="add-more-amenities-button" class="add-more-button "value="+ Add more amenities" >
				
			</div>
						
			
			
			
			<div id="nearby-places-container">
			
			<div class="clear field-group">
			
			 <div class="field-full-width">
                    <label for="nearby_places"><?php esc_html_e('Nearby places', 'propatiz'); ?></label>
                    <input id="nearby_places" type="text" name="nearby_places[]" value="" placeholder="Nearby places (popular places around the location)">
            </div>
        
			</div>

			</div>
			
			
			<div class="clear field-group">
			
			<input type="button" id="add-more-places-button" class="add-more-button" value="+ Add more places">
				
			</div>
			
			
			
						
			<div id="nearby-schools-container">
			
			<div class="clear field-group">
			
			 <div class="field-full-width">
                    <label for="nearby_schools"><?php esc_html_e('Nearby schools', 'propatiz'); ?></label>
                    <input id="nearby_schools" type="text" name="nearby_schools[]" value="" placeholder="Nearby schools (popular schools around the location)">
            </div>
        
			</div>
			
			</div>
			
			
			<div class="clear field-group">
			
			<input type="button" id="add-more-schools-button" class="add-more-button" value="+ Add more schools">
				
			</div>
			
			
			
					
			<div id="property-documentation-container">
						
			<div class="clear field-group">
			
			<div class="field-full-width">
                    <label for="property_documentation"><?php esc_html_e('Property documentation', 'propatiz'); ?></label>
                    <input id="property_documentation" type="text" name="property_documentation[]" value="" placeholder="Documentation (for example, C of O)">
            </div>
        
			</div>
			
			</div>
			
			
			<div class="clear field-group">
			
			<input type="button" id="add-more-documentation-button" class="add-more-button" value="+ Add more documentation">
				
			</div>
			
			
			
			
			<div id="youtube-video-links-container">
						
			<div class="clear field-group">
			
			<div class="field-full-width">
                    <label for="youtube_links"><?php esc_html_e('YouTube link', 'propatiz'); ?></label>
                    <input id="youtube_links" type="text" name="youtube_links[]" value="" placeholder="YouTube link (of property video, if available)">
            </div>
        
			</div>
			
			</div>
			
			
			<div class="clear field-group">
			
			<input type="button" id="add-more-youtube-links-button" class="add-more-button" value="+ Add more YouTube links" >
				
			</div>
			
			<div class="youtube-link-error"></div>
			
					
					
					
			<div class="clear first-file-input field-group">
			
            <div  id="custom-file-input" class="field-full-width-file">
			<h2 class="upload-pictures"><?php esc_html_e('Upload pictures', 'propatiz'); ?></h2>
			
			
			<div class="upload">
			<input type="button" class="uploadButton" value="Browse">
			<input type="file" name="file" id="pictureUpload" required>
			<span class="fileName">Select picture...</span>
			</div>
			
			</div>
        
			</div>
			
			
			
			
			<div class="clear field-group">
			
			<input type="button" id="add-more-pictures-button" class="add-more-button" value="+ Add more pictures">
				
			</div>
        
			<div class="picture-upload-error"></div>
		
			
			
								
			<div class="form-button">
					<input type="submit" id="listing-submit" name="submit" value="Submit">
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
