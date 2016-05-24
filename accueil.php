<?php
/*
Template Name: Accueil
*/
?><?php

get_header(); ?>
    <section id="parallax">
        <div id="parallax-text">
            <?php
            $henri_pourrat_options = get_option('henri_pourrat_option_name');
            $mini_bio = $henri_pourrat_options['mini_bio_1']; ?>
            <span class="henri">Henri</span>
            <span class="pourrat">Pourrat</span>
            <div class="mini-bio"><?= $mini_bio; ?>
                <div class="bio-gradient"></div>
            </div>
            <a href="#" class="btn">Biographie</a>
        </div>
        <div id="parallax-henri"></div>
        <a href='#accueil_actu' class="arrow bounce"></a>
    </section>
    <section id="accueil_actu" class="bg-white clearfix pb70">
        <div class="wrapper">
            <h1>Actualités & Événements</h1>
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
            wp_reset_query();
            ?>
        </div>
    </section>
    <script src="https://cdn.rawgit.com/coverflowjs/coverflow/master/dist/coverflow.min.js"></script>
    <section id="coverflow-section">
        <div id="coverflow-container">
            <div class="wrapper">
                <h1>Livres</h1>
            </div>
            <div id="coverflow">
                <?php
                $args = array('post_type' => array('livre'), 'posts_per_page' => -1);

                $query = new WP_Query($args);
                $count = 0;
                $middle = round($query->post_count / 2) - 1;
                while ($query->have_posts()) : $query->the_post();
                    $image = get_field('image');
                    $count == $middle ? $citation = get_field('citation') : '';
                    ?>
                    <a data-citation="<?php echo get_field('citation'); ?>" data-href='<?= the_permalink(); ?>'><img
                            src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"/></a>

                    <?php
                    $count++;

                endwhile; ?>
            </div>
            <div id='coverflow-controls'>
                <i class="fa fa-chevron-left"></i>
                <i class="fa fa-chevron-right"></i>
            </div>
        </div>
    </section>
    <section id="quote">
        <div class="wrapper">
            <p id="citation" class="italic"><?php echo $citation; ?></p>
            <span class="triangle_bottom rotate180"></span>
        </div>
    </section>
    <section id="newsletter" class="bg-white">
        <div class="wrapper">
            <?php $widgetNL = new WYSIJA_NL_Widget(true);
            echo $widgetNL->widget(array('form' => 2, 'form_type' => 'php'));
            ?>
        </div>
    </section>
    <script type="text/javascript">
        var $ = jQuery.noConflict();

        $('#parallax').height($(window).height() - $('nav').height());

        $(window).resize(function(){
            $('#parallax').height($(window).height() - $('nav').height());
        });

        $('.arrow.bounce').click(function(){
            var page = $(this).attr('href');
            var speed = 750;
            $('html, body').animate({
                scrollTop: $(page).offset().top - $('nav').height()
            }, speed);
            return false;
        });


        $("#accueil_actu").css("margin-top", $(window).height());

        $(window).resize(function () {
            $("#accueil_actu").css("margin-top", $(window).height());
            bookCoverflow.init();
        });

        var bookCoverflow = (function () {

            var self = {};

            self.init = function () {
                $('#coverflow').coverflow({
                    active: <?php echo $middle; ?>
                });
            }

            function resizeCoverflow() {
                bookCoverflow.init();
            }

            $('body').on('click', '.ui-state-active', function () {
                    window.location = $(this).data('href');
                })
                .on('click', '#coverflow-controls .fa-chevron-left', function () {
                    $('#coverflow').coverflow('prev');
                })
                .on('click', '#coverflow-controls .fa-chevron-right', function () {
                    $('#coverflow').coverflow('next');
                });

            $('#coverflow').on('change', function () {
                alert('toto');
            });

            return self;
        })();

        $(document).ready(function () {
            bookCoverflow.init();
        });
    </script>
<?php
get_footer();
