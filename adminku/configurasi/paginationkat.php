<?php
function paginate_one($reload, $page, $tpages) {
	$id = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_GET['tags']);  

	$firstlabel = "&laquo;&nbsp;";
	$prevlabel  = "&lsaquo;&nbsp;";
	$nextlabel  = "&nbsp;&rsaquo;";
	$lastlabel  = "&nbsp;&raquo;";
	$out = "<center><ul class=\"pagination\">";
	if($page>1) {
		$out.= "<li><a href=".MY_PATH."news/kategori/".$id.">" . $firstlabel . "</a></li>";
	}
	else {
		$out.= "<li><span>" . $firstlabel . "</span></li>";
	}
	if($page==1) {
		$out.= "<li><span>" . $prevlabel . "</span></li>";
	}
	elseif($page==2) {
		$out.= "<li><a href=".MY_PATH."news/kategori/".$id.">" . $prevlabel . "</a></li>";
	}
	else {
		$out.= "<li><a href=\"" . $reload . "" . ($page-1) . "\">" . $prevlabel . "</a></li>";
	}
	$out.= "<li><span class=\"current\">Page " . $page . " of " . $tpages ."</span></li>";
	if($page<$tpages) {
		$out.= "<li><a href=\"" . $reload . "" .($page+1) . "\">" . $nextlabel . "</a></li>";
	}
	else {
		$out.= "<li><span>" . $nextlabel . "</span></li>";
	}
	
	if($page<$tpages) {
		$out.= "<li><a href=\"" . $reload . "" . $tpages . "\">" . $lastlabel . "</a></li>";
	}
	else {
		$out.= "<li><span>" . $lastlabel . "</span></li>";
	}	
	$out.= "</ul></center>";	
	return $out;
}
?>