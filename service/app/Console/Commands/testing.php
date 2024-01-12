<?php

namespace App\Console\Commands;

use App\Models\Responses\Response;
use Exception;
use Illuminate\Console\Command;

class testing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:testing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $messages = new Response();

        try {
            $char = 'c';
            $test = [
                'number' => 1,
                'string' => 'test',
                'char' => $char,
                'gettype_char' => gettype($char),
            ];

            echo $messages->getSuccess(['check' => $test]);
        } catch (Exception $exception) {

            echo $messages->getExceptionError($exception);
        }
    }
}
