<?php declare(strict_types=1);

namespace AsyncBot\Plugin\PackagistFinder\Validation\JsonSchema;

use AsyncBot\Core\Http\Validation\JsonSchema;

final class GetByPackageNameResponse extends JsonSchema
{
    public function __construct()
    {
        parent::__construct(
            [
                '$id'        => 'AsyncBot/Plugin/PackagistFinder/get-by-package-name-response.json',
                '$schema'    => 'http://json-schema.org/draft-07/schema#',
                'title'      => 'Packagist get by package name response',
                'type'       => 'object',
                'required'   => [
                    'package',
                ],
                'properties' => [
                    'package' => [
                        'type'       => 'object',
                        'required'   => [
                            'name',
                            'description',
                            'time',
                            'maintainers',
                            'versions',
                            'type',
                            'repository',
                            'type',
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
                            'time' => [
                                'type' => 'string',
                            ],
                            'maintainers' => [
                                'type'  => 'array',
                                'items' => [
                                    'type' => 'object',
                                ],
                            ],
                            'versions' => [
                                'type' => 'object',
                            ],
                            'type' => [
                                'type' => 'string',
                            ],
                            'repository' => [
                                'type' => 'string',
                            ],
                            'downloads' => [
                                'type' => 'object',
                                'required' => [
                                    'total',
                                    'monthly',
                                    'daily',
                                ],
                                'properties' => [
                                    'total' => [
                                        'type' => 'integer',
                                    ],
                                    'monthly' => [
                                        'type' => 'integer',
                                    ],
                                    'daily' => [
                                        'type' => 'integer',
                                    ],
                                ],
                            ],
                            'favers' => [
                                'type' => 'integer',
                            ],
                        ],
                    ],
                ],
            ],
        );
    }
}
