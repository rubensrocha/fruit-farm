<?php
@error_reporting(E_ALL ^ E_NOTICE);
@ini_set('display_errors', true);
@ini_set('html_errors', false);
@ini_set('error_reporting', E_ALL ^ E_NOTICE);

function clean_url ($url) {

  if ($url == '') return;

  $url = str_replace("http://", "", $url);
  if (strtolower(substr($url, 0, 4)) == 'www.')  $url = substr($url, 4);
  $url = explode('/', $url);
  $url = reset($url);
  $url = explode(':', $url);
  $url = reset($url);

  return $url;
}

if (clean_url($_SERVER['HTTP_REFERER']) != clean_url($_SERVER['HTTP_HOST'])) return;

session_start();
$font=imagecreatefrompng("fonts/font.png");

imagealphablending($font, true);
$fontfile_width=imagesx($font);
$fontfile_height=imagesy($font)-1;
$font_metrics=array();
$symbol=0;
$reading_symbol=false;

$alphabet = "0123456789";
$alphabet_length = strlen($alphabet);

for($i=0;$i<$fontfile_width && $symbol<$alphabet_length;$i++){
    $transparent = (imagecolorat($font, $i, 0) >> 24) == 127;

    if(!$reading_symbol && !$transparent){
        $font_metrics[$alphabet{$symbol}]=array('start'=>$i);
        $reading_symbol=true;
        continue;
    }

    if($reading_symbol && $transparent){
        $font_metrics[$alphabet{$symbol}]['end']=$i;
        $reading_symbol=false;
        $symbol++;
        continue;
    }
}

$image = imagecreatetruecolor(165,60);
$width = ImageSX($image);
$height = ImageSY($image);

imagealphablending($image, true);

$background_color = array(247,247,247);
$foreground_color = array(70,70,70);

$white=imagecolorallocate($image, 255, 255, 255);
$black=imagecolorallocate($image, 128, 128, 0);

imagefilledrectangle($image, 0, 0, ImageSX($image)-1, ImageSY($image)-1, $white);

$string = '';
$x = 5;
$y = 5;

for ($i=0;$i<6;$i++) {
    $char = rand(0,9);
    $string .= $char;
    if ($x > 15) $x = $x - 2;
    imagecopy($image,$font,$x,$y,$font_metrics[$char]['start'],1,$font_metrics[$char]['end']-$font_metrics[$char]['start'],42);
    $x += $font_metrics[$char]['end']-$font_metrics[$char]['start'];
}

for ($i=0;$i<10;$i++) {
    ImageSmoothAlphaLine($image,Rand(5,$width*0.5),Rand(5,$height-5),rand($width*0.5,$width-5),rand(5,$height-5),255,255,255);
}

for ($i=0;$i<2;$i++) {
    ImageSmoothAlphaLine($image,rand(5,10),Rand(5,$height-5),rand($width-10,$width-5),rand(5,$height-5),0,0,0);
}

$center=$x/2;

$img2=imagecreatetruecolor(ImageSX($image), ImageSY($image));


$rand1=mt_rand(750000,1200000)/10000000;
$rand2=mt_rand(750000,1200000)/10000000;
$rand3=mt_rand(750000,1200000)/10000000;
$rand4=mt_rand(750000,1200000)/10000000;

$rand5=mt_rand(0,3141592)/500000;
$rand6=mt_rand(0,3141592)/500000;
$rand7=mt_rand(0,3141592)/500000;
$rand8=mt_rand(0,3141592)/500000;

$rand9=mt_rand(330,420)/110;
$rand10=mt_rand(330,450)/110;


