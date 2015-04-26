<div id="ltpost">
<?php 
$promax_args = array( 
 'ignore_sticky_posts' => true,
 'showposts' => 5,
'orderby' => 'date',  );
$the_query = new WP_Query( $promax_args );
 if ( $the_query->have_posts() ) :
while ( $the_query->have_posts() ) : $the_query->the_post();
			 ?>
								<div class="latest-post">
									<?php if ( has_post_thumbnail() ) {the_post_thumbnail('latestpostthumb');} else { ?><img src="<?php echo get_template_directory_uri(); ?>/images/thumb.jpg" />
<?php } ?> 
									 <a title="<?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a><br />
									 <div class="clear"></div>
								</div>
							<?php endwhile; ?>
							<?php endif; ?>			 <?php wp_reset_postdata(); ?>
									</div>					
					
		
			<div style="clear:both;"></div>