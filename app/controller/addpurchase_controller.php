<?php
	require_once "data/config.php";
	require_once "data/product_db_access.php";
	require_once "data/history_db_access.php";
	require_once "app/lib/validationHelper.php";
	$productsNames = json_encode(getAllProductsNamesFromDB());	
?>
<script>
	var productsNames = <?= $productsNames ?>;
    var name = '<?=$_SESSION['shopKeeper']['username']?>';
</script>
<?php
    require_once "app/view/template.html";
	require_once "app/view/addpurchase.html";
	$uniqueIdError = "";
	$productNameError = "";
	$customerPhoneError = "";

	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		$isValidInput=true;

		$newEntry['unique_id'] = $_POST["uniqueId"];
		$newEntry['name_of_product'] = $_POST["productName"];
		$newEntry['customer_phone'] = $_POST["customerPhone"];
		$newEntry['purchase_date'] = date('d-m-Y');
		$newEntry['expiry_date'] = "";
		$newEntry['replace_date'] = "";
		$newEntry['status'] = "Start Warranty";

		if($newEntry['unique_id']=="")
		{
			$uniqueIdError = "*Please insert a valid Unique ID.";
			$isValidInput=false;
		}
		if($newEntry['name_of_product']=="")
		{
			$productNameError = "*Please insert a valid Product Name.";
			$isValidInput=false;
		}
		if(!isValidPhoneNo($newEntry['customer_phone']))
		{
			$customerPhoneError = "*Please insert a valid Phone Number.";
			$isValidInput=false;
		}

		if($isValidInput)
		{
			$product = getProductFromDBByName($newEntry['name_of_product']);
			if($product!=NULL)
			{
				$entries = getHistoryEntriesByUniqueIdFromDB($newEntry['unique_id']);
				if(count($entries)==0)
				{
					$years = intval($product['validity_in_years']);
					$months = intval(( $product['validity_in_years'] - $years ) * 12); //e.g. for 1.5 years: 1.5-1 = 0.5 * 12 = 6 months
					$date = strtotime(date('d-m-Y'));;
					$date = strtotime('+'.$years.' years', $date);
					$date = strtotime('+'.$months.' months', $date);
					$newEntry['expiry_date'] = date('d-m-Y',$date);
					$_SESSION['newEntry'] = $newEntry;
?>
					<script>
						window.location = '?confirmchanges';
					</script>
<?php
				}
				else
				{
					$uniqueIdError = "*Can not make entry since the Unique ID already exists in database.";
				}
			}
			else
			{
				$productNameError = "*No product found with that name!";
			}
		}
?>
		<script>
			document.getElementsByName("uniqueId")[0].value = "<?=$_POST['uniqueId']?>";
			document.getElementsByName("productName")[0].value = "<?=$_POST['productName']?>";
			document.getElementsByName("customerPhone")[0].value = "<?=$_POST['customerPhone']?>";
		</script>
<?php
	}
?>
<script>
	var productsNames = <?= $productsNames ?>;
	var obj1 = document.getElementsByName("uniqueIdError")[0];
	var obj2 = document.getElementsByName("productNameError")[0];
	var obj3 = document.getElementsByName("customerPhoneError")[0];
	obj1.innerHTML = "<?=$uniqueIdError?>";
	obj2.innerHTML = "<?=$productNameError?>";
	obj3.innerHTML = "<?=$customerPhoneError?>";
</script>
