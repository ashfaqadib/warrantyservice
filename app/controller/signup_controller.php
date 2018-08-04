<?php
	if(isset($_SESSION['shopKeeper'])){
		header("location:?home");
	}
	require_once "data/config.php";
	require_once "data/shopkeeper_db_access.php";
	require_once "app/lib/validationHelper.php";
	require_once "app/view/signup.html";

	$userNameError = "";
	$passwordError = "";
	$confirmPasswordError = "";
	$shopNameError = "";
	
	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		$isValidInput = true;
		$shopKeeper['username'] = trim($_POST['userName']);
		$shopKeeper['password'] = trim($_POST['password']);
		$shopKeeper['shopname'] = trim($_POST['shopName']);
		$shopKeeper['confirmPassword'] = trim($_POST['confirmPassword']);
		if(!isValidUserName($shopKeeper['username']))
		{
			$userNameError="*User name must not be empty and can only contain letters or numbers!";
			$isValidInput = false;
		}
		if(!isValidPassword($shopKeeper['password']))
		{
			$passwordError="*Password must be at least 8 characters long!";
			$isValidInput = false;
		}
		if(!isValidShopName($shopKeeper['shopname']))
		{
			$shopNameError="*Shop name cannot be empty!";
			$isValidInput = false;
		}
		if($shopKeeper['password']!=$shopKeeper['confirmPassword'])
		{
			$confirmPasswordError="*Password not matched!";
			$isValidInput = false;
		}
		if($isValidInput)
		{
			if(getShopKeeperFromDbByUserName($shopKeeper['username'])!=NULL)
			{
				$userNameError="*There is already an user with this user name!";
				$isValidInput = false;
			}
			else
			{
				$shopKeeper['password'] = hash("md5",$shopKeeper['password']);
				addShopKepperInDb($shopKeeper);
				$_SESSION['shopKeeper'] = $shopKeeper;
?>
				<script>
					window.location = '?home';
				</script>
<?php
			}
		}
?>
		<script>
			document.getElementsByName("userName")[0].value = "<?=$_POST['userName']?>";
			document.getElementsByName("password")[0].value = "<?=$_POST['password']?>";
			document.getElementsByName("shopName")[0].value = "<?=$_POST['shopName']?>";
		</script>
<?php
	}
?>
<script>
	var obj1 = document.getElementsByName("userNameError")[0];
	var obj2 = document.getElementsByName("passwordError")[0];
	var obj3 = document.getElementsByName("shopNameError")[0];
	var obj4 = document.getElementsByName("confirmPasswordError")[0];
	obj1.innerHTML = "<?=$userNameError?>";
	obj2.innerHTML = "<?=$passwordError?>";
	obj3.innerHTML = "<?=$shopNameError?>";
	obj4.innerHTML = "<?=$confirmPasswordError?>";
</script>