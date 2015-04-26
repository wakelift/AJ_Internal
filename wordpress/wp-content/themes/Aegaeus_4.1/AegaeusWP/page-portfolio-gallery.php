<?php
/**
 * @package WordPress
 * @subpackage Aegaeus
 */
 
/*
 
Template Name: Portfolio Gallery Type
 
*/
global $data;

?>
<?php get_header(); ?>

<?php 
if (have_posts()) :
while (have_posts()) : the_post();

// Portfolio description
$page_portfolio_description = get_post_meta ( get_the_ID() , 'hb_portfolio_page_description' , true );

// Portfolio Icon
$page_portfolio_icon = get_post_meta ( get_the_ID() , 'hb_portfolio_separator_icon' , true );
$portfolio_class_icon="<span class='".strtolower($page_portfolio_icon)."'></span>";

// Portfolio cats
$page_portfolio_cats_temp = get_post_meta ( get_the_ID() , 'hb_portfolio_category_include' , true );
$page_portfolio_cats = string_to_array_names_categories($page_portfolio_cats_temp);

// Portfolio items per page
$portfolio_per_page = get_post_meta ( get_the_ID() , 'hb_portfolio_per_page' , true );
if ( !$portfolio_per_page ) $portfolio_per_page = -1;

// Portfolio columns
$page_portfolio_columns = get_post_meta ( get_the_ID() , 'hb_portfolio_columns' , true); 

if ( get_query_var('paged') ) {
    $paged = get_query_var('paged');
} elseif ( get_query_var('page') ) {
    $paged = get_query_var('page');
} else {
    $paged = 1;
}

// Extract portfolio items
if ( $page_portfolio_cats_temp ) {
	$loop = new WP_Query( array( 'post_type' => 'portfolio' , 'orderby' => 'menu_order', 'order' => 'ASC', 'posts_per_page' => $portfolio_per_page, 'paged' => $paged, 'tax_query' => array( array( 'taxonomy' => 'portfolio_cats', 'field' => 'slug', 'terms' => $page_portfolio_cats ) ) ) );
} else {
	$loop = new WP_Query( array( 'post_type' => 'portfolio' , 'orderby' => 'menu_order', 'order' => 'ASC', 'posts_per_page' => $portfolio_per_page, 'paged' => $paged ) );
}

?>

<!-- START .from-the-portfolio-wrapper -->
<div class="from-the-portfolio-wrapper">

	<?php 
	// Content
	if ( get_the_content() ) { the_content(); ?>
	<div class="separator"></div>
	<?php } ?>

	<div class="from-the-portfolio-title clearfix">
		<!-- START .from-the-portfolio-title -->
        <div class="from-the-portfolio-title clearfix">
			<h3><?php echo $page_portfolio_description; ?></h3>
			<?php if ( get_post_meta ( get_the_ID() , 'hb_enable_filter_skills' , true ) )  add_portfolio_filter( $loop ); ?>
		</div>
		<!-- END title -->

		<?php if ( $page_portfolio_icon ) { ?>
		<!-- BEGIN .separator -->
		<div class="separator">
			<div class="separator-icon"><?php echo $portfolio_class_icon; ?></div>
		</div>
		<!-- END .separator -->
		<?php } else { ?>
		<div class="spacer"></div>
		<?php } ?>

		<?php add_portfolio_items_gallery( $loop , $page_portfolio_columns ); ?>

		<?php hb_pagination ( '', 4, $loop); ?>
		<?php wp_reset_query(); ?>
		
	</div>
</div>
<!-- END .from-the-portfolio-wrapper -->
<?php
endwhile;
endif; 
?>

<?php get_footer(); ?>