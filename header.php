<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:og="http://ogp.me/ns#"
      xmlns:fb="https://www.facebook.com/2008/fbml">
<head>
<meta charset="utf-8"/>

<title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>

<!-- Open Graph Protocol: http://developers.facebook.com/docs/opengraphprotocol -->
<meta property="og:title" content="<?php bloginfo('name'); ?> <?php wp_title(); ?>"/>
<meta property="og:type" content="<?php echo fb_page_type(is_home(), $pagename); ?>"/>
<meta property="og:image" content="<?php echo fb_image($post->ID, is_single()); ?>"/>
<meta property="og:url" content="<?php echo get_permalink($post->ID); ?>"/>
<meta property="og:site_name" content="<?php bloginfo('name'); ?>"/>
<meta property="og:description" content="<?php echo generate_description($post->ID, is_single()) ?>"/>

<meta name="description" content="<?php echo generate_description($post->ID, is_single()) ?>"/>

<?php wp_head(); ?>
</head>
