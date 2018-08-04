<?php
	function getAllProductsFromDB()
	{
		$sql = "SELECT * from product_details";
        $result = executeSQL($sql);
		$products=array();
        for($i=0; $row=mysqli_fetch_assoc($result); ++$i){
            $products[$i] = $row;
        }
        return $products;
    }
	function getAllProductsNamesFromDB()
	{
		$sql = "SELECT * from product_details";
        $result = executeSQL($sql);
		$productsNames=array();
        for($i=0; $row=mysqli_fetch_assoc($result); ++$i){
            $productsNames[$i] = $row['name'];
        }
        return $productsNames;
    }    
	function getProductFromDBByName($name)
	{
        $sql = "select * from product_details where name='$name'";
        $result = executeSQL($sql);
        $product = mysqli_fetch_assoc($result);
        return $product;
    }    
?>