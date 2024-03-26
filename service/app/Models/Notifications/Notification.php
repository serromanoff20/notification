<?php namespace App\Models\Notifications;

//use App\Types;
use App\Models\ModelApp;

class Notification extends ModelApp
{
    public mixed $returnedModel = [];

    private string $type;
    private array $tokens;
    private array $reason;

    /**
     * Notification constructor.
     * @param array $params
     */
    public function __construct($param)
    {
        parent::__construct();

        $this->type = $param;

        if (
            isset($params['type'])
            && isset($params['tokens'])
            && isset($params['reason'])
        ) {
            if ($params['type'] === $this->type) {
//                $this->returnedModel = $params['type'];
            }
        } else {
//            $this->setError(get_called_class(), 'Неверно переданы параметры');
//            $this->setEmptyModel($this->returnedModel);
        }
    }
}
