<?php
declare(strict_types=1);
namespace App\Exception;

use Throwable;
use ErrorException;
use App\Helpers\App;


class ExceptionHandler 
{

    public function handle(Throwable $exception): void
    {
        $application = new App;

        if($application->isDebugMode()){
            var_dump($exception);
        } else {
            echo "This should not have happened, please try again.";
        }
        exit;
    }

    public function convertWarningsToException($severity, $message, $file, $line): void
    {
         throw new ErrorException(  $message, $severity, $severity, $file, $line     );
    }

}