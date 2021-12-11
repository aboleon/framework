<?php

declare(strict_types=1);

namespace Aboleon\Framework\Http;

use Illuminate\Http\RedirectResponse;
use JetBrains\PhpStorm\Pure;

class ResponseRenderers
{
    #[Pure] public static function parse($response): string
    {
        $html = '';
        if (is_string($response)) {
            return ResponseRenderers::notice($response);
        }
        if ($response instanceof RedirectResponse) {
            return $html;
        }
        if (!is_array($response)) {
            return $html;
        }
        if (array_key_exists('messages', $response)) {
            foreach ($response['messages'] as $val) {
                foreach ($val as $key => $message) {
                    $html .= ResponseRenderers::alert($message, $key);
                }
            }
        }
        return $html;
    }

    public static function validation($errors)
    {
        if ($errors->any()) {
            foreach ($errors->all() as $error) {
                echo ResponseRenderers::critical($error);
            }
        }
    }

    public static function alert($message, $class): string
    {
        return '<div class="alert alert-' . $class . '">' . $message . "</div>";
    }

    #[Pure] public static function critical($message): string
    {
        return ResponseRenderers::alert($message, 'danger');
    }

    #[Pure] public static function success($message): string
    {
        return ResponseRenderers::alert($message, 'success');
    }

    #[Pure] public static function warning($message): string
    {
        return ResponseRenderers::alert($message, 'warning');
    }

    #[Pure] public static function notice($message): string
    {
        return ResponseRenderers::alert($message, 'info');
    }
}
