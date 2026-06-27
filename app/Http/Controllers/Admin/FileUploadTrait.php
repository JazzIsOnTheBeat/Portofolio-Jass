<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait FileUploadTrait
{
    /**
     * Upload a file and return its path
     */
    protected function uploadFile(Request $request, string $fieldName, string $directory = 'uploads'): ?string
    {
        if ($request->hasFile($fieldName)) {
            $file = $request->file($fieldName);
            // generate unique name
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            // store file
            return $file->storeAs($directory, $filename, 'public');
        }
        return null;
    }

    /**
     * Upload multiple files and return paths
     */
    protected function uploadMultipleFiles(Request $request, string $fieldName, string $directory = 'uploads'): array
    {
        $paths = [];
        if ($request->hasFile($fieldName)) {
            foreach ($request->file($fieldName) as $file) {
                $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $paths[] = $file->storeAs($directory, $filename, 'public');
            }
        }
        return $paths;
    }

    /**
     * Delete a file from storage
     */
    protected function deleteFile(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
