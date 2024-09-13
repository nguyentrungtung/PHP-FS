<?php

namespace App\Utils;

class FileUpload
{
    protected $uploadDir;

    public function __construct($uploadDir = 'uploads/')
    {
        $this->uploadDir = $uploadDir;
    }

    public function upload($file, $oldFile = null)
    {
        if (isset($file) && $file['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $file['tmp_name'];
            $fileName = $file['name'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            $destPath = $this->uploadDir . uniqid() . '.' . $fileExtension;

            // Di chuyển file tạm đến thư mục đích
            if (move_uploaded_file($fileTmpPath, $destPath)) {
                // Xóa file cũ nếu có
                if ($oldFile && file_exists($oldFile)) {
                    unlink($oldFile);
                }

                return $destPath;
            } 
        }

        return $oldFile; // Trả về file cũ nếu không có file mới
    }
}
