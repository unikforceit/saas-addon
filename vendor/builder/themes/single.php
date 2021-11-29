	<?php get_header(); ?>
        <?php while ( have_posts() ) : the_post(); ?>
			<article itemtype="http://schema.org/CreativeWork" itemscope="itemscope" id="post-<?php the_ID(); ?>" class="<?php post_class('post-builder-template'); ?>">
				<?php do_action('saas_doctor_single_post');?>
				<?php do_action('saas_doctor_single_listing');?>
			</article>
        <?php endwhile; ?>
	<?php get_footer();?>