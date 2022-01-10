<?php


namespace App\Services;


use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class FileService
{
    public static function randomWalpaper()
    {
        $files = self::getWalpaperOptions();
        $index = array_rand($files, 1);
        $image = $files[$index];
        return self::getUrlForImage($image);
    }

    private static function getUrlForImage(string $image)
    {
        $chacheKey = 'walpapers_url_'. $image;
        return Cache::get($chacheKey, function () use ($image, $chacheKey) {
            $tempUrl = Storage::disk('s3')->temporaryUrl($image, now()->addHours(24));
            Cache::add($chacheKey, $tempUrl, now()->addHours(24));
            return $tempUrl;
        });
    }

    public static function getWalpaperOptions(): array
    {
        return Cache::get('walpapers_options', function () {
            $filesFromFtp = Storage::disk('s3')->files('walpapers');

            Cache::add('walpapers_options', $filesFromFtp, now()->addHours(24));
            return $filesFromFtp;
        });
    }
}
