<?php
/**
 * @package WordPress
 * @subpackage Aegaeus
 */
 
global $data, $wp_query; 
?>

<?php get_header(); 
echo add_portfolio_items( $wp_query , 3 , $wp_query );
hb_pagination();
get_footer(); 
?>