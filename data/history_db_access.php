<?php
	function getAllHistoryEntriesFromDB()
	{
		$sql = "SELECT * from history ORDER BY sl DESC";
        $result = executeSQL($sql);
		$entries=array();
        for($i=0; $row=mysqli_fetch_assoc($result); ++$i){
            $entries[$i] = $row;
        }
        return $entries;
    }
	function getRecentHistoryEntriesFromDB()
	{
		$sql = "SELECT * FROM history ORDER BY sl DESC LIMIT 10";
        $result = executeSQL($sql);
		$entries=array();
        for($i=0; $row=mysqli_fetch_assoc($result); ++$i){
            $entries[$i] = $row;
        }
        return $entries;
    }    
	function getHistoryEntriesByUniqueIdFromDB($uId)
	{
        $sql = "select * from history where unique_id='$uId'";
        $result = executeSQL($sql);
		$entries=array();
        for($i=0; $row=mysqli_fetch_assoc($result); ++$i){
            $entries[$i] = $row;
        }
        return $entries;
    }    
    function addHistoryEntryInDb($entry){
		$sql = "INSERT INTO history
				(unique_id, name_of_product, customer_phone,purchase_date,expiry_date,replace_date,status) 
				VALUES 
				('$entry[unique_id]','$entry[name_of_product]','$entry[customer_phone]','$entry[purchase_date]','$entry[expiry_date]',
                '$entry[replace_date]','$entry[status]')";
        $result = executeSQL($sql);
        return $result;
    }    

?>