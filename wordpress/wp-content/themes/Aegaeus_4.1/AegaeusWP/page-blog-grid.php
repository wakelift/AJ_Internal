<?php
/**
 * @package WordPress
 * @subpackage Aegaeus
 */
 
/*
 
Template Name: Blog Grid
 
*/
global $data;

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
		?>
		<!-- START .posts-grid -->
		<div class="posts-grid clearfix">
		<?php
		while ( have_posts () ) : the_post(); 
			echo print_blog_grid_post( get_the_ID() );
		endwhile;
		?>
		</div>
		<!-- END .posts-grid -->
		<?php 
			
	endif;	
	
	hb_pagination();
	
	wp_reset_query();

endwhile;
endif; ?>

<?php get_footer(); ?>