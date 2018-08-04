<?php
	require_once "data/config.php";
	require_once "data/product_db_access.php";
	require_once "data/history_db_access.php";
	require_once "app/lib/validationHelper.php";
?>
<script>
    var name = '<?=$_SESSION['shopKeeper']['username']?>';
</script>
<?php
    require_once "app/view/template.html";
	require_once "app/view/replaceproduct.html";
	$uniqueIdError = "";
	if($_SERVER['REQUEST_METHOD']=="POST")
	{		
		$isValidInput=true;
		$newEntry['uniqueId'] = $_POST["uniqueId"];

		if($newEntry['uniqueId']!="")
		{
			$entries = getHistoryEntriesByUniqueIdFromDB($newEntry['uniqueId']);
			if(count($entries)!=0)
			{
				$date1 = date_create(date('d-m-Y'));
				$date2 = date_create($entries[0]['expiry_date']);
				$diff=date_diff($date1,$date2);
				if($diff->format("%R%a days")>0)
				{
					$entries[0]['replace_date'] = date('d-m-Y');
					$entries[0]['status'] = "Replaced";
					$_SESSION['newEntry'] = $entries[0];
?>
					<script>
						window.location = '?confirmchanges';
					</script>
<?php
				}
				else
				{
					$uniqueIdError = "*The warranty of the product has been expired!";
				}
			}
			else
			{
				$uniqueIdError = "*No entry found with that Unique ID in history!";
			}
		}
		else
		{
			$uniqueIdError = "*Please enter the Unique ID of the product!";
		}
    }
?>
<script>
	var obj1 = document.getElementsByName("uniqueIdError")[0];
	obj1.innerHTML = "<?=$uniqueIdError?>";
</script>