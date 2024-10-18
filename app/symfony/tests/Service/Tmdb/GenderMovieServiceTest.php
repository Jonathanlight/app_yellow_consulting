<?php

declare(strict_types=1);

namespace App\Tests\Service\Tmdb;

use App\Service\Tmdb\GenderMovieService;
use Symfony\Contracts\HttpClient\ResponseInterface;

class GenderMovieServiceTest extends BaseTmdbServiceTest
{
    private GenderMovieService $genderMovieService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->genderMovieService = new GenderMovieService($this->getHttpClient(), $this->getParameterBag());
    }

    public function testGetGenderMovieReturnsValidResponse(): void
    {
        $mockResponse = $this->createMock(ResponseInterface::class);

        $mockResponse
            ->method('toArray')
            ->willReturn([
                'genres' => [
                    ['id' => 28, 'name' => 'Action'],
                ],
            ]);

        $this->httpClient
            ->method('request')
            ->with('GET', $this->anything(), $this->callback(function ($options) {
                return isset($options['query']['api_key']) && $options['query']['api_key'] === $this->getTmdbApiKey();
            }))
            ->willReturn($mockResponse);

        $result = $this->genderMovieService->getGenderMovie('fr');

        $this->assertEquals([
            'genres' => [
                ['id' => 28, 'name' => 'Action'],
            ],
        ], $result);
    }

    public function testGetGenderMovieUsesDefaultLanguage(): void
    {
        $mockResponse = $this->createMock(ResponseInterface::class);
        $mockResponse
            ->method('toArray')
            ->willReturn([
                'genres' => [
                    ['id' => 28, 'name' => 'Action'],
                ],
            ]);

        $this->httpClient
            ->method('request')
            ->with('GET', $this->anything(), $this->callback(function ($options) {
                return isset($options['query']['language']) && 'fr' === $options['query']['language'];
            }))
            ->willReturn($mockResponse);

        $result = $this->genderMovieService->getGenderMovie();

        $this->assertEquals([
            'genres' => [
                ['id' => 28, 'name' => 'Action'],
            ],
        ], $result);
    }
}
