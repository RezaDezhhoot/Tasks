<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MovieCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($item){
            return [
                'id' => $item['id'],
                'title' => $item['title'],
                'poster' => $item['poster'],
                'year' => $item['year'],
                'country' => $item['country'],
                'imdb_rating' => $item['imdb_rating'],
                'genres' => $item['genres'],
                'images' => $item['images'],
            ];
        });
    }
}
