
<?php
$testResults = parse_testResult("$innerValue/testResults.php");
list ($compileErrors, $compileWarnings, $junitFailures) = $testResults;

echo "<td width=\"6%\">&nbsp;</td>";
echo "<td width=\"6%\"><img src=\"../commonPages/compile_err.gif\" width=\"16\" height=\"16\"/><font color=red>$compileErrors</font></td>";
echo "<td width=\"6%\"><img src=\"../commonPages/compile_warn.gif\" width=\"16\" height=\"16\"/><font color=orange>$compileWarnings</font></td>";
echo "<td width=\"6%\"><img src=\"../commonPages/junit_err.gif\" width=\"16\" height=\"16\"/><font color=red>$junitFailures</font></td>";

?>