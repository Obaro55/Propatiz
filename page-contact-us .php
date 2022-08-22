<?php
/**
 * Template Name: Contact Us
 *
 */
 
 
include(locate_template('extra-codes/google-recaptcha.php'));  


if (isset($_POST['send_message']))  {
	

if (!isset($_POST['contact_us_form']) || !wp_verify_nonce($_POST['contact_us_form'],'contact_us') ){
        exit('No Access!'); 
}

$full_name = sanitize_text_field($_POST['full_name']);
$phone_number = intval($_POST['phone_number']);
$email_address = sanitize_email($_POST['email_address']); 
$message_text = sanitize_textarea_field($_POST['message_text']);


$to = "info@propatiz.com";
$subject = "Email from Propatiz.com";

$message = "";
$message .= "Name: $full_name \r\n";
$message .= "Phone number: $phone_number \r\n";
$message .= "Email: $email_address \r\n \r\n";

$message .= "Message: \r\n \r\n$message_text";


$message .= "Propatiz&#8228;com";


$headers .= "From: $full_name <$email_address>\r\n";
$headers .= "Reply-To: $full_name <$email_address>\r\n";
$headers .= "Return-Path: $full_name <$email_address>\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
$headers .= "X-Priority: 3\r\n";
$headers .= "X-Mailer: PHP" . phpversion() . "\r\n";

mail($to, $subject, $message, $headers, '-fmail@propatiz.com');
	wp_redirect(esc_url( home_url('/email-received/')));
	exit();
}
    
get_header(); ?>

<div class="clear site-content-area contact-us">
<div class="clear site-contents contact-us">


<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
	
		
        <div class="contact-us-page">

<div class="section-border">

<h1>Contact Us</h1>
<p class="company-name">Propatiz.com</p>

<p class="address">2, Amos Akanbi Street, Iju, Ifako-Ijaiye, Lagos State, Nigeria</p>

<p><span class="bold-letter">T.</span> 07040301466</p>
<p class="page-paragraph-spacing"><span class="bold-letter">E.</span> <?php echo antispambot("info@propatiz.com"); ?></p>

<p>Or you can fill out the form below:


            <div class="site-form">
			
			 
            <form action="<?php the_permalink(); ?>"  method="post">
			
			<?php wp_nonce_field('contact_us', 'contact_us_form'); ?>			
			
			<div class="clear field-group">
			
            <div class="field-full-width">
                    <label for="full_name">Name <span class="required">*</span></label>
                    <input id="full_name" type="text" name="full_name" value="" placeholder="Full Name" required>
            </div>
        
			</div>
			
			<div class="clear field-group">
			
			
			<div class="field-left">
                    <label for="email_address">Email <span class="required">*</span></label>
                    <input id="email_address" type="text" name="email_address" value="" placeholder="Email" required>
					<div class="form-error"><?php echo $email_error; ?></div>
					<div class="email-error"></div>
            </div>
                 
			<div class="field-right">
                    <label for="phone_number">Phone number <span class="required">*</span></label>
                    <input id="phone_number" type="text" name="phone_number" value="" placeholder="Phone Number" required>
                </div>
				
				
			
			</div>
      
			<div class="clear field-group">
			
			 <div class="field-full-width">
                     <label for="message_text">Message <span class="required">*</span></label>
                    <textarea id="message_text" name="message_text" placeholder="Message for Propatiz.com" rows="4"></textarea>
            </div>
        
			</div>
			
			
			<div class="form-button">
					<input type="submit" id="send_message" name="send_message" value="Send Message">
            </div>
			
			 
		</form> 
     
       
	   
	   	</div>
		
		</div>
		
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