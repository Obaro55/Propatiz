
<?php
/**
 * Template Name: Dashboard - Promoted Listings - Admin
 *
 */


include(locate_template('extra-codes/admin-control.php'));
include(locate_template('extra-codes/google-recaptcha.php'));
include(locate_template('extra-codes/login-control.php'));


if (isset($_POST['submit']))  { 
 

if (!isset($_POST['new_listing_nonce']) || !wp_verify_nonce($_POST['new_listing_nonce'],'new_listing') ){
        exit('No Access!'); 
 }


$upload_error = array();

$propatiz_user_id = intval($_POST['user_id']);

$listing_title = uc_hyphenated_words(sanitize_text_field($_POST['listing_title']));	

$property_type = sanitize_text_field($_POST['property_type']);
$classification = sanitize_text_field($_POST['property_classification']);
$classification = lcfirst($classification);


$property_price = price_convert(sanitize_text_field($_POST['property_price']));
$property_size = strtolower(sanitize_text_field($_POST['property_size']));
$property_address = uc_hyphenated_words(strtolower(sanitize_text_field($_POST['property_address'])));
$property_city = ucfirst(strtolower(sanitize_text_field($_POST['property_city'])));
$property_state = ucfirst(strtolower(sanitize_text_field($_POST['property_state'])));
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




	$post = array(
                'post_title' => $listing_title,
                'post_status' => 'publish', 
                'post_type'  => 'property' ,
                'post_author' => $propatiz_user_id,
                'post_content' => $property_details
);


    $post_id =  wp_insert_post($post);  
				

	wp_set_object_terms($post_id, $property_type, 'type', false);
	
	
	$cities = array("Ikeja", "Lekki", "Surulere", "Maryland", "Festac", "Agege", "Epe", "Ikorodu", "Badagry", "Sagamu", "Abeokuta", "Ijebu Ode", "Ibadan", "Ogbomosho", "Ife", "Ile Ife", "Ilesha", "Ilesa", "Ado Ekiti", "Akure", "Ondo City", "Ilorin", "Benin", "Benin City", "Warri", "Sapele", "Asaba", "Agbor", "Yenagoa", "Awka", "Onitsha", "Owerri", "Aba", "Umuahia", "Nsukka", "Abakaliki", "Port Harcourt", "Uyo", "Calabar", "Lokoja", "Okene", "Makurdi", "Jos", "Zaria", "Bida", "Gusau", "Potiskum", "Minna", "Lavun", "Suleja", "Maiduguri" , "Mubi", "Yola"); // Populate with all the popular cities in Nigeria

    if(in_array($property_city, $cities)) {

    $extra_classification = $property_type . " " . $classification . " in " . $property_city . ", " . $property_state;

    } else {

    $extra_classification = $property_type . " " . $classification . " in " . $property_state;

    }

    
    $property_classification = array($classification, $extra_classification);

    
    wp_set_object_terms($post_id, $property_classification, 'classification', false);
	
	
	
		
	update_post_meta($post_id, 'property_type', $property_type);
	update_post_meta($post_id, 'property_classification', $property_classification);
	update_post_meta($post_id, 'property_price', $property_price);
	update_post_meta($post_id, 'property_size', $property_size);
	update_post_meta($post_id, 'property_address', $property_address);
	update_post_meta($post_id, 'property_city', $property_city);
	update_post_meta($post_id, 'property_state', $property_state);
	update_post_meta($post_id, 'property_location', $property_location);
	update_post_meta($post_id, 'bedrooms', $bedrooms);
	update_post_meta($post_id, 'bathrooms', $bathrooms);
	update_post_meta($post_id, 'property_details', $property_details);
	update_post_meta($post_id, 'amenities', $amenities);
	update_post_meta($post_id, 'location_details', $location_details);
	update_post_meta($post_id, 'nearby_schools', $nearby_places);
	update_post_meta($post_id, 'nearby_places', $nearby_schools);
	update_post_meta($post_id, 'property_documentation', $property_documentation); 
	update_post_meta($post_id, 'youtube_links', $youtube_links);
	
	update_post_meta($post_id, 'property_listing_status', 'promoted');
	
	update_post_meta($propatiz_user_id, 'unlimited_listing_start_date', time());

			
    
	if ($post_id) {
 
   
    $valid_formats = array('jpg', 'png', 'jpeg'); // Supported file types
    $max_file_size = 209715.2; // 200KB
    $max_image_upload = 5; // Define how many images can be uploaded to the current post
    $wp_upload_dir = wp_upload_dir();
    $path = $wp_upload_dir['path'] . '/';
    $count = 0;
       
        // Check if user is trying to upload more than the allowed number of images for the current post
        if( (count($_FILES['file_attachment']['name'])) > $max_image_upload) {
			$upload_error['number_error'] = "You can only upload five pictures.";
			
			
        } else {
           
            foreach($_FILES['file_attachment']['name'] as $f => $name) {
                $extension = pathinfo($name, PATHINFO_EXTENSION);
               
                if ($_FILES['file_attachment']['error'][$f] == 4) {
                    continue;
                }
               
                if ($_FILES['file_attachment']['error'][$f] == 0) {
                    // Check if image size is larger than the allowed file size
                    if ($_FILES['file_attachment']['size'][$f] > $max_file_size) {
                        $upload_error['size_error'] = "$name is too large. File size shouldn't be bigger than 250KB.";
                        continue;
                   
                    // Check if the file being uploaded is in the allowed file types
                    } elseif(!in_array( strtolower( $extension ), $valid_formats)){
                        $upload_error['file_error'] = "$name file type is not allowed.";
                        continue;
                   
                    } else {
						
                        // If no errors, upload the file...
                        
                        $name = strstr($name, '.', true);
						$name = "Propatiz-" . md5($name);
						$name = $name . "." . $extension;
						
						$filename = $path . $name;
						
                        if(move_uploaded_file($_FILES["file_attachment"]["tmp_name"][$f], $filename)) {
                           
                            $count++;

                            $filetype = wp_check_filetype(basename($filename), null);
                            $wp_upload_dir = wp_upload_dir();
                            $attachment = array(
                                'guid'           => $wp_upload_dir['url'] . '/' . basename($filename),
                                'post_mime_type' => $filetype['type'],
                                'post_title'     => preg_replace('/\.[^.]+$/', '', basename($filename)),
                                'post_content'   => '',
                                'post_status'    => 'inherit'
                            );
                            // Insert attachment to the database
                            $attach_id = wp_insert_attachment($attachment, $filename, $post_id);

                            require_once(ABSPATH . 'wp-admin/includes/image.php');
                           
                            // Generate meta data
                            $attach_data = wp_generate_attachment_metadata($attach_id, $filename);
                            wp_update_attachment_metadata($attach_id, $attach_data);
							set_post_thumbnail($post_id, $attach_id);
                           
                    }
            }
        }
    }
}
   


   
if(!$attach_id){
	
wp_delete_post($post_id);

} else {

wp_redirect(esc_url( home_url('/admin-promoted-listing-successful/')));
exit();

}
 
}
 
 
}

 
get_header(); ?>



