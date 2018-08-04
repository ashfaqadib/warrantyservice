<?php
	if(isset($_SESSION['shopKeeper'])){
		header("location:?home");
	}
	require_once "data/config.php";
	require_once "data/shopkeeper_db_access.php";
    require_once "app/lib/validationHelper.php";
    require_once "app/view/login.html";
    
    $userNameError = "";
    $passwordError = "";
    if($_SERVER['REQUEST_METHOD']=="POST")
    {
        $isMatched = true;
		$shopKeeper['userName'] = trim($_POST['userName']);
        $shopKeeper['password'] = trim($_POST['password']);
        $user = getShopKeeperFromDbByUserName($shopKeeper['userName']);
        if($user!=NULL)
        {
            $password = hash("md5", $shopKeeper['password']);
            if($user['password']==$password)
            {
                $_SESSION['shopKeeper'] = $user;
?>
            <script>
                window.location = '?home';
            </script>
<?php
            }
            else
            {
                $passwordError = "*Incorrect password!";
            }
        }
        else
        {
            $userNameError = "*No such user found!";
        }
?>
		<script>
			document.getElementsByName("userName")[0].value = "<?=$_POST['userName']?>";
		</script>
<?php
    }
?>
<script>
	var obj1 = document.getElementsByName("userNameError")[0];
	var obj2 = document.getElementsByName("passwordError")[0];
	obj1.innerHTML = "<?=$userNameError?>";
	obj2.innerHTML = "<?=$passwordError?>";
</script>