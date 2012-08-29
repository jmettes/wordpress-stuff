<?php
// enter your TypePad AntiSpam API key here (http://antispam.typepad.com)
$key = "";

if ($_POST[sent]) {
  $error = "";

  if (
    !trim($_POST[your_name]) ||
    !trim($_POST[your_phone]) ||
    !trim($_POST[your_message])
  ) {
    $error = "Please fill in all required fields.";
  } elseif (!filter_var($_POST[your_email], FILTER_VALIDATE_EMAIL)) {
    $error = "Please enter a valid email address.";
  }


  if (!$error) {

    $context = stream_context_create(array(
      'http' => array(
        'method' => 'POST',
        'header' => 'Content-Type: application/x-www-form-urlencoded',
        'content' => 'key=' . $key . '&blog=' . bloginfo("url") . '&user_ip=' . $_SERVER['REMOTE_ADDR'] . '&user_agent=' . $_SERVER['HTTP_USER_AGENT'] . 'comment_content=' . trim($_POST[your_message]) . '&comment_author=' . trim($_POST[your_name]) . '&comment_author_email=' . trim($_POST[your_email])
      )));
    $isSpam = file_get_contents('http://' . $key . '.api.antispam.typepad.com/1.1/comment-check', false, $context);
echo $isSpam;
    if ($isSpam == 'false') {
      $email = wp_mail(
        get_option("admin_email"),
        trim($_POST[your_name]) . " sent you a message from " . stripslashes(trim(get_option("blogname"))),
        stripslashes(trim($_POST[your_message])) . "\r\nPhone: " . stripslashes(trim($_POST[your_phone])),
        "From: " . trim($_POST[your_name]) . " <" . trim($_POST[your_email]) . ">\r\nReply-To:" . trim($_POST[your_email])
      );
    } else {
      $error = "It failed to pass the spam filter...";
    }

  }
}
?>
<?php get_header(); ?>

<form id="contact" method="post" action="<?php get_permalink($post->ID); ?>">
  <div id="messages">
  <?php if ($email) { ?>
    <p class="success">Thank you! Your message successfully sent!</p>
  <?php } elseif ($error) { ?>
    <p class="fail">Your message wasn't sent. <?php echo $error; ?></p>
  <?php } ?>
  </div>
  <input type="hidden" name="sent" id="sent" value="1" />
  <div class="field">
    <label for="your_name">Name *</label>
    <input type="text" name="your_name" id="your_name" value="<?php
      echo $_POST[your_name];
    ?>" />
  </div>
  <div class="field">
    <label for="your_email">Email *</label>
    <input type="text" name="your_email" id="your_email" value="<?php
      echo $_POST[your_email];
    ?>" />
  </div>
  <div class="field">
    <label for="your_phone">Phone *</label>
    <input type="text" name="your_phone" id="your_phone" value="<?php
      echo $_POST[your_phone];
    ?>" />
  </div>
  <div class="field">
    <label for="your_message">Message *</label>
    <textarea name="your_message" id="your_message">
      <?php echo $_POST[your_message]; ?>
    </textarea>
  </div>
  <div class="field">
    <input value="Send" type="submit" />
  </div>
  <div>
    <p>* required fields</p>
  </div>
</form>


<?php get_footer(); ?>
