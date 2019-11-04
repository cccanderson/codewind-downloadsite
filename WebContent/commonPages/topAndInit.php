


<table border=0 cellpadding=0 width="100%">
	<tr>
		<td width="35%"><?php echo $indexTop; ?></td>
		<td width="25%" align="right"><a
			href="http://www.eclipse.org/codewind/"><img border="0"
			src="../commonPages/codewind-logo.svg" /></a></td>
	</tr>
</table>

<!-- heading end -->


<hr />
<table border=0 cellpadding=2 width="70%" align="center">
	<tr>
		<td><?php echo $pageExplanation; ?></td>
	</tr>
</table>

<?php

if (!isset($dlconfigfilename)) {
   $dlconfigfilename='dlconfig.txt'; 
}

$contents = substr(file_get_contents($dlconfigfilename),0,-1);
$contents = str_replace("\n", "", $contents);

#split the content file by & and fill the arrays
$elements = explode("&",$contents);
$t = 0;
$p = 0;
for ($c = 0; $c < count($elements); $c++) {
	$tString = "dropType";
	$pString = "dropPrefix";
	if (strstr($elements[$c],$tString)) {
		$temp = preg_split("/=/",$elements[$c]);
		$dropType[$t] = trim($temp[1]);
		$t++;
	}
	if (strstr($elements[$c],$pString)) {
		$temp = preg_split("/=/",$elements[$c]);
		$dropPrefix[$p] = trim($temp[1]);
		$p++;
	}
}

// debug
// echo "Debug: droptype count: ", count($dropType), "<br />";

for ($i = 0; $i < count($dropType); $i++) {
	$dt = $dropType[$i];
	$dt = trim($dt);
	$typeToPrefix[$dt] = $dropPrefix[$i];

	//   echo "Debug prefix: ", $dropPrefix[$i], "<br />";
	//   echo "Debug dropType: ", $dropType[$i], "<br />";

}


include 'report.php';
include 'report2.php';
$latestTimeStamp=array();
$latestFile = array();
$buckets = array();
$timeStamps = array();

function computeBuildName($longname) {
	$majorParts = explode("/", $longname);
	$nParts = sizeof($majorParts);
	if ($nParts > 1) {
		$innerValueParts = explode("-", $majorParts[$nParts-1]);
	}
	else {
		$innerValueParts = explode("-", $longname);
	}
	return $innerValueParts[1];
}
function computeStreamName($longname) {
	$majorParts = explode("/", $longname);
	$nParts = sizeof($majorParts);
	if ($nParts > 1) {
		// a format such as "drops/R3.0"
		$name = $majorParts[1];
		
	}
	else {
		// a format such as "wtp-R3.0-I"
		$majorParts = explode("-", $longname);
//		$name = $majorParts[1];
		$name = $majorParts[0]."-".$majorParts[1];
	}
	return $name;
}
?>
