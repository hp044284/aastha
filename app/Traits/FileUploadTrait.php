<?php
namespace App\Traits;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait FileUploadTrait
{
    /**
     * Handle file upload and deletion of old file.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string $inputName The input name for the file
     * @param  string $uploadPath The directory where the file will be uploaded
     * @param  string|null $oldFileName The current file name (for deletion, if exists)
     * @return string The new file name after uploading
     */
    public function handleFileUpload($request, $inputName, $uploadPath, $oldFileName = null)
    {
        // Check if a new file is uploaded
        if ($request->hasFile($inputName) && $request->file($inputName)->isValid())
        {
            $Request_File = $request->file($inputName);
            // Delete old file if it exists
            if ($oldFileName)
            {
                $this->deleteFile($uploadPath, $oldFileName);
            }
            // Generate a new file name and move the file to the destination folder
            $fileName = $Request_File->hashName();
            $destinationPath = public_path($uploadPath);
            $Request_File->move($destinationPath, $fileName);

            return $fileName;
        }

        return null; // Return null if no file was uploaded
    }

    public function deleteFile($uploadPath, $fileName)
    {
        $publicPath = public_path($uploadPath . $fileName);
        if (!empty($fileName) && File::exists($publicPath))
        {
            @unlink($publicPath); // Delete the old file
        }
    }

    /**
     * Handle file upload and deletion of old file using Laravel Storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string $inputName The input name for the file
     * @param  string $uploadPath The directory (relative to storage/app/public) where the file will be uploaded
     * @param  string|null $oldFileName The current file name (for deletion, if exists)
     * @return string|null The new file name after uploading, or null if no file uploaded
     */
    public function storeUploadedFile($request, array $params)
    {
        // Expected keys in $params: inputName, uploadPath, oldFileName (optional)

        $inputName   = $params['inputName']   ?? null;
        $uploadPath  = $params['uploadPath']  ?? 'uploads';
        $oldFileName = $params['oldFileName'] ?? null;

        if ($inputName && $request->hasFile($inputName) && $request->file($inputName)->isValid()) {
            $Request_File = $request->file($inputName);

            // Delete old file if it exists
            if ($oldFileName) 
            {
                $this->deleteFileWithStorage($uploadPath, $oldFileName);
            }

            // Store file
            $filePath = $Request_File->store($uploadPath, 'public');
            return $filePath; // returns e.g. uploads/testimonials/filename.ext
        }

        return null;
    }


    /**
     * Delete a file from storage/app/public using Laravel Storage.
     *
     * @param string $uploadPath The directory (relative to storage/app/public)
     * @param string $fileName The file name to delete
     * @return void
     */
    public function deleteFileWithStorage($uploadPath, $fileName)
    {
        if (!empty($fileName)) {
            $filePath = trim($fileName);
            Storage::disk('public')->delete($filePath);
        }
    }

}

