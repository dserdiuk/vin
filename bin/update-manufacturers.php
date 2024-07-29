<?php
$content = file_get_contents('https://en.wikipedia.org/wiki/Vehicle_identification_number#List_of_common_WMI');
preg_match('/<table class="wikitable sortable">.*?<tbody>(.*?)<\/tbody><\/table>/is', $content, $matches);
$db = [];
preg_match_all('/<tr>(.*?)<\/tr>/is', $matches[1], $trMatches);
foreach ($trMatches[1] as $i => $trMatch) {
    if ($i === 0) continue;
//    var_dump($trMatch); die;
    preg_match_all('/<td.*?>(.*?)<\/td>/is', $trMatch, $tds);
    $manufacturer = count($tds[1]) === 3 ? $tds[1][2] : $tds[1][1];
    if (preg_match('/<a.*?>(.*?)<\/a>/is', $manufacturer, $manufacturerMatches)) {
        $manufacturer = $manufacturerMatches[1];
    }
    $vinStarts = preg_replace('/\R+/', ' ', $tds[1][0]);
    $vinStarts = preg_replace('/ .*/', ' ', $vinStarts);
    $db[strval($vinStarts)] = preg_replace('/\R+/', ' ', strip_tags($manufacturer));

}
var_export($db);
