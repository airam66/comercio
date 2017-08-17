<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;

trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }

    public function seeErrors(array $fields)
        {

        foreach ($fields as $name=>$errors){
            foreach((array) $errors as $message){
            $this->seeInElement(
                    "#field_{$name}.has-error .help-block", $message
                );
        }
    }

   }
}
