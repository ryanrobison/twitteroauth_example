<?php
  
  session_start();
  header("content-type:application/json");

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

  $message = $_POST['message'];
  $status = $connection->post( "statuses/update", ["status" => $message] );

  echo json_encode($status);

?>