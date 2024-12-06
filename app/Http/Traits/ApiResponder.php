<?php

namespace App\Http\Traits;

use Illuminate\Http\Response;
use App\Exceptions\ApiException;
use Illuminate\Http\JsonResponse;

trait ApiResponder
{
    public static function successResponse(mixed $data, $message, int $statusCode = Response::HTTP_OK, $pagination = null): JsonResponse
    {
        if (!$message) {
            $message = Response::$statusTexts[$statusCode];
        }

        $response = [
            'status_code' => $statusCode,
            'message' => $message,
            'data' => $data
        ];

        if ($pagination) {
            $response['pagination'] = $pagination;
        }

        return response()->json($response, $statusCode);
    }

    public static function errorResponse(mixed $data, $message = '', int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR): JsonResponse
    {
        if (!$message) {
            $message = Response::$statusTexts[$statusCode];
        }

        throw new ApiException($data, $message, $statusCode);
    }

    public static function okResponse(mixed $data, $message = '', $pagination = null): JsonResponse
    {
        return Self::successResponse($data, $message, Response::HTTP_OK, $pagination);
    }

    public static function createdResponse($data, $message = ''): JsonResponse
    {
        return Self::successResponse($data, $message, Response::HTTP_CREATED);
    }

    public static function noContentResponse($data, $message = ''): JsonResponse
    {
        return Self::successResponse($data, $message, Response::HTTP_NO_CONTENT);
    }

    public static function badRequest($data, $message  = ''): JsonResponse
    {
        return Self::errorResponse($data, $message, Response::HTTP_BAD_REQUEST);
    }

    public static function unauthorizedResponse($data, string $message = ''): JsonResponse
    {
        return Self::errorResponse($data, $message, Response::HTTP_UNAUTHORIZED);
    }

    public static function forbiddenResponse($data, string $message = ''): JsonResponse
    {
        return Self::errorResponse($data, $message, Response::HTTP_FORBIDDEN);
    }

    public static function notFoundResourceResponse($data, string $message = ''): JsonResponse
    {
        return Self::errorResponse($data, $message, Response::HTTP_NOT_FOUND);
    }

    public static function unprocessableEntityResponse($data, string $message = ''): JsonResponse
    {
        return Self::errorResponse($data, $message, Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public static function conflictResponse($data, string $message = ''): JsonResponse
    {
        return Self::errorResponse($data, $message, Response::HTTP_CONFLICT);
    }

    public static function notAllowedResponse($data, string $message = ''): JsonResponse
    {
        return Self::errorResponse($data, $message, Response::HTTP_METHOD_NOT_ALLOWED);
    }

    public static function serviceUnavailableResponse($data, string $message = ''): JsonResponse
    {
        return Self::errorResponse($data, $message, Response::HTTP_SERVICE_UNAVAILABLE);
    }
}
