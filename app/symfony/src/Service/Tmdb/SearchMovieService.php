<?php

declare(strict_types=1);

namespace App\Service\Tmdb;

use App\Enum\CallApiEnum;

class SearchMovieService extends BaseTmdbService
{
    /**
     * @param string $query
     * @param int $page
     * @param string $language
     * @return array
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function searchMovies(string $query, int $page = 1, string $language = 'fr'): array
    {
        $response = $this->client->request('GET', CallApiEnum::SEARCH_MOVIE->value, [
            'query' => [
                'api_key' => $this->tmdbApiKey,
                'query' => $query,
                'include_adult' => false,
                'language' => $language,
                'page' => $page,
            ],
        ]);

        return $response->toArray();
    }
}