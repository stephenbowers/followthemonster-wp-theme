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
					<h1>Our Signature Shows</h1>
                </header><!-- .page-header -->
            <?php
                // Start the loop.
						$signatureShows = new WP_Query(array(
							'posts_per_page' => -1,
							'post_type' => 'signature_show',
							'orderby' => 'date',
							'order' => 'ASC'
						));
		
						while ( $signatureShows->have_posts() ) {
							$signatureShows->the_post();
							?>
							<div>
								<h3><?php the_title(); ?></h3>
								<?php the_post_thumbnail(); ?>
								<p><?php echo get_the_content(); ?></p>
							</div>
							<?php
						} wp_reset_postdata();
            ?>

			</main><!-- #main -->

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php
get_footer();
