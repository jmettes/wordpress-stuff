<?php

/* generate meta/facebook description */
function generate_description($id, $is_single) {
  // use post meta data if available
  $description = get_post_meta($id, 'description', true);
  if (!empty($description)) {
    return $description;
  } elseif ($is_single) {
    // use first paragraph for blog posts
    $post = get_post($id);
    $content = $post->post_content;
    $content = strip_tags($content);
    $content = split("\n", $content);

    // attempt to fetch first two paragraphs
    if (trim($content[0]) !== '') {
      return $content[0];
    } elseif (trim($content[1]) !== '') {
      return $content[1];
    }
  }

  // fall back to default blog description
  return bloginfo('description');
}

/* Select appropriate image for Open Graph image tag */
function fb_image($id, $is_single) {
  // return first image
  if ($is_single) {
    $post = get_post($id);
    preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $images);
    if (!empty($images[1][0])) {
      return $images[1][0];
    }
  }

  // default to logo
  return bloginfo('template_url') . "/images/logo.png";
}

/* Select appropriate Open Graph page type */
function fb_page_type($is_home, $name) {
  if ($is_home) {
    return "website";
  } elseif ($name == "blog") {
    return "blog";
  } else {
    return "article";
  }
}
?>
