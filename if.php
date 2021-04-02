<?php
$even_num = [];
$odd_num = [];

function sort_number($num){
    global $even_num, $odd_num;
    $i =10;
    while($num <= $i){
        if($num % 2 == 0){
            array_push($even_num,$num);
        }elseif($num % 2 == 1){
            array_push($odd_num,$num);
        }
        $num++;
    }
    foreach($odd_num as $value_o){
        print $value_o;
    }
    foreach($even_num as $value_e){
        print $value_e;
    }
}
sort_number(1);

?>