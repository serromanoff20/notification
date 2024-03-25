<?php namespace App\Models;

use App\Exceptions\ErrorHandler;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ModelApp extends Model
{
    private static array $errors = [];

    private mixed $emptyModel = [];

    /**
     * ModelApp constructor.
     * @param mixed $model
     */
    public function getEmptyModel()
    {

        return $this->emptyModel;
//        if ($model instanceof Collection) {
//            $this->response = new DataResult($model->all());
//        } else if (gettype($model) === 'array') {
//            $this->response = new DataResult($model);
//        } else {
//            $this->response = new DataResult((array)$model);
//        }
    }

    protected function setEmptyModel(mixed $model=[]): void
    {
        $this->emptyModel = $model;
    }


    public function setError(string $placeError, string $textError): void
    {
        $error = new ErrorHandler($placeError, $textError);

        self::$errors = array_merge(self::$errors, [$error]);
    }

    public function getErrors(): array
    {
        return self::$errors;
    }

    public function hasErrors(): bool
    {
        return !empty(self::$errors);
    }
}
