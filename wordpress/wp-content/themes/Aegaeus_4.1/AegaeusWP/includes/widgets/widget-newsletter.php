<?php
/*
 * Plugin Name: Video Widget
 * Plugin URI: http://www.hb-themes.com
 * Description: A widget that displays video
 * Version: 1.0
 * Author: HB-Themes
 * Author URI: http://www.hb-themes.com
 */

/*
 * Add function to widgets_init that'll load our widget.
 */
add_action( 'widgets_init', 'hb_newsletter_widgets' );

/*
 * Register widget.
 */
function hb_newsletter_widgets() {
	register_widget( 'HB_Newsletter_Widget' );
}

/*
 * Widget class.
 */
class hb_newsletter_widget extends WP_Widget {

	/* ---------------------------- */
	/* -------- Widget setup -------- */
	/* ---------------------------- */
	
	function HB_Newsletter_Widget() {
	
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget-newsletter', 'description' => __('A widget that shows newsletter', 'hbthemes') );
		$control_ops = array ();
		/* Create the widget. */
		$this->WP_Widget( 'hb_newsletter_widget', __('Custom Newsletter Widget','hbthemes'), $widget_ops, $control_ops );
	}

	/* ---------------------------- */
	/* ------- Display Widget -------- */
	/* ---------------------------- */
	
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$action = $instance['action'];
		
		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

		echo '<form class="newsletter-box-form" action="'.$action.'" method="post" novalidate>';
		echo '<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="'.__('Email address' , 'hbthemes' ) . '" />';
		echo '<input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe"/>';
		echo '</form>';
		
		echo '<div class="clear"></div>';
		
		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/* ---------------------------- */
	/* ------- Update Widget -------- */
	/* ---------------------------- */
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['action'] = strip_tags( $new_instance['action'] );

		/* No need to strip tags for.. */

		return $instance;
	}
	
	/* ---------------------------- */
	/* ------- Widget Settings ------- */
	/* ---------------------------- */
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	 
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
		'title' => 'Newsletter Widget',
		'action' => '',
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , 'hbthemes'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<!-- Username: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'action' ); ?>"><?php echo ' Action attribute from the mailchimp embedded sign up form.'; ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'action' ); ?>" name="<?php echo $this->get_field_name( 'action' ); ?>" value="<?php echo $instance['action']; ?>" ><?php echo $instance['action']; ?></textarea>
		</p>

		
	<?php
	}
}
?>