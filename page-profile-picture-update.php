<?php
/**
 * Template Name: Profile Picture Update
 *
 */




 
if (isset($_POST['submit']))  {
	
	
if (!isset($_POST['picture_upload_nonce']) || !wp_verify_nonce($_POST['picture_upload_nonce'],'picture_upload')){
        exit('No Access!'); 
}
	
	
	$valid_formats = array('jpg', 'png', 'jpeg'); // Supported file types
    $max_file_size = 209715.2; // 200KB
    $wp_upload_dir = wp_upload_dir();
    $path = $wp_upload_dir['path'] . '/';


    $name = $_FILES['profile_picture']['name'];
	
	$extension = pathinfo($name, PATHINFO_EXTENSION);

    // Check if image size is larger than the allowed file size
    if ( $_FILES['profile_picture']['size'] > $max_file_size ) {
        $upload_error['size_error'] = "$name is too large. File size shouldn't be bigger than 200KB.";
		}
                   
    // Check if the file being uploaded is in the allowed file types
	if(!in_array( strtolower( $extension ), $valid_formats)){
        $upload_error['file_error'] = "$name file type is not allowed.";
		}
		
	$name = strstr($name, '.', true);
	$name = "Propatiz-" . md5($name);
	$name = $name . "." . $extension;
		
	$filename = $path . $name;
                   
    if(move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $filename)) {
                           
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
                            $attach_id = wp_insert_attachment($attachment, $filename);

                            require_once(ABSPATH . 'wp-admin/includes/image.php');
                           
                            // Generate meta data
                            $attach_data = wp_generate_attachment_metadata($attach_id, $filename);
                            wp_update_attachment_metadata($attach_id, $attach_data);
							
							// Attach avatar to user
							update_user_meta($userID, 'user_profile_picture_id', $attach_id);
													
                           
    }

if($attach_id && !$upload_error['file_error'] && !$upload_error['size_error']) {

   wp_redirect(esc_url(home_url('/profile-picture-updated/')));
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
		
		    
            <div class="form-container">
			
			<h1 class="page-top-heading signup">Update Profile Picture</h1>
			
			<?php if($upload_error['file_error']) { echo '<div class="picture-upload-errors"><div class="custom-form-error">' . esc_html($upload_error['file_error']) . '</div></div>'; }  ?>
			<?php if($upload_error['size_error']) { echo '<div class="picture-upload-errors"><div class="custom-form-error">' . esc_html($upload_error['size_error']) . '</div></div>'; }  ?>
			
			 
            <form action="<?php the_permalink(); ?>"  method="post" enctype="multipart/form-data">
			
			<?php wp_nonce_field('picture_upload', 'picture_upload_nonce'); ?>
		
		
			<div class="clear field-group">
			
            <div  id="profile_picture" class="field-full-width-file">
			<p class="upload-pictures update">Select a profile picture or logo</p>
			  <div class="upload">
        <input type="button" class="uploadButton" value="Browse" />
        <input id="profile_picture_upload" type="file" name="profile_picture" required>
        <span class="fileName">Select picture...</span>
		</div>
		
			<div class="profile-picture-error"></div>
			
			</div>
        
			</div>
			
						
			
			<div class="form-button registration">
				<input type="submit" id="upload" name="submit" value="Upload">
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
