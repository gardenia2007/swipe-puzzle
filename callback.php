<?php

session_start();
include_once( 'config.php' );
include_once( 'weibooauth.php' );
include_once( 'tools.php' );


$o = new WeiboOAuth( WB_AKEY , WB_SKEY , $_SESSION['keys']['oauth_token'] , $_SESSION['keys']['oauth_token_secret']  );

$last_key = $o->getAccessToken(  $_REQUEST['oauth_verifier'] ) ;
//print_r($last_key);
$_SESSION['last_key'] = $last_key;

$route = "create_new_puzzle.php";
redirect($route);
?>
