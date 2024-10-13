<?php

namespace App\Traits;

use App\Models\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait Mediable
{
    public function images()
    {
        return $this->morphMany(Image::class, 'mediable');
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'mediable');
    }

    public function getMainImageAttribute()
    {
        return $this->images()->where('is_main', true)->first();
    }

    public function addMedia(UploadedFile $media, string $directory, bool $isMain = true, string $type = 'photo')
    {
        $this->image()->create([
            'path' => $media->store($directory),
            'is_main' => $isMain,
            'extension' => $media->extension(),
            'size' => $media->getSize(),
            'type' => $type,
        ]);

        return $this;
    }

    public function addManyMedia(array $mediaData, string $directory, string $type = 'photo')
    {
        foreach ($mediaData as $media) {
            $this->addMedia(media: $media['image'], directory: $directory, isMain: $media['is_main'], type: $type);
        }
    }

    public function updateMedia(UploadedFile $media, string $directory, string $type = 'photo')
    {
        Storage::delete($this->image->path);
        $this->image()->update([
            'path' => $media->store($directory),
            'is_main' => true,
            'extension' => $media->extension(),
            'size' => $media->getSize(),
            'type' => $type,
        ]);

        return $this;
    }

    public function replaceMedia($media, string $directory = '', string $type = 'photo')
    {
        if ($media instanceof UploadedFile) {
            return $this->updateMedia($media, explode('/', $this->image->path)[0], $this->image->type);
        }

        $this->images()->each(function ($image) {
            Storage::delete($image->path);
            $image->delete();
        });
        $this->addManyMedia($media, $directory, $type);

        return $this;
    }

    public function removeMedia()
    {
        if ($this->images()->count() > 1) {
            foreach ($this->images as $image) {
                Storage::delete($image->path);
            }
            $this->images()->delete();
            return $this;
        }

        Storage::delete($this->image->path);
        $this->image()->delete();

        return $this;
    }
}
