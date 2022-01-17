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
                    <h1><?php echo get_the_title(); ?></h1>
                </header><!-- .page-header -->
                <div class="container intro-workshop">
                <?php
                    while(have_posts()) {
                        the_post(); 
                        ?>
                        <div class="col next-workshop">
                            <h2 class="center"><?php echo get_field('next_workshop_message'); ?> <?php 
                            $nextWorkshopDate = get_post_meta( $post->ID, 'next_workshop_date', true); 
                            if($nextWorkshopDate){
                                echo get_field('next_workshop_date');
                            } else {
                                echo "TBD";
                            } ?>
                            </h2>
                            <?php 
                                $nextWorkshopLink = get_post_meta( $post->ID, 'free_registration_link', true); 
                                if($nextWorkshopLink){
                            ?>
                            <a href="<?php echo get_field('free_registration_link'); ?>"><button type="button" class="btn btn-lg btn-primary btn-center">Sign Up For Free Workshop</button></a>
                            <?php } ?>
                        </div>
                        <div class="col col-lg-8">
                            <p><?php echo get_the_content(); ?></p>
                        </div>
                        <div class="col col-lg-8">
                            <a href="<?php echo site_url('/complete-program') ?>"><button type="button" class="btn btn-primary btn-center">View Complete Improv Program</button></a>
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
