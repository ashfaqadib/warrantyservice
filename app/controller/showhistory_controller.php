<?php
	require_once "data/config.php";
	require_once "data/history_db_access.php";

    $entries = json_encode(getAllHistoryEntriesFromDB());
?>
<script>
    var entries = <?=$entries?>;
    var name = '<?=$_SESSION['shopKeeper']['username']?>';
</script>
<?php
    require_once "app/view/template.html";
    require_once "app/view/showhistory.html";
?>