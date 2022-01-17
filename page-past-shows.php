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

<div class="wrapper" id="page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<main class="site-main" id="main">
				
					<header class="page-header">
						<h1>Past Shows</h1>
					</header><!-- .page-header -->

					<div class="container past-shows">
					<?php
						// Start the loop.
                    	$today = date('Ymd');
                    	$pastShows = new WP_Query(array(
                    	    'paged' => get_query_var('paged', 1),
                    	    'post_type' => 'show',
                    	    'meta_key' => 'show_date',
                    	    'orderby' => 'meta_value_num',
                    	    'order' => 'ASC',
                    	    'meta_query' => array(
                    	        array(
                    	            'key' => 'show_date',
                    	            'compare' => '<',
                    	            'value' => $today,
                    	            'type' => 'numeric'
                    	        )
                    	    )
                    	));

						while ( $pastShows->have_posts() ) {
							$pastShows->the_post();
							$showDate = new DateTime(get_field('show_date'));
							$showTime = new DateTime(get_field('show_time'));
					?>
							<div class="col-lg-8">
								<div class="event">
									<div class="date">
										<span class="date-month"><?php echo $showDate->format('M'); ?></span>
										<span class="date-day"><?php echo $showDate->format('d'); ?></span>
									</div>
									<h4><a href="<?php the_permalink(); ?>"><span><?php echo $showTime->format('g:i A') ?></span>: <?php the_title(); ?></a></h4>
									<h5><?php echo $showDate->format('M'); ?> <?php echo $showDate->format('d'); ?>, <?php echo $showDate->format('Y'); ?></h5>
									<p><?php echo wp_trim_words(get_the_content(), 18); ?> <a href="<?php the_permalink(); ?>">Read more</a></p>
								</div>
							</div><!-- .col-lg-8 -->
							<?php
								} wp_reset_postdata();
							?>
								<div class="col-lg-8">
									<a href="<?php echo site_url('/upcoming-shows') ?>"><button type="button" class="btn btn-primary btn-center">View Upcoming Shows</button></a>
								</div><!-- .col-lg-8 -->
				</div><!-- .past-shows -->
			</main><!-- #main -->

			<?php
			// Display the pagination component.
			understrap_pagination(array(
                'total' => $pastShows->max_num_pages
            ));
			?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #archive-wrapper -->

<?php
get_footer();
