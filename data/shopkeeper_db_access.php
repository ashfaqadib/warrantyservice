<?php
	function getShopKeepersFromDB()
	{
		$sql = "SELECT * from shopkeeper";
        $result = executeSQL($sql);
		$shopkeepers=array();
        for($i=0; $row=mysqli_fetch_assoc($result); ++$i){
            $shopkeepers[$i] = $row;
        }
        return $shopkeepers;
	}
    function addShopKepperInDb($shopkeeper){
		$sql = "INSERT INTO shopkeeper
				(username, password, shopname) 
				VALUES 
				('$shopkeeper[username]','$shopkeeper[password]','$shopkeeper[shopname]')";
        $result = executeSQL($sql);
        return $result;
	}	
    function getShopKeeperFromDbByUserName($userName){
        $sql = "select * from shopkeeper where username='$userName'";
        $result = executeSQL($sql);
        $user = mysqli_fetch_assoc($result);
        return $user;
    }	
?>