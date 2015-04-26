<h4><?php _e('Popular post', 'promax'); ?></h4>
<div id="populars">
<?php 
$args = array( 
 'ignore_sticky_posts' => true,
 'showposts' => 5,
'orderby' => 'comment_count',  );
$the_query = new WP_Query( $args );
 if ( $the_query->have_posts() ) :
while ( $the_query->have_posts() ) : $the_query->the_post();
			 ?>							
	 <span class="ltl"> <a title="<?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></span>
								<div class="pop">
						<?php if ( has_post_thumbnail() ) {the_post_thumbnail('popularpost');} else { ?><img src="<?php echo get_template_directory_uri(); ?>/images/thumb.jpg" /><?php } ?></div> 		
																	</a>	<?php endwhile; ?>
							<?php endif; ?>	<?php wp_reset_postdata(); ?>
									</div>					
					<div style="clear:both;"></div>