<?php

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <div class="wrapper clearfix">
                <?php while (have_posts()) : the_post(); ?>
                    <div id="livre-min">
                        <?php $image = get_field('image');  ?>
                        <img src="<?= $image['url']; ?>">
                    </div>
                    <div id="infos">
                        <h3><?php the_title(); ?></h3>
                        <p><?php the_field('editeur'); ?></p>
                        <p><span><?php the_field('genre'); ?></span></p>
                        <p>Vous voulez votre exemplaire ?</p>
                        <?php the_marchand(get_field('site_marchand')); ?>
                    </div>
                    <div id="resume">
                        <h4> Resumé du livres </h4>
                        <?php the_content(); ?>
                    </div>
                <?php endwhile; // End of the loop.
                ?>
            </div>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
