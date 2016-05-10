<?php
/*
Template Name: Articles
*/
?><?php


get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <div class="clearfix wrapper">

                <h1>Actualités</h1>
                <?php
                //The Query
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $new_query = new WP_Query();
                $new_query->query('post_type=post&paged=' . $paged);

                //The Loop
                while ($new_query->have_posts()) : $new_query->the_post();
                    ?>
                    <div class="archive-article-container">
                        <a href="<?= get_permalink(); ?>">
                            <div class="card card_hover">
                                <div class="archive-thumb"
                                     style="background-image: url('<?php the_thumb_url() ?>')"></div>
                                <div class="archive-content">
                                    <div class="archive-title"><?= the_title(); ?></div>

                                    <div class="archive-text">
                                        <?= wp_strip_all_tags(get_the_content()); ?>
                                        <div class="card-gradient"></div>
                                    </div>
                                    <div class="archive-more"><a href="<?= get_permalink(); ?>">lire la suite</a></div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php
                endwhile;
                ?>
            </div>
            <?php
            if ($new_query->max_num_pages > 1) { ?>
                <p class="pager">
                    <?php
                    if ($paged != 1) {
                        ?>
                        <a href="<?php echo site_url() . '/actualites/page/' . ($paged - 1); ?>">Précédent</a>
                    <?php }
                    for ($i = 1; $i <= $new_query->max_num_pages; $i++) {
                        ?>
                        <a href="<?php echo site_url() . '/actualites/page/' . $i; ?>" <?php echo ($paged == $i) ? 'class="active"' : ''; ?>><?php echo $i; ?></a>
                        <?php
                    }
                    if ($paged != $new_query->max_num_pages) {
                        ?>
                        <a href="<?php echo site_url() . '/actualites/page/' . ++$paged; ?>">Suivant</a>
                    <?php } ?>
                </p>
            <?php } ?>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php

get_footer();
