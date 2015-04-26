<?php
/**
 * @package WordPress
 * @subpackage Aegaeus
 */
 
 
/*
 
Template Name: Blog Small 
*/
?>

<?php get_header(); ?>

<?php 
if (have_posts()) : 
	
	while (have_posts()) : the_post();
		
		$exclude_cats = get_post_meta ( get_the_ID() , 'hb_exclude_from_blog_categories' , true );
	
		$idObj = get_category_by_slug($exclude_cats); 
	  	$exclude_string = $idObj->term_id;
		
		if ( get_query_var('paged') ) {
		    $paged = get_query_var('paged');
		} elseif ( get_query_var('page') ) {
		    $paged = get_query_var('page');
		} else {
		    $paged = 1;
		}
		
			// Content
		if ( get_the_content() ) { the_content(); ?>
		<div class="separator"></div>
		<?php } 

		query_posts( 'post_type=post&paged='.$paged.'&cat='.$exclude_string );
		if ( have_posts() ) :
		
			while ( have_posts () ) : the_post(); 
			
				$thumb = get_post_thumbnail_id(); 
				$full_thumb = wp_get_attachment_image_src( get_post_thumbnail_id ( get_the_ID() ), 'original') ;
						
				echo '<article class="search-entry clearfix">';
				
				if ( $thumb ) {
					$image = hb_resize( $thumb, '', 215, 140, true );
					echo '<a href="'.get_permalink().'" title="'.get_the_title().'" class="search-portfolio-thumb"><img src="'.$image['url'].'" /></a>';
				}
				
				$echo_title = get_the_title();
				if ( $echo_title == "" ) $echo_title = __('No Title' , 'hbthemes' );
				echo '<h4>';
				
				if ( !has_post_format ('aside') && !has_post_format('link') )
					echo '<a href="'.get_permalink().'" title="'.$echo_title.'">';
				
				echo $echo_title;
				
				if ( !has_post_format ('aside') && !has_post_format('link') )
					echo '</a>';
					
				echo '</h4>';
			
				the_excerpt();
				
				echo '</article>';
			
			endwhile;
		
		endif;
		
		hb_pagination();
		wp_reset_query();
		
	endwhile; 
	
	hb_pagination();
	
endif;
?>

<?php get_footer(); ?>