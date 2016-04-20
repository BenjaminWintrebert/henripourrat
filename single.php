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
                        <h2><?php echo the_title(); ?></h2>
                    </div>
                        <?php
                        if (function_exists('yoast_breadcrumb')) {
                            yoast_breadcrumb('<div id="breadcrumbs">', '</div>');
                        }
                        ?>
                </div>
                <div class="post-article wrapper">
                    <?php the_content(); ?>
                </div>

                <?php wp_related_posts()?>

                <?php


                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;

            endwhile; // End of the loop.
            ?>

            <span class="triangle_bottom border-white"></span>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
