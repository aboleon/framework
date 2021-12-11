<?php

namespace Aboleon\Framework\Models;

use Aboleon\Framework\Interfaces\FileUploadImageInterface;
use Aboleon\Framework\Traits\Responses;
use Illuminate\Support\Str;
use Request as Input;
use Illuminate\Http\Request;

abstract class FileUploadImages
{

    use Responses;

    protected $path;

    protected object $image;
    protected array $default_dims = [
        [
            'width' => 1920,
            'height' => 1080
        ],
        [
            'width' => 400,
            'height' => null
        ]
    ];
    protected array $dims = [];
    protected string $mime_type;
    protected string $random_filename;


    public function __construct()
    {
        $this->dims = $this->default_dims;
        $this->random_filename = Str::random(6);
    }

    /*
    |--------------------------------------------------------
    | Traitements ajax
    |--------------------------------------------------------
    */
    public function ajax(): static
    {
        $this->path = request('aboleon_accesskey') . '/';
        switch (request('case')) {
            case 'crop':
                $this->processCrop();
                break;
            case 'delete':
                $this->processDelete();
                break;
            case 'upload':
                $this->processUpload();
                break;
        }

        $this->response['input'] = request()->input();
        $this->response['file'] = request('file');

        return $this;
    }

}