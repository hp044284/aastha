<?php
namespace App\Traits;
use Illuminate\Support\Facades\File;
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
}

