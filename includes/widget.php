<?php

/**
 * SocialWiggle - Widget Class
 *
 * @author 	Brad Vincent
 * @package 	social-wiggle/includes
 * @version     1.0
 */

class SocWig_Widget extends WP_Widget {

    const POWERED_BY_URL = 'http://fooplugins.com/plugins/socialwiggle-lite/';
	const PRO_URL = 'http://fooplugins.com/plugins/socialwiggle-pro/';

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'socwig_widget', // Base ID
			'SocialWiggle', // Name
			array( 'description' => __( 'Add SocialWiggle icons to a widget area', 'socialwiggle' ), )
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $before_widget;
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;

		$generator = new socwig_button_generator();

		$generator->render($instance['size'], $instance['style'], $instance['wiggle']);

        $powered_by = '<div class="social-wiggle-powered">' . __('Powered by', 'socialwiggle') . ' <a target="_blank" title="' . __('SocialWiggle Free WordPress Plugin', 'socialwiggle') . '" href="' . self::POWERED_BY_URL . '">SocialWiggle</a></div>';

        echo $powered_by;

		echo $after_widget;
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['size'] = strip_tags( $new_instance['size'] );
		$instance['style'] = strip_tags( $new_instance['style'] );
		$instance['wiggle'] = strip_tags( $new_instance['wiggle'] );

		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : __( 'Social Networks', 'socialwiggle' );
		$size = isset( $instance[ 'size' ] ) ? $instance[ 'size' ] : '64';
		$style = isset( $instance[ 'style' ] ) ? $instance[ 'style' ] : 'square';
		$wiggle = isset( $instance[ 'wiggle' ] ) ? $instance[ 'wiggle' ] : 'random';
		?>
		<p>
			<?php
			$url = admin_url('options-general.php?page=socialwiggle');
			$link = sprintf('<a href="%s" target="_blank">%s</a>', $url, __('SocialWiggle settings page', 'socialwiggle'));
			$html = sprintf( __('To setup your social network buttons, visit the %s.', 'socialwiggle'), $link );
			echo $html;
			?>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'socialwiggle' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'size' ); ?>"><?php _e( 'Size:', 'socialwiggle' ); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id( 'size' ); ?>" name="<?php echo $this->get_field_name( 'size' ); ?>">
				<option <?php echo ($size == '64') ? 'selected="selected"' : ''; ?> value="64">64 x 64</option>
				<option <?php echo ($size == '32') ? 'selected="selected"' : ''; ?> value="32">32 x 32</option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'style' ); ?>"><?php _e( 'Style:', 'socialwiggle' ); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id( 'style' ); ?>" name="<?php echo $this->get_field_name( 'style' ); ?>">
				<option <?php echo ($style == 'square') ? 'selected="selected"' : ''; ?> value="square">Square</option>
				<option <?php echo ($style == 'rounded') ? 'selected="selected"' : ''; ?> value="rounded">Rounded</option>
				<option <?php echo ($style == 'round') ? 'selected="selected"' : ''; ?> value="round">Round</option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'wiggle' ); ?>"><?php _e( 'Wiggle:', 'socialwiggle' ); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id( 'wiggle' ); ?>" name="<?php echo $this->get_field_name( 'wiggle' ); ?>">
				<option <?php echo ($wiggle == 'random') ? 'selected="selected"' : ''; ?> value="random">Random</option>
				<option <?php echo ($wiggle == 'hover') ? 'selected="selected"' : ''; ?> value="hover">On Hover</option>
				<option <?php echo ($wiggle == 'start') ? 'selected="selected"' : ''; ?> value="start">On Page Load</option>
				<option <?php echo ($wiggle == 'none') ? 'selected="selected"' : ''; ?> value="none">None</option>
			</select>
		</p>
		<p>
			<label><?php _e( 'Show SocialWiggle Branding:', 'socialwiggle' ); ?></label>
			<input type="checkbox" checked="checked" disabled="disabled" /><br /><a target="_blank" href="<?php echo self::PRO_URL; ?>"><?php _e('Purchase the PRO version to remove this.', 'socialwiggle') ?></a>
		</p>
		<?php
	}

} // class Foo_Widget