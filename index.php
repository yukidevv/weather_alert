<?php
/**
* 天気情報を取得するための関数
*
*/
  function getWeatherInfo(){ 
    $baseUrl = 'https://weather.tsukumijima.net/api/forecast/city/';
    $city = '140010';
    $requestUrl = $baseUrl . $city;
    $response = file_get_contents($requestUrl);
    $data = json_decode($response,true);
    $text = '';
    $index = timeCheck();
    if($data){
      //日付
      $text .= $data['forecasts'][$index]['date'] . "の天気です。" . PHP_EOL;
      //天気
      $text .= $data['forecasts'][$index]['telop'] . "でしょう。" . PHP_EOL;
      //最高気温と最低気温
      if($data['forecasts'][$index]['temperature']['min']['celsius']){
        $text .= "最高気温は" . $data['forecasts'][$index]['temperature']['max']['celsius'] . "度で、最低気温は" . $data['forecasts'][$index]['temperature']['min']['celsius'] . "度でしょう" . PHP_EOL;
      } else {
        $text .= "最高気温は" . $data['forecasts'][$index]['temperature']['max']['celsius'] . "度でしょう" . PHP_EOL;
      }
      //お天気の詳細
      $text .= $data['description']['bodyText'] . PHP_EOL;
      return $text;
    }
  }
/**
* 現在hourから、天気情報を取得するための配列インデックスを取得する
* @return int インデックス
*/
function timeCheck(){
  $today = date("H");
  if($today>=12){
    return 1;
  }else{
    return 0;
  }
}
echo getWeatherInfo();
