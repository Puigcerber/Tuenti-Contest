<?php
ini_set('memory_limit', '1024M');
$zip = zip_open("in.zip");
$zip_entry = zip_read($zip);
$tasks = array();
$depen = array();
if (zip_entry_open($zip, $zip_entry, "r"))
{
    $file = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
    $tok = strtok($file, "\n\t\r");
    if ($tok == "#Number of tasks")
    {
        $n = strtok("\n\t\r");
    }
    $tok = strtok("\n\t\r");
    if ($tok == "#Task duration")
    {
        for ($i = 0; $i < $n; $i++)
        {
            $tok = strtok("\n\t\r");
            $dur = strstr($tok, ',');
            $tasks[$i] = substr($dur, 1);
        }
    }
    $tok = strtok("\n\t\r");
    if ($tok == "#Task dependencies")
    {
        while ($tok !== false)
        {
            $tok = strtok("\n\t\r");
            $a = explode(",", $tok);
            $depen[$a[0]] = array_slice($a, 1);
        }
    }
}

$f = fopen('php://stdin', 'r');
$line = fgets($f);
$input = explode(",", $line);
foreach ($input as $value)
{
    echo $value." ".duration($value)."\n";
}

function duration($value)
{
    global $tasks;
    global $depen;
    $dur = $tasks[$value];

    if (array_key_exists($value, $depen))
    {
        $dep = $depen[$value];
        if (count($dep) > 1)
        {
            $max = 0;
            foreach ($dep as $d)
            {
                if ( ($du = duration($d)) > $max )
                {
                    $max = $du;
                }
            }
            $dur = $dur + $max;
        }
        else
        {
            $dur = $dur + duration($dep[0]);
        }
    }
    return $dur;
}

?>
