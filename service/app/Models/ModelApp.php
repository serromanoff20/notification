<?php namespace App\Models;

use App\Exceptions\ErrorHandler;
use Illuminate\Database\Eloquent\Model;

class ModelApp extends Model
{
    /**
     * Array processed errors that may be called in model
     * @var array
     */
    private static array $errors = [];

    /**
     * Body of model that initialized when apply on endpoint.
     * @var mixed|array
     */
    private mixed $bodyModel = [];


    /**
     * When apply on endpoint in construct initialized model.
     * @param mixed $model
     */
    protected function setBodyModel(mixed $model=[]): void
    {
        if (isset($model->fillable)) {
            $this->id = 0;
            foreach ($model->fillable as $attribute) {
                $this->bodyModel[$attribute] = null;
            }
        }
        $this->bodyModel = [];
    }

    /**
     * Model that initialized when apply on endpoint.
     * May be empty array or filled object with values - null
     *
     * @return array
     */
    public function getBodyModel(): array
    {
        return $this->bodyModel;
    }


    /**
     * When happens error in model, to called this function
     *
     * @param string $placeError
     * @param string $textError
     */
    public function setError(string $placeError, string $textError): void
    {
        $error = new ErrorHandler($placeError, $textError);

        self::$errors = array_merge(self::$errors, [$error]);
    }

    /**
     * Get errors. Called function from controller.
     *
     * @return array
     */
    public function getErrors(): array
    {
        return self::$errors;
    }

    /**
     * Check on exist errors in model
     *
     * @return bool
     */
    public function hasErrors(): bool
    {
        return !empty(self::$errors);
    }
}
