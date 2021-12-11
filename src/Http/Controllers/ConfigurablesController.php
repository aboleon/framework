<?php

namespace Aboleon\Framework\Http\Controllers;

use Aboleon\Framework\Models\Configurables;
use Aboleon\Framework\Traits\ModelObject;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Throwable;

class ConfigurablesController extends Controller
{

    use ModelObject;

    public function index(): Renderable
    {
        return view('aboleon.framework::configurables.index')->with('data', Configurables::all());
    }

    public function edit(Configurables $configurable): Renderable
    {
        return view('aboleon.framework::configurables.edit')->with(
            [
                'configurable' => $configurable
            ]
        );
    }


    public function update(Request $request, Configurables $configurable): RedirectResponse
    {
        try {
            $configurable->value = $configurable->parseValue();
            $configurable->save();
            $this->responseSuccess(__('aboleon.framework::ui.operation_done'));

        } catch (Throwable $e) {
            $this->failureResponse($e);

        } finally {
            Configurables::recacheItems();
        }

        return $this->sendResponse();
    }

}