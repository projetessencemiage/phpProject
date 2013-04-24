<?php
require_once 'application/inc/declarations.inc.php';
$body = 'listestations.body.php';

$script = '
<!-- fonctions jquery.tablesorter pour le tri du tableau --> 
<script type="text/javascript">
	$(function() {		
		$("#tablesorter-demo").tablesorter({sortList:[[4,0],[5,1]], widgets: [\'zebra\']});
		$("#options").tablesorter({sortList: [[0,0]], headers: { 3:{sorter: false}, 4:{sorter: false}}});
	});	
</script>
<script  type="text/javascript" src="./js/ListeStations.js"></script>
';

echo Structure::getHeader($script);
echo Structure::getBody($body);
?>