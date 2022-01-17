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
                    <h1>Instructors</h1>
                </header><!-- .page-header -->
            
                <div class="container">
                    <?php
                    $instructors = new WP_Query(array(
                        'posts_per-page' => -1,
                        'post_type' => 'instructor',
                        'orderby' => 'title',
                        'order' => 'ASC'
                    ));

                    while($instructors->have_posts()) {
                        $instructors->the_post(); 
                        ?>
                        <div class="instructor row">
                            <div class="col-lg-4 name">
                                <?php the_post_thumbnail(); ?>
                                <h2 class="instructor-name center"><?php echo get_the_title(); ?></h2>
                            </div>
                            <div class="col-lg-8">
                                <p class="instructor-bio"><?php echo get_the_content(); ?></p>
                            </div>
                        </div>
                </div><!-- .container -->
                <?php
                }  wp_reset_postdata();
                ?>
			</main><!-- #main -->

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php
get_footer();
