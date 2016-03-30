<?php
/*
Template Name: Accueil
*/
?><?php

get_header(); ?>
<section id="accueil_hp">
	<div id="img_parallax"></div>
	<div id="hp_container">
		<h1>Henri Pourrat</h1>
		<hr>
		<p>
			Lorem ipsum dolor sit amet, consectetur adipiscing elit. In a suscipit nibh. Sed vehicula enim eget maximus accumsan. In lobortis enim ut neque sollicitudin facilisis. Curabitur finibus ultrices nunc eu accumsan. Donec at nisl et sapien aliquet dignissim sed mattis est.
		</p>
		<div class='btn'>Biographie</div>
	</div>
</section>
<section id="accueil_actu">
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
