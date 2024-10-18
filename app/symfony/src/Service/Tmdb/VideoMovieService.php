<?php

declare(strict_types=1);

namespace App\Service\Tmdb;

use App\Enum\CallApiEnum;

class VideoMovieService extends BaseTmdbService
{
    public function getVideoMovie(int $id, string $language = 'fr'): array
    {
        $response = $this->client->request('GET', CallApiEnum::SEARCH_MOVIE->value.'/'.$id.'/videos', [
            'query' => [
                'api_key' => $this->tmdbApiKey,
                'language' => $language,
                'move_id' => $id,
            ],
        ]);

        return $response->toArray();
    }
}
