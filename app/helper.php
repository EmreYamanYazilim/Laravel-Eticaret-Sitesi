<?php

// silme bölümü
if (!function_exists('dosyasil')) {
    function dosyasil($string)
    {
        if (file_exists($string)) {
            if (!empty($string)) {
                unlink($string);
            }
        }
    }

}

// Resim yükleme functionu

if (!function_exists('resimyukle')) {
    function resimyukle($image,$name,$yol)
    {
        $uzanti     = $image->getClientOriginalExtension();
        $dosyaadi = time() . '-' . Str::slug($name);
        if ($uzanti == 'pdf' || $uzanti == 'svg' || $uzanti == 'webp' || $uzanti == 'jiff') {
            $image->move(public_path($yol), $dosyaadi . '.' . $uzanti);
        }else{
            $image = ImageResize::make($image);
            $image->encode('webp', 75)->save($yol . $dosyaadi . '.webp');
            $imageurl = $yol . $dosyaadi . '.webp';
        }
        return $imageurl;
    }
}

// limit
if (!function_exists('strLimit')) {
    function strLimit($text, $limit, $url = null)
    {
        if ($url == null) {
            $end = '...';
        }else{
            $end = '<a class="ml-2" href="'.$url.'">[...]</a>';
        }
        return Str::limit($text, $limit, $end);

    }

}

//klasör açma

if (!function_exists('klasorac')) {
    function klasorac($dosyayol, $izinler = 0777) {
        if (!file_exists($dosyayol)) {
            mkdir($dosyayol,$izinler, true);
        }
    };
}
