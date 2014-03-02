<?php
/**
 * SocialWiggle - networks array
 *
 * @author 	Brad Vincent
 * @package 	social-wiggle/includes
 * @version     1.0
 */

$GLOBALS['socialwiggle_networks'] = array(
    'twitter' => array(
        'name' => 'Twitter',
        'message' => __('Follow On Twitter', 'socialwiggle'),
        'placeholder' => __('Twitter URL', 'socialwiggle'),
        'linkprefix' => 'http://www.twitter.com/'
    ),
    'googleplus' => array(
        'name' => 'Google+',
        'message' => __('View Google+ Profile', 'socialwiggle'),
        'placeholder' => __('Google+ URL', 'socialwiggle'),
        'linkprefix' => 'https://plus.google.com/'
    ),
    'facebook' => array(
        'name' => 'Facebook',
        'message' => __('Like On Facebook', 'socialwiggle'),
        'placeholder' => __('Facebook URL', 'socialwiggle'),
        'linkprefix' => 'http://www.facebook.com/'
    ),
    'pinterest' => array(
        'name' => 'Pinterest',
        'message' => __('Follow On Pinterest', 'socialwiggle'),
        'placeholder' => __('Pinterest URL', 'socialwiggle'),
        'linkprefix' => 'http://www.pinterest.com/'
    ),
    'linkedin' => array(
        'name' => 'Linked In',
        'message' => __('Connect On Linked In', 'socialwiggle'),
        'placeholder' => __('Linked In URL', 'socialwiggle'),
        'linkprefix' => 'http://www.linkedin.com/'
    ),
    'youtube' => array(
        'name' => 'YouTube',
        'message' => __('Visit YouTube Channel', 'socialwiggle'),
        'placeholder' => __('YouTube URL', 'socialwiggle'),
        'linkprefix' => 'https://www.youtube.com/user/'
    ),
    'flickr' => array(
        'name' => 'Flickr',
        'message' => __('Follow On Flickr', 'socialwiggle'),
        'placeholder' => __('Flickr URL', 'socialwiggle'),
        'linkprefix' => 'http://www.flickr.com/'
    ),
    'wordpress' => array(
        'name' => 'WordPress',
        'message' => __('View WordPress.org Profile', 'socialwiggle'),
        'placeholder' => __('', 'socialwiggle'),
        'linkprefix' => 'http://profiles.wordpress.org/'
    ),
    'rss' => array(
        'name' => 'RSS Feed',
        'message' => __('Subscribe to RSS Feed', 'socialwiggle'),
        'placeholder' => __('RSS Feed URL', 'socialwiggle'),
        'linkprefix' => 'http://'
    ),
    'email' => array(
        'name' => 'Email',
        'message' => __('Send An Email', 'socialwiggle'),
        'placeholder' => __('Email Address', 'socialwiggle'),
        'linkprefix' => 'mailto:'
    )
);