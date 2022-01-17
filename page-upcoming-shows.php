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
                    <h1>Upcoming Shows</h1>
			    </header><!-- .page-header -->

                <div class="container upcoming-shows">
                <?php
                    // Start the loop.
                    $today = date('Ymd');
                    $upcomingShows = new WP_Query(array(
                        'paged' => get_query_var('paged', 1),
                        'post_type' => 'show',
                        'meta_key' => 'show_date',
                        'orderby' => 'meta_value_num',
                        'order' => 'ASC',
                        'meta_query' => array(
                            array(
                                'key' => 'show_date',
                                'compare' => '>=',
                                'value' => $today,
                                'type' => 'numeric'
                            )
                        )
                    ));
                    if ($upcomingShows->have_posts() ) {
                        while ( $upcomingShows->have_posts() ) {
                            $upcomingShows->the_post();
                            $showDate = new DateTime(get_field('show_date'));
                            $showTime = new DateTime(get_field('show_time'));
                        ?>
                            <div class="col-lg-8">
                                <div class="event-img">
                                    <?php the_post_thumbnail(); ?>
                                </div>
                                <div class="event">
                                    <div class="date">
                                        <span class="date-month"><?php echo $showDate->format('M'); ?></span>
                                        <span class="date-day"><?php echo $showDate->format('d'); ?></span>
                                    </div>
                                    <div>
                                        <h4><a href="<?php the_permalink(); ?>"><span><?php echo $showTime->format('g:i A') ?></span>: <?php the_title(); ?></a></h4>
                                        <p><?php echo wp_trim_words(get_the_content(), 18); ?> <a href="<?php the_permalink(); ?>">Read more</a></p>
                                        <a href="<?php echo get_field('tickets_link'); ?>" target="_blank"><button type="button" class="btn btn-primary btn-sm">Buy Tickets</button></a>
                                    </div>
                                </div>
                            </div><!-- .col-lg-8 -->
                            <?php
                            } wp_reset_postdata();
                    } else { ?>
                        <p class="center">No Shows Currently Scheduled.  Please Check Back Later.</p>
                        <?php } ?>
                        <div class="col-lg-8 past-btn">
                            <a href="<?php echo site_url('/past-shows') ?>"><button type="button" class="btn btn-primary btn-center">View Past Shows</button></a>
                        </div><!-- .col-lg-8 -->
                </div><!-- .upcoming-shows -->
			</main><!-- #main -->

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php
get_footer();
