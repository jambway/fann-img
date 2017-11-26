<?php
$d = dir('./train_img');

while ($entry = $d->read()){
    if(!is_file($entry) && $entry != '.' && $entry != '..')
    {
        echo PHP_EOL;
    }
}

$train = [
    1 => './train_img/circle',
    2 => './train_img/square',
    3 => './train_img/triangle'
];

$array = [];
$cnt = 0;
$i = 0;
foreach ($train as $key => $value) {
    $cnt = 0;
    $i = 0;
    $d = dir($value);
    while ($entry = $d->read()) {

        echo PHP_EOL;

        if(preg_match('~jpg~', $entry)) {
            $img = imagecreatefromjpeg($value . '/'. $entry);
            for ($y = 0; $y < 16; $y++) {
                for ($x = 0; $x < 16; $x++) {
                    $rgb = imagecolorat($img, $x, $y)/16777215;
                    $array[$key][$i][] = $rgb;
                    $cnt++;
                }
            }
        }
        $i++;
    }
}

$text = '';
$i = 0;
foreach ($array as $key => $value) {
    foreach ($value as $k => $v) {
        $text .= PHP_EOL;
        $text .= implode(' ', $v);
        $i++;
        if ($key == 1)
            $text .= PHP_EOL. '1 0 0';
        elseif($key == 2)
            $text .= PHP_EOL. '0 1 0';
        else
            $text .= PHP_EOL. '0 0 1';
    }
}

$in = $i . ' 256 3';

file_put_contents('./train/data.net', $in . $text);

