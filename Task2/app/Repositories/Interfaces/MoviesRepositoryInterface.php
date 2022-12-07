<?php

namespace App\Repositories\Interfaces;

interface MoviesRepositoryInterface
{
    public function search($query , $page);

    public function httpRequest($uri , $service = 'movies_api' , $verb = 'get' , $params = [] , $version = 'v1');
}
