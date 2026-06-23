<?php

namespace App\Exceptions;

use Exception;

class InvalidTransitionException extends Exception
{
    public function __construct(string $message = "Transisi status tidak valid", int $code = 422)
    {
        parent::__construct($message, $code);
    }

    public function render(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $this->getMessage(),
        ], $this->getCode());
    }
}
