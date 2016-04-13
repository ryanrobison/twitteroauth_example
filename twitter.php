<?php

  session_start();

  require "config.php";
  require "twitteroauth/autoload.php";
  use Abraham\TwitterOAuth\TwitterOAuth;

  $access_token = $_SESSION['access_token'];
  $connection = new TwitterOAuth(
    CONSUMER_KEY,
    CONSUMER_SECRET,
    $access_token['oauth_token'],
    $access_token['oauth_token_secret']
  );

  $userData = $connection->get( "account/verify_credentials" );

?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/main.css">
  <title>Friendemic twitter code exercise</title>
</head>
<body>

  <h2>Welcome! Lets start making some tweets!</h2>

  <div id="errors"></div>

  <form id="tweet" method="POST">
    <div class="row clearfix">
      <label>User:</label>
      <span><?php echo $userData->screen_name; ?></span>
    </div>
    <div class="row clearfix">
      <label>Message:</label>
      <textarea id="message" name="message"></textarea>
    </div>
    <div class="row clearfix">
      <button>Send</button>
    </div>
  </form>

  <div id="tweets">
    <h2>Tweets</h2>
    <div id="successful">
      <h3>Successful Tweets</h3>
    </div>
    <div id="rejected">
      <h3>Rejected Tweets</h3>
    </div>
  </div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="./js/main.js"></script>
</html>