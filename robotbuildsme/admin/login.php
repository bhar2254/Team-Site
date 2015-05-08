<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../common.php');

$accessMessage = "";
$username;
$password;

if($_SERVER['HTTP_HOST'] == "www.liberty.k12.mo.us" || $_SERVER['HTTP_HOST'] == "www")
{
    include_once('/var/www/resources/auth_class/studentuser.inc.php');
    include_once('/var/www/resources/auth_class/staffuser.inc.php');
}
else if($_SERVER['HTTP_HOST'] == "first1764.liberty.k12.mo.us" || $_SERVER['HTTP_HOST'] == "first1764")
{
    include_once('/var/www/resources/auth_class/studentuser.inc.php');
    include_once('/var/www/resources/auth_class/staffuser.inc.php');
}
else
{
    include_once('/var/www/resources/auth/studentuser.inc.php');
    include_once('/var/www/resources/auth/staffuser.inc.php');
}
$accessMessage;
if($_POST['login'] == "signin")
{
    
    
    //exit();
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sysallowed = false;
    
    include_once('aclList.php');
    
    if(in_array($username, $allowedLogins))
    {
        //Than we are allowing the name to go further.
        //Lets first try to find a staff username.
        //echo "In Array\n\n";
        $u = new staffuser();
        $u->username = $username;
        $u->setPassword($password);
        $u->encodeToChallenge();
        $u->requestChallengeFromServer();
        $sysallowed = $u->isUserAccessGranted();
        var_dump($u);
        if($sysallowed)
        {
            echo "In Allowed";
            $accessMessage = "Access Granted";
            session_start();
            $_SESSION['userobj'] = serialize($u);
            $_SESSION['username'] = $username;
            $_SESSION['usertype'] = "staff";
            
            
            unset($u);
            header("Location: list.php");
            exit();
        }
        else
        {
            //Student login.
            unset($u);
            $u = new studentuser();
            $u->username = $username;
            $u->setPassword($password);
            $u->encodeToChallenge();
            $u->requestChallengeFromServer();
            $sysAllowed = $u->isUserAccessGranted();
            //var_dump($u);
            //exit();
            if($sysAllowed)
            {
                $accessMessage = "Access Granted";
                session_start();
                $_SESSION['userobj'] = serialize($u);
                $_SESSION['username'] = $username;
                $_SESSION['usertype'] = "student";
                
                header("Location: list.php");
                exit();
            }
            else
            {
                $accessMessage = "Access Denied";
            }
            //End Student Login.
        }
        
    }
    else
    {
        $accessMessage = "Access Denied";
    }
    
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Sign in &middot; Robot Builds Me Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="<?= bootstrapBase; ?>css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>
    <link href="<?= bootstrapBase; ?>css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="<?= bootstrapBase; ?>js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?= bootstrapBase; ?>ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= bootstrapBase; ?>ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= bootstrapBase; ?>ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="<?= bootstrapBase; ?>ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="<?= bootstrapBase; ?>ico/favicon.png">
  </head>

  <body>

    <div class="container">

      <form class="form-signin" method="post">
        <h2 class="form-signin-heading">Please sign in</h2>
        <input type="text" class="input-block-level" placeholder="Username" name="username" id="username" value="<?= $username; ?>">
        <input type="password" class="input-block-level" placeholder="Password" name="password" id="password">
<!--        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>-->
        <button class="btn btn-large btn-primary" type="submit" name="login" value="signin">Sign in</button>
      </form>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?= bootstrapBase; ?>js/jquery.js"></script>
    <script src="<?= bootstrapBase; ?>js/bootstrap-transition.js"></script>
    <script src="<?= bootstrapBase; ?>js/bootstrap-alert.js"></script>
    <script src="<?= bootstrapBase; ?>js/bootstrap-modal.js"></script>
    <script src="<?= bootstrapBase; ?>js/bootstrap-dropdown.js"></script>
    <script src="<?= bootstrapBase; ?>js/bootstrap-scrollspy.js"></script>
    <script src="<?= bootstrapBase; ?>js/bootstrap-tab.js"></script>
    <script src="<?= bootstrapBase; ?>js/bootstrap-tooltip.js"></script>
    <script src="<?= bootstrapBase; ?>js/bootstrap-popover.js"></script>
    <script src="<?= bootstrapBase; ?>js/bootstrap-button.js"></script>
    <script src="<?= bootstrapBase; ?>js/bootstrap-collapse.js"></script>
    <script src="<?= bootstrapBase; ?>js/bootstrap-carousel.js"></script>
    <script src="<?= bootstrapBase; ?>js/bootstrap-typeahead.js"></script>

  </body>
</html>
