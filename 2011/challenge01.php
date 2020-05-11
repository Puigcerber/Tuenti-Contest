<?php
$f = fopen('php://stdin', 'r');
while ($line = fgets($f))
{
    $tok = strtok($line, " \n\t\r");
    $n = $tok;
    while ($tok !== false)
    {
        $tok = strtok(" \n\t\r");
        $n = bcadd($n, $tok);
    }
    echo $n . "\n";
}
?>
