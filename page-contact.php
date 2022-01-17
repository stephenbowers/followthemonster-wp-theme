<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );

?>

<div class="wrapper" id="page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<main class="site-main" id="main">
				<header class="page-header">
					<h1>Contact</h1>
                </header><!-- .page-header -->
				<div class="container contact-info">
					<div class="col col-lg-8">
						<h3 class="center"><?php echo get_field('address'); ?></h3>
						<h3 class="center"><?php echo get_field('phone_number'); ?></h3>
					</div>
					<div class="col col-lg-8">
						<h4>Contact Follow the Monster Comedy through the form below.</h4>
						<h5>For tickets or other venue related questions, contact Mic Drop Comedy at <?php echo get_field('phone_number'); ?></h5>
						<?php
							echo do_shortcode('[contact-form-7 id="164" title="Contact form 1"]');
						?>
					</div>
				</div><!-- .container -->

			</main><!-- #main -->

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php
get_footer();
