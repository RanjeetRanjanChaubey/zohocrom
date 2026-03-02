<?php
$secret = "x9T!vL2#pQ8@rK7$wM5z";
if (!isset($_GET['key']) || $_GET['key'] !== $secret) {
    http_response_code(403);
    exit("Access Denied");
}

// ===== Git Pull Function =====
function execPrint($command)
{
    $result = [];
    exec($command . " 2>&1", $result);
    foreach ($result as $line) {
        echo $line . "<br>";
    }
}

// ===== Run Git Pull =====
echo "<pre>";
execPrint("git pull origin main");
echo "</pre>";
?>