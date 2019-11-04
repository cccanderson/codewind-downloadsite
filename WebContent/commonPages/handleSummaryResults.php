<?php
// if compilelogsSummary.xml exists, assume the "new way" (summary in xml file).
// else, assume old way
//echo "drops/$bValue/$innerValue/compilelogsSummary.xml";
if (file_exists("$innerValue/compilelogsSummary.xml"))
{
    include 'compileLogSumaryXML.php';
}
// if compileResults.php exists, assume the "new way" (testResults and compileResult seperated).
// else, assume old way
else if (file_exists("$innerValue/compileResults.php"))
{
    include 'parse2Handling.php';
}
else {
    include 'parseHandling.php';
}
?>