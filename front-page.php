<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="index-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<main class="site-main front-page" id="main">
                <div class="hero">
                    <img src="<?php echo get_theme_file_uri('/img/Parallax-Moon2.png'); ?>" id="parallax-moon">
                    <img src="<?php echo get_theme_file_uri('/img/Parallax-Monster2.png'); ?>" id="parallax-monster">
                    <img src="<?php echo get_theme_file_uri('/img/Parallax-Trees-Large.png'); ?>" id="parallax-trees-lg">
                    <img src="<?php echo get_theme_file_uri('/img/Parallax-Trees-Medium.png'); ?>" id="parallax-trees-md">
                    <img src="<?php echo get_theme_file_uri('/img/Parallax-Trees-Small.png'); ?>" id="parallax-trees-sm">
                    <h1 class="center" id="parallax-title">Follow the Monster Comedy</h1>
                </div><!-- .hero -->
                <div class="tagline">
                    <h2 class="center"><?php echo get_field('tagline'); ?></h2>
                </div>
                <div class="front-page-content">
                    <div class="row cta">
                        <div class="col center">
                            <?php if ( get_field('next_class') ) { ?>
                                <h3><?php echo get_field('next_class'); ?></h3>
                            <?php } ?>
                            <a href="<?php echo site_url('/sign-up') ?>"><button type="button" class="btn btn-lg btn-primary">Sign Up For Classes</button></a>
                        </div>
                    </div>
                    <div class="row events">
                        <div class="col-lg">
                            <h3 class="center">Announcements</h3>
                            <?php
                                $homepageAnnouncements = new WP_Query(array(
                                    'posts_per_page' => 3
                                ));
                                if ($homepageAnnouncements->have_posts()) {
                                    while($homepageAnnouncements->have_posts()) {
                                        $homepageAnnouncements->the_post(); ?>
                                        <div class="event">
                                            <div class="date">
                                                <span class="date-month"><?php the_time('M'); ?></span>
                                                <span class="date-day"><?php the_time('d'); ?></span>
                                            </div>
                                            <h4><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></a></h4>
                                            <?php if(has_excerpt()){ ?>
                                            <p><?php echo get_the_excerpt(); ?></p>
                                            <?php } else { ?>
                                            <p><?php echo wp_trim_words(get_the_content(), 18); ?>...</p>
                                            <a href="<?php the_permalink(); ?>"><button type="button" class="btn btn-primary btn-sm">Read More</button></a>
                                            <?php } ?>
                                        </div>
                                    <?php } wp_reset_postdata(); ?>
                                    <a href="<?php echo site_url('/announcements') ?>"><button type="button" class="btn btn-primary btn-center">View All Announcements</button></a>
                                    <?php 
                                } else { ?>
                                <p class="center">No Announcements Available</p>
                                <?php } ?>
                        </div>
                        <div class="col-lg">
                            <h3 class="center">Upcoming Shows</h3>

                            <?php
                                $today = date('Ymd');
                                $homepageShows = new WP_Query(array(
                                    'posts_per_page' => 3,
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
                                if ($homepageShows->have_posts()) {
                                    while($homepageShows->have_posts()) {
                                        $homepageShows->the_post(); 
                                        $showDate = new DateTime(get_field('show_date'));
                                        $showTime = new DateTime(get_field('show_time'));
                                        ?>
                                        <div class="event">
                                            <div class="date">
                                                <span class="date-month"><?php echo $showDate->format('M'); ?></span>
                                                <span class="date-day"><?php echo $showDate->format('d'); ?></span>
                                            </div>
                                            <div>
                                                <h4><a href="<?php the_permalink(); ?>"><span><?php echo $showTime->format('g:i A') ?></span>: <?php the_title(); ?></a></h4>
                                                <?php if(has_excerpt()){ ?>
                                                <p><?php echo get_the_excerpt(); ?></p>
                                                <?php } else { ?>
                                                <p><?php echo wp_trim_words(get_the_content(), 18); ?>...</p>
                                                <?php } ?>
                                                <a href="<?php echo get_field('tickets_link'); ?>" target="_blank"><button type="button" class="btn btn-primary btn-sm">Buy Tickets</button></a>
                                            </div>
                                        </div>
                                    <?php
                                    }  wp_reset_postdata(); ?>
                                    <a href="<?php echo site_url('/upcoming-shows') ?>"><button type="button" class="btn btn-primary btn-center">View All Upcoming Shows</button></a>
                                    <?php 
                                } else { ?>
                                <p class="center">No Upcoming Shows Announced</p>
                                <?php } ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col center">
                            <h3>Follow The Monster On Social Media!</h3>
                            <div class="socials center">
                            <?php if ( get_field('facebook_url') ) {?>
                                <a href="<?php echo get_field('facebook_url'); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
                            <?php } ?>
                            <?php if ( get_field('instagram_url') ) {?>
                                <a href="<?php echo get_field('instagram_url'); ?>" target="_blank"><i class="fa fa-instagram"></i></a>
                            <?php } ?>
                            <?php if ( get_field('yelp_url') ) {?>
                                <a href="<?php echo get_field('yelp_url'); ?>" target="_blank"><i class="fa fa-yelp"></i></a>
                            <?php } ?>
                            </div>
                        </div>
                    </div>
                </div><!-- .front-page-content -->
			</main><!-- #main -->

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #index-wrapper -->

<?php
get_footer();
