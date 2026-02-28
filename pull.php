<?php
function execPrint($command)
{
    $result = array();
    exec($command, $result);
    foreach ($result as $line) {
        print($line . "<br>");
    }
}
// Print the exec output inside of a pre element
print("<pre>" . execPrint("git pull https://RanjeetRanjanChaubey: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@github.com/RanjeetRanjanChaubey/test.nxtgeneducation.com.git main") . "</pre>");
?>