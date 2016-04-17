<!DOCTYPE html>
<?php setlocale(LC_TIME, 'french'); ?>
<html <?php language_attributes(); ?> style="margin-top: 0px!important;">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <link rel="stylesheet" href="https://cdn.rawgit.com/coverflowjs/coverflow/master/dist/coverflow.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <?php wp_head(); ?>

    <script type="text/javascript">
        var $ = jQuery.noConflict();
        $(document).ready(function () {
            $('#nav-icon2').click(function () {
                $(this).toggleClass('open');
            });
        });
    </script>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
    <header id="masthead" class="site-header" role="banner">
        <nav id="site-navigation" class="main-navigation" role="navigation">
            <img class='nav_logo' src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="logo sahp"/>
            <div id="nav-icon2">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
            <?php wp_nav_menu(array('theme_location' => 'primary', 'menu_id' => 'primary-menu')); ?>
        </nav><!-- #site-navigation -->
    </header><!-- #masthead -->

    <div id="content" class="site-content">

        <?php if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
        } ?>
