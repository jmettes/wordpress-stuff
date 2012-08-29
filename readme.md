## What is this?

Assorted Wordpress code I've hacked together for myself, mainly because the level of functionality I wanted didn't justify using a plugin. It's not the greatest quality code, but it might be useful, or at least give you some ideas.

## Contact form

Installing a plugin like [Contact Form 7](http://wordpress.org/extend/plugins/contact-form-7/) seems like a bit of overkill for just a single contact page. I've opted for using a [page-slug template](http://codex.wordpress.org/Pages#Templates_by_page_ID_or_page_Slug) instead. Also, most plugins only support Akismet for spam detection. You may want to avoid using them and/or their [paid commercial plans](http://akismet.com/signup/). I personally prefer [TypePad's antispam service](http://antispam.typepad.com/).

### Installation

1. Create a page

2. Upload [`page-contact.php`](http://github.com/jmettes/wordpress-stuff/blob/master/page-contact.php) to the root of your theme directory.

3. Ensure the file name matches the slug or ID of the page, e.g.

    `page-contact-us.php`
or
    `page-3.php`

4. Get your [TypePad AntiSpam API key](http://antispam.typepad.com/), and paste it as the `$key` variable

When customising, pay attention that your form name/id attributes don't [clash with existing wordpress POST parameters](http://codex.wordpress.org/Function_Reference/register_taxonomy#Reserved_Terms).

## Facebook open graph generator & meta description

Generates facebook open graph tags (and HTML meta description tag) based on page type and data available.

### Installation

1. Copy over the meta tags from [`header.php`](https://github.com/jmettes/wordpress-stuff/blob/master/header.php) to your `header.php` file

2. Copy over the code from [`functions.php`](https://github.com/jmettes/wordpress-stuff/blob/master/functions.php) to your `functions.php` file

3. Enable [custom fields](http://codex.wordpress.org/Custom_Fields) in the [screen options](http://codex.wordpress.org/Administration_Screens#Screen_Options) menu

4. You can customise Facebook/meta descriptions for posts/pages by filling creating a 'description' custom field -- it falls back to using the first paragraph, or default blog description

You might have to change the [`fb_page_type()`](https://github.com/jmettes/wordpress-stuff/blob/master/functions.php) function to suit your situation. I always put my blogs on a separate "blog" page, however, you might name it "news", or have it as the homepage. While you're at it, you might also want to change `fb_image()` if your logo isn't located at `/images/logo.png`.

## Sitemap

A simple hack that serves a `sitemap.txt` file from all pages and posts.

### Installation

1. Copy `sitemap.php` into the root of your wordpress installation

2. Copy over the first line of `.htaccess` into yours
