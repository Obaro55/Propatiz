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
    
   
		
		
	<?php wp_head(); ?>

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
            <a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php bloginfo("template_url"); ?>/images/Propatiz-logo.svg" alt="Propatiz logo"></a>
			</div>
			
			
			
		
			
			
            <div id="navigation">
			
			<ul>
			<li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
			<li><a href="https://www.propatiz.com/pricing/">Pricing</a></li>	
			
			<li class="highlight-remover"><a href="#">Listings &nbsp;<i class="fa fa-caret-down"></i></a>
			
			 <ul>
                <li><a href="https://www.propatiz.com/classification/properties-for-sale/">Sale</a></li>
                <li><a href="https://www.propatiz.com/classification/properties-for-rent/">Rent</a></li>
				<li><a class="extra-margin" href="https://www.propatiz.com/classification/properties-for-lease/">Lease</a></li>
			</ul>
			
			</li>
			
			<li><a href="https://www.propatiz.com/listing-guidelines/">Guidelines</a></li>
			
			<li class="highlight-remover"><a class="info-desk" href="#">Info Desk &nbsp;<i class="fa fa-caret-down"></i></a>
			
			 <ul>
                <li><a href="">Locations</a></li>
                <li><a href="">Places</a></li>
				<li><a class="extra-margin" href="">Event Centres</a></li>
			</ul>
			
			</li>
			
			
			
			
			
						
			<?php

            if(!is_user_logged_in()) { ?>

			<li><a class="signup" href="https://www.propatiz.com/signup/">Sign Up</a></li>
			<li><a class="login" href="https://www.propatiz.com/login/">Login</a></li>
            
			<?php    }    ?> 
			
			
			
			
			
						
			<?php
			
			if(is_user_logged_in()) { ?>

			
			<li><a href="https://www.propatiz.com/my-listings/"><span>My Listings</span></a></li>
		
            
            <?php    }
			
			
			?>
			
			
		
					
		
		
			<?php

            if(is_user_logged_in()) { ?>

			<li><a href="<?php
			
			$logout_url = "https://www.propatiz.com/wp-login.php";
			$logout_url = add_query_arg('action', 'logout', $logout_url); 
			$logout_url = add_query_arg('_wpnonce', wp_create_nonce( 'log-out' ), $logout_url);
			echo $logout_url;
			
			?>"><span class="space-remover log-out">Sign Out</span></a></li>
            
		<?php    }
			
		?> 
			
			
			
			</ul>
            
			</div>		
			
				
			
		</nav>
		
		
		
    </header>
	
	
	