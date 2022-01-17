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
					$startDate = new DateTime(get_field('start_date'));
					$endDate = new DateTime(get_field('end_date'));
					the_post();
				?>
					<header class="page-header">
                    	<h1><?php the_title(); ?></h1>
                	</header><!-- .page-header -->

					<div class="container single-class">
						<div class="event-img">
                            <?php the_post_thumbnail(); ?>
                        </div>
						<div class="col-lg-8">
							<h2>Starts: <?php echo $startDate->format('F j, Y'); ?></h2>
							<h2>Ends: <?php echo $endDate->format('F j, Y'); ?></h2>
							<h2>Time: <?php echo get_field('class_start_time'); ?> - <?php echo get_field('class_end_time'); ?></h2>
							<h3>Location: <?php echo get_field('location'); ?></h3>
							<h3>Price: $<?php echo get_field('class_price'); ?></h3>
                    		<p><?php echo get_the_content(); ?></p>
						<?php
							if ($today <= $startDate->format('Ymd')  ) {
						?>
							<a href="<?php echo site_url('/sign-up'); ?>"><button type="button" class="btn btn-primary btn-lg">Sign Up</button></a>
						<?php
							}
						?>
						</div>
						
						<div class="col-lg-8 upcoming">
							<a href="<?php echo site_url('/upcoming-classes'); ?>"><button type="button" class="btn btn-primary btn-center">View Upcoming Classes</button></a>
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
