<?php
$f = fopen('php://stdin', 'r');
while ($line = trim(fgets($f)))
{
    $pieces = explode(" ", $line);
    $num = $pieces[0];
    $truck = $pieces[1];
    $cows = explode(",", $pieces[2]);
    $milk = explode(",", $pieces[3]);
    echo knapSolve($cows, $milk, $num-1, $truck)."\n";
}

function knapSolve($w, $v, $i, $aW)
{
    global $numcalls;
    $numcalls ++;

    if ($i == 0)
    {
        if ($w[$i] <= $aW)
        {
            return $v[$i];
        }
        else
        {
            return 0;
        }
    }

    $without_i = knapSolve($w, $v, $i-1, $aW);
    if ($w[$i] > $aW)
    {
        return $without_i;
    } 
    else
    {
        $with_i = $v[$i] + knapSolve($w, $v, ($i-1), ($aW - $w[$i]));
        return max($with_i, $without_i);
    }
}
?>
