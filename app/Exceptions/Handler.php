<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\AuthenticationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Throwable
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        // 验证异常
        if ($exception instanceof ValidationException) {
            $message = $exception->validator->getMessageBag()->first();

            return response([
                'success' => false,
                'errorCode' => '40000',
                'errorMessage' => $message,
                'showType' => 4
            ]);
        } else if ($exception instanceof AuthenticationException) {
            // 无权限
            return response([
                'success' => false,
                'errorCode' => '40001',
                'errorMessage' => '请求失败，令牌鉴权失败',
            ]);
        }



        return parent::render($request, $exception);
    }

}
