<?php
/*
Template Name: Accueil
*/
?><?php

get_header(); ?>
    <section id="accueil_actu" class="wrapper clearfix">
        <h1>Actualités</h1>
        <?php query_posts('showposts=3');
        if (have_posts()) : while (have_posts()) : the_post(); ?>
            <a href="<?php the_permalink(); ?>">
                <div class="article_container">
                    <div class="article_container_hover card_hover">
                        <div class="left thumb_article" style="background-image: url('<?php the_thumb_url() ?>')">

                        </div>
                        <div class="left">
                            <div class="triangle_left card_fleche"></div>
                            <div class="text">
                                <div class="article_container_date"><span class="the_date"><?php the_date(); ?></span>
                                </div>
                                <div class="article_container_title"><span
                                        class="the_title"><?php the_title(); ?></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        <?php endwhile; ?>
        <?php endif;
        wp_reset_query(); ?>
    </section>
    <section id="quote">
        <?php
        $henri_pourrat_options = get_option('henri_pourrat_option_name');
        $citations = $henri_pourrat_options['citations_1_par_lignes_0'];
        $citations = explode("\n", $citations);
        $week = date('W');
        $week = count($citations) + 1 >= $week ? $week : count($citations) - 1;
        $citations = explode('-', $citations[$week]);
        $citation = trim($citations[0]);
        $auteur = trim($citations[1]);
        ?>
        <p id="citation"><?php echo $citation; ?></p>
        <p id="auteur"><?php echo $auteur; ?></p>
        <span class="triangle_bottom"></span>
    </section>

    <script src="https://cdn.rawgit.com/coverflowjs/coverflow/master/dist/coverflow.min.js"></script>
    <section id="coverflow-section">
        <div id="coverflow-container">
            <div id="coverflow">
                <?php
                $args = array('post_type' => array('livre'));

                $query = new WP_Query($args);

                $middle = round($query->post_count/2)-1;
                while ($query->have_posts()) : $query->the_post();
                    $image = get_field('image');

                ?>
                    <a href='#' data-href='<?php the_field('page_link'); ?>'><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" /></a>

                <?php endwhile; ?>
            </div>
            <div id='coverflow-controls'>
                <i class="fa fa-chevron-left"></i>
                <i class="fa fa-chevron-right"></i>
            </div>
        </div>
    </section>


    <script type="text/javascript">
        var $ = jQuery.noConflict();
        $(function () {

            $('#coverflow').coverflow({
                active: <?php echo $middle; ?>,
                select: function (event, ui) {
                    console.log();
                }
            });

            $('.ui-state-active a').click(function (e) {
                window.location = $this.attr('data-href');
                e.stopPropagation();
            });

            $('#coverflow-background .fa-chevron-right').click(function () {
                $('#coverflow').coverflow('next');
            });

            $('#coverflow-background .fa-chevron-left').click(function () {
                $('#coverflow').coverflow('prev');
            });

            $("body").keydown(function (e) {
                // left arrow
                if ((e.keyCode || e.which) == 37) {
                    $('#coverflow').coverflow('prev');
                }
                // right arrow
                if ((e.keyCode || e.which) == 39) {
                    $('#coverflow').coverflow('next');
                }
            });

        });
    </script>
<?php
get_footer();
