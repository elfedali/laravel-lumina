<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Encoders\AutoEncoder;
use Intervention\Image\ImageManager;

trait UploadTrait
{
    /**
     * Handles file uploads, including image resizing and optimization.
     *
     * @param Request $request The request object.
     * @param string $fieldName The name of the file input field.
     * @param string $path The storage path for the uploaded file.
     * @param int|null $resizeWidth The width to resize the image to (optional).
     * @param int|null $quality The image quality (for Jpeg).
     * @param string|null $existingFile The path to an existing file to delete (optional).
     * @return string|null The path to the uploaded file, or null if no file was uploaded.
     */
    protected function upload(Request $request, string $fieldName, string $path, int $resizeWidth = null, int $quality = 90, string $existingFile = null): ?string
    {
        if (!$request->hasFile($fieldName)) {
            return $existingFile ?? null; // Return existing file if no new upload
        }

        if ($existingFile) {
            $this->deleteFile($existingFile); // Delete old file if updating
        }

        $file = $request->file($fieldName);
        $year = date('Y');
        $month = date('m');
        $filePath = $path . "/{$year}/{$month}/" . uniqid() . '.' . $file->getClientOriginalExtension(); // Maintain original extension

        if ($resizeWidth) {
            $manager = new ImageManager(new \Intervention\Image\Drivers\Gd\Driver());
            $image = $manager->read($file)->resize($resizeWidth, $resizeWidth, function ($constraint) {
                $constraint->aspectRatio();
            });

            Storage::disk('public')->put(
                $filePath,
                $image->encode(new AutoEncoder(quality: $quality))

            );
        } else {
            Storage::disk('public')->put($filePath, $file);
        }

        return $filePath;
    }

    /**
     * Deletes a file from storage.
     * @param string $path
     */
    protected function deleteFile(string $path): void
    {
        try {
            Storage::disk('public')->delete($path);
        } catch (\Exception $e) {
            // Log error or handle silently
            \Log::error("Error deleting file: " . $e->getMessage()); // Example logging
        }
    }
}
