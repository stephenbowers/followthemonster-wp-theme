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
                    <h1>Workshops</h1>
                </header><!-- .page-header -->

                <div class="container workshops">
                <?php
                    $workshops = new WP_Query(array(
                        'posts_per-page' => -1,
                        'post_type' => 'workshop',
                        'orderby' => 'date',
                        'order' => 'ASC'
                    ));
                    
                    if ($workshops->have_posts() ) {
                        while($workshops->have_posts()) {
                            $workshops->the_post(); 
                            ?>
                            <div class="row">
                                <h2 class="workshop-title"><?php echo get_the_title(); ?></h2>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="circle-img">
                                        <?php the_post_thumbnail(); ?>
                                    </div>
                                    <?php 
                                        if ( get_field('workshop_location') ) {
                                    ?>
                                    <h4>Location: <?php echo get_field('workshop_location'); ?></h4><!-- #TODO Add Conditional -->
                                    <?php
                                        }
                                    ?>
                                    <?php 
                                        if ( get_field('workshop_price') ) {
                                    ?>
                                    <h4>Price: $<?php echo get_field('workshop_price'); ?></h4><!-- #TODO Add Conditional -->
                                    <?php
                                        }
                                    ?>
                                    <?php 
                                        if ( get_field('workshop_date') ) {
                                    ?>
                                    <h3><?php echo get_field('workshop_date'); ?></h3>
                                        <?php 
                                            if ( get_field('workshop_price') ) {
                                        ?>
                                        <h3><?php echo get_field('workshop_start_time'); ?> - <?php echo get_field('workshop_end_time'); ?></h3>
                                        <?php
                                            }
                                        ?>
                                        <?php if ( get_field('registration_link') ) {?>
                                    <a href="<?php echo get_field('registration_link'); ?>" target="_blank"><button type="button" class="btn btn-primary btn-lg">Register For Workshop</button></a>
                                        <?php } 
                                        } ?>
                                </div>
                                <div class="col-lg-6">
                                    <p><?php echo get_the_content(); ?></p>
                                </div>
                            </div>
                        <?php
                        }  wp_reset_postdata();
                    } else { ?>
                        <p class="center">No Workshops Currently Scheduled.  Please Check Back Later.</p>
                    <?php } ?>
                </div><!-- .container -->
			</main><!-- #main -->

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php
get_footer();
