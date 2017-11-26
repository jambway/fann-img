<?php


$filename = './train_img/square/test.jpg';
$array = [];
$cnt = 0;
$img = imagecreatefromjpeg($filename);
for ($y = 0; $y < 16; $y++) {
    for ($x = 0; $x < 16; $x++) {
        $rgb = imagecolorat($img, $x, $y)/16777215;
        $array[$cnt] = $rgb;
        $cnt++;
    }
}

$train_file =  "./data/data.data";


$ann = fann_create_from_file($train_file);


$calc_out = fann_run($ann, $array);
print_r($calc_out);

fann_destroy($ann);
