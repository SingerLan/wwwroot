<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package QuotesIn
 */

?>
<div id="footer">
	<div class="wrapper">
		<div id="footerwidgets">
			<?php /* Widgetised Area */
			if (!function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'Footer' )) ?>

		</div>
		<!-- End Footer Widgets-->
	</div><!-- End Wrapper -->
		<?php do_action( 'quotesin_credits' );
		quotesin_jis_footer();
		wp_footer();
		?>
</div><!-- End Footer -->
</body>
</html>
