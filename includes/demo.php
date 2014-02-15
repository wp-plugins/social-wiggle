<?php
/**
 * Demo on SocialWiggle Settings Page
 *
 * @author 	Brad Vincent
 * @package 	social-wiggle/includes
 * @version     1.0
 */


function socwig_render_demo($style, $wiggle) {

	$generator = new socwig_button_generator();

	echo '<h3>64 x 64 Demo</h3>';

	$generator->render('64', $style, $wiggle, __('Please setup your networks for the demo to work', 'socialwiggle'));

	echo '<h3>32 x 32 Demo</h3>';

	$generator->render('32', $style, $wiggle, __('Please setup your networks for the demo to work', 'socialwiggle'));
}
