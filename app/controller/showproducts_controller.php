<?php
	require_once "data/config.php";
	require_once "data/product_db_access.php";

    $products = json_encode(getAllProductsFromDB());
?>
<script>
    var products = <?=$products?>;
    var name = '<?=$_SESSION['shopKeeper']['username']?>';
</script>
<?php
    require_once "app/view/template.html";
    require_once "app/view/showproducts.html";
?>