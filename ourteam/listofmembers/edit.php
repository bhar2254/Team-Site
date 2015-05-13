<?php
session_start();
$authorized = false;
if(isset($_SESSION['auth']))
{
    $authorized = true;
}
if(isset($_SESSION['username']))
{
    $username = $_SESSION['username'];
}
$username;
//$password;
if(isset($_GET['loginpage']))
{
    if($_POST['login'] == "Login")
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        if($username == "team1764" && $password=="first1764!")
        {
            $_SESSION['auth'] = true;
            $_SESSION['username'] = $username;
            
            $authorized = true;
            ?>
<p>Access Granted</p>
<a href="edit.php">Edit Page</a>
            <?php
        }
 else {
     session_destroy();
      ?>
<p>Access Denied</p>
<a href="?loginpage">
    Login Page
</a>
      <?php
 }
        
    }
 else {
        ?>
<form id="loginform" name="loginform" method="post">
    <div>
        <label>Username:</label> <input type="text" name="username" id="username" value="<?= $username; ?>" /> <br />
        <label>Password: </label> <input type="password" name="password" id="password" value="" /> <br />
        <button name="login" type="submit" value ="Login">Sign In</button>
    </div>
</form>
        <?php
        
    }
    exit();
}
else
{
    $htmlPg = file_get_contents('listofmembers.php');
    if($authorized)
    {
        if($_POST['savepage'] == "Update")
        {
            $htmlIn = $_POST['rawHTML'];
            //We will write to the file.
            echo "Saved to File";
            echo " <a href=\"index.php\">View Page</a>";
            echo "<br /><br /><br />";
            echo $htmlIn;
            file_put_contents('listofmembers.php', $htmlIn);
        }
        else
        {
            ?>
<!DOCTYPE html >
<html>
    <head>
        <title>Edit Page</title>
        <script type="text/javascript" id="ckeditor" src="/ckeditor/ckeditor.js"></script>
        <script type="text/javascript">
            
        </script>

    </head>
    <body>
<form id="editForm" name="editForm" class="ckeditor" method="post" action="edit.php">
    <label>Html</label><br />
    <textarea name="rawHTML" id="rawHTML"><?= $htmlPg; ?></textarea>
    <br />
    <button type="submit" name="savepage" id="savepage" value="Update">Update</button>
</form>

    </body>
</html>
            <?php
        }
    }
    else
    {
        echo "Access Denied Login <a href=\"edit.php?loginpage\">Login</a>";
    }
}
?>
