<?php

return array(
    'bjyauthorize' => array(
        'default_role' => 'guest',
        'identity_provider' => 'BjyAuthorize\Provider\Identity\ZfcUserDoctrine',
        'unauthorized_strategy' => 'Application\View\UnauthorizedStrategy',
        'role_providers' => array(
            'BjyAuthorize\Provider\Role\Doctrine' => array(
                'table'             => 'user_role',
                'role_id_field'     => 'role_id',
                'parent_role_field' => 'parent',
            ),
        ),
        'resource_providers' => array(
            'BjyAuthorize\Provider\Resource\Config' => array(
                'editor' => array(),
                'super' => array(),
            ),
        ),
        'rule_providers' => array(
            'BjyAuthorize\Provider\Rule\Config' => array(
                'allow' => array(
                    array(array('user'), 'editor'),
                    array(array('admin'), 'super'),
                ),
                'deny' => array(
                ),
            ),
        ),
        'guards' => array(
            'BjyAuthorize\Guard\Controller' => array(
                array('controller' => 'Application\Controller\Index', 'roles' => array('guest', 'user')),
                array('controller' => 'Album\Controller\Album', 'action' => 'index', 'roles' => array('guest','user')),
                array('controller' => 'Album\Controller\Album', 'action' => 'add', 'roles' => array('user')),
                array('controller' => 'Album\Controller\Album', 'action' => 'edit', 'roles' => array('user')),
                array('controller' => 'Album\Controller\Album', 'action' => 'delete', 'roles' => array('user')),
                array('controller' => 'SwebContact\Controller\Contact', 'action' => 'index', 'roles' => array()),
                array('controller' => 'zfcuser', 'roles' => array()),
                array('controller' => 'ZfcAdmin\Controller\AdminController', 'roles' => array('admin')),
                array('controller' => 'zfcuseradmin', 'roles' => array('admin')),
                array('controller' => 'AlbumAdmin\Controller\Album', 'roles' => array('admin')),
            ),
        ),
    ),
);
