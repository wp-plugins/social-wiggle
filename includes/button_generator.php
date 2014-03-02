<?php
/**
 * SocialWiggle - button generator
 *
 * @author 	Brad Vincent
 * @package 	social-wiggle/includes
 * @version     1.0
 */

if (!class_exists('socwig_button_generator')) {

    class socwig_button_generator {

        function get_networks() {
            $socialwiggleoptions = get_option('socialwiggle');
            if (!empty($socialwiggleoptions)) {
                return ( array_key_exists('networks', $socialwiggleoptions) ) ? $socialwiggleoptions['networks'] : false;
            }
            return false;
        }

        //size:32|64
        //style:rounded|rounded|square
        //wiggle:none|start|random|hover
        function render($size, $style, $wiggle, $no_networks_message = '', $echo = true) {

            $available_networks = $GLOBALS['socialwiggle_networks'];

            $networks = $this->get_networks();

            if ($networks === false) {
                if ($echo) {
                    echo $no_networks_message;
					return;
                } else {
                    return $no_networks_message;
                }
            }

            $socwig_actual_sortorder = array_keys($available_networks);

            if (array_key_exists('sortorder', $networks)) {
                $sortorder = $networks['sortorder'];
                if (!empty($sortorder)) {
                    $sortorder = str_replace('socwig-sort[]=&', '', $sortorder);

                    parse_str($sortorder, $socwig_actual_sortorder);

                    $socwig_actual_sortorder = $socwig_actual_sortorder['socwig-sort'];
                }
            }

            $class[] = ($size == '64') ? 'socwig-64' : 'socwig-32';
            if ($style == 'rounded') {
                $class[] = 'socwig-rounded';
            } else if ($style == 'round') {
                $class[] = 'socwig-round';
            }
            if ($wiggle == 'random') {
                $class[] = 'socwig-wiggle-randomly';
            } else if ($wiggle == 'start') {
                $class[] = 'socwig-wiggle-on-start';
            } else if ($wiggle == 'hover') {
                $class[] = 'socwig-wiggle-on-hover';
            }

            $output = '<!-- Powered by SocialWiggle : http://fooplugins.com/products/socialwiggle-pro/ -->
<div class="socwig-container ' . implode(' ', $class) . '">';
            foreach ($socwig_actual_sortorder as $class) {
                $network = $available_networks[$class];
                $message = $network['message'];
                if (array_key_exists($class.'-enabled', $networks)) {
                    $linkprefix = $network['linkprefix'];
                    $url = array_key_exists($class.'-url', $networks) ? $networks[$class.'-url'] : $linkprefix;
                    $tooltip = array_key_exists($class.'-tooltip', $networks) ? $networks[$class.'-tooltip'] : $message;
                    $output .= sprintf('<a href="%s" target="_blank" rel="nofollow" class="socwigbtn socwig-%s" title="%s"></a>', $url, $class, $tooltip);
                }
            }
            $output .= '</div>';

            if ($echo) {
                echo $output;
            } else {
                return $output;
            }
        }
    }
}