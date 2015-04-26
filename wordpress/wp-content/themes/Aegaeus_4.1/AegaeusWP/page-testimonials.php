<?php
/**
 * @package WordPress
 * @subpackage Notable
 */

/*
 
Template Name: Testimonials
 
*/

global $data, $wp_query;
?>
<?php get_header();
if ( have_posts() ) : while ( have_posts() ) : the_post();

	if ( get_query_var('paged') ) {
	    $paged = get_query_var('paged');
	} elseif ( get_query_var('page') ) {
	    $paged = get_query_var('page');
	} else {
	    $paged = 1;
	}

	// Testomonial items per page
	$testimonails_per_page = get_post_meta ( get_the_ID() , 'hb_portfolio_per_page' , true );
	if ( !$testimonails_per_page ) $testimonails_per_page = -1;

	$page_testimonial_size = (int) get_post_meta ( get_the_ID() , 'hb_staff_columns' , true );
	$page_testimonial_col_class = 'col-6';
	
	switch ( $page_testimonial_size ) {
		case 2 : $page_testimonial_col_class = 'col-6'; break;
		case 3 : $page_testimonial_col_class = 'col-4'; break;
		case 4 : $page_testimonial_col_class = 'col-3'; break;
	}
	
	// Testimonial cats
	$page_testimonial_cats_temp = get_post_meta ( get_the_ID() , 'hb_testimonial_category_include' , true );
	$page_testimonial_cats = string_to_array_names_categories($page_testimonial_cats_temp);
	
	if ( $page_testimonial_cats_temp ) {
		$loop = new WP_Query( array( 'posts_per_page' => $testimonails_per_page, 'paged'=> $paged, 'post_type' => __('testimonials' , 'hbthemes') , 'orderby' => 'menu_order', 'order' => 'ASC', 'tax_query' => array( array( 'taxonomy' => 'testimonial_category', 'field' => 'slug', 'terms' => $page_testimonial_cats ) ) ) );
	} else {
		$loop = new WP_Query( array( 'posts_per_page' => $testimonails_per_page, 'paged'=> $paged, 'post_type' => __('testimonials' , 'hbthemes') , 'orderby' => 'menu_order', 'order' => 'ASC' ) );
	}

	if ( get_the_content() ) { the_content(); ?>
	<div class="separator"></div>
	<?php } ?>
	
	<!-- START .posts-grid -->
	<div class="posts-grid">
	
	<?php while ( $loop->have_posts() ) : $loop->the_post() ; 
	
		
		$testimonial_author = get_post_meta ( get_the_ID() , 'hb_testimonial_author' , true );
		$testimonial_author_info = get_post_meta ( get_the_ID() , 'hb_testimonial_author_info' , true );
		
		?>
		<div class="<?php echo $page_testimonial_col_class; ?> post">
		
			<!-- START .testimonial-box -->
			<div class="testimonial-box">
				<!-- START .testimonial-header -->
				<div class="testimonial-header">
					<div class="testimonial-content"><?php the_content(); ?></div>
					<span class="arrow-down"></span>
				</div>
				<!-- END .testimonial-header -->
				
				<!-- START .testimonial-footer -->
				<div class="testimonial-footer">
				<span><?php echo $testimonial_author; ?></span><?php if ( $testimonial_author_info ) { echo ', '.$testimonial_author_info; } ?>
				</div>
				<!-- END .testimonial-footer -->
			</div>
			<!-- END .testimonial-box -->
			
		</div>		
	<?php endwhile; ?>
	
	</div>
	<!-- END .posts-grid -->
	<?php hb_pagination('', 4, $loop); ?>
		
	<?php wp_reset_query(); ?>
	
<?php endwhile; endif; ?>
<?php get_footer(); ?>