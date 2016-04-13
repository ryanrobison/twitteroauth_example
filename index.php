<?php

  session_start();

  if ( isset($_SESSION['access_token']) ) {
    header( 'Location: twitter.php' );
  }

  require "config.php";
  require "twitteroauth/autoload.php";
  use Abraham\TwitterOAuth\TwitterOAuth;

  $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
  $connection->setTimeouts(10, 15);
  $request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));

  $_SESSION['oauth_token'] = $request_token['oauth_token'];
  $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

  $url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
  
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/main.css">
  <title>Friendemic twitter exercise</title>
</head>
<body>

  <p>This application takes a user-submitted string and posts it to a twitter account.</p>
  <p>Please click on the link below to authorize this app to use your twitter account.</p>
  <a href="<?php echo $url ?>">Authorize on twitter.com</a>

</body>
</html>