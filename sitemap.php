der('Content-Type: text/xml; charset=uft-8');
require('wp-load.php');

function w3c_format($date) {
//  return date("Y-m-dTH:i:sP", strtotime($date));
  return date("Y-m-d", strtotime($date));
}

echo '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.google.com/schemas/sitemap/0.84" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.google.com/schemas/sitemap/0.84 http://www.google.com/schemas/sitemap/0.84/sitemap.xsd">
  <url>
    <loc>', bloginfo("url"), '</loc>
    <lastmod>', w3c_format(get_lastpostmodified()), '</lastmod>
  </url>';

$pages = get_pages();
foreach ($pages as $page) {
  echo '
  <url>
    <loc>', get_permalink($page->ID), '</loc>
    <lastmod>', w3c_format($page->post_modified), '</lastmod>
    <changefreq>monthly</changefreq>
  </url>';
}

$posts = get_posts();
foreach ($posts as $post) {
  echo '
  <url>
    <loc>', get_permalink($post->ID), '</loc>
    <lastmod>', w3c_format($post->post_modified), '</lastmod>
    <changefreq>monthly</changefreq>
  </url>';
}

echo '
</urlset>';

?>

