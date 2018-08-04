<?php
	if(!isset($_SESSION['newEntry'])){
		header("location:?home");
	}
	require_once "data/config.php";
	require_once "data/history_db_access.php";
	$entry = json_encode($_SESSION['newEntry']);	
?>
<script>
	var entry = <?= $entry ?>;
    var name = '<?= $_SESSION['shopKeeper']['username']?>';
</script>
<?php
    require_once "app/view/template.html";
	require_once "app/view/confirmchanges.html";
	if($_SERVER['REQUEST_METHOD']=="POST"){
		addHistoryEntryInDb($_SESSION['newEntry']);
		unset($_SESSION['newEntry']);
?>
		<script>
			window.location = '?showhistory';
		</script>
<?php
	}
?>