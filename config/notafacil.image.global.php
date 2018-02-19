<?php
return array(
    'asset_manager' => array(
        'resolver_configs' => array(
            'paths' => array(
                'data/upload',
            ),
        ),
    ),
    'images' => array(
        'asset_manager_resolver_path' => 'data/upload',
        'target' => 'data/upload/images/img',
        'thumb_path' => 'data/upload/images/thumbs',
        'ori_path'   => 'data/upload/images/ori',
    ),
    'authorization' => array(
        'scopes' => array(
            'post' => array(
                'resource' => 'Notafacil\Image\V1\Rest\Image\Controller::collection',
                'method' => 'POST',
            ),
            'update' => array(
                'resource' => 'Notafacil\Image\V1\Rest\Image\Controller::entity',
                'method' => 'PATCH',
            ),
            'delete' => array(
                'resource' => 'Notafacil\Image\V1\Rest\Image\Controller::entity',
                'method' => 'DELETE',
            )
        )
    ),
);
