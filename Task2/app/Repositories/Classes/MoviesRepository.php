<?php

namespace App\Repositories\Classes;

use App\Repositories\Interfaces\MoviesRepositoryInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\HttpFoundation\Response;

class MoviesRepository implements MoviesRepositoryInterface
{

    public function search($query, $page)
    {
        $key = "api_search_{$query}_page_{$page}";
        $data = Cache::get($key);
        if ($data) {
            $data = unserialize($data);
        } else {
            $data = $this->httpRequest(
                uri: 'movies',
                params: [
                    'q' => $query,
                    'page' => $page
                ]
            );

            Cache::forever($key,serialize($data));
        }

        return $data;
    }

    public function httpRequest($uri , $service = 'movies_api' , $verb = 'get' , $params = [] , $version = 'v1')
    {
        $http = Http::acceptJson();
        $uri = config('app.options.'.$service.'.versions.'.$version.'.uri').$uri;
        try {
            $response = match (mb_strtolower($verb)) {
                'get' => $http->get($uri,$params),
                'post' => $http->post($uri,$params),
                'put' => $http->put($uri,$params),
                'delete' => $http->delete($uri,$params),
                'patch' => $http->patch($uri,$params),
            };

            $response = [
                'response' => $response->ok() ? $response->json() : config('app.options.'.$service.'.api_error'),
                'code' => $response->status()
            ];

        } catch (\Exception $e) {
            $response = [
                'response' => config('options.'.$service.'api_error'),
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR
            ];
        }

        return $response;
    }
}
