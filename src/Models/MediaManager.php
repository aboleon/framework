<?php declare(strict_types=1);

namespace Aboleon\Framework\Models;

use File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Image;
use App\Traits\{
    Media,
    Responses};

class MediaManager extends Model
{
    use Responses;
    use Media;

    public $timestamps = false;
    protected $table = 'media_content';
    protected $guarded = [];

    public function media(): MorphTo
    {
        return $this->morphTo();
    }

    protected function remove_image(): void
    {
        $this->deleteImages();
    }


    public function uploadMedia(object $object, string $filename, array $config): void
    {
        if (request()->hasFile($filename)) {
            $media = new MediaUploader();
            $media->newUploadedFile($filename);
            $media->staticUpload($object, $config);

            $this->insertRecord($object, $media->fetchResponse());

        }
        if (request()->has($filename . '_jcrop_confirm')) {
            (new MediaUploader())->jcrop();
        }

    }

    protected function remove_document(): void
    {
        $key = $this->getAccessKey(Pages::find($this->editable->pages_id));
        $this->response['page_id'] = $this->editable->pages_id;
        $this->response['accessKey'] = $key;
        $this->response['path_delete'] = $this->uploadPath . $key . '/documents/' . $this->editable->content;
        File::delete($this->uploadPath . $key . '/documents/' . $this->editable->content);
    }

    protected function deleteImages(): void
    {
        $page = Pages::find($this->editable->pages_id);
        File::delete(File::glob($this->uploadPath . $this->getAccessKeyWithSeparator($page) . 'images' . DIRECTORY_SEPARATOR . '*' .
            str_replace('.jpg', '*', $this->editable->content)));
    }

    public function description(string $lang = ''): object
    {
        if (empty($lang)) {
            $lang = app()->getLocale();
        }

        return $this->descriptions()->where('lg', $lang);
    }

    public function descriptions(): object
    {
        return $this->hasMany(MediaDescription::class, 'media_content_id');
    }

    public function http(string $resource): string
    {
        return asset('upload/' . $resource);
    }

    public function getAccessKey(Pages $page)
    {
        $this->accessKey($page);
        return $page->access_key;
    }

    public function getAccessKeyWithSeparator(Pages $page, $separator = null)
    {
        $this->accessKey($page);
        return $this->withAccessKey($separator);
    }

    public function removeAttachedMedia(Pages $page)
    {
        if (is_null($page)) {
            return;
        }

        $media = self::where('pages_id', $page->id)->get();

        $images = $media->filter(function ($val) {
            return $val->type == 'image';
        });

        $documents = $media->filter(function ($val) {
            return $val->type == 'document';
        });

        $accessKey = $this->getAccessKeyWithSeparator($page);

        if (!$images->isEmpty()) {
            foreach ($images as $image) {
                File::delete(File::glob($this->uploadPath . '/' . $accessKey . 'images' . DIRECTORY_SEPARATOR . '*' . str_replace
                    (['.jpg', '.png'], '',
                        $image->content) . '*'));
            }
        }

        if (!$documents->isEmpty()) {
            foreach ($documents as $document) {
                File::delete(File::glob($this->uploadPath . '/' . $accessKey . 'documents/' . $accessKey . '*' . str_replace(['.pdf'], '', $document->content) . '*'));
            }
        }

        if (str_replace('/', '', $accessKey) != '') {
            File::deleteDirectory($this->uploadPath . '/' . $accessKey);
        }

    }

    public function sortable()
    {
        $positions = json_decode(request()->positions);
        if ($positions) {
            foreach ($positions as $pos) {
                static::where('id', $pos->key)->update(['position' => $pos->position]);
            }
        }
        $this->responseSuccess("L'ordre est mis à jour");
        return $this->response;
    }

    protected function editDescription()
    {
        MediaDescription::where(['media_content_id' => request()->id, 'lg' => request()->lg])->update(['description' => request()->text]);
        $this->response['callback'] = 'zone_edit_remove';
        $this->responseSuccess("Mise à jour effectuée");

        return $this->response;
    }

    public static function retina($img)
    {
        return is_file(public_path('upload/images/' . str_replace('.', '@2x.', $img))) ? asset('upload/images/' . str_replace('.', '@2x.', $img)) : null;
    }

    public function scopeVarname($query, $varname = null)
    {

        if (!is_null($varname)) {
            return $query->where('varname', $varname);
        }
    }

    protected function insertRecord(object $object, array $response): void
    {
        $record = new MediaManager();
        $record->media_type = get_class($object);
        $record->media_id = $object->id;
        $record->type = $response['file_type'];
        $record->content = $response['filename'];

        if (request()->has('media_description_'.$response['file_type'])) {
            $record->description = request()->{'media_description_'.$response['file_type']};
        }
        $record->save();

        $this->response['uploaded_id'] = $record->id;
    }

}