for($x=0;$x<ImageSX($image);$x++){
    for($y=0;$y<ImageSY($image);$y++){
        $sx=$x+(sin($x*$rand1+$rand5)+sin($y*$rand3+$rand6))*$rand9-$width/2+$center+1;
        $sy=$y+(sin($x*$rand2+$rand7)+sin($y*$rand4+$rand8))*$rand10;
        if($sx<0 || $sy<0 || $sx>=$width-1 || $sy>=$height-1){
            $color=255;
            $color_x=255;
            $color_y=255;
            $color_xy=255;
        }else{
            $color=imagecolorat($image, $sx, $sy) & 0xFF;
            $color_x=imagecolorat($image, $sx+1, $sy) & 0xFF;
            $color_y=imagecolorat($image, $sx, $sy+1) & 0xFF;
            $color_xy=imagecolorat($image, $sx+1, $sy+1) & 0xFF;
        }
        if($color==0 && $color_x==0 && $color_y==0 && $color_xy==0){
            $newred=$foreground_color[0];
            $newgreen=$foreground_color[1];
            $newblue=$foreground_color[2];
        }else if($color==255 && $color_x==255 && $color_y==255 && $color_xy==255){
            $newred=$background_color[0];
            $newgreen=$background_color[1];
            $newblue=$background_color[2];
        }else{
            $frsx=$sx-floor($sx);
            $frsy=$sy-floor($sy);
            $frsx1=1-$frsx;
            $frsy1=1-$frsy;
            $newcolor=(
                $color*$frsx1*$frsy1+
                $color_x*$frsx*$frsy1+
                $color_y*$frsx1*$frsy+
                $color_xy*$frsx*$frsy);

            if($newcolor>255) $newcolor=255;

            $newcolor=$newcolor/255;
            $newcolor0=1-$newcolor;
            $newred=$newcolor0*$foreground_color[0]+$newcolor*$background_color[0];
            $newgreen=$newcolor0*$foreground_color[1]+$newcolor*$background_color[1];
            $newblue=$newcolor0*$foreground_color[2]+$newcolor*$background_color[2];
        }
        imagesetpixel($img2, $x, $y, imagecolorallocate($img2, $newred, $newgreen, $newblue));
    }
}
$_SESSION['captcha'] = $string;


header("content-type: image/png");
imagepng($img2);

imagedestroy($img2);

function ImageSmoothAlphaLine ($image, $x1, $y1, $x2, $y2, $r, $g, $b, $alpha=0) {
  $icr = $r;
  $icg = $g;
  $icb = $b;
  $dcol = imagecolorallocatealpha($image, $icr, $icg, $icb, $alpha);

  if ($y1 == $y2 || $x1 == $x2)
    imageline($image, $x1, $y2, $x1, $y2, $dcol);
  else {
    $m = ($y2 - $y1) / ($x2 - $x1);
    $b = $y1 - $m * $x1;

    if (abs ($m) <2) {
      $x = min($x1, $x2);
      $endx = max($x1, $x2) + 1;

      while ($x < $endx) {
        $y = $m * $x + $b;
        $ya = ($y == floor($y) ? 1: $y - floor($y));
        $yb = ceil($y) - $y;

        $trgb = ImageColorAt($image, $x, floor($y));
        $tcr = ($trgb >> 16) & 0xFF;
        $tcg = ($trgb >> 8) & 0xFF;
        $tcb = $trgb & 0xFF;
        imagesetpixel($image, $x, floor($y), imagecolorallocatealpha($image, ($tcr * $ya + $icr * $yb), ($tcg * $ya + $icg * $yb), ($tcb * $ya + $icb * $yb), $alpha));

        $trgb = ImageColorAt($image, $x, ceil($y));
        $tcr = ($trgb >> 16) & 0xFF;
        $tcg = ($trgb >> 8) & 0xFF;
        $tcb = $trgb & 0xFF;
        imagesetpixel($image, $x, ceil($y), imagecolorallocatealpha($image, ($tcr * $yb + $icr * $ya), ($tcg * $yb + $icg * $ya), ($tcb * $yb + $icb * $ya), $alpha));

        $x++;
      }
    } else {
      $y = min($y1, $y2);
      $endy = max($y1, $y2) + 1;

      while ($y < $endy) {
        $x = ($y - $b) / $m;
        $xa = ($x == floor($x) ? 1: $x - floor($x));
        $xb = ceil($x) - $x;

        $trgb = ImageColorAt($image, floor($x), $y);
        $tcr = ($trgb >> 16) & 0xFF;
        $tcg = ($trgb >> 8) & 0xFF;
        $tcb = $trgb & 0xFF;
        imagesetpixel($image, floor($x), $y, imagecolorallocatealpha($image, ($tcr * $xa + $icr * $xb), ($tcg * $xa + $icg * $xb), ($tcb * $xa + $icb * $xb), $alpha));

        $trgb = ImageColorAt($image, ceil($x), $y);
        $tcr = ($trgb >> 16) & 0xFF;
        $tcg = ($trgb >> 8) & 0xFF;
        $tcb = $trgb & 0xFF;
        imagesetpixel ($image, ceil($x), $y, imagecolorallocatealpha($image, ($tcr * $xb + $icr * $xa), ($tcg * $xb + $icg * $xa), ($tcb * $xb + $icb * $xa), $alpha));

        $y ++;
      }
    }
  }
}

?>