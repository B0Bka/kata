<?php
//error_reporting(E_ERROR | E_PARSE);
$arData = [3, 5, 6];
echo('<pre>');print_r($arData);echo('</pre>');
function chop2($val, $data = [])
{
    $middle = $middleElem = round(count($data) / 2) - 1;
    if($val == $data[$middle])
        return $middle;

    $arHalf = $data;

    $res = false;
    do
    {
        if($arHalf[$middle] == $val)
            $res = $middle;
        elseif(count($arHalf) <= 1 )
            $res = -1;
        else
        {
            if($val < $arHalf[$middle])
                $arHalf = array_slice($arHalf, 0, $middleElem, true);
            else
                $arHalf = array_slice($arHalf, $middle, count($arHalf), true);
            if(count($arHalf)%2 == 0 || count($arHalf) == 1)
                $middleElem = round(count($arHalf) / 2)-1;
            else
                $middleElem = round(count($arHalf) / 2);

            $keys = array_keys($arHalf);
            $middle = $keys[$middleElem];
        }
    }while($res === false);

    return $res;
}

echo 'res : '.chop2(6, $arData);