<?php
return [
    'router' => [
        'routes' => [
            'image.rest.image' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/v1.0/image[/:image_id]',
                    'defaults' => [
                        'controller' => 'NotafacilAPI\\Image\\V1\\Rest\\Image\\Controller',
                    ],
                ],
            ],
            'image.rest.images' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/v1.0/images',
                    'defaults' => [
                        'controller' => 'NotafacilAPI\\Image\\V1\\Rest\\Images\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'hydrators' => [
        'factories' => [
            'NotafacilAPI\\Image\\Entity\\Hydrator' => 'NotafacilAPI\\Image\\Service\\Factory\DoctrineObjectHydratorFactory',
        ],
        'shared' => [
            'NotafacilAPI\\Image\\Entity\\Hydrator' => true
        ]
    ],
    'service_manager' => [
        'invokables' => [
            'NotafacilAPI\\Image\\Mapper\\Image'  => 'NotafacilAPI\\Image\\Mapper\\Adapter\\DoctrineORMImage',
            'NotafacilAPI\\Image\\Mapper\\User'   => 'NotafacilAPI\\Image\\Mapper\\Adapter\\DoctrineORMUser',
            'NotafacilAPI\\Image\\Service\\Image' => 'NotafacilAPI\\Image\\Service\\Image',
            'NotafacilAPI\\Image\\SharedEventListener' => 'NotafacilAPI\\Image\\Service\\SharedEventListener',
            'NotafacilAPI\\Image\\Authorization\\AclImageListener'    =>
                'NotafacilAPI\\Image\\Authorization\\AclImageListener',
            'NotafacilAPI\\Image\\Authorization\\AclScopeListener' =>
                'NotafacilAPI\\Image\\Authorization\\AclScopeListener',
            'NotafacilAPI\\Image\\V1\\Rest\\Image\\ImageResource'   =>
                'NotafacilAPI\\Image\\V1\\Rest\\Image\\ImageResource',
            'NotafacilAPI\\Image\\V1\\Rest\\Images\\ImagesResource' =>
                'NotafacilAPI\\Image\\V1\\Rest\\Images\\ImagesResource',
            'NotafacilAPI\\Image\\Stdlib\\Hydrator\\Strategy\\AssetManagerResolverStrategy' =>
                'NotafacilAPI\\Image\\Stdlib\\Hydrator\\Strategy\\AssetManagerResolverStrategy'
        ],
        'factories' => [
            'image.authenticated.user' => 'NotafacilAPI\\Image\\Service\\Factory\\AuthUserFactory',
            'image.requested.image'    => 'NotafacilAPI\\Image\\Service\\Factory\\RequestedImageFactory'
        ],
        'aliases' => [
            'ZF\OAuth2\Provider\UserId' => 'ZF\OAuth2\Provider\UserId\AuthenticationService',
        ],
    ],
    'zf-versioning' => [
        'uri' => [
            0 => 'image.rest.image',
            1 => 'image.rest.images',
        ],
    ],
    'zf-rest' => [
        'NotafacilAPI\\Image\\V1\\Rest\\Image\\Controller' => [
            'listener' => 'NotafacilAPI\\Image\\V1\\Rest\\Image\\ImageResource',
            'route_name' => 'image.rest.image',
            'route_identifier_name' => 'image_id',
            'collection_name' => 'image',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'NotafacilAPI\\Image\\Entity\\Image',
            'collection_class' => 'NotafacilAPI\\Image\\V1\\Rest\\Image\\ImageCollection',
            'service_name' => 'NotafacilAPI\\Image',
        ],
        'NotafacilAPI\\Image\\V1\\Rest\\Images\\Controller' => [
            'listener' => 'NotafacilAPI\\Image\\V1\\Rest\\Images\\ImagesResource',
            'route_name' => 'image.rest.images',
            'route_identifier_name' => 'images_id',
            'collection_name' => 'images',
            'entity_http_methods' => [],
            'collection_http_methods' => [
                0 => 'GET',
            ],
            'collection_query_whitelist' => [
               0 => 'page'
            ],
            'page_size' => 5,
            'page_size_param' => null,
            'entity_class' => 'NotafacilAPI\\Image\\V1\\Rest\\Images\\ImagesEntity',
            'collection_class' => 'NotafacilAPI\\Image\\V1\\Rest\\Images\\ImagesCollection',
            'service_name' => 'NotafacilAPI\\Images',
        ],
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            'NotafacilAPI\\Image\\V1\\Rest\\Image\\Controller' => 'HalJson',
            'NotafacilAPI\\Image\\V1\\Rest\\Images\\Controller' => 'HalJson',
        ],
        'accept_whitelist' => [
            'NotafacilAPI\\Image\\V1\\Rest\\Image\\Controller' => [
                0 => 'application/vnd.image.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'NotafacilAPI\\Image\\V1\\Rest\\Images\\Controller' => [
                0 => 'application/vnd.image.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'NotafacilAPI\\Image\\V1\\Rest\\Image\\Controller' => [
                0 => 'application/vnd.image.v1+json',
                1 => 'application/json',
                2 => 'multipart/form-data',
                3 => 'image/jpeg',
                4 => 'image/png',
                5 => 'image/jpg',
            ],
            'NotafacilAPI\\Image\\V1\\Rest\\Images\\Controller' => [
                0 => 'application/vnd.image.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'zf-hal' => [
        'metadata_map' => [
            'NotafacilAPI\\Image\\Entity\\Image' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'image.rest.image',
                'route_identifier_name' => 'image_id',
                'hydrator' => 'NotafacilAPI\\Image\\Entity\\Hydrator',
            ],
            'NotafacilAPI\\Image\\V1\\Rest\\Images\\ImagesCollection' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'image.rest.images',
                'route_identifier_name' => 'images_id',
                'is_collection' => true,
            ],
        ],
    ],
    'zf-content-validation' => [
        'NotafacilAPI\\Image\\V1\\Rest\\Image\\Controller' => [
            'input_filter' => 'NotafacilAPI\\Image\\V1\\Rest\\Image\\Validator',
        ],
    ],
    'zf-mvc-auth' => [
        'authorization' => [
            'NotafacilAPI\\Image\\V1\\Rest\\Image\\Controller' => [
                'entity' => [
                    'GET' => true,
                    'PATCH' => true,
                    'DELETE' => true,
                ],
                'collection' => [
                    'POST' => true,
                ]
            ],
            'NotafacilAPI\\Image\\V1\\Rest\\Images\\Controller' => [
                'collection' => [
                    'GET' => true,
                ],
            ],
        ],
    ],
    'input_filter_specs' => [
        'NotafacilAPI\\Image\\V1\\Rest\\Image\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => 'Zend\\Validator\\NotEmpty',
                        'options' => [],
                    ],
                    1 => [
                        'name' => 'Zend\\I18n\\Validator\\Alnum',
                        'options' => [
                            'allowwhitespace' => true,
                        ],
                    ],
                ],
                'filters' => [
                    0 => [
                        'name' => 'Zend\\Filter\\StringTrim',
                        'options' => [],
                    ],
                    1 => [
                        'name' => 'Zend\\Filter\\StripTags',
                        'options' => [],
                    ],
                ],
                'name' => 'description',
                'description' => 'NotafacilAPI\\Image Description',
                'error_message' => 'A descrição deve ser preenchida',
            ],
            1 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => 'Zend\\Validator\\File\\Extension',
                        'options' => [
                            0 => 'jpg',
                            1 => 'png',
                        ],
                    ],
                ],
                'filters' => [],
                'name' => 'image',
                'description' => 'NotafacilAPI\\Image File',
                'type' => 'Zend\\InputFilter\\FileInput',
                'error_message' => 'O arquivo deve ser carregado',
            ],
        ],
    ],
    'doctrine' => [
        'driver' => [
            'image_db_driver' => [
                'class' => 'Doctrine\\ORM\\Mapping\\Driver\\YamlDriver',
                'paths' => [
                    0 => __DIR__ . '/entity',
                ],
                'cache' => 'array',
            ],
            'orm_default' => [
                'drivers' => [
                    'NotafacilAPI\\Image\\Entity' => 'image_db_driver',
                ],
            ],
        ],
    ],
    'data-fixture' => [
        'fixtures' => __DIR__ . '/../src/NotafacilAPI/Image/Fixture'
    ],
    'asset_manager' => [
        'resolver_configs' => [
            'paths' => [
                'data/upload',
            ],
        ],
    ],
    'images' => [
        'asset_manager_resolver_path' => 'data/upload',
        'target' => 'data/upload/images/img',
        'thumb_path' => 'data/upload/images/thumbs',
        'ori_path'   => 'data/upload/images/ori',
    ],
    'authorization' => [
        'scopes' => [
            'post' => [
                // 'resource' => 'NotafacilAPI\Image\V1\Rest\Image\Controller::collection',
                // 'method' => 'POST',
            ],
            'update' => [
                // 'resource' => 'NotafacilAPI\Image\V1\Rest\Image\Controller::entity',
                // 'method' => 'PATCH',
            ],
            'delete' => [
                // 'resource' => 'NotafacilAPI\Image\V1\Rest\Image\Controller::entity',
                // 'method' => 'DELETE',
            ]
        ]
    ],
];
