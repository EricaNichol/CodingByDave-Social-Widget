<?php

/*
Plugin Name: Custom Social Widget
Plugin URI: codingbydave.com
Description: Social Media Widget for the footer area, use this instead of text directly in the input area.
Author: David Lin @CodingByDave
Version: 1
Author URI: codingbydave.com
*/


// Creating the widget
class CBD_socialwidget extends WP_Widget {

	function __construct() {
		$widget_options = array(
			'classname'		 => 'codingbydave_socialwiget',
			'description'  => 'This is an Social Media Widget'
		);

		parent::__construct(
			// Base ID of my widget
			'CBD_socialwidget',

			// The Widget Name that will appear in the UI,
			'CodingByDave Social Media Widget',

			//description
			$widget_options
		);
	}

	// Creating widget front-end
	// This is where the action happens
	public function widget( $args, $instance ) {
		$facebook = strtolower($instance[ 'facebook' ]);
		$twitter = strtolower($instance[ 'twitter' ]);
		$instagram = strtolower($instance[ 'instagram' ]);

		?>

		<div class="widget-area">
			<div class="widget">
				<h3 class="widget-title">SOCIAL MEDIA</h3>
				<div class="social_container">

					<?php if ( !empty($facebook) ): ?>
						<a class="fa fa-facebook-square" href="https://<?php echo $facebook; ?>"></a>
					<?php endif; ?>

					<?php if ( !empty($twitter) ): ?>
						<a class="fa fa-instagram" href="https://<?php echo $twitter; ?>"></a>
					<?php endif; ?>

					<?php if ( !empty($instagram) ): ?>
						<a class="fa fa-twitter-square" href="https://<?php echo $instagram; ?>"></a>
					<?php endif; ?>

				</div>
			</div>
		</div>

		<?

 		echo $args['after_widget'];
	}

	// Widget Backend
	public function form( $instance ) {
		$array = Array();

		if ( isset( $instance[ 'facebook' ] ) ) {
			$facebook = $instance[ 'facebook' ];
		}
		if ( isset( $instance[ 'instagram' ] ) ) {
			$instagram = $instance[ 'instagram' ];
		}
		if ( isset( $instance[ 'twitter' ] ) ) {
			$twitter = $instance[ 'twitter' ];
		}

		// Widget admin form
		?>
		<p> Please type in the url of your social media profile .. IE www.facebook.com/codingbydave </p>
		<div>
			<label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e( 'Facebook:' ); ?></label>
			<input class="widefat"
						 id="<?php echo $this->get_field_id( 'facebook' ); ?>"
						 name="<?php echo $this->get_field_name( 'facebook' ); ?>"
						 type="text"
						 value="<?php echo esc_attr( $facebook ); ?>" />
		</div>

		<div>
			<label for="<?php echo $this->get_field_id( 'instagram' ); ?>"><?php _e( 'instagram:' ); ?></label>
			<input class="widefat"
						 id="<?php echo $this->get_field_id( 'instagram' ); ?>"
						 name="<?php echo $this->get_field_name( 'instagram' ); ?>"
						 type="text"
						 value="<?php echo esc_attr( $instagram ); ?>" />
		</div>

		<div>
			<label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e( 'Twitter:' ); ?></label>
			<input class="widefat"
						 id="<?php echo $this->get_field_id( 'twitter' ); ?>"
						 name="<?php echo $this->get_field_name( 'twitter' ); ?>"
						 type="text"
						 value="<?php echo esc_attr( $twitter ); ?>" />
		</div>

		<?php
	}

	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['facebook']  = ( ! empty( $new_instance['facebook'] ) ) ? strip_tags( $new_instance['facebook'] ) : '';
		$instance['instagram'] = ( ! empty( $new_instance['instagram'] ) ) ? strip_tags( $new_instance['instagram'] ) : '';
		$instance['twitter']   = ( ! empty( $new_instance['twitter'] ) ) ? strip_tags( $new_instance['twitter'] ) : '';

		return $instance;
	}

} // Class wpb_widget ends here

// Register and load the widget
function wpb_load_widget() {
	register_widget( 'CBD_socialwidget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );
