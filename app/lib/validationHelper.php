<?php    
    function isValidUserName($userName){
        $parts = explode(" ", $userName);
        $isValid = false;
		if(count($parts)==1)
		{
			if(preg_match('/^[a-zA-Z0-9]+/',$userName)){
				$isValid = true;
			}
		}
        return $isValid;
    }
	function isValidShopName($name){
		if($name=="") return false;
		else return true;
    }
	function isValidPassword($password)
	{
		if(strlen($password)<8) return false;
		else return true;
	}
    function isMatchingPassword($userName){
        $parts = explode(" ", $userName);
        $isValid = false;
		if(count($parts)==1)
		{
			if(preg_match('/^[a-zA-Z0-9]+/',$userName)){
				$isValid = true;
			}
		}
        return $isValid;
	}	
    function isValidPhoneNo($phone){
        $parts = explode(" ", $phone);
        $isValid = false;
		if(count($parts)==1)
		{
			if(preg_match('/^[0-9]+/',$phone)){
				$isValid = true;
				if(strlen($phone)<11) return false;
			}
		}
        return $isValid;
    }		
?>