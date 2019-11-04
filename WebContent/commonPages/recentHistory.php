

<?php

$debugRecentHistory=false;

if (!isset($buckets) || !function_exists("computeMainData")) {
    include 'computeMainData.php';
    computeMainData($buildBranches, $debugRecentHistory);
}

?>

<table border="0" cellpadding="2" width="100%">
  <tr>
    <td align="center" bgcolor="#999999"><font color="#FFFFFF"
      face="Arial,Helvetica">
      <?php 
        echo "$subsectionHeading"; 
      ?>
      </font></td>
  </tr>
</table>

<?php

foreach($dropType as $value) {
    $prefix=$typeToPrefix[$value];

    if ($debugRecentHistory) {
        echo "dropType value: $value <br />";
        echo "prefix: $prefix <br />";
    }

    echo "<table width=\"100%\" cellpadding=2>
            <tr bgcolor=\"#999999\">
            <td align=left colspan=\"11\">
            <a name=\"$prefix\">
            <font color=\"#FFFFFF\" face=\"Arial,Helvetica\">";
    echo "$value";
    echo "</font></a></td>";
    echo "</tr>";

    echo "<tr>
            <td width=\"13%\">Build Name</td>
            <td width=\"8%\">Stream</td>
            <td width=\"20%\">Build Date</td>
            <td colspan=\"8\">&nbsp;</td>
          </tr>";

    if ($debugRecentHistory) {
        echo "buildBranches: <br />";
        foreach($buildBranches as $tempbuildBranches) {
            echo "$tempbuildBranches <br />";
        }
        echo "buckets: <br />";
        if (isset($buckets)) {
            foreach($buckets as $tempbuckets) {
                foreach($tempbuckets as $tempbucket) {
                    foreach ($tempbucket as $oneTempBucket) {
                        echo "onetempBucket: $oneTempBucket <br />";
                    }
                }
            }
        }
    }

    foreach($buildBranches as $bValue) {
        if ($debugRecentHistory) {
            echo "loop through each buildBranch: $bValue <br />";
            echo "isset(\$buckets): " . isset($buckets). "<br />";
        }
        if (isset($buckets) && array_key_exists($bValue, $buckets) && array_key_exists($prefix, $buckets[$bValue]))
        //&& $buckets[$bValue] != NULL && array_key_exists($prefix, $buckets[$bValue]))
        {
            if ($debugRecentHistory) {
                echo "in loop<br />";
            }
            echo "<tr><td colspan=\"11\"><hr/></td></tr>";
            $aBranchBucket = $buckets[$bValue][$prefix];
            if (isset($aBranchBucket)) {
                rsort($aBranchBucket);
                if ($debugRecentHistory) {
                    echo "buckets in this branch: <br />";
                    foreach($aBranchBucket as $tempBucket) {
                        echo "$tempBucket <br />";
                    }
                }

                foreach($aBranchBucket as $innerValue) {
                    //if ($debugRecentHistory) {
                       // echo "Debug recentHistory: innerValue: $innerValue <br />";
                    //}
                    $buildName = computeBuildName($innerValue);
                    $streamName = computeStreamName($bValue);
                    
                    echo "<tr>";
                    echo "<td width=\"13%\"><a href=\"$innerValue/\">$buildName</a></td>";
                    echo "<td width=\"8%\">$streamName</td>";
                    echo "<td width=\"20%\">$timeStamps[$innerValue]</td>";
                    echo "<td>&nbsp;</td>";
                    // our recent summary results handling requires php 5 (for simple xml file loading)
                    // so, if not php 5, just don't display any summary results
                    // This was found to be required, since some mirror our whole site (e.g. IBM) and not all their
                    // mirrors use PHP 5
                    if (phpversion() >= 5) {
                        include 'handleSummaryResults.php';
                    }
                    echo "</tr>";
                }
            }
        }
    }
    echo "</table>";

}
?>

<table border="0" cellpadding="2" width="100%">
	<tr>
		<td bgcolor="#999999">&nbsp;</td>
	</tr>
</table>
