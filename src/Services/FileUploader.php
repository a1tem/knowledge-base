<?php

namespace A1tem\KnowledgeBase\Services;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

/**
 * Class FileUploader
 *
 * @package A1tem\KnowledgeBase\Services
 * @author  Artem Petrusenko <artempetrusenko@gmail.com>
 */
class FileUploader
{
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return string
     */
    public static function save(Request $request): ?string
    {
        if ($request->hasFile('articleFile')) {
            /** @var UploadedFile $file */
            $file = $request->file('articleFile');
            if ($file->isValid()) {
                return config('app.url') . '/' . str_replace('public', 'storage', $file->store('public/images'));
            }
        }

        return null;
    }
}
