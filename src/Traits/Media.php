<?php

declare(strict_types=1);

namespace Aboleon\Framework\Traits;

use MediaManager\MediaManager;
use MediaManager\MediaUploader;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Media
{

    public string $uploadPath;
    public string $uploadDir;
    public array $uploadParams;
    protected $uploaded_file;
    protected string $uploaded_type;
    protected $uploaded_file_config;
    protected $uploaded_filename;

    public bool $has_gallery = false;
    public array $gallery = [
        'label' => 'Médias',
        'cols' => 'auto',
        'fields' => [
            'image' => [
                'label' => 'Ajouter une image',
                'size' => ['w' => 1920, 'h' => null],
                'acceptable' => '/(\.|\/)(gif|jpe?g|png)$/i',
                'type' => 'fileupload'
            ],
            'video' => [
                'label' => 'Vidéo',
                'placeholder' => 'Lien de la vidéo',
                'info' => "Copiez/collez simplement le lien d'une video disponible sur Youtube, Vimeo, DailyMotion, Vine ou Kickstarter.<br><strong>Exemple :</strong> <em>https://www.youtube.com/watch?v=cq9bBqjknAY</em> ou <em>https://youtu.be/cq9bBqjknAY</em>"
            ],
        ],
    ];
    public bool $has_images = false;
    public array $image_collection = [
        'image_base' => [
            'label' => 'Illustration',
            'size' => ['w' => 560, 'h' => 440],
            'jcrop'
        ]
    ];


    public function medias(): MorphMany
    {
        return $this->morphMany(MediaManager::class, 'media');
    }

    public function checkMakeDir(string $directory = ''): void
    {
        if (!is_dir($this->uploadPath . $directory)) {
            mkdir($this->uploadPath . $directory, (int)0755, true);
        }
    }

    public function processMedia()
    {
        if ($this->has_images) {
            foreach ($this->image_collection as $image_key => $values) {
                (new MediaManager)->uploadMedia($this, $image_key, $this->image_collection[$image_key]);
                if (request()->has('media_description_' . $image_key) && (request()->has('_method') && request()->_method == 'put')) {
                    $this->medias->where('type', $image_key)->first()->update(['description' => request()->{'media_description_' . $image_key}]);
                }
            }
            session()->flash('processed_images', true);
        }
    }

    public function showThumbnail(string $type, int $height=60)
    {
        $img = $this->medias->where('type', $type)->first();
        return '<img style="height:'.$height.'px;" class="th_img" src="'.asset((!is_null($img) ? $this->uploadParams['dir'] . 'th_' . $img->content : 'images/th_default.png') . '" alt="' . $this->title ).'"/>';

    }

}
