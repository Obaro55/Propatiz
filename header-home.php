<!DOCTYPE html>

<html lang="en" dir="ltr">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
    
    <meta name="theme-color" content="#fd330b" />


 
<?php 
	
	$protected_page_ids = array(115, 56, 58, 60, 64, 70, 72, 74, 78, 82, 84, 129, 131, 86, 88, 90, 98, 100, 105, 107, 109, 113, 115, 133, 135, 137, 139, 117, 96, 119, 123, 125, 160, 171); 
	
	if(in_array($post->ID, $protected_page_ids)) {
		
		echo '<meta name="robots" content="noindex,nofollow">'; 
		
	}
	
	?>

</head>

	<body <?php body_class() ?>>

	<header>
			
		<nav>
			<div class="menu-container">
			<div class="menu-icon">
			<div class="bar one"></div>
			<div class="bar two"></div>
			<div class="bar three"></div>			
			</div>
			</div>
		
			<div id="logo">
            <a class="white-logo" href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php bloginfo("template_url"); ?>/images/Propatiz-Logo-White.svg"></a>
			<a class="orange-logo" href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php bloginfo("template_url"); ?>/images/Propatiz-Logo-Orange.svg"></a>
			</div>
			
			
			
			
						
		<?php

if(!is_user_logged_in()) { ?>

	<div class="signup-login">

			<span class="links"><a href="https://propatiz.com/signup/">Sign Up</a> <span class="separator">&middot;</span> <a href="http://localhost/propatiz/login/">Login</a></span> 
			
	</div>	
            
       <?php    }
			
?> 
			
			
            <div id="navigation">
			
			<ul>
			<li><a href="<?php echo esc_url(home_url('/')); ?>"><span>Home</span></a></li>
			<li><a href="localhost/propatiz/pricing/"><span>Pricing</span></a><li>
			<li><a href="localhost/propatiz/all-listings/"><span>All Listings</span></a><li>	
			<li><a href="localhost/propatiz/for-sale/"><span>For Sale</span></a><li>
			<li><a href="localhost/propatiz/for-rent/"><span>For Rent</span></a><li>
			<li><a href="localhost/propatiz/for-lease/"><span>For Lease</span></a><li>
			<li><a href="localhost/propatiz/listing-guidelines/"><span>Listing Guidelines</span></a><li>

			<li><a href="localhost/propatiz/info-desk/"><span>Info Desk</span></a><li>			
			
					<?php

if(is_user_logged_in()) { ?>

			<li><a class="sign-out" href="<?php
			
			$logout_url = "localhost/propatiz/wp-login.php";
			$logout_url = add_query_arg('action', 'logout', $logout_url); 
			$logout_url = add_query_arg('propatiz_logout_nonce', wp_create_nonce( 'action' ), $logout_url);
			echo $logout_url;
			
			?>">Sign Out</a><li>
            
       <?php    }
			
?> 
			
			
			
			</ul>
            
			</div>		
			
				
			
		</nav>
		
		
		
    </header>
	
	
	