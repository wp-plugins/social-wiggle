<?php

/**
 * SocialWiggle - settings
 *
 * @author    Brad Vincent
 * @package    social-wiggle/includes
 * @version     1.0
 */

if (!class_exists('socwig_admin_settings')) {

    class socwig_admin_settings {

        function __construct($show_license = false) {
            add_action('socialwiggle_admin_settings_init', array(&$this, 'create_settings'));
        }

        function create_settings($socialwiggle) {

            $socialwiggle->admin_settings_add_tab('networks', __('Networks', 'socialwiggle'));

            $socialwiggle->admin_settings_add(array(
                'id' => 'socialwiggle_info',
                'title' => __('Setup Your Social Networks', 'socialwiggle'),
                'type' => 'socialnetworks',
                'tab' => 'networks'
            ));

            $socialwiggle->admin_settings_add_tab('demo', __('Demo', 'socialwiggle'));

            $demo_style_choices = array();
            $demo_style_choices['square'] = __('Square', 'socialwiggle');
            $demo_style_choices['rounded'] = __('Rounded', 'socialwiggle');
            $demo_style_choices['round'] = __('Round', 'socialwiggle');

            $socialwiggle->admin_settings_add(array(
                'id' => 'demo_style',
                'title' => __('Button Style', 'foobox'),
                'default' => 'square',
                'type' => 'select',
                'section' => 'demo',
                'choices' => $demo_style_choices,
                'tab' => 'demo',
                'class' => 'demo_drop_style'
            ));

            $demo_wiggle_choices = array();
            $demo_wiggle_choices['random'] = __('Random', 'socialwiggle');
            $demo_wiggle_choices['hover'] = __('On Hover', 'socialwiggle');
            $demo_wiggle_choices['start'] = __('On Page Load', 'socialwiggle');
            $demo_wiggle_choices['none'] = __('None', 'socialwiggle');

            $socialwiggle->admin_settings_add(array(
                'id' => 'demo_wiggle',
                'title' => __('Button Wiggle', 'foobox'),
                'default' => 'random',
                'type' => 'select',
                'section' => 'demo',
                'choices' => $demo_wiggle_choices,
                'tab' => 'demo',
                'class' => 'demo_drop_wiggle'
            ));

            $socialwiggle->admin_settings_add(array(
                'id' => 'demo_js',
                'title' => '',
                'type' => 'demo',
                'tab' => 'demo'
            ));

            $socialwiggle->admin_settings_add_tab('upgrade', __('Pro Version', 'socialwiggle'));

            $upgrade_html = '</td></tr><tr valign="top"><td colspan="2">
<a class="social-wiggle-pro-ad" href="'.socialwiggle::PRO_URL.'" target="_blank"></a><br />
<h3>Here are a few reasons:</h3>
<div style="width:50%">
<table class="widefat social-wiggle-pro-table">
<thead>
    <tr>
        <th>Feature</th>
        <th>Lite</th>
        <th><a href="'.socialwiggle::PRO_URL.'" target="_blank">Pro</a></th>
    </tr>
</thead>
<tbody>
    <tr>
        <td><strong>Plugin Support</strong></td>
        <td>Limited, delayed support via WordPress.org support forums</td>
        <td><span>Priority, super-fast support</span> via FooPlugins Support</td>
    </tr>
    <tr>
        <td><strong># of Social Networks</strong></td>
        <td>10 Social Networks</td>
        <td><span>25 Social Networks icons</span> and more coming soon!</td>
    </tr>
    <tr>
        <td><strong>Widget Branding</strong></td>
        <td>Has a "powered by SocialWiggle" link</td>
        <td><span>No branding</span> or powered by link!</td>
    </tr>
    <tr>
        <td><strong>Shortcode Support</strong></td>
        <td>No shortcode support</td>
        <td><span>Full shortcode support</span> including WYSIWYG <span>editor buttons</span> and built-in <span>visual shortcode generator</span></td>
    </tr>
    <tr>
        <td><strong>PHP Function Support</strong></td>
        <td>No PHP function support</td>
        <td>Includes a <span>PHP function</span> that you can call from your theme or other plugins</td>
    </tr>
    <tr>
        <td><strong>Advanced Settings</strong></td>
        <td>No advanced settings</td>
        <td><span>Includes advanced settings</span> like custom CSS, force scripts into page footer and more</td>
    </tr>
</tbody>
</table>
</div>
';

                $socialwiggle->admin_settings_add( array(
                'id'      => 'upgrade_info',
                'title'   => sprintf ( __( 'Why Upgrade To Pro?', 'socialwiggle' ), socialwiggle::PRO_URL ),
                'desc'    => $upgrade_html,
                'type'    => 'html',
                'tab'     => 'upgrade'
            ) );
        }
    }
}