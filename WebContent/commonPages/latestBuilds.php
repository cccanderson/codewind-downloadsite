<?php

$debugLatest=false;

if (!function_exists("computeMainData")) {
    include 'computeMainData.php';
}

computeMainData($buildBranches, $debugLatest);

echo "<table border=0 cellpadding=2 width=\"100%\"><tr>";
echo "<td align=\"center\" bgcolor=\"#0080C0\"><font color=\"#FFFFFF\" face=\"Arial,Helvetica\">";
echo $mainTableHeader;
echo "</font></td>";
echo "</tr></table>";


?>


<table width="70%" align="center" cellpadding=2>
	<tr>
		<td width="25%"><b>Build Type</b></td>
		<td width="25%"><b>Build Name</b></td>
		<td width="15%"><b>Stream</b></td>
		<td width="40%"><b>Build Date</b></td>
	</tr>



	<?php
	foreach($dropType as $value) {
	    $prefix=$typeToPrefix[$value];

	    foreach($buildBranches as $bValue) {

	        if (array_key_exists ($bValue, $latestFile) && array_key_exists($prefix, $latestFile[$bValue])) {
	            $fileName = $latestFile[$bValue][$prefix];
                //echo "Debug: anEntry (filename) indexing timeStamps: ", $fileName, " <br />";
	            echo "<tr>";
	            echo "<td width=\"25%\">$value</td>";

                $buildName=computeBuildName($fileName);
	            $streamName=computeStreamName($bValue);
	            if (sizeof($buildName) > 0) {
	                echo "<td  width=\"25%\"><a href=\"$fileName/\">$buildName</a></td>";
	                echo "<td width=\"15%\">$streamName</td>";
	                echo "<td width=\"40%\">$timeStamps[$fileName]</td>";
	                echo "</tr>";
	            }
	        }
	    }
	}
	?>

</table>
