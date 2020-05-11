<?php
$f = fopen('php://stdin', 'r');
while ($line = fgets($f))
{
    $trans = array('^' => '^ ', '=' => '+', '#' => '*', '@' => '-', '$' => ' $');
    $new = strtr($line, $trans);
    $trimmed = rtrim($new);
    $pieces = explode(" ", $trimmed);
    challenge($pieces);
}

function challenge($pieces)
{
    if (count($pieces) > 1)
    {
        $s = 0;
        $t = 0;
        for ($i = 0; $i < count($pieces); $i++) {
            if ($pieces[$i] == '$')
            {
                for ($j = 0; $j < $i; $j++)
                {
                    if ($pieces[$j] == '^')
                    {
                        $s = $j;
                    }
                }
                $t = $i;
                break 1;
            }
        }
        if (($t - $s) > 3)
        {
            $opr = $pieces[$s + 1];
            $opn1 = $pieces[$s + 2];
            $opn2 = $pieces[$s + 3];
            $res = 0;
            switch ($opr) {
                case '+':
                    $res = $opn1 + $opn2;
                    break;
                case '-':
                    $res = $opn1 - $opn2;
                    break;
                case '*':
                    $res = $opn1 * $opn2;
                    break;
            }
            $pieces[$s] = $res;
            unset ($pieces[$s + 1], $pieces[$s + 2], $pieces[$s + 3], $pieces[$s + 4]);
        }
        else
        {
            $opr = $pieces[$s + 1];
            $opn1 = 0;
            $opn2 = $pieces[$s + 2];
            $res = 0;
            switch ($opr) {
                case '+':
                    $res = $opn1 + $opn2;
                    break;
                case '-':
                    $res = $opn1 - $opn2;
                    break;
                case '*':
                    $res = $opn1 * $opn2;
                    break;
            }
            $pieces[$s] = $res;
            unset ($pieces[$s + 1], $pieces[$s + 2], $pieces[$s + 3]);
        }
        $array = array_values($pieces);
        challenge($array);
    }
    else
    {
        echo $pieces[0]."\n";
    }
}
?>
