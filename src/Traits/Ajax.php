<?php

declare(strict_types=1);

namespace Aboleon\Framework\Traits;

use Illuminate\Http\JsonResponse;

trait Ajax {

    protected array $response = [];

    public function ajax(): JsonResponse
    {
        $method = 'ajax_'.request()->ajax_action;
        $this->is_ajax_request = true;
        if (method_exists($this, $method)) {
            $this->response = $this->{$method}();
        }
        $this->response['input'] = request()->input();
        return response()->json($this->response);
    }

}
