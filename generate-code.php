<?php
session_start();
//生成验证码图片
header("Content-type: image/png");
// 全数字
$str = "1,2,3,4,5,6,7,8,9,A,B,C,D,E,F,G,H,J,K,L,M,N,P,R,S,T,U,V,W,X,Y,Z";      //要显示的字符，可自己进行增删
$list = explode(",", $str);
$cmax = count($list) - 1;
$verifyCode = '';
for ( $i=0; $i < 4; $i++ ){
      $randnum = mt_rand(0, $cmax);
      $verifyCode .= $list[$randnum];           //取出字符，组合成为我们要的验证码字符
}
$_SESSION['code'] = $verifyCode;        //将字符放入SESSION中
  
$im = imagecreate(80,36);    //生成图片
$black = imagecolorallocate($im, 0,0,0);     //此条及以下三条为设置的颜色
$white = imagecolorallocate($im, 255,255,255);
$gray = imagecolorallocate($im, 240,240,240);
$red = imagecolorallocate($im, 255, 0, 0);
$green = imagecolorallocate($im, 0, 255, 0);
$blue = imagecolorallocate($im, 0, 0, 255);
imagefill($im,0,0,$gray);     //给图片填充颜色

for($i=0;$i<2;$i++)  //加入干扰象素
{
     imageline($im, rand(0, 80) , rand(0, 36) ,rand(0, 80) , rand(0, 36) , $red);    //加入线条状干扰素
     imageline($im, rand(0, 80) , rand(0, 36) ,rand(0, 80) , rand(0, 36) , $green);    //加入线条状干扰素
     imageline($im, rand(0, 80) , rand(0, 36) ,rand(0, 80) , rand(0, 36) , $blue);    //加入线条状干扰素
	 imageline($im, rand(0, 80) , rand(0, 36) ,rand(0, 80) , rand(0, 36) , $white);    //加入线条状干扰素

}

//将验证码绘入图片
ImageTTFText($im, 15, rand(-30, 30), 5, 27, $black, "/Library/Fonts/Chalkduster.ttf", $verifyCode[0]);
ImageTTFText($im, 15, rand(-30, 30), 23, 27, $black, "/Library/Fonts/Chalkduster.ttf", $verifyCode[1]);
ImageTTFText($im, 15, rand(-30, 30), 41, 27, $black, "/Library/Fonts/Chalkduster.ttf", $verifyCode[2]);
ImageTTFText($im, 15, rand(-30, 30), 59, 27, $black, "/Library/Fonts/Chalkduster.ttf", $verifyCode[3]);
  
for($i=0;$i<100;$i++)  //加入干扰象素
{
     imagesetpixel($im, rand(0, 80) , rand(0, 36) , $black);    //加入点状干扰素
     imagesetpixel($im, rand(0, 80) , rand(0, 36) , $red);
     imagesetpixel($im, rand(0, 80) , rand(0, 36) , $blue);
}

imagepng($im);
imagedestroy($im);
?>