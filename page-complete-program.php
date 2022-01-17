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
                    <h1>Complete Improv Program</h1>
                </header><!-- .page-header -->
                <div class="container complete-program">
                    <div class="col next-class">
                        <h3 class="center"><?php echo get_field('next_class_message'); ?> <?php echo get_field('next_class_date'); ?></h3>
                        <h4 class="center"><?php echo get_field('next_class_note'); ?></h4>
                        <a href="<?php echo site_url('/sign-up') ?>"><button type="button" class="btn btn-lg btn-primary btn-center">Sign Up For Classes</button></a>
                    </div>
                    <div class="col col-lg-8">
                        <?php echo get_the_content(); ?>
                    </div>
                    <div class="col col-lg-8">
                        <?php
                            $levels = new WP_Query(array(
                                'posts_per-page' => -1,
                                'post_type' => 'level',
                                'orderby' => 'title',
                                'order' => 'ASC'
                            ));
                        
                            while($levels->have_posts()) {
                                $levels->the_post(); 
                                ?>
                                <div class="row">
                                    <div class="col">
                                        <h2><?php echo get_the_title(); ?></h2>
                                        <h3><?php echo get_field('level_subtitle'); ?></h3>
                                        <p><?php echo get_the_content(); ?></p>
                                    </div>
                                </div>
                            <?php
                            }  wp_reset_postdata();
                        ?>

                        <a href="<?php echo site_url('/sign-up') ?>"><button type="button" class="btn btn-lg btn-primary btn-center">Sign Up For Classes</button></a>
                    </div>
                    <?php
                        $class_policies = get_page_by_path('/class-policies');
                        $class_policies_content = apply_filters('the_content', $class_policies->post_content);
                    ?>
                    <div class="col col-lg-8">
                        <h2>Class Policies</h2>
                        <?php echo $class_policies_content; ?>
                    </div>
                </div><!-- .container -->
			</main><!-- #main -->

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php
get_footer();
