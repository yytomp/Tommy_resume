<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="header-footer-bg">

<div onclick="dw_micronix_topFunction()" id="TopBtn"></div>

<nav role="navigation" id="skip" aria-label="<?php echo esc_attr_x( 'Skip links', 'ARIA label', 'dw-micronix' ); ?>">

	<?php if ( is_active_sidebar( 'left-sidebar' ) ) : ?>

	<a class="tab-shortcut" id="shortcut-left-sidebar" href="#left"><?php is_active_sidebar( 'right-sidebar' ) ? esc_html_e( 'Skip to first sidebar', 'dw-micronix' ) : esc_html_e( 'Skip to sidebar', 'dw-micronix' ); ?></a>

	<?php endif; ?>

	<a class="tab-shortcut" id="shortcut-content" href="#content"><?php esc_html_e( 'Skip to content', 'dw-micronix' ); ?></a>

	<?php if ( is_active_sidebar( 'right-sidebar' ) ) : ?>

	<a class="tab-shortcut" id="shortcut-right-sidebar" href="#right"><?php is_active_sidebar( 'left-sidebar' ) ? esc_html_e( 'Skip to second sidebar', 'dw-micronix' ) : esc_html_e( 'Skip to sidebar', 'dw-micronix' ); ?></a>

	<?php endif; ?>

</nav> <!-- /skip -->

<div id="site-wrapper" class="site-wrapper">

		<!-- ? HEADER SECTION STARTS -->
		<header>
			<div class="hd-body">
				<div class="hd-row1">
					<div class="hd-row1-inner-1"></div>
					<div class="hd-row1-inner-2"></div>
					<div class="hd-row1-inner-3">
					<a id="dw-micronix-toggle" href="javascript:;" class="hd-row1-nav-colorpicker"></a>
					</div>
				</div>
				<div class="hd-row2">
					<div class="hd-row2-inner-1"></div>
					<div class="hd-row2-inner-2"></div>
					<div class="hd-row2-inner-3">
					<div class="datetime">
						<div id="dw-micronix-digital-clock">
							<span class="date-string"><?php esc_html_e( 'Date:', 'dw-micronix' ); ?></span>
							<span class="date-date"></span>
							<span class="time-string"><?php esc_html_e( 'Time:', 'dw-micronix' ); ?></span>
							<span class="time-time"></span>
						</div>
					</div>
					</div>
				</div>
				<div class="hd-row3">
					<div class="hd-row3-inner-1">
					<div class="hd-row3-navcap1"></div>
					<a class="hd-row3-nav-link-1" href="<?php echo esc_url( get_theme_mod( 'dw-micronix-hnav-link1' ) ); ?>"><div class="hdmainnav"><?php echo esc_textarea( get_theme_mod( 'dw-micronix-hnav-linkname1' ) ); ?></div></a>
					<a class="hd-row3-nav-link-2" href="<?php echo esc_url( get_theme_mod( 'dw-micronix-hnav-link2' ) ); ?>"><div class="hdmainnav"><?php echo esc_textarea( get_theme_mod( 'dw-micronix-hnav-linkname2' ) ); ?></div></a>
					<a class="hd-row3-nav-link-3" href="<?php echo esc_url( get_theme_mod( 'dw-micronix-hnav-link3' ) ); ?>"><div class="hdmainnav"><?php echo esc_textarea( get_theme_mod( 'dw-micronix-hnav-linkname3' ) ); ?></div></a>
					<a class="hd-row3-nav-link-4" href="<?php echo esc_url( get_theme_mod( 'dw-micronix-hnav-link4' ) ); ?>"><div class="hdmainnav"><?php echo esc_textarea( get_theme_mod( 'dw-micronix-hnav-linkname4' ) ); ?></div></a>
					<a class="hd-row3-nav-link-5" href="<?php echo esc_url( get_theme_mod( 'dw-micronix-hnav-link5' ) ); ?>"><div class="hdmainnav"><?php echo esc_textarea( get_theme_mod( 'dw-micronix-hnav-linkname5' ) ); ?></div></a>
					<div class="hd-row3-navcap2"></div>
					</div>
					<div class="hd-row3-inner-2"></div>
					<div class="hd-row3-inner-3">
					<div id="headerlogo">
						<a href="<?php echo esc_url( home_url() ); ?>">
						<?php
						$dw_micronix_custom_logo_id = get_theme_mod( 'custom_logo' );
						$dw_micronix_logo           = wp_get_attachment_image_src( $dw_micronix_custom_logo_id, 'full' );
					
						if ( has_custom_logo() ) {
							echo '<img src="' . esc_url( $dw_micronix_logo[0] ) . '" alt="' . esc_html( get_bloginfo( 'name' ) ) . '">';
						} else {
							echo '<div id="blog-name">' . esc_html( get_bloginfo( 'name' ) ) . '</div>';
							echo '<div id="blog-tagline">' . esc_html( get_bloginfo( 'description' ) ) . '</div>';
						}
						?>
						</a>
						</div>
					</div>
					<div class="hd-row3-inner-4"></div>
				</div>
				<div class="hd-row4">
					<div class="hd-row4-inner-1">
					<div class="userlog">
						<?php 
						if ( is_user_logged_in() ) {
							/* translators: %s = Logout URL */
							$dw_micronix_html_message = sprintf( __( 'Welcome, you are logged in. <a href="%s">Logout?</a>', 'dw-micronix' ), esc_url( wp_login_url() ) );
							echo wp_kses_post( $dw_micronix_html_message );
						} else {
							/* translators: %s = Login URL */
							$dw_micronix_html_message = sprintf( __( 'Welcome, Log in by clicking <a href="%s">&nbsp;Here!</a>', 'dw-micronix' ), esc_url( wp_login_url() ) );
							echo wp_kses_post( $dw_micronix_html_message );
						} 
						?>
						</div>
					</div>
					<div class="hd-row4-inner-2"></div>
					<div class="hd-row4-inner-3">
						<!--- Start Social Bar --->

						<div id="socialbar">
								<?php if ( get_theme_mod( 'dw_micronix_display_socialicons' ) !== '' ) { ?>
									<div class="socialicon-wrap">
										<?php if ( get_theme_mod( 'dw_micronix_facebook_url' ) !== '' ) { ?>
											<a href="<?php echo esc_url( get_theme_mod( 'dw_micronix_facebook_url', '' ) ); ?>"><div class="socialicon-fb"></div></a>
										<?php } ?>
										<?php if ( get_theme_mod( 'dw_micronix_gplus_url' ) !== '' ) { ?>
											<a href="<?php echo esc_url( get_theme_mod( 'dw_micronix_gplus_url', '' ) ); ?>"><div class="socialicon-gplus"></div></a>
										<?php } ?>
									</div>
								<?php } ?>
						</div>

						<!-- End Social Bar -->
					</div>
				</div>
				<div class="hd-row5">
					<div class="hd-row5-inner"></div>
				</div>
			</div>
		</header>
		<!-- ! HEADER SECTION ENDS -->

