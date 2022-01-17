<?php
/**
 * Single post partial template
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header post-header">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">

			<?php understrap_posted_on(); ?>

		</div><!-- .entry-meta -->

	</header><!-- .entry-header -->

	<div class="col-lg-8">
    	<div class="announcement-img-container">
		    <?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
    	</div>
	
		<div class="entry-content">
	
			<?php the_content(); ?>
	
			<?php
			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
					'after'  => '</div>',
				)
			);
			?>
	
		</div><!-- .entry-content -->
	</div><!-- .col-lg-8 -->
	<footer class="entry-footer">

		<?php understrap_entry_footer(); ?>

        <a href="<?php echo site_url('/announcements') ?>"><button type="button" class="btn btn-primary btn-center">View All Announcements</button></a>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
