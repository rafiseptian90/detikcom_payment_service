<?php

namespace Helpers;

class ResponseJSON
{
    public static function success(string $msgStatus) : false|string
    {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code(200);

        return json_encode([
            'code_status' => 200,
            'msg_status' => $msgStatus
        ]);
    }

    public static function successWithData(string $msgStatus, array $data) : false|string
    {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code(200);

        return json_encode([
            'code_status' => 200,
            'msg_status' => $msgStatus,
            'data' => $data
        ]);
    }

    public static function badRequest(string $msgStatus) : false|string
    {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code(400);

        return json_encode([
            'code_status' => 400,
            'msg_status' => $msgStatus
        ]);
    }

    public static function forbidden(string $msgStatus) : false|string
    {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code(403);

        return json_encode([
            'code_status' => 403,
            'msg_status' => $msgStatus
        ]);
    }

    public static function notFound(string $msgStatus) : false|string
    {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code(404);

        return json_encode([
            'code_status' => 404,
            'msg_status' => $msgStatus
        ]);
    }

    public static function unprocessableEntity(string $msgStatus, array $errors) : false|string
    {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code(422);

        return json_encode([
            'code_status' => 422,
            'msg_status' => $msgStatus,
            'errors' => $errors
        ]);
    }

    public static function internalServerError(string $msgStatus) : false|string
    {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code(500);

        return json_encode([
            'code_status' => 500,
            'msg_status' => $msgStatus
        ]);
    }
}
