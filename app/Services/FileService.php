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
        return env('FTP_HTTP_URL') . $image;
    }

    public static function getWalpaperOptions(): array
    {
        return Cache::get('walpapers_ftp', function () {
            $filesFromFtp = Storage::disk('ftp')->files('walpapers');
            Cache::add('walpapers_ftp', $filesFromFtp, now()->addHours(24));
            return $filesFromFtp;
        });
    }
}
