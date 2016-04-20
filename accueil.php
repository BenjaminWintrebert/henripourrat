<?php
/*
Template Name: Accueil
*/
?><?php

get_header(); ?>
    <section id="accueil_actu" class="bg-white clearfix pb70">
        <div class="wrapper">
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
                                    <div class="article_container_date"><span
                                            class="the_date"><?php the_date(); ?></span>
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
        </div>
    </section>
    <section id="quote">
        <div class="wrapper">
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
            <p id="citation" class="italic"><?php echo $citation; ?></p>
            <p id="auteur">Henri Pourrat, <span class="italic"><?php echo $auteur; ?></span></p>
            <span class="triangle_bottom"></span>
        </div>
    </section>

    <script src="https://cdn.rawgit.com/coverflowjs/coverflow/master/dist/coverflow.min.js"></script>
    <section id="coverflow-section">
        <div id="coverflow-container">
            <div id="coverflow">
                <?php
                $args = array('post_type' => array('livre'));

                $query = new WP_Query($args);

                $middle = round($query->post_count / 2) - 1;
                while ($query->have_posts()) : $query->the_post();
                    $image = get_field('image');

                    ?>
                    <a data-href='<?php the_field('page_link'); ?>'><img src="<?php echo $image['url']; ?>"
                                                                         alt="<?php echo $image['alt']; ?>"/></a>

                <?php endwhile; ?>
            </div>
            <div id='coverflow-controls'>
                <i class="fa fa-chevron-left"></i>
                <i class="fa fa-chevron-right"></i>
            </div>
        </div>
    </section>
    <section id="event" class="bg-white clearfix pb70">
        <div class="wrapper">
            <span class="triangle_bottom border-white"></span>
            <h1>Événements</h1>
            <?php $args = array('post_type' => array('event'), 'posts_per_page' => 3);

            $query = new WP_Query($args);
            if ($query->have_posts()) {
                while ($query->have_posts()) : $query->the_post();
                    $couverture = get_field('couverture_de_levenement');
                    $date = get_field('date');
                    date('Y-m-d', strtotime($date)) > date('Y-m-d') ? $past = '' : $past = 'past';
                    ?>

                    <a href="<?php the_permalink(); ?>">
                        <div class="article_container">
                            <div class="article_container_hover card_hover <?php echo $past; ?>">
                                <div class="left thumb_article"
                                     style="background-image: url('<?php echo $couverture['sizes']['thumbnail']; ?>')">

                                </div>
                                <div class="left">
                                    <div class="triangle_left card_fleche"></div>
                                    <div class="text">
                                        <div class="article_container_date"><span
                                                class="the_date"><?php echo month(date('d n Y', strtotime($date))); ?></span>
                                        </div>
                                        <div class="article_container_title"><span
                                                class="the_title"><?php the_title(); ?></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php endwhile;
            } else {

            }
            wp_reset_query(); ?>
        </div>
    </section>
    <section id="parallax-henri">
        <div id="parallax-text">
            <?php $mini_bio = $henri_pourrat_options['mini_bio_1']; ?>
            <span class="henri">Henri</span>
            <span class="pourrat">Pourrat</span>
            <div class="mini-bio"><?= $mini_bio; ?></div>
        </div>
        <img src="<?php echo get_template_directory_uri(); ?>/img/henri.jpg" alt="Henri Pourrat"/>
    </section>


    <script type="text/javascript">
        var $ = jQuery.noConflict();

        $("#accueil_actu").css("margin-top", $(window).height());

        $(window).resize(function () {
            $("#accueil_actu").css("margin-top", $(window).height());
            bookCoverflow.init();
        });

        var bookCoverflow = (function () {

            var self = {};

            self.init = function () {
                $('#coverflow').coverflow({
                    active: Math.floor(document.getElementById('coverflow').querySelectorAll('img').length / 2)
                });
            }

            function resizeCoverflow() {
                bookCoverflow.init();
            }

            $('body').on('click', '.ui-state-active', function () {
                    window.location = $(this).data('href');
                })
                .on('click', '#coverflow-background .fa-chevron-left', function () {
                    $('#coverflow').coverflow('prev');
                })
                .on('click', '#coverflow-background .fa-chevron-right', function () {
                    $('#coverflow').coverflow('next');
                })
                .on('keydown', function (e) {
                    if ((e.keyCode || e.which) == 37) {
                        $('#coverflow').coverflow('prev');
                    }
                    if ((e.keyCode || e.which) == 39) {
                        $('#coverflow').coverflow('next');
                    }
                })

            return self;
        })();

        $(document).ready(function () {
            bookCoverflow.init();
        });
    </script>
<?php
get_footer();
