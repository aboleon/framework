<?php

namespace Aboleon\Framework\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Throwable;

trait ModelObject
{
    use Responses;
    use Validation;

    private function performDelete(Model $object): RedirectResponse
    {
        try {
            $object->delete();
            $this->responseSuccess(__('aboleon.framework::ui.operation_done'));
        } catch (Throwable $e) {
            $this->failureResponse($e);
        }
        return $this->sendResponse();
    }

    private function performUpdate(Model $object): RedirectResponse
    {
        try {
            $object->update($this->validated_data);
            $this->responseSuccess(__('aboleon.framework::ui.operation_done'));
        } catch (Throwable $e) {
            $this->failureResponse($e);
        }
        return $this->sendResponse();
    }

    private function performCreate(Model $object): RedirectResponse
    {
        try {
            $object::create($this->validated_data);
            $this->responseSuccess(__('aboleon.framework::ui.operation_done'));
        } catch (Throwable $e) {
            $this->failureResponse($e);
        }
        return $this->sendResponse();
    }

    private function failureResponse($e)
    {
        $this->responseWarning(__('aboleon.framework::ui.operation_failed'));
        $this->responseWarning($e->getMessage());
    }
}
