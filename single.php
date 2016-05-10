<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Henri_Pourrat
 */

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <?php
            while (have_posts()) : the_post();
                $event = get_field('evenement');
                (!$event) ? $location = get_field('adresse') : '';
                (!$event) ? $date = get_field('date') : '';
                $couverture = get_field('couverture');
                ?>

                <div class="post-cover" style="background-image:url(<?= $couverture['url']; ?>);">
                    <div class="post-gradient"></div>
                </div>
                <div class="post-top wrapper">
                    <div class="post-title">
                        <h1><?php echo the_title(); ?></h1>
                        <div class="post-info">
                            <?php if ('event' == get_post_type()) : ?>
                                <i class="fa fa-map-marker" aria-hidden="true"></i> <?= $location['address']; ?>
                                <i class="fa fa-clock-o"
                                   aria-hidden="true"></i><?= month(date('d n Y', strtotime($date))); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php
                    if (function_exists('yoast_breadcrumb')) {
                        yoast_breadcrumb('<div id="breadcrumbs">', '</div>');
                    }
                    ?>
                </div>
                <div class="post-article wrapper clearfix">
                    <?php the_content(); ?>


                    <?php if ('event' == get_post_type()) :
                        if (!empty($location)):
                            ?>
                            <div class="acf-map">
                                <div class="marker" data-lat="<?php echo $location['lat']; ?>"
                                     data-lng="<?php echo $location['lng']; ?>"></div>
                            </div>
                        <?php endif;
                    endif; ?>
                </div>

                <?php wp_related_posts() ?>

                <?php

            endwhile; // End of the loop.
            ?>

            <style type="text/css">

                .acf-map {
                    width: 100%;
                    height: 400px;
                    border: #ccc solid 1px;
                    margin: 20px 0;
                }

                /* fixes potential theme css conflict */
                .acf-map img {
                    max-width: inherit !important;
                }

            </style>
            <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
            <script type="text/javascript">
                (function ($) {

                    /*
                     *  new_map
                     *
                     *  This function will render a Google Map onto the selected jQuery element
                     *
                     */

                    function new_map($el) {

                        var $markers = $el.find('.marker');

                        var args = {
                            zoom: 16,
                            center: new google.maps.LatLng(0, 0),
                            mapTypeId: google.maps.MapTypeId.ROADMAP
                        };

                        var map = new google.maps.Map($el[0], args);

                        map.markers = [];

                        $markers.each(function () {

                            add_marker($(this), map);

                        });

                        center_map(map);

                        return map;

                    }

                    /*
                     *  add_marker
                     *
                     *  This function will add a marker to the selected Google Map
                     *
                     */

                    function add_marker($marker, map) {

                        var latlng = new google.maps.LatLng($marker.attr('data-lat'), $marker.attr('data-lng'));

                        var marker = new google.maps.Marker({
                            position: latlng,
                            map: map
                        });

                        map.markers.push(marker);

                        if ($marker.html()) {
                            var infowindow = new google.maps.InfoWindow({
                                content: $marker.html()
                            });
                            google.maps.event.addListener(marker, 'click', function () {

                                infowindow.open(map, marker);

                            });
                        }

                    }

                    /*
                     *  center_map
                     *
                     *  This function will center the map, showing all markers attached to this map

                     */

                    function center_map(map) {

                        var bounds = new google.maps.LatLngBounds();

                        $.each(map.markers, function (i, marker) {

                            var latlng = new google.maps.LatLng(marker.position.lat(), marker.position.lng());

                            bounds.extend(latlng);

                        });

                        if (map.markers.length == 1) {
                            map.setCenter(bounds.getCenter());
                            map.setZoom(16);
                        }
                        else {
                            map.fitBounds(bounds);
                        }

                    }

                    /*
                     *  document ready
                     *
                     *  This function will render each map when the document is ready (page has loaded)
                     *
                     */
                    var map = null;

                    $(document).ready(function () {

                        $('.acf-map').each(function () {

                            // create map
                            map = new_map($(this));

                        });

                    });

                })(jQuery);
            </script>

            <span class="triangle_bottom border-white"></span>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
