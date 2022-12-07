<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\SearchRequest;
use App\Repositories\Interfaces\MoviesRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class MovieSearchController extends Controller
{
    protected ?MoviesRepositoryInterface $moviesRepository;

    public function __construct(MoviesRepositoryInterface $moviesRepository)
    {
        $this->moviesRepository = $moviesRepository;
    }

    public function __invoke(SearchRequest $searchRequest): Response|Application|ResponseFactory
    {
        // get data
        $results = $this->moviesRepository->search(
            query: $searchRequest->input('q'),
            page: $searchRequest->input('page') ?? 1
        );

        return response([
            'data' => [
                'movies' => [
                    'items' => $results['response']['data'],
                    'paginate' => $results['response']['metadata'],
                ]
            ],'status' => 'success'
        ],$results['code']);
    }
}
