<?php

namespace App\Actions\GlobalActions;

class UploadImage
{
    static function upload()
    {
        if (request()->hasFile('image')) {
            return request()->file('image')->store('storage', 'public');
        }
    }
}
