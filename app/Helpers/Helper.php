<?php

use Illuminate\Http\UploadedFile;

/**
 * Upload an image and return its path.
 *
 * @param UploadedFile $image
 * @param string $folder
 * @return string
 */
function uploadImage(UploadedFile $image, string $folder)
{
    // Tạo tên tệp duy nhất
    $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

    // Đường dẫn lưu trữ ảnh
    $destinationPath = public_path('uploads/' . $folder);

    // Tải lên tệp vào thư mục chỉ định
    $image->move($destinationPath, $filename);

    // Trả về đường dẫn URL của tệp đã tải lên
    return 'uploads/' . $folder . '/' . $filename;
}
