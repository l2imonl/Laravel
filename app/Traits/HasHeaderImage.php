<?php
namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasHeaderImage
{
    /**
     * Update header image.
     *
     * @param  \Illuminate\Http\UploadedFile  $photo
     * @return void
     */
    public function updateHeadingImage(UploadedFile $photo)
    {
        tap($this->heading_image_path, function ($previous) use ($photo) {
            $this->forceFill([
                'heading_image_path' => $photo->storePublicly(
                    'post-header', ['disk' => $this->headerImageDisk()]
                ),
            ])->save();

            if ($previous) {
                Storage::disk($this->headerImageDisk())->delete($previous);
            }
        });
    }

    /**
     * Get the URL to the heading image.
     *
     * @return string
     */
    public function getHeaderImageUrlAttribute()
    {
        return $this->heading_image_path
            ? Storage::disk($this->headerImageDisk())->url($this->heading_image_path)
            : $this->defaultHeadingImagUrl();
    }

    /**
     * Get the default heading image URL if no heading image has been uploaded.
     *
     * @return string
     */
    protected function defaultHeadingImagUrl()
    {
        return '/storage/0' . rand(1,5) . '.jpg';
    }

    /**
     * Get the disk that heading image should be stored on.
     *
     * @return string
     */
    protected function headerImageDisk()
    {
        return 'public';
    }
}