<div class="clear site-content-area dashboard">
<div class="clear site-contents dashboard">


<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		
		
	<div class="listing-submission-form admin">
			
			 
            <form action="<?php the_permalink(); ?>"  method="post" enctype="multipart/form-data">
		
		    <?php wp_nonce_field('new_listing', 'new_listing_nonce'); ?>
		
		
			<?php if($upload_error['number_error']) { echo '<div class="custom-form-error">' . esc_html($upload_error['number_error']) . '</div>'; }  ?>
			<?php if($upload_error['file_error']) { echo '<div class="custom-form-error">' . esc_html($upload_error['file_error']) . '</div>'; }  ?>
			<?php if($upload_error['size_error']) { echo '<div class="custom-form-error">' . esc_html($upload_error['size_error']) . '</div>'; }  ?>
			
			
			
			
			<div class="clear field-group">
			
			 <div class="field-full-width user-id">
                    <label for="user_id"><?php esc_html_e('User ID', 'propatiz'); ?></label>
                    <input id="user_id" type="text" name="user_id" value="" placeholder="User ID" required>
					<div class="user-id-error"></div>
            </div>
        
			</div>
			
		
			
						
			<div class="clear field-group">
			
			 <div class="field-full-width">
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
			<input type="file" name="file_attachment[]" id="pictureUpload" required>
			<span class="fileName">Select picture...</span>
			</div>
			
			</div>
        
			</div>
			
		

		
			<div class="clear field-group">
			
			<input type="button" id="add-file-button" class="add-more-button" value="+ Add more pictures">
				
			</div>
        
			<div class="picture-upload-error"></div>
		
			
			
					
			<div class="form-button">
					<input type="submit" id="listing-submit" name="submit" value="Submit">
            </div>
			
			
			 <div class="google-recaptcha-policy"><p class="google-policy-text">This site is protected by reCAPTCHA and the Google <a href="https://policies.google.com/privacy">Privacy Policy</a> and <a 
href="https://policies.google.com/terms">Terms of Service</a> apply.</p></div>
		   
	   
	</form> 


	   </div>
	
	

	</main><!-- .site-main -->


</div><!-- .content-area -->

</div>
</div>



<?php get_footer(); ?>
