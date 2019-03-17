<?php
/**
 * Created by PhpStorm.
 * User: 皇阿玛
 * Date: 2019/3/1
 * Time: 11:18
 */

session_start();
header("Content-type:image/PNG");
$img = imagecreate("45","20");  //图片
$bg_color = imagecolorallocate($img,"255","255","255");  //白色
imagefill($img,"0","0",$bg_color);  //填充

$code = "";
srand((double)microtime()*1000000);   //4位数
for($i=0;$i<4;$i++){
    $font_color = imagecolorallocate($img,rand(100,255),rand(0,100),rand(100,255)); //字体颜色
    $ran_num = rand(1,9);
    $code .= $ran_num;
    imagestring($img,"5",10*$i,"5",$ran_num,$font_color);
}
$_SESSION['VCode'] = $code;

for($i=0;$i<100;$i++){     //100个像素点
    $rand_color = imagecolorallocate($img,rand(0,255),rand(0,255),rand(0,255));
    imagesetpixel($img,rand()%60,rand()%40,$rand_color);  //0-59,0-39
}
imagepng($img);
imagedestroy($img);