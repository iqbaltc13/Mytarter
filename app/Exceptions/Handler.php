<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use App\Http\ApiResponder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use stdClass;
use Illuminate\Support\Str;

class Handler extends ExceptionHandler
{
    use ApiResponder;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        // \Illuminate\Auth\AuthenticationException::class,
        // \Illuminate\Auth\Access\AuthorizationException::class,
        // \Symfony\Component\HttpKernel\Exception\HttpException::class,
        // \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        // \Illuminate\Session\TokenMismatchException::class,
        // \Illuminate\Validation\ValidationException::class,
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
     * @param  \Exception  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception){
        if ($request->expectsJson()) {
            if ($exception instanceof AuthenticationException) {
                return $this->unauthorized();
            }else{
                $app_debug      = env('APP_DEBUG', false);
                $urls           = explode("/",$request->url());
                $url            = "";
                $isPassed       = false;
                for ($i=0; $i <@count($urls) ; $i++) { 
                    if($isPassed){
                        $url    .= "/".$urls[$i];
                    }else{
                        if($urls[$i] == 'v1'){
                            $isPassed   = true;
                        }
                    }
                }
                $fileNames      = explode("/",$exception->getFile());
                $fileName       = str_replace('Controller.php',"-Berkas",$fileNames[@count($fileNames)-1]);
                $fileName       = $url.' in '.$fileName.'['.$exception->getLine().']';
                return $this->clientError([$fileName,$exception->getMessage(),get_class($exception)]);
            }
        }
        return parent::render($request, $exception);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return $this->unauthorized();
        }

        return redirect()->guest(route('login'));
    }
}
