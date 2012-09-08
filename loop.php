<?php if ( ! have_posts() ) : ?>
<div id="post-0" class="post error404 not-found">
	<h1 class="entry-title"><?php _e( 'Not Found' ); ?></h1>
	<div class="entry-content">
		<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.' ); ?></p>
		<?php get_search_form(); ?>
	</div><!-- .entry-content -->
</div><!-- #post-0 -->
<?php endif; ?>


<?php while ( have_posts() ) : the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php echo print_post_title() ?>

	<time class="entry-meta">
		<i class="ball"></i>
		<?php echo get_the_date('M dS \'y') ?>
	</time><!-- .entry-meta -->

	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>') ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:'), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->

<?php if (!is_page()): ?>
	<?php comments_template( '', true ); ?>
<?php endif ?>


<?php endwhile; // End the loop. Whew. ?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
<nav id="nav-below" class="pagination">
	<?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts' ) ); ?>
	<?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>' ) ); ?>
</nav><!-- #nav-below -->
<?php endif; ?>

<?php if (is_single()): ?>
<nav id="nav-below" class="pagination">
	<div class="nav-previous"><a href="<?php echo esc_url( home_url( ) ); ?>">&larr; Back to blog</a></div>
</nav><!-- #nav-below -->
<?php endif ?>