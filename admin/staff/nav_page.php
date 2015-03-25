<?php
$_self = $_SERVER['PHP_SELF'];
$paging = ceil ($numrows / $limit);
if ($display > 1) {
	$previous = $display - 1;
	printf("<a href=\"%s?show=%s&category_id=%s&Sort_by=%s\" class=\"page-numbers\">&laquo;</a>", $_self, $previous, $category_id, $Sort_by);
}
if ($numrows != $limit) {
	if ($paging > $scroll) {	// remove this to get rid of the scroll feature
		if($_GET['show'] != ""){ $first = $_GET['show']; }else{ $first = "1"; } ; //New
		$last = ($scroll - 1) + $_GET['show'];
	} else {
		$first = 1;
		$last = $paging;
	}// REMOVE THIS TO GET RID OF THE SCROLL FEATURE
	if ($last > $paging ) {
		$first = $paging - ($scroll - 1);
		$last = $paging;
	}
		for ($i = $first;$i <= $last;$i++){
			if ($display == $i)
				echo "<span class=\"page-numbers current\">$i</span>";
			else
				printf("<a href=\"%s?show=%s&category_id=%s&Sort_by=%s\" class=\"page-numbers\">%s</a>", $_self, $i, $category_id, $Sort_by, $i);
		}
	}
	if ($display < $paging) {
		$next = $display + 1;
		printf("<a href=\"%s?show=%s&category_id=%s&Sort_by=%s\" class=\"page-numbers\">&raquo;</a>", $_self, $next, $category_id, $Sort_by);
	}
?>
