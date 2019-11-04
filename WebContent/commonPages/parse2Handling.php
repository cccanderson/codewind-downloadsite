<?php
$testResults = parse2_testResults("$innerValue/testResults.php");
list ($junitFailures) = $testResults;

$compileResults = parse2_compileResults("drops/$bValue/$innerValue/compileResults.php");
list ($compileErrors, $compileAccessWarnings, $compileOtherWarnings) = $compileResults;
$testCompileResults = parse2_compileResults("drops/$bValue/$innerValue/testCompileResults.php");
list ($testCompileErrors, $testCompileAccessWarnings, $testCompileOtherWarnings) = $testCompileResults;

$totalCommpileErrors = $compileErrors + $testCompileErrors;
// we'll just use code for warnning summaries, for now
$totalAccessWarnings = $compileAccessWarnings;
$totalCompileOtherWarnings = $compileOtherWarnings;

echo "<td width=\"6%\">&nbsp;</td>";
echo "<td width=\"6%\"><img src=\"../commonPages/compile_err.gif\" width=\"16\" height=\"16\"/><font color=red>$totalCommpileErrors</font></td>";
echo "<td width=\"6%\"><img src=\"../commonPages/compile_warn.gif\" width=\"16\" height=\"16\"/><font color=orange>$totalCompileOtherWarnings</font></td>";
if ($junitFailures < 0) {
echo "<td width=\"6%\"><img src=\"../commonPages/pending.gif\" width=\"16\" height=\"16\"/><font color=red>&nbsp;</font></td>";
}
else {
echo "<td width=\"6%\"><img src=\"../commonPages/junit_err.gif\" width=\"16\" height=\"16\"/><font color=red>$junitFailures</font></td>";
}

?>