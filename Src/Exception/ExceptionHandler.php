<?php
namespace App\Exception;

use Throwable;
use App\Helpers\App;

class ExceptionHandler 
{

    public function handler(Throwable $exception): void
    {
        $application = new App;

        if($application->isDebugMode()){
            var_dump($exception);
        } else {
            echo "This should not have happened, please try again.";
        }
        exit;
    }

}