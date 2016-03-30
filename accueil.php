<?php
/*
Template Name: Accueil
*/
?><?php

get_header(); ?>
<section id="accueil_actu" class="wrapper clearfix">
    <h1>Actualités</h1>
    <?php query_posts('showposts=3'); if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="article_container">
            <div class="left thumb_article" style="background-image: url('<?php the_thumb_url() ?>')">

            </div>
            <div class="left">
                <div class="text">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    <?php the_date(); ?>
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    <?php endwhile;?>
     <?php endif; wp_reset_query(); ?>
</section>
<?php
get_footer();
