<?php
/**
 * Template Name: Profile Picture Upload
 *
 */


$current_user = wp_get_current_user();
$userID = $current_user->ID;




include(locate_template('extra-codes/google-recaptcha.php')); 
 
 
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
        $upload_error['size_error'] = "$name is too large. File size shouldn't be bigger than 250KB.";
		}
                   
    // Check if the file being uploaded is in the allowed file types
	if(!in_array( strtolower( $extension ), $valid_formats)){
        $upload_error['file_error'] = "$name file type is not allowed.";
		}
		
	$name = strstr($name, '.', true);
	$name = "Summit-Solicitors-" . md5($name);
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

	
} 




    
get_header('signup'); ?>

<div class="clear site-content-area picture-uploads">
<div class="clear site-contents">


<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
	    
			
		    <?php if($upload_error['file_error']) { echo '<div class="picture-upload-errors"><div class="custom-form-error">' . esc_html($upload_error['file_error']) . '</div></div>'; }  ?>
			<?php if($upload_error['size_error']) { echo '<div class="picture-upload-errors"><div class="custom-form-error">' . esc_html($upload_error['size_error']) . '</div></div>'; }  ?>
	

           <div class="form-container picture-uploads">
			
			<h1 class="page-top-heading signup">Profile Picture</h1>
			
			 
            <form action="<?php the_permalink(); ?>"  method="post" enctype="multipart/form-data">
			
			<?php wp_nonce_field('picture_upload', 'picture_upload_nonce'); ?>
				
			
			<div class="clear field-group">
			
            <div  id="profile_picture" class="field-full-width-file">
			<p class="upload-pictures">Select a profile picture or logo (optimal picture dimension is 110px by 110px)</p>
			  <div class="upload">
        <input type="button" class="uploadButton" value="Browse" />
        <input id="profile_picture_upload" type="file" name="profile_picture" required>
        <span class="fileName">Select picture...</span>
		</div>
		
			
			</div>
        
			</div>
							
			
			<div class="form-button registration">
				<input type="submit" id="upload" name="submit" value="Upload">
            </div>
				
			
			
    	   
		   <div class="google-recaptcha-policy"><p class="google-policy-text">This site is protected by reCAPTCHA and the Google <a href="https://policies.google.com/privacy">Privacy Policy</a> and <a 
href="https://policies.google.com/terms">Terms of Service</a> apply.</p></div>
			
			 
		</form> 
 
		   
	   	</div>
		
		
	
		
		
		<?php
		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'summitsolicitors' ),
				get_the_title()
			),
			'<footer class="entry-footer"><span class="edit-link">',
			'</span></footer><!-- .entry-footer -->'
		);
	?>	
		

	</main><!-- .site-main -->
</div><!-- .content-area -->


</div>
</div>


<?php get_footer(); ?>






