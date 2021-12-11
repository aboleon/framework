<?php

declare(strict_types=1);

namespace Aboleon\Framework\Traits;

use Cache;
use Illuminate\Http\JsonResponse;

trait Helper
{
    use Locale;
    use Responses;
    /**
    * Fonction JS à éxecuter sur une réponse ajax
    * @var string
    */

    protected $callback;

    /**
    * La langue en cours
    * @var string
    */

    protected $locale;

    /**
    * Les langues
    * @var array
    */

    protected $locales;

    /**
    * Champs DB du modèle
    * @var array
    */

    protected $editor_fields;

    /**
    * static::class
    * @var instance of Model
    */

    protected $editable;

    /**
    * Le type d'image associé dans Images.
    * @var string
    */

    protected $image_of;

    /**
    * Data à compose pour les views
    * @var array
    */

    protected $view_data = [];

    protected $object_id;
    protected $error = false;

    protected $validation_fields;
    protected $validated_data = [];
    protected $is_ajax_request = false;

    public function __construct()
    {
        $this->locale = app()->getLocale();
        $this->locales = config('aboleon_framework.locales');

        if (request()->filled('object_id')) {
            $this->object_id = request()->object_id;
        } else {
            $this->object_id = session()->get('object_id');
            if (!is_int($this->object_id) && count(request()->segments())>4) {
                $this->object_id = request()->segment(5);
            }
        }
        if (request()->isMethod('post')) {
            $this->response['input'] = request()->input();
        }
    }

    public function ajax(): JsonResponse
    {
        $this->response['input'] = request()->input();
        $method = request()->ajax_action;
        $this->is_ajax_request = true;
        if (method_exists($this, $method)) {
            $this->{$method}();
        }
        //de($this->response);
        return response()->json($this->response);
    }

    /**
    * Récupérer une page
    * @var string|int
    * @return instance of App\Http\CPP\Products\AppStore
    */

    public static function gePage($id)
    {
        $page = static::whereHash($id)->select('id')->first();
        if (preg_match('/0*[1-9]\d*$/', $id) && !is_null($page)) {
            $id = $page->id;
        }
        return self::find($id);
    }

    public static function getStatic($property)
    {
        if (property_exists(static::class, $property)) {
            return static::${$property};
        }
    }

    public function getResponse()
    {
        return $this->response;
    }

    /**
    * The sortable position save function for every Model with "position" field in DB
    */
    public function sortable()
    {
        foreach(request()->position as $key=>$val) {
            static::where('id', $key)->update(['position'=>$val]);
        }
        Cache::forget('nav');
        $this->responseSuccess("L'ordre a été mis à jour");
        return $this->response;
    }

    /**
    * Show updated_at field in a readable way
    */
    public function getUpdatedAttribute()
    {
        return $this->updated_at->format("d/m/Y ".trans('core::core.datetime.at'). " H:i");
    }

    public function remove(): object
    {
        if (request()->isMethod('post') && request()->filled('object_id')) {
            if (static::where('id', request()->object_id)->delete()) {
                $this->responseNotice("L'enregistrement a été supprimé.");
            }
        }
        $this->flash_to_session();
        return redirect()->back();
    }


    protected function session_message(string $message='')
    {
        return session()->flash('session_message', $message);
    }

    /**
    * Enregistre les données sur un modèle
    * @return json|array
    */

    protected function editor()
    {
        $this->editable = static::firstOrNew(['id' => request()->object_id]);

        foreach ($this->editor_fields as $val) {
            $this->editable->{$val} = request()->{$val};
        }

        $this->editable();

        $this->editable->save();

        $this->response['object_id'] = $this->editable->id;
        $this->response['callback'] = $this->callback;

        return response()->json($this->response);
    }

    protected function editable()
    {
    }

    protected function unlink(): JsonResponse
    {
        static::findOrFail(request()->object_id)->delete();
        $this->response['messages'][] = ['danger' => trans('core::ui.deleted')];
        return response()->json($this->response);
    }

    public function formattedPrice($price=null)
    {
        (int)$priceToFormat = !is_null($price) ? $price : $this->price;
        return number_format($priceToFormat/100, 2, '.', ' ');
    }

    public function unformattedPrice($price=null)
    {
        (int)$priceToFormat = !is_null($price) ? $price : $this->price;
        return $priceToFormat/100;
    }

    public function ceilPrice($price=null)
    {
        (int)$priceToFormat = !is_null($price) ? $price : $this->price;
        return number_format($priceToFormat, 0, '.', ' ');
    }

    public function viewData()
    {
        return $this->view_data;
    }

}
