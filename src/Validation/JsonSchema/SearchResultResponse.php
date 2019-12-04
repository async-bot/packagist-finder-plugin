<?php declare(strict_types=1);

namespace AsyncBot\Plugin\PackagistFinder\Validation\JsonSchema;

use AsyncBot\Core\Http\Validation\JsonSchema;

final class SearchResultResponse extends JsonSchema
{
    public function __construct()
    {
        parent::__construct(
            [
                '$id'        => 'AsyncBot/Plugin/PackagistFinder/search-result-response.json',
                '$schema'    => 'http://json-schema.org/draft-07/schema#',
                'title'      => 'Packagist search result response',
                'type'       => 'object',
                'required'   => [
                    'results',
                    'total',
                    'next',
                ],
                'properties' => [
                    'results' => [
                        'type'  => 'array',
                        'items' => [
                            'type'     => 'object',
                            'required' => [
                                'name',
                                'description',
                                'url',
                                'repository',
                                'downloads',
                                'favers',
                            ],
                            'properties' => [
                                'name' => [
                                    'type' => 'string',
                                ],
                                'description' => [
                                    'type' => 'string',
                                ],
                                'url' => [
                                    'type' => 'string',
                                ],
                                'repository' => [
                                    'type' => 'string',
                                ],
                                'downloads' => [
                                    'type' => 'integer',
                                ],
                                'favers' => [
                                    'type' => 'integer',
                                ],
                            ],
                        ],
                        'total' => [
                            'type' => 'integer',
                        ],
                        'next' => [
                            'type' => 'string',
                        ],
                    ],
                ],
            ],
        );
    }
}
