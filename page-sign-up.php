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
                    <?php the_title( '<h1 class="center entry-title">', '</h1>' ); ?>
                </header><!-- .page-header -->
                <div class="container registration">
                    <div class="col-lg-8">
                        <?php the_content(); ?>
                    </div>
                    <div class="col-lg-8">
                        <h1 class="center">Classes</h1>
                        <?php
                            // Start the loop.
                            $paypal = get_field('paypal_email');
                            $venmo = get_field('venmo_username');
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
                                    $purchaseClass = "Registration for " . get_the_title();
                                    $classPrice = get_field('class_price');
                                    ?>
                                    <div class="event-img">
                                        <?php the_post_thumbnail(); ?>
                                    </div>
                                    <div class="event">
                                        <div class="date">
                                            <span class="date-month"><?php echo $classDate->format('M'); ?></span>
                                            <span class="date-day"><?php echo $classDate->format('d'); ?></span>
                                        </div>
                                        <div>
                                            <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                            <h5>Location: <?php 
                                                $classLocation = get_post_meta( $post->ID, 'location', true);
                                                if($classLocation) {
                                                    echo get_field('location');
                                                } else {
                                                    echo "TDB";
                                                }
                                            ?></h5>
                                            <h5>Price: <?php
                                                $classPrice = get_post_meta( $post->ID, 'class_price', true);
                                                if($classPrice) {
                                                    echo "$" . get_field('class_price');
                                                } else {
                                                    echo "TDB";
                                                }
                                            ?></h5>
                                            <p><?php echo get_the_content(); ?></p>
                                            <?php 
                                                $classRegistration = get_post_meta( $post->ID, 'class_registration', true);
                                                if($classRegistration) {
                                            ?>
                                                <a href="<?php echo get_field('class_registration'); ?>" target="_blank"><button type="button" class="btn btn-primary btn-sm">Register</button></a>
                                            <?php
                                                } else {
                                            ?>
                                                <p>
                                                    <strong>Pay via PayPal (<?php echo $paypal; ?>).</strong>
                                                    <br>
                                                    <strong>Pay via Venmo (@<?php echo $venmo; ?>).</strong>
                                                </p>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <?php
                                } wp_reset_postdata();
                            } else { ?>
                                <p class="center">No Classes Currently Open For Registration.  Please Check Back Later.</p>
                                <?php } ?>
                    </div>
                    <div class="col-lg-8">
                        <h1 class="center">Workshops</h1>
                        <?php
                            // Start the loop.
                            $today = date('Ymd');
                            $upcomingWorkshops = new WP_Query(array(
                                'paged' => get_query_var('paged', 1),
                                'post_type' => 'workshop',
                                'meta_key' => 'workshop_date',
                                'orderby' => 'meta_value_num',
                                'order' => 'ASC',
                                'meta_query' => array(
                                    array(
                                        'key' => 'workshop_date',
                                        'compare' => '>=',
                                        'value' => $today,
                                        'type' => 'numeric'
                                    )
                                )
                            ));
                            if ($upcomingWorkshops->have_posts() ) {
                                while ( $upcomingWorkshops->have_posts() ) {
                                    $upcomingWorkshops->the_post();
                                    $workshopDate = new DateTime(get_field('workshop_date'));
                                    $purchaseWorkshop = "Registration for " . get_the_title();
                                    $workshopPrice = get_field('workshop_price');
                                    ?>
                                    <div class="circle-img">
                                        <?php the_post_thumbnail(); ?>
                                    </div>
                                    <div class="event">
                                        <div class="date">
                                            <span class="date-month"><?php echo $workshopDate->format('M'); ?></span>
                                            <span class="date-day"><?php echo $workshopDate->format('d'); ?></span>
                                        </div>
                                        <div>
                                            <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                            <h5>Time: <?php 
                                                $workshopStart = get_post_meta( $post->ID, 'workshop_start_time', true);
                                                $workshopEnd = get_post_meta( $post->ID, 'workshop_end_time', true);
                                                if($workshopStart && $workshopEnd) {
                                                    echo get_field('workshop_start_time') . ' - ' . get_field('workshop_end_time');
                                                } else {
                                                    echo "TDB";
                                                }
                                            ?></h5>
                                            <h5>Location: <?php 
                                                $workshopLocation = get_post_meta( $post->ID, 'workshop_location', true);
                                                if($workshopLocation) {
                                                    echo get_field('workshop_location');
                                                } else {
                                                    echo "TDB";
                                                }
                                            ?></h5>
                                            <h5>Price: <?php
                                                $workshopPrice = get_post_meta( $post->ID, 'workshop_price', true);
                                                if($workshopPrice) {
                                                    echo "$" . get_field('workshop_price');
                                                } else {
                                                    echo "TDB";
                                                }
                                            ?></h5>
                                            <p><?php echo get_the_content(); ?></p>
                                            <?php 
                                                $workshopRegistration = get_post_meta( $post->ID, 'registration_link', true);
                                                if($workshopRegistration) {
                                            ?>
                                                <a href="<?php echo get_field('registration_link') ?>" target="_blank"><button type="button" class="btn btn-primary btn-sm">Register</button></a>
                                            <?php
                                                } else {
                                            ?>
                                                <p>
                                                    <strong>Pay via PayPal (<?php echo $paypal; ?>).</strong>
                                                    <br>
                                                    <strong>Pay via Venmo (@<?php echo $venmo; ?>).</strong>
                                                </p>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <?php
                                } wp_reset_postdata();
                            } else { ?>
                                <p class="center">No Workshops Currently Open For Registration.  Please Check Back Later.</p>
                                <?php } ?>
                    </div>
                </div><!-- .container -->
			</main><!-- #main -->

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php
get_footer();
