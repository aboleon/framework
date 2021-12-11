<?php

declare(strict_types=1);

namespace Aboleon\Framework\Traits;

use Illuminate\Http\RedirectResponse;
use JetBrains\PhpStorm\Pure;
use Throwable;

trait Responses
{
    protected array $response = [];
    protected string|null $redirect_route = null;
    protected string|null $redirect_to = null;

    public function fetchResponse(): array
    {
        return $this->response;
    }

    public function fetchResponseElement(string $key)
    {
        return $this->response[$key] ?? null;
    }

    public function hasErrors(): bool
    {
        return array_key_exists('error', $this->response);
    }
    public function mustAbort(): bool
    {
        return array_key_exists('abort', $this->response);
    }

    #[Pure] public function canContinue(): bool
    {
        return !$this->mustAbort();
    }

    protected function responseNotice($message): void
    {
        $this->response['messages'][]['info'] = $message;
    }

    protected function responseSuccess($message): void
    {
        $this->response['messages'][]['success'] = $message;
    }

    protected function responseError($message): void
    {
        $this->response['error'] = true;
        $this->response['messages'][]['danger'] = $message;
    }

    protected function standardResponseError(Throwable $e)
    {
        $this->response['error'] = true;
        $this->response['messages'][]['danger'] = trans('aboleon.framework::errors.an_error_occurred');
        $this->response['messages'][]['warning'] = $e->getMessage();
    }

    protected function responseAbort($message): void
    {
        $this->response['abort'] = true;
        $this->response['messages'][]['danger'] = $message;
    }

    protected function responseWarning($message): void
    {
        $this->response['error'] = true;
        $this->response['messages'][]['warning'] = $message;
    }

    protected function responseElement(string $key, $value): void
    {
        $this->response[$key] = $value;
    }

    private function unknownContent(string $content, int $id): string
    {
        return trans('aboleon.framework::errors.contentUnknown', ['content' => $content, 'id' => $id]);
    }

    protected function flash(string $key = 'session_response'): void
    {
        session()->flash($key, $this->response);
    }

    protected function sendResponse(): RedirectResponse
    {
        $this->flash();

        if ($this->redirect_route) {
            return redirect()->route($this->redirect_route);
        }

        if ($this->redirect_to) {
            return redirect()->to($this->redirect_to)->with($this->response);
        }
        return redirect()->back()->withInput();
    }

    protected function pushMessages(object $object)
    {
        $messages = $object->fetchResponse()['messages'] ?? [];

        if ($messages) {
            foreach ($messages as $message) {
                $this->response['messages'][] = $message;
            }
        }
    }
    private function responseException(Throwable $e, string $message = ''): void
    {
        $this->responseError(!empty($message) ? $message : "Une erreur est survenue.");

        if (auth()->id()) {
            $this->responseWarning($e->getMessage());
        }
    }
}
