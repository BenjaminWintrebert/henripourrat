<?php
/*
Template Name: Accueil
*/
?><?php

get_header(); ?>
<section id="accueil_actu" class="clearfix">
    <h1>Actualités</h1>
    <?php query_posts('showposts=3'); if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="article_container">
            <?php the_thumb_url() ?>
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            <?php the_date(); ?>
            <?php the_content(); ?>
        </div>
    <?php endwhile;?>
     <?php endif; wp_reset_query(); ?>
</section>
<?php
get_footer();
