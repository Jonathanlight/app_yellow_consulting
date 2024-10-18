<?php

declare(strict_types=1);

namespace App\Service\Tmdb;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class BaseTmdbService
{
    protected readonly string $tmdbApiKey;

    public function __construct(public HttpClientInterface $client, public ParameterBagInterface $parameterBag)
    {
        $this->tmdbApiKey = $this->parameterBag->get('tmdbApiKey');
    }
}
