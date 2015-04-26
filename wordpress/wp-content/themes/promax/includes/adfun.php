<div id="bottom-menu">
<div id="bottom-menu-inner" class="clearfix">
<div id="bottom-menu-1">
<?php if (!dynamic_sidebar('Bottom Menu 1') ) : ?>
		<?php endif; ?>
</div> <!-- end div #bottom-menu-left -->
<div id="bottom-menu-2">
	<?php if (!dynamic_sidebar('Bottom Menu 2') ) : ?>
			<?php endif; ?>
</div> <!-- end div #bottom-menu-center -->
<div id="bottom-menu-4">
	<?php if ( !dynamic_sidebar('Bottom Menu 4') ) : ?>
	<?php endif; ?>
</div> </div> </div>
	<div id="footer">
	<div id="footer-inner" class="clearfix">
	   <?php _e('Copyright &#169;', 'promax'); ?>  <?php echo date('Y');?> <a href="<?php echo esc_url(home_url('/'));?>" title="<?php bloginfo('name');?>" ><?php bloginfo('name');?></a> <?php _e('Powered by', 'promax'); ?> <a href="http://wordpress.org/"><?php _e('WordPress', 'promax'); ?></a><?php _e(' Theme ', 'promax'); ?><a href="<?php echo esc_url( __( 'http://www.insertcart.com/promax-basic', 'promax' ) ); ?>" title="<?php esc_attr_e( 'InsertCart', 'promax' ); ?>"><?php printf( __( 'ProMax %s', 'promax' ),''); ?></a>
	</div> <!-- end div #footer-inner -->
	</div> <!-- end div #footer -->
	<!-- END FOOTER -->
		
</div> 