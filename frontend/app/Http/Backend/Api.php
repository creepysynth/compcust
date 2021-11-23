<?php

namespace App\Http\Backend;

use App\Http\Pagination\Paginator;
use Illuminate\Support\Facades\Http;

class Api
{
    private $response;
    private $options;
    private $method;
    private $path;

    /**
     * Prepare get request to api
     *
     * @param string $path
     * @param array $query
     * @return $this
     */
    public function get(string $path='', array $query=[])
    {
        $this->request('get', $path, $query);

        return $this;
    }

    /**
     * Prepare post request to api
     *
     * @param string $path
     * @param array $data
     * @return $this
     */
    public function post(string $path='', array $data=[])
    {
        $this->request('post', $path, $data);

        return $this;
    }

    /**
     * Prepare put request to api
     *
     * @param string $path
     * @param array $data
     * @return $this
     */
    public function put(string $path='', array $data=[])
    {
        $this->request('put', $path, $data);

        return $this;
    }

    /**
     * Prepare delete request to api
     *
     * @param string $path
     * @param array $data
     * @return $this
     */
    public function delete(string $path='', array $data=[])
    {
        $this->request('delete', $path, $data);

        return $this;
    }

    /**
     * Prepare request to api
     *
     * @param string $method
     * @param string $path
     * @param array $data
     */
    protected function request(string $method, string $path, array $data)
    {
        $this->method = $method;
        $this->path = $path;

        if ($method === 'get') {
            $this->options = ['query' => $data];
        } else {
            $this->options = ['json' => $data];
        }
    }

    /**
     * Send a request to api
     *
     * @return $this
     */
    public function send()
    {
        $url = $this->url($this->path);

        $this->response = Http::withToken(request()->cookie(config('app.token_name')))
                                ->send($this->method, $url, $this->options);

        $this->checkStatus();

        return $this;
    }

    /**
     * Make full api url
     *
     * @param string $path
     * @return string
     */
    public function url(string $path='')
    {
        return rtrim(config('app.api_url'), '/') . '/' . ltrim($path, '/');
    }

    /**
     * Paginate data received from api
     *
     * @param int $perPage
     * @return Paginator
     */
    public function paginate(int $perPage)
    {
        $currentPage = (int) request()->query('page', 1);
        $this->options['query']['limit'] = $perPage;
        $this->options['query']['offset'] = $perPage * ($currentPage - 1);

        $this->send();

        return (new Paginator(
                   $this->response->object(),
                   (int) $this->response->header('X-Total-Count'),
                   $perPage,
                   $currentPage
               ))->setPath(request()->url())
                 ->appends(request()->except('page'));
    }

    /**
     * Get response object
     *
     * @return \Illuminate\Http\Client\Response
     */
    public function response()
    {
        return $this->response;
    }

    /**
     * Get the JSON decoded body as an object/array of objects
     *
     * @return object|array
     */
    public function object()
    {
        return $this->response->object();
    }

    /**
     * Get errors array from response
     *
     * @return array
     */
    public function errors()
    {
        $body = json_decode($this->response->body());

        return $body->errors ?? [];
    }

    /**
     * Check response status
     *
     * @return void
     */
    public function checkStatus()
    {
        $code = $this->response->status();

        switch ($code) {
            case 200:
            case 201:
                break;
            case 401:
                abort(redirect(route('user.login.form')));
                break;
            case 422:
                abort(redirect()->back()->withErrors($this->errors())->withInput());
                break;
            default:
                abort($code);
        }
    }
}
