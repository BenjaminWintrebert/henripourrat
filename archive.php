<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Henri_Pourrat
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="clearfix wrapper">

			<h1>Événements</h1>
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) : the_post(); ?>
				<div class="card_hover">
					<div class="archive_thumb" style="background-image: url('<?php the_thumb_url() ?>')"></div>
					<div class="title"><?php echo the_title(); ?></div>
				</div>
			<?php endwhile;

			the_posts_navigation();

		else :

		endif; ?>

			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php

get_footer();
