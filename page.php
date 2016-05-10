<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Henri_Pourrat
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while (have_posts()) : the_post();
				$couverture = get_field('couverture');
				?>

				<div class="post-cover" style="background-image:url(<?= $couverture['url']; ?>);">
					<div class="post-gradient"></div>
				</div>
				<div class="post-top wrapper">
					<div class="post-title">
						<h1><?php echo the_title(); ?></h1>
					</div>
					<?php
					if (function_exists('yoast_breadcrumb')) {
						yoast_breadcrumb('<div id="breadcrumbs">', '</div>');
					}
					?>
				</div>
				<div class="post-article wrapper clearfix">
					<?php the_content(); ?>
				</div>
				<?php

			endwhile; // End of the loop.
			?>
			<span class="triangle_bottom border-white"></span>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
