<?php
$f = fopen('php://stdin', 'r');
while ($line = fgets($f))
{
    $input[] = trim($line);
}
$sort = $input;
array_push($sort, '12');
sort($sort);
$sum = 0;
$output = array();
for ($i = 1; $i < count($sort); $i++)
{
    $a = get_emirps_sum($sort[$i - 1], $sort[$i]);
    $sum = $a + $sum;
    $output[$sort[$i]] = $sum;
}
for ($i = 0; $i < count($input); $i++)
{
    echo $output[$input[$i]]."\n";
}

function get_emirps_sum($j, $n)
{
    $a = 0;
    for ($i = $j; $i <= $n; $i++)
    {
        if (is_odd($i))
        {
            if (is_prime($i))
            {
                $r = strrev($i);
                if ($r != $i)
                {
                    if (is_odd($r))
                    {
                        if (is_prime($r))
                        {
                            $a = $a + $i;
                        }
                    }
                }
            }
        }
    }
    return $a;
}

function is_prime($num)
{
    for ($i = 3; $i * $i <= $num; $i = $i + 2) {
        if ($num % $i == 0)
        {
            return false;
        }
    }
    return true;
}

function is_odd($num)
{
    if ($num % 2 == 0)
    {
        return false;
    }
    else
    {
        return true;
    }
}
?>
