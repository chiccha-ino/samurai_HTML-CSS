<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;

#初期設定
$KEYID = "4d9f5d07cd6771c6";
$COUNT = 100;
$PREF = "Z011";
$FREEWORD = "渋谷駅";
$FORMAT = "json";
$HIT_PER_PAGE = 0;

$PARAMS = array("key"=> $KEYID, "count"=>$HIT_PER_PAGE,  "large_area"=>$PREF, "keyword"=>$FREEWORD, "format"=>$FORMAT);

function write_data_to_csv($params){
    $restaurants = [["名称","営業日","住所","アクセス"]];
    $client = new Client();
    
    try{
       $json_res = $client->request('GET', "http://webservice.recruit.co.jp/hotpepper/gourmet/v1/", ['query' => $params])->getBody();
    }catch(Exception $e){
        return print("エラーが発生しました。");
    }
    
    $response = json_decode($json_res,true);    
    
    if(isset($response["results"]["error"])){
        return print("エラーが発生しました！");
    }

    foreach($response["results"]["shop"] as &$restaurant){
        $restaurant_name = $restaurant["name"];
        $restaurants[] = $restaurant_name;
    }
    $handle = fopen("restaurants_list.csv", "wb");
    fputcsv($handle,$restaurants);
    fclose($handle);
    return print_r($restaurants);
}

write_data_to_csv($PARAMS);

?>