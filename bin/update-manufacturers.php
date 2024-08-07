<?php
$content = file_get_contents('https://en.wikibooks.org/wiki/Vehicle_Identification_Numbers_(VIN_codes)/World_Manufacturer_Identifier_(WMI)');
preg_match('/<table class="wikitable x".*?>.*<tbody>(.*?)<\/tbody><\/table>/is', $content, $matches);
$db = [];
preg_match_all('/<tr>(.*?)<\/tr>/is', $matches[1], $trMatches);
foreach ($trMatches[1] as $i => $trMatch) {
    if ($i === 0) continue;
    preg_match_all('/<td.*?>(.*?)<\/td>/is', $trMatch, $tds);
    $db[trim($tds[1][0])] = trim(strip_tags($tds[1][1]));
//    var_dump($tds[1]); die;
//    $manufacturer = count($tds[1]) === 3 ? $tds[1][2] : $tds[1][1];
/*    if (preg_match('/<a.*?>(.*?)<\/a>/is', $manufacturer, $manufacturerMatches)) {*/
//        $manufacturer = $manufacturerMatches[1];
//    }
//    $vinStarts = preg_replace('/\R+/', ' ', $tds[1][0]);
//    $vinStarts = preg_replace('/ .*/', ' ', $vinStarts);
//    $db[strval($vinStarts)] = preg_replace('/\R+/', ' ', strip_tags($manufacturer));

}
var_export($db);
