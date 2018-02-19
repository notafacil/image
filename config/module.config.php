<?php
return [
    'router' => [
        'routes' => [
            'image.rest.image' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/v1.0/image[/:image_id]',
                    'defaults' => [
                        'controller' => 'Notafacil\\Image\\V1\\Rest\\Image\\Controller',
                    ],
                ],
            ],
            'image.rest.images' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/v1.0/images',
                    'defaults' => [
                        'controller' => 'Notafacil\\Image\\V1\\Rest\\Images\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'hydrators' => [
        'factories' => [
            'Notafacil\\Image\\Entity\\Hydrator' => 'Notafacil\\Image\\Service\\Factory\DoctrineObjectHydratorFactory',
        ],
        'shared' => [
            'Notafacil\\Image\\Entity\\Hydrator' => true
        ]
    ],
    'service_manager' => [
        'invokables' => [
            'Notafacil\\Image\\Mapper\\Image'  => 'Notafacil\\Image\\Mapper\\Adapter\\DoctrineORMImage',
            'Notafacil\\Image\\Mapper\\User'   => 'Notafacil\\Image\\Mapper\\Adapter\\DoctrineORMUser',
            'Notafacil\\Image\\Service\\Image' => 'Notafacil\\Image\\Service\\Image',
            'Notafacil\\Image\\SharedEventListener' => 'Notafacil\\Image\\Service\\SharedEventListener',
            'Notafacil\\Image\\Authorization\\AclImageListener'    =>
                'Notafacil\\Image\\Authorization\\AclImageListener',
            'Notafacil\\Image\\Authorization\\AclScopeListener' =>
                'Notafacil\\Image\\Authorization\\AclScopeListener',
            'Notafacil\\Image\\V1\\Rest\\Image\\ImageResource'   =>
                'Notafacil\\Image\\V1\\Rest\\Image\\ImageResource',
            'Notafacil\\Image\\V1\\Rest\\Images\\ImagesResource' =>
                'Notafacil\\Image\\V1\\Rest\\Images\\ImagesResource',
            'Notafacil\\Image\\Stdlib\\Hydrator\\Strategy\\AssetManagerResolverStrategy' =>
                'Notafacil\\Image\\Stdlib\\Hydrator\\Strategy\\AssetManagerResolverStrategy'
        ],
        'factories' => [
            'image.authenticated.user' => 'Notafacil\\Image\\Service\\Factory\\AuthUserFactory',
            'image.requested.image'    => 'Notafacil\\Image\\Service\\Factory\\RequestedImageFactory'
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
        'Notafacil\\Image\\V1\\Rest\\Image\\Controller' => [
            'listener' => 'Notafacil\\Image\\V1\\Rest\\Image\\ImageResource',
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
            'entity_class' => 'Notafacil\\Image\\Entity\\Image',
            'collection_class' => 'Notafacil\\Image\\V1\\Rest\\Image\\ImageCollection',
            'service_name' => 'Notafacil\\Image',
        ],
        'Notafacil\\Image\\V1\\Rest\\Images\\Controller' => [
            'listener' => 'Notafacil\\Image\\V1\\Rest\\Images\\ImagesResource',
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
            'entity_class' => 'Notafacil\\Image\\V1\\Rest\\Images\\ImagesEntity',
            'collection_class' => 'Notafacil\\Image\\V1\\Rest\\Images\\ImagesCollection',
            'service_name' => 'Notafacil\\Images',
        ],
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            'Notafacil\\Image\\V1\\Rest\\Image\\Controller' => 'HalJson',
            'Notafacil\\Image\\V1\\Rest\\Images\\Controller' => 'HalJson',
        ],
        'accept_whitelist' => [
            'Notafacil\\Image\\V1\\Rest\\Image\\Controller' => [
                0 => 'application/vnd.image.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'Notafacil\\Image\\V1\\Rest\\Images\\Controller' => [
                0 => 'application/vnd.image.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'Notafacil\\Image\\V1\\Rest\\Image\\Controller' => [
                0 => 'application/vnd.image.v1+json',
                1 => 'application/json',
                2 => 'multipart/form-data',
                3 => 'image/jpeg',
                4 => 'image/png',
                5 => 'image/jpg',
            ],
            'Notafacil\\Image\\V1\\Rest\\Images\\Controller' => [
                0 => 'application/vnd.image.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'zf-hal' => [
        'metadata_map' => [
            'Notafacil\\Image\\Entity\\Image' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'image.rest.image',
                'route_identifier_name' => 'image_id',
                'hydrator' => 'Notafacil\\Image\\Entity\\Hydrator',
            ],
            'Notafacil\\Image\\V1\\Rest\\Images\\ImagesCollection' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'image.rest.images',
                'route_identifier_name' => 'images_id',
                'is_collection' => true,
            ],
        ],
    ],
    'zf-content-validation' => [
        'Notafacil\\Image\\V1\\Rest\\Image\\Controller' => [
            'input_filter' => 'Notafacil\\Image\\V1\\Rest\\Image\\Validator',
        ],
    ],
    'zf-mvc-auth' => [
        'authorization' => [
            'Notafacil\\Image\\V1\\Rest\\Image\\Controller' => [
                'entity' => [
                    'GET' => true,
                    'PATCH' => true,
                    'DELETE' => true,
                ],
                'collection' => [
                    'POST' => true,
                ]
            ],
            'Notafacil\\Image\\V1\\Rest\\Images\\Controller' => [
                'collection' => [
                    'GET' => true,
                ],
            ],
        ],
    ],
    'input_filter_specs' => [
        'Notafacil\\Image\\V1\\Rest\\Image\\Validator' => [
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
                'description' => 'Notafacil\\Image Description',
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
                'description' => 'Notafacil\\Image File',
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
                    'Notafacil\\Image\\Entity' => 'image_db_driver',
                ],
            ],
        ],
    ],
    'data-fixture' => [
        'fixtures' => __DIR__ . '/../src/Notafacil/Image/Fixture'
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
                // 'resource' => 'Notafacil\Image\V1\Rest\Image\Controller::collection',
                // 'method' => 'POST',
            ],
            'update' => [
                // 'resource' => 'Notafacil\Image\V1\Rest\Image\Controller::entity',
                // 'method' => 'PATCH',
            ],
            'delete' => [
                // 'resource' => 'Notafacil\Image\V1\Rest\Image\Controller::entity',
                // 'method' => 'DELETE',
            ]
        ]
    ],
];
