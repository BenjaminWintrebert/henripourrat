<?php
/*
Template Name: Accueil
*/
?><?php

get_header(); ?>
<section id="accueil_actu" class="wrapper clearfix">
    <h1>Actualités</h1>
    <?php query_posts('showposts=3'); if (have_posts()) : while (have_posts()) : the_post(); ?>
        <a href="<?php the_permalink(); ?>">
        <div class="article_container">
            <div class="article_container_hover card_hover">
            <div class="left thumb_article" style="background-image: url('<?php the_thumb_url() ?>')">

            </div>
            <div class="left">
                <div class="triangle_left card_fleche"></div>
                <div class="text">
                    <div class="article_container_date"><span class="the_date"><?php the_date(); ?></span></div>
                    <div class="article_container_title"><span class="the_title"><?php the_title(); ?></span></div>
                </div>
            </div>
            </div>
        </div>
        </a>
    <?php endwhile;?>
     <?php endif; wp_reset_query(); ?>
</section>
<?php
get_footer();
