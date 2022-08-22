
<?php
/**
 * Template Name: Dashboard - Edit Listing
 *
 */
 
 

$query = new WP_Query(array('post_type' => 'property', 'posts_per_page' =>'-1', 'post_status' => array('publish', 'pending', 'draft', 'private', 'trash')));

if ($query->have_posts()) { 

	while ($query->have_posts()) { $query->the_post();
	
	if(isset($_GET['listing_id'])) {
		
		if($_GET['listing_id'] == $post->ID)
		{
			$current_listing_id = $post->ID;
			$listing_title = get_the_title();
			$property_details = get_the_content();

		}
	}

} 

}

wp_reset_query();

global $current_listing_id;



$property_price = get_post_meta($current_listing_id, 'property_price', true);
$property_size = get_post_meta($current_listing_id, 'property_size', true);
$property_address = get_post_meta($current_listing_id, 'property_address', true);
$property_city = get_post_meta($current_listing_id, 'property_city', true);
$property_state = get_post_meta($current_listing_id, 'property_state', true);
$location_details = get_post_meta($current_listing_id, 'location_details', true);



if(isset($_POST['submit'])) {
	
	
	if (!isset($_POST['edit_listing_nonce']) || !wp_verify_nonce($_POST['edit_listing_nonce'],'edit_listing')) {
        exit('No Access!'); 
	}


$edit_title = uc_hyphenated_words(sanitize_text_field($_POST['edit_title']));	

$property_type = sanitize_text_field($_POST['property_type']);
$classification = sanitize_text_field($_POST['property_classification']);

$property_price = price_convert(sanitize_text_field($_POST['property_price']));
$property_size = strtolower(sanitize_text_field($_POST['property_size']));
$property_address = uc_hyphenated_words(strtolower(sanitize_text_field($_POST['property_address'])));
$property_city = ucfirst(sanitize_text_field(strtolower($_POST['property_city'])));
$property_state = ucfirst(sanitize_text_field(strtolower($_POST['property_state'])));
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


if(empty($edit_title)) {
	$edit_title = $listing_title;
}


	$post_information = array(
		'ID' => $current_listing_id,
		'post_title' => $edit_title,
		'post_name' => $edit_title,
		'post_content' => $property_details,
		'post-type' => 'property',
		'post_status' => 'publish'
	);

	$post_id = wp_update_post($post_information);
	
	
	
	
	
	
	
	
	
	
	if(!empty($property_type)) {
		
	wp_set_object_terms($post_id, $property_type, 'type', false);
	
	}
	
	
	$cities = array("Ikeja", "Lekki", "Surulere", "Maryland", "Festac", "Agege", "Epe", "Ikorodu", "Badagry", "Sagamu", "Abeokuta", "Ijebu Ode", "Ibadan", "Ogbomosho", "Ife", "Ile Ife", "Ilesha", "Ilesa", "Ado Ekiti", "Akure", "Ondo City", "Ilorin", "Benin", "Benin City", "Warri", "Sapele", "Asaba", "Agbor", "Yenagoa", "Awka", "Onitsha", "Owerri", "Aba", "Umuahia", "Nsukka", "Abakaliki", "Port Harcourt", "Uyo", "Calabar", "Lokoja", "Okene", "Makurdi", "Jos", "Zaria", "Bida", "Gusau", "Potiskum", "Minna", "Lavun", "Suleja", "Maiduguri" , "Mubi", "Yola"); // Populate with all the popular cities in Nigeria

    if(in_array($property_city, $cities) && !empty($classification) && $classification == "Properties for Sale" && !empty($property_state)) {

		
    $extra_classification = $property_type . " for Sale in " . $property_city . ", " . $property_state;


    } 
	
	
	if(in_array($property_city, $cities) && !empty($classification) && $classification == "Properties for Sale" && empty($property_state)) {

		
    $extra_classification = $property_type . " for Sale in " . $property_city . ", " . $property_state;


    } 
	
	
	
	
	
	
	if(in_array($property_city, $cities) && !empty($classification) && $classification == "Properties for Rent" && !empty($property_state)) {

		
    $extra_classification = $property_type . " for Rent in " . $property_city . ", " . $property_state;


    } 
	
	
	if(in_array($property_city, $cities) && !empty($classification) && $classification == "Properties for Rent" && empty($property_state)) {

		
    $extra_classification = $property_type . " for Rent in " . $property_city . ", " . $property_state;


    } 
	

	
	
	
	
	if(in_array($property_city, $cities) && !empty($classification) && $classification == "Properties for Lease" && !empty($property_state)) {

		
    $extra_classification = $property_type . " for Lease in " . $property_city . ", " . $property_state;


    } 
	
	
	if(in_array($property_city, $cities) && !empty($classification) && $classification == "Properties for Lease" && empty($property_state)) {

		
    $extra_classification = $property_type . " for Lease in " . $property_city . ", " . $property_state;


    } 
	
	
	if(!empty($classification) && !empty($extra_classification)) {
	
	$property_classification = array($classification, $extra_classification);
	
	}
	
	
	if(!empty($property_classification)) {

    wp_set_object_terms($post_id, $property_classification, 'classification', false);
	
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
		
	if(!empty($property_type)) {
	update_post_meta($post_id, 'property_type', $property_type);
	}
	
	if(!empty($classification)) {
	update_post_meta($post_id, 'property_classification', $property_classification);
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/*
	
	if(!empty($property_type)) {
	wp_set_object_terms($post_id, $property_type, 'type', false);
	}
	
	if(!empty($property_classification)) {
	wp_set_object_terms($post_id, $property_classification, 'classification', false);
	}
		
	if(!empty($property_type)) {
	update_post_meta($post_id, 'property_type', $property_type);
	}
	
	if(!empty($property_classification)) {
	update_post_meta($post_id, 'property_classification', $property_classification);
	}
	
	
	*/
	
	
	
	if(!empty($property_price)) {
	update_post_meta($post_id, 'property_price', $property_price);
	}
	
	if(!empty($property_size)) {
	update_post_meta($post_id, 'property_size', $property_size);
	}
	
	if(!empty($property_address)) {
	update_post_meta($post_id, 'property_address', $property_address);
	}
	
	if(!empty($property_city)) {
	update_post_meta($post_id, 'property_city', $property_city);
	}
	
	if(!empty($property_state)) {
	update_post_meta($post_id, 'property_state', $property_state);
	}
	
	if(!empty($property_location)) {
	update_post_meta($post_id, 'property_location', $property_location);
	}
	
	if(!empty($bedrooms)) {
	update_post_meta($post_id, 'bedrooms', $bedrooms);
	}
	
	if(!empty($bathrooms)) {
	update_post_meta($post_id, 'bathrooms', $bathrooms);
	}
			
	if(!empty($amenities)) {
	update_post_meta($post_id, 'amenities', $amenities);
	}
	
	if(!empty($location_details)) {
	update_post_meta($post_id, 'location_details', $location_details);
	}
	
	if(!empty($nearby_places)) {
	update_post_meta($post_id, 'nearby_placess', $nearby_places);
	}
	
	if(!empty($nearby_schools)) {
	update_post_meta($post_id, 'nearby_schools', $nearby_schools);
	}
	
	if(!empty($property_documentation)) {
	update_post_meta($post_id, 'property_documentation', $property_documentation);
	}
	
	if(!empty($youtube_links)) {
	update_post_meta($post_id, 'youtube_links', $youtube_links);
	}
	
	
	
	
	if($post_id)
	{
		wp_redirect(esc_url( home_url('/my-listings/')));
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
		
		    <div class="listing-submission-form">

		<form action="" id="primaryPostForm" method="POST">
		
		<?php wp_nonce_field('edit_listing', 'edit_listing_nonce'); ?>

			
			<div class="clear field-group">
			
			 <div class="field-full-width title">
                    <label for="listing_title"><?php esc_html_e('Title', 'couchnbed'); ?></label>
                    <input id="listing_title" type="text" name="edit_title" value="<?php echo $listing_title; ?>" placeholder="Title (for example, 'Apartment Building for Sale')">
            </div>
        
			</div>
			
			
			
			
			<div class="clear field-group">
			
			<div class="field-left select">
						
			<select class="form-select" id="select_property_type" name="property_type">
			<option disabled selected value=""><?php esc_html_e('Property type', 'propatiz'); ?></option>
			<?php
			$tax_terms = get_terms('type', array('hide_empty' => '0'));      
			foreach ( $tax_terms as $tax_term ):  
			echo '<option value="'.$tax_term->name.'">' . $tax_term->name . '</option>';   
			endforeach;
			?>
			</select> 
			

			</div>
			
			<div class="field-right select">
						
			<select class="form-select" id="select_property_classification" name="property_classification">
			<option disabled selected value=""><?php esc_html_e('Classification', 'propatiz'); ?></option>
			<?php
			$tax_terms = get_terms('classification', array('hide_empty' => '0'));      
			foreach ( $tax_terms as $tax_term ):  
			echo '<option value="'.$tax_term->name.'">' . $tax_term->name . '</option>';   
			endforeach;
			?>
			</select> 
		

			</div>
						
			</div>
		
			
			
			
			<div class="clear field-group overflow">
			
			<div class="field-left">
                    <label for="property_price"><?php esc_html_e('Property price', 'propatiz'); ?>></label>
                    <input id="property_price" type="text" name="property_price" value="<?php echo $property_price; ?>" placeholder="Property price">
            </div>
                 
			<div class="field-right">
                    <label for="property_size"><?php esc_html_e('Property size', 'propatiz'); ?></label>
                    <input id="property_size" type="text" name="property_size" value="<?php echo $property_size; ?>" placeholder="Property size">
                </div>
				
			</div>
					
			
			
			
			<div class="clear field-group">
			
			 <div class="field-full-width">
                    <label for="property_address"><?php esc_html_e('Address', 'propatiz'); ?></label>
                    <input id="property_address" type="text" name="property_address" value="<?php echo $property_address; ?>" placeholder="Property address">
            </div>
        
			</div>
			
			
			
			
			
			<div class="clear field-group overflow">
			
			<div class="field-left">
                    <label for="property_city"><?php esc_html_e('City', 'propatiz'); ?></label>
                    <input id="property_city" type="text" name="property_city" value="<?php echo $property_city; ?>" placeholder="City">
            </div>
                 
			<div class="field-right">
                    <label for="property_state"><?php esc_html_e('State', 'propatiz'); ?></label>
                    <input id="property_state" type="text" name="property_state" value="<?php echo $property_state; ?>" placeholder="State">
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
                     <label for="property_details"><?php esc_html_e('Property details', 'propatiz'); ?></label>
                    <textarea id="property_details" name="property_details" placeholder="Property details"><?php echo esc_textarea($property_details); ?></textarea>
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
                    <label for="youtube_link"><?php esc_html_e('YouTube link', 'propatiz'); ?></label>
                    <input id="youtube_link" type="text" name="youtube_links[]" value="" placeholder="YouTube link (of property video, if available)">
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
			<input type="file" name="file_attachment[]" id="pictureUpload">
			<span class="fileName">Select picture...</span>
			</div>
			
			</div>
        
			</div>
			
			
			<div class="clear field-group">
			
			<input type="button" id="add-file-button" class="add-more-button" value="+ Add more pictures">
				
			</div>
        
			<div class="picture-upload-error"></div>
		
			
			
					

					
			<div class="form-button">
					<input type="submit" id="listingsubmit" name="submit" value="Submit">
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
