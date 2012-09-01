	<footer id="colophon" role="contentinfo">
		<div id="site-generator">
			<?php do_action( 'onlinemarketer_credits' ); ?>
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'online-marketer' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'online-marketer' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'online-marketer' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<a href="<?php echo esc_url( __( 'http://wpthemes.co.nz/', 'online-marketer' ) ); ?>" rel="designer"><?php printf( __( '%1$s Theme by %2$s', 'online-marketer' ), 'Online Marketer', 'WPThemes.co.nz' ); ?></a>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>