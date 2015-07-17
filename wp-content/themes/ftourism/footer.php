			<a href="#" class="scrollup"></a>
			<footer id="footer-main">
				<div id="footer-content-wrapper">
					<?php get_sidebar( 'footer' ); ?>
					<div class="clear">
					</div><!-- .clear -->
					<div id="copyright">
						<p>
						 <?php fkidd_show_copyright_text(); ?> <a href="<?php echo esc_url( 'http://tishonator.com/product/ftourism' ); ?>" title="<?php esc_attr_e( 'fTourism Theme', 'ftourism' ); ?>">
							<?php _e('fTourism Theme', 'ftourism'); ?></a> <?php esc_attr_e( 'powered by', 'ftourism' ); ?> <a href="<?php echo esc_url( 'http://wordpress.org/' ); ?>" title="<?php esc_attr_e( 'WordPress', 'ftourism' ); ?>">
							<?php _e('WordPress', 'ftourism'); ?></a>
						</p>
					</div><!-- #copyright -->
				</div><!-- #footer-content-wrapper -->
			</footer><!-- #footer-main -->
		</div><!-- #body-content-wrapper-full -->
		<?php wp_footer(); ?>
	</body>
</html>