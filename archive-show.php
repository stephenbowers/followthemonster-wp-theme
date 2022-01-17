<?php
/**
 * The template for displaying archive pages
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="archive-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<main class="site-main" id="main">
				
				<?php
				if ( have_posts() ) {
					?>
					<header class="page-header">
						<h1>Shows</h1>
					</header><!-- .page-header -->
					<h2>Our Signature Shows</h2>
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
					
					// Start the loop.
					while ( have_posts() ) {
						the_post();

					}
				} else {
					
				}
				?>
				<a href="<?php echo site_url('/upcoming-shows') ?>"><button type="button" class="btn btn-primary">View Upcoming Shows</button></a>
				<a href="<?php echo site_url('/past-shows') ?>"><button type="button" class="btn btn-primary">View Past Shows</button></a>

			</main><!-- #main -->

			<?php
			// Display the pagination component.
			understrap_pagination();
			?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #archive-wrapper -->

<?php
get_footer();
