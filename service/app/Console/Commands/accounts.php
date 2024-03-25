<?php

namespace App\Console\Commands;

use App\Consts;
use App\Models\ConsoleHandlerException;
use App\Models\Push\PushMediator;
use Exception;
use Illuminate\Console\Command;
use League\CommonMark\Exception\InvalidArgumentException;
use PHPUnit\Framework\UnknownClassOrInterfaceException;

class accounts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:accounts {type}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
//        $schema = env('DB_SCHEMA');

        try {
            $type = $this->argument('type');

            if ($type === Consts::TYPE_PUSH_MOBILE) {
                echo($type . "\n");
//                echo($schema);
//                print_r(getenv());

                dd((new PushMediator())->accountsNotifyPushMobile());
            }

//        if ($type === Notifications::TYPE_PUSH_MOBILE) {
//            (new PushMediator())->accountsNotifyPushMobile();
//        }

            exit();
        } catch (Exception $exception) {
//            $modelExc = new ConsoleHandlerException();
//
//            $modelExc->nameProcedure = $this->signature;
//            $modelExc->descriptionException = $exception->getMessage();
//
//            $modelExc->save();
            echo("Не работает: " . $exception->getMessage());
            exit();
        }
    }
}
