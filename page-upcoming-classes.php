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
                    <h1>Upcoming Classes</h1>
			    </header><!-- .page-header -->

                <div class="container upcoming-classes">
                        <?php
                        // Start the loop.
                        $today = date('Ymd');
                        $upcomingClasses = new WP_Query(array(
                            'paged' => get_query_var('paged', 1),
                            'post_type' => 'class',
                            'meta_key' => 'start_date',
                            'orderby' => 'meta_value_num',
                            'order' => 'ASC',
                            'meta_query' => array(
                                array(
                                    'key' => 'start_date',
                                    'compare' => '>=',
                                    'value' => $today,
                                    'type' => 'numeric'
                                )
                            )
                        ));
                        if ($upcomingClasses->have_posts() ) {
                            while ( $upcomingClasses->have_posts() ) {
                                $upcomingClasses->the_post();
                                $classDate = new DateTime(get_field('start_date'));
                            ?>
                                <div class="col-lg-8">
                                    <div class="event-img col-lg-8">
                                        <?php the_post_thumbnail(); ?>
                                    </div>
                                    <div class="event">
                                        <div class="date">
                                            <span class="date-month"><?php echo $classDate->format('M'); ?></span>
                                            <span class="date-day"><?php echo $classDate->format('d'); ?></span>
                                        </div>
                                        <div>
                                            <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                            <h5>Location: <?php echo get_field('location'); ?></h5>
                                            <p><?php echo get_the_content(); ?></p>
                                            <a href="<?php echo site_url('/sign-up') ?>"><button type="button" class="btn btn-primary btn-sm">Sign Up</button></a>
                                        </div>
                                    </div>
                                </div><!-- .col-lg-8 -->
                            <?php
                            } wp_reset_postdata();
                        } else { ?>
                        <p class="center">No Classes Currently Scheduled.  Please Check Back Later.</p>
                        <?php } ?>
                    </div><!-- .full-page-events -->
			</main><!-- #main -->

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php
get_footer();