<div id="sb-wrap">

<div id="headerlogo2">
	<a href="<?php echo esc_url( home_url() ); ?>">
	<?php
	$dw_micronix_custom_logo_id = get_theme_mod( 'custom_logo' );
	$dw_micronix_logo           = wp_get_attachment_image_src( $dw_micronix_custom_logo_id, 'full' );
					
	if ( has_custom_logo() ) {
		echo '<img src="' . esc_url( $dw_micronix_logo[0] ) . '" alt="' . esc_html( get_bloginfo( 'name' ) ) . '">';
	} else {
		echo '<div id="blog-name">' . esc_html( get_bloginfo( 'name' ) ) . '</div>';
		echo '<div id="blog-tagline">' . esc_html( get_bloginfo( 'description' ) ) . '</div>';
	}
	?>
	</a>
</div> <!-- /header -->

<div class="hmenu">

<nav id="site-navigation" class="main-navigation" role="navigation">
	<button class="menu-toggle"><?php esc_html_e( 'Menu', 'dw-micronix' ); ?></button>
		<?php
			wp_nav_menu(
				array(
					'theme_location'       => 'top_header_menu',
					'menu_class'           => 'nav-menu',
					'container_aria_label' => _x( 'Header Menu', 'ARIA label', 'dw-micronix' ),
				)
			);
			?>
</nav><!-- #site-navigation -->

</div>

<!-- ? MAIN STARTS -->
<main id="main-container" class="main-container">

<?php
if ( is_active_sidebar( 'left-sidebar' ) ) : 

	?>

<div id="widget-left" class="widget-column">

<!-- ? LEFT WIDGET AREA STARTS -->

	<?php if ( is_active_sidebar( 'left-sidebar' ) ) : ?>	
		<!-- SB 1 -->		
		<div class="widget-container">
			<div class="blk-body">
				<div class="blk-row1">
					<div class="blk-row1-inner"></div>
				</div>
				<div class="blk-content">
					<div class="blk-content-inner">
						<aside role="complementary" id="left" class="sidebar" aria-label="<?php echo is_active_sidebar( 'right-sidebar' ) ? esc_attr_x( 'Left Sidebar 1', 'ARIA label', 'dw-micronix' ) : esc_attr_x( 'Sidebar', 'ARIA label', 'dw-micronix' ); ?>">
							<ul>
							<?php dynamic_sidebar( 'left-sidebar' ); ?>
							</ul>
						</aside>
					</div>
				</div>
				<div class="blk-row3">
					<div class="blk-row3-inner"></div>
				</div>
			</div>
		</div>
		<!-- END SB 1 -->
	<?php endif; ?>

	</div> <!--- END WIDGET COLUMN --->

<?php endif; ?>


<div id="content">
