<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PartCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->map(function ($part) {
            return new PartResource($part); // Usando PartResource para cada item na coleção
        });
    }
}

