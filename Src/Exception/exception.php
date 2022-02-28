<?php
set_error_handler([new \App\Exception\ExceptionHandler(), 'convertWarningsToException' ]);
set_exception_handler([new \App\Exception\ExceptionHandler(), 'handle' ]);