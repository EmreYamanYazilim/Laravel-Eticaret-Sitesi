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
