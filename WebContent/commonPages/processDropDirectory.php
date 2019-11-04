<?php
// echo "Debug: yes, counted parts was 3<br />";
$buildTypePart = $entryParts[0];
$buckets[$buildBranch][$buildTypePart][] = $aDropDirectoryName;
// if ($debugScript) {
//echo "Debug: Started processDropDirectory with following <br />";
//echo "    buildBranch: $buildBranch <br />"; 
//echo "    buildTypePart: $buildTypePart <br />";
//echo "    anEntry: $anEntry <br />";
// }

$timePart = $entryParts[2];
$year = substr($timePart, 0, 4);
$month = substr($timePart, 4, 2);
$day = substr($timePart, 6, 2);
$hour = substr($timePart,8,2);
$minute = substr($timePart,10,2);

$newTimePart = "$year-$month-$day $hour:$minute UTC";

$timeStamp = strtotime($newTimePart);

$timeStamps[$buildBranch."/".$artifactTimeStamp.$anEntry] = gmdate("D, j M Y -- H:i  \(\U\T\C\)", $timeStamp);
//echo "Debug: anEntry indexing timeStamps: ", $buildBranch."/".$artifactTimeStamp.$anEntry, "<br />";
// debug
//  echo "<br />buildBranch:  $buildBranch <br />";
//  echo "<br />parts[0]:  -$buildTypePart- <br />";
//  echo "latestTimeStamp[buildBranch]:";
//  echo $latestTimeStamp[$buildBranch];
//  echo "latestTimeStamp:";
//  echo $latestTimeStamp;

if ((sizeof($latestTimeStamp[$buildBranch]) > 0) &&
(isset($latestTimeStamp[$buildBranch][$buildTypePart])))
{
	if ($timeStamp > $latestTimeStamp[$buildBranch][$buildTypePart])
	{
		$latestTimeStamp[$buildBranch][$buildTypePart] = $timeStamp;
		$latestFile[$buildBranch][$buildTypePart] = $aDropDirectoryName;
	}
}
else
{
	$latestTimeStamp[$buildBranch][$buildTypePart] = $timeStamp;
	$latestFile[$buildBranch][$buildTypePart] = $aDropDirectoryName;

}
?>