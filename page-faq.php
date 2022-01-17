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
                    <h1>Frequently Asked Questions</h1>
                    <h3>Use our contact form for any other questions and/or concerns</h3>
                </header><!-- .page-header -->
            
                <div class="container faqs">
                <?php
                    $faqs = new WP_Query(array(
                        'posts_per-page' => -1,
                        'post_type' => 'faq',
                        'orderby' => 'order_number',
                        'order' => 'ASC'
                    ));

                    while($faqs->have_posts()) {
                        $faqs->the_post(); 
                        ?>
                        <div class="row">
                            <div class="col col-lg-8">
                                <h2><?php echo get_the_title(); ?></h2>
                                <p><?php echo get_the_content(); ?></p>
                            </div>
                        </div>
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
