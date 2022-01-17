<?php
/**
 * The template for displaying all single posts
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="single-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<main class="site-main" id="main">

				<?php
				while ( have_posts() ) {
					$today = date('Ymd');
					$showDate = new DateTime(get_field('show_date'));
					the_post();
				?>
					<header class="page-header">
                    	<h1><?php the_title(); ?></h1>
                	</header><!-- .page-header -->
					
					<div class="container single-show">
						<div class="event-img">
                            <?php the_post_thumbnail(); ?>
                        </div>
						<div class="col-lg-8 show-info">
							<h2><?php echo $showDate->format('F j, Y'); ?> at <?php echo get_field('show_time'); ?></h2>
                    		<p><?php echo get_the_content(); ?></p>
						<?php
							if ($today <= $showDate->format('Ymd') ) {
						?>
                    		<a href="<?php echo get_field('tickets_link'); ?>" target="_blank"><button type="button" class="btn btn-primary btn-sm">Buy Tickets</button></a>
						<?php
							}
						?>
						</div>

						<div class="col-lg-8 show-buttons">
							<a href="<?php echo site_url('/upcoming-shows') ?>"><button type="button" class="btn btn-primary">View Upcoming Shows</button></a>
							<a href="<?php echo site_url('/past-shows') ?>"><button type="button" class="btn btn-primary">View Past Shows</button></a>
						</div>
					</div><!-- .container -->
				<?php
				}
				?>

			</main><!-- #main -->

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #single-wrapper -->

<?php
get_footer();
