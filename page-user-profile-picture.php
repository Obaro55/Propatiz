<?php
/**
 * Template Name: Picture Uploads NEW 10 TEST
 *
 */



if (!is_user_logged_in() || !$current_user) {   
    wp_redirect(esc_url(home_url('/')));
	exit();
} 


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

	
	
	
	if(!$attach_id) {
		
		
	// We'll begin by assigning the "To" address and message subject
   $to = "user_verification@propatiz.com";
   $subject = "User Verification";
	
	// Get the sender's name and email address
   $from = $full_name."<".$email_address.">";


   // Generate a random string to be used as the boundary marker
   $mime_boundary="==Multipart_Boundary_x".md5(mt_rand())."x";
   

   // Now we'll build the message headers
	$headers = "From: $from\r\n" .
	$headers .= "Reply-To: ".$email_address."" . 
   "MIME-Version: 1.0\r\n" .
      "Content-Type: multipart/mixed;\r\n" .
      " boundary=\"{$mime_boundary}\"";
	  
 
$message = "";
$message .= "Name: $full_name \r\n";
$message .= "Email address: $email_address \r\n";
$message .= "Phone number: $phone_number \r\n";



   // Next, we'll build the invisible portion of the message body
   // Note that we insert two dashes in front of the MIME boundary when we use it
   
   $message = "This is a multi-part message in MIME format.\n\n" .
      "--{$mime_boundary}\n" .
      "Content-Type: text/plain; charset=\"iso-8859-1\"\n" .
      "Content-Transfer-Encoding: 7bit\n\n" .
   $message . "\n\n";


     	   
      	   
      // Store the file information to variables for easier access
	  
	   if(isset($_FILES['user_verification']) && $_FILES['user_verification']['error'] === UPLOAD_ERR_OK) {
	  
	  $name = $_FILES['user_verification']['name'];
	  $tmp_name = $_FILES['user_verification']['tmp_name'];
	  $type = $_FILES['user_verification']['type'];
	  $size = $_FILES['user_verification']['size'];
	  
	   }
	  
	  
	  $allowed_file_extensions = array(
        "jpg",
        "jpeg",
		"png"
    );
	  
	// Get image file extension	
	
	$file_extension = explode('.', $name);
	$file_extension = strtolower(end($file_extension));
	
	// Validate uploaded file extension	
	
	if(in_array($file_extension, $allowed_file_extensions ) === false){
		$upload_error['file_error'] = "You can only upload JPEG, JPG, and PNG files.";
	}  
	
	// Validate uploaded file size	
		
	if($size > 209715.2) {
        $upload_error['size_error'] = "Each file size shouldn't be bigger than 200KB.";
	};		

	

      // If the upload succeded, the file will exist
      if (file_exists($tmp_name)){
	
	
         // Check to make sure that it is an uploaded file and not a system file
         if(is_uploaded_file($tmp_name)){

            // Open the file for a binary read
            $file = fopen($tmp_name,'rb');

            // Read the file content into a variable
            $data = fread($file,filesize($tmp_name));

            // Close the file
            fclose($file);

            // Now we encode it and split it into acceptable length lines
            $data = chunk_split(base64_encode($data));
         }

         // Now we'll insert a boundary to indicate we're starting the attachment.
         // We have to specify the content type, file name, and disposition as an attachment, then add the file content.
         // NOTE: we don't set another boundary to indicate that the end of the file has been reached here. We only want one boundary between each file.
         // We'll add the final one after the loop finishes.
         $message .= "--{$mime_boundary}\n" .
            "Content-Type: {$type};\n" .
            " name=\"{$name}\"\n" .
            "Content-Disposition: attachment;\n" .
            " filename=\"{$name}\"\n" .
            "Content-Transfer-Encoding: base64\n\n" .
         $data . "\n\n";
      }
 
   // here's our closing mime boundary that indicates the last of the message
   $message.="--{$mime_boundary}--\n";
   // now we just send the message

if(!$upload_error['file_error'] && !$upload_error['size_error']) {

	update_user_meta($userID, 'profile_picture_status', 'uploaded');
	mail($to, $subject, $message, $headers, '-fmail@propatiz.com');
	wp_redirect(esc_url(home_url('/my-listings/')));
	exit();
	  
}	  
	
	  
}
	
} 




    
get_header('signup'); ?>

<div class="clear site-content-area">
<div class="clear site-contents">


<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
	

           <div class="form-container">
			
			<h1 class="page-top-heading signup">Upload ID and Profile Picture</h1>
			
			 
            <form action="<?php the_permalink(); ?>"  method="post" enctype="multipart/form-data">
			
			<?php wp_nonce_field('picture_upload', 'picture_upload_nonce'); ?>
		
		
			<?php if($upload_error['file_error']) { echo '<div class="custom-form-error">' . esc_html($upload_error['file_error']) . '</div>'; }  ?>
			<?php if($upload_error['size_error']) { echo '<div class="custom-form-error">' . esc_html($upload_error['size_error']) . '</div>'; }  ?>
				
			
			<div class="clear first-file-input-uploads field-group">
			
            <div  id="user_verification" class="field-full-width-file">
			<p class="upload-pictures">Select an ID for verification</p>
			  <div class="upload">
        <input type="button" class="uploadButton" value="Browse" />
        <input id="file_upload" type="file" name="user_verification" required>
        <span class="fileName">Select picture...</span>
		</div>
			
			<div class="file-upload-error"></div>
			
			</div>
        
			</div>
			
			
			
			<div class="clear field-group">
			
            <div  id="profile_picture" class="field-full-width-file">
			<p class="upload-pictures">Select a profile picture or logo (optimal picture dimnesion should be 110px by 110px)</p>
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
		
		
	
		
		
		<?php
		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'propatiz' ),
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






