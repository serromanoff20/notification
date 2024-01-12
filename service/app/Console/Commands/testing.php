<?php

namespace App\Console\Commands;

use App\Exceptions\UndefinedException;
use App\Models\Responses\Message;
use ErrorException;
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
        $messages = new Message();

        try {
//            $char = 'c';
            $test = [
                'number' => 1,
                'string' => 'test',
                'char' => $char,
                'gettype_char' => gettype($char),
            ];

            echo $messages->getSuccess(['check' => $char]);
        } catch (Exception $exception) {

            echo $messages->getExceptionError($exception);
        }
    }
}
