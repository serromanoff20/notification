<?php namespace App\Models;

use Illuminate\Http\Request;

class LogRequest
{
    private string $bodyParams;
    private string $queryParams;
    private string $method_request;
    private string $ip;
    private string $url;
    private string $user_agent;
    private array $header;

    /**
     * LogRequest constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        if ($request->isMethod('get')) {
            $this->bodyParams = json_encode($request->query(), JSON_UNESCAPED_UNICODE);
        } else if (
            $request->isMethod('post')
            || $request->isMethod('put')
            || $request->isMethod('delete')
        ) {
            $this->queryParams = json_encode($request->all(), JSON_UNESCAPED_UNICODE);
        }
        $this->method_request = $request->method();
        $this->ip = (string)$request->ip();
        $this->url = $request->fullUrl();
        $this->user_agent = (string)$request->header('user-agent');
        $this->header = (array)$request->header();
    }

    public function getBodyParams(): array
    {
        return json_decode($this->bodyParams, JSON_UNESCAPED_UNICODE);
    }

    public function getQueryParams(): array
    {
        return json_decode($this->queryParams, JSON_UNESCAPED_UNICODE);
    }
}
