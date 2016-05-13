<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Henri_Pourrat
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div id="social-network">
			<div class="wrapper">
				<a href=""><span class="fa flaticon-social"></span></a>
				<a href=""><span class="fa flaticon-social-1"></span></a>
				<a href=""><span class="fa flaticon-circle"></span></a>
				<a href=""><span class="fa flaticon-social-2"></span></a>
				<a href="<?php bloginfo('rss2_url'); ?>"><span class="fa fa-rss"></span></a>
			</div>
		</div>
		<div id="link-footer">
			<?php wp_nav_menu(array('theme_location' => 'footer', 'menu_id' => 'footer-menu')); ?>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->
<script src="//www.google-analytics.com/analytics.js" async=""></script>
<script type="text/javascript">
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','__gaTracker');

	__gaTracker('create', 'UA-77138886-1', 'auto');
	__gaTracker('set', 'forceSSL', true);
	__gaTracker('send','pageview');

</script>
<?php wp_footer(); ?>

</body>
</html>
