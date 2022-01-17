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
                    <h1>Testimonials</h1>
                </header><!-- .page-header -->

                <div class="container endorsements">
                    <h1 class="center">Endorsements</h1>
                <?php
                    $endorsements = new WP_Query(array(
                        'posts_per-page' => -1,
                        'post_type' => 'endorsement',
                        'orderby' => 'endorsement_order_number',
                        'order' => 'ASC'
                    ));

                    while($endorsements->have_posts()) {
                        $endorsements->the_post(); 
                        ?>
                        <div class="row">
                            <div class="col col-lg-8">
                                <p class="testimonial-text">
                                    <i class="fa fa-quote-left"></i>
                                    <?php echo wp_strip_all_tags(get_the_content()); ?>
                                    <i class="fa fa-quote-right"></i>
                                </p>
                                <div class="container">
                                    <h4 class="center testimonial-name">&mdash;<?php echo wp_strip_all_tags(get_the_title()); ?></h4>
                                    <p class="center testimonal-credits"><?php echo wp_strip_all_tags(get_field("endorsement_credits")); ?></p>
                                </div>
                            </div><!-- .col -->
                        </div><!-- .row -->
                    <?php
                    }  wp_reset_postdata();
                ?>
                <div class="container testimonials">
                    <h1 class="center">What Students Are Saying</h1>
                <?php
                    $testimonials = new WP_Query(array(
                        'posts_per-page' => -1,
                        'post_type' => 'testimonial',
                        'orderby' => 'endorsement_order_number',
                        'order' => 'ASC'
                    ));

                    while($testimonials->have_posts()) {
                        $testimonials->the_post(); 
                        ?>
                        <div class="row">
                            <div class="col col-lg-8">
                                <p class="testimonial-text">
                                    <i class="fa fa-quote-left"></i>
                                    <?php echo wp_strip_all_tags(get_the_content()); ?>
                                    <i class="fa fa-quote-right"></i>
                                </p>
                                <div class="container">
                                    <h4 class="center testimonial-name">&mdash;<?php echo wp_strip_all_tags(get_the_title()); ?></h4>
                                    <p class="center testimonal-credits"><?php echo wp_strip_all_tags(get_field("endorsement_credits")); ?></p>
                                </div>
                            </div><!-- .col -->
                        </div><!-- .row -->
                    <?php
                    }  wp_reset_postdata();
                ?>
                </div><!-- .container -->
			</main><!-- #main -->

        </div><!-- .row -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php
get_footer();
