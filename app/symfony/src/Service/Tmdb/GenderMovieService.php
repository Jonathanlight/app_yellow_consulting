<?php

declare(strict_types=1);

namespace App\Service\Tmdb;

use App\Enum\CallApiEnum;

class GenderMovieService extends BaseTmdbService
{
    /**
     * @param string $language
     * @return array<string, mixed>
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function getGenderMovie(string $language = 'fr'): array
    {
        $response = $this->client->request('GET', CallApiEnum::SEARCH_DISCOVER->value, [
            'query' => [
                'api_key' => $this->tmdbApiKey,
                'language' => $language,
            ],
        ]);

        return $response->toArray();
    }
}
