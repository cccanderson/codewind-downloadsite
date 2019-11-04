
<?php

$filename = "$innerValue/compilelogsSummary.xml";
$prefixForVariable = "code_";
$compileSummary = simplexml_load_file($filename);
foreach ($compileSummary->summaryItem as $summaryItem) {
    $name = $summaryItem->name;
    $value = $summaryItem->value;
    $code= "\$" . $prefixForVariable . $name . " = " . $value . ";";
    //echo "<br />code: " . $code;
    eval($code);
}

$filename = "$innerValue/testcompilelogsSummary.xml";
if (file_exists($filename)) {
    $prefixForVariable = "test_";
    $compileSummary = simplexml_load_file($filename);
    foreach ($compileSummary->summaryItem as $summaryItem) {
        $name = $summaryItem->name;
        $value = $summaryItem->value;
        $code= "\$" . $prefixForVariable . $name . " = " . $value . ";";
        //echo "<br />code: " . $code;
        eval($code);
    }
} else {
    $test_totalErrors = 0;
    $test_totalBundles = 0;
    $test_totalforbiddenAccessWarningCount = 0;
    $test_totaldiscouragedAccessWarningCount = 0;
}

$filename = "$innerValue/unitTestsSummary.xml";
if (file_exists("$filename")) {
    $prefixForVariable = "unittest_";
    $unitTestsSummary = simplexml_load_file($filename);
    foreach ($unitTestsSummary->summaryItem as $summaryItem) {
        $name = $summaryItem->name;
        $value = $summaryItem->value;
        $code= "\$" . $prefixForVariable . $name . " = " . $value . ";";
        // echo "<br />code: " . $code;
        eval($code);
    }
}
else {
    unset($unittest_grandTotalErrors, $unittest_grandTotalTests);
}

$totalCommpileErrors = $code_totalErrors + $test_totalErrors;
$totalCompileOtherWarnings = $code_totalWarnings;
$totalBundles = $code_totalBundles + $test_totalBundles;
$totalForbidden = $code_totalforbiddenAccessWarningCount + $test_totalforbiddenAccessWarningCount;
$totalDiscouraged = $code_totaldiscouragedAccessWarningCount + $test_totaldiscouragedAccessWarningCount;

echo "<td width=\"6%\">($totalBundles)</td>";
echo "<td width=\"6%\"><img src=\"../commonPages/compile_err.gif\" width=\"16\" height=\"16\"/><font color=red>$totalCommpileErrors</font></td>";
echo "<td width=\"6%\"><img src=\"../commonPages/compile_warn.gif\" width=\"16\" height=\"16\"/><font color=orange>$totalCompileOtherWarnings</font></td>";
echo "<td width=\"6%\"><img src=\"../commonPages/access_err.gif\" width=\"16\" height=\"16\"/><font color=red>$totalForbidden</font></td>";
echo "<td width=\"6%\"><img src=\"../commonPages/access_warn.gif\" width=\"16\" height=\"16\"/><font color=orange>$totalDiscouraged</font></td>";

if (isset($unittest_grandTotalErrors)) {
    echo "<td width=\"6%\"><img src=\"../commonPages/junit_err.gif\" width=\"16\" height=\"16\"/><font color=red>$unittest_grandTotalErrors</font></td>";
    echo "<td width=\"6%\">($unittest_grandTotalTests)</td>";
}
else {
    echo "<td width=\"6%\"><img src=\"../commonPages/pending.gif\" width=\"16\" height=\"16\"/></td>";
    echo "<td width=\"6%\"><img src=\"../commonPages/pending.gif\" width=\"16\" height=\"16\"/></td>";
}


?>