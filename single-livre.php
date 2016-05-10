<?php

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <?php
            while ( have_posts() ) : the_post();
                $couverture = get_field('couverture_de_levenement');
                $date = get_field('date');
                date('Y-m-d', strtotime($date)) > date('Y-m-d') ? $past = '' : $past = 'past';
                $date = month(date('d n Y', strtotime($date)));;
                ?>
                <div class="left">

                </div>
                <div class="left">

                </div>
                <?
                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;

            endwhile; // End of the loop.
            ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
