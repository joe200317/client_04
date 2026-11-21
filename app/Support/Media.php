<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Media
{
    public static function disk(): string
    {
        return (string) config('filesystems.media_disk', 's3');
    }

    public static function store(UploadedFile $file, string $directory): string
    {
        return $file->store($directory, [
            'disk' => self::disk(),
        ]);
    }

    public static function delete(?string $path): void
    {
        if ($path === null || $path === '') {
            return;
        }

        Storage::disk(self::disk())->delete($path);
    }

    public static function url(?string $path): ?string
    {
        if ($path === null || $path === '') {
            return null;
        }

        if (self::disk() === 's3') {
            return self::s3Url($path);
        }

        return Storage::disk(self::disk())->url($path);
    }

    private static function s3Url(string $path): string
    {
        $bucket = (string) config('filesystems.disks.s3.bucket');
        $region = (string) config('filesystems.disks.s3.region', 'us-east-1');
        $path = ltrim($path, '/');

        $base = $region === 'us-east-1'
            ? "https://{$bucket}.s3.amazonaws.com"
            : "https://{$bucket}.s3.{$region}.amazonaws.com";

        return $base.'/'.$path;
    }
}
