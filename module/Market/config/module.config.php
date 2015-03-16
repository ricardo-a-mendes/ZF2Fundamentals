<?php

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        'controller' => 'market-index-controller',
                        'action' => 'index',
                    ),
                ),
            ),
            'market' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/market',
                    'defaults' => array(
                        'controller' => 'market-index-controller',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                //Encadeando as rotas (filhas)
                'child_routes' => array(
                    'slash' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/',
                            'defaults' => array(
                                'controller' => 'market-index-controller',
                                'action' => 'index',
                            ),
                        ),
                    ),
                    'view' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/view[/]',
                            'defaults' => array(
                                'controller' => 'market-view-controller',
                                'action' => 'index',
                            ),
                        ),
                        'may_terminate' => true,
                        //Rota filha de uma rota filha
                        'child_routes' => array(
                            'main' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => 'main[/:category]',
                                    'defaults' => array(
                                        'action' => 'index',
                                    ),
                                ),
                            ),
                            'item' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => 'item[/:itemId]',
                                    'defaults' => array(
                                        'controller' => 'market-view-controller',
                                        'action' => 'item',
                                    ),
                                    'constraints' => array(
                                        'itemId' => '[0-9]*',
                                    ),
                                ),
                            ),
                        ),
                    ),
                    'post' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/post[/]',
                            'defaults' => array(
                                'controller' => 'market-post-controller',
                                'action' => 'index',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(

        ),
        'factories' => array(
            'market-post-controller'    => 'Market\Factory\PostControllerFactory',
            'market-index-controller'   => 'Market\Factory\IndexControllerFactory',
            'market-view-controller'    => 'Market\Factory\ViewControllerFactory',
        ),
        'aliases' => array(
            'alt' => 'market-view-controller'
        )
    ),
    'service_manager' => array(
        'factories' => array(
            'general-adapter'       => 'Zend\Db\Adapter\AdapterServiceFactory',
            'market-post-form'      => 'Market\Factory\PostFormFactory',
            'market-post-filter'    => 'Market\Factory\PostFilterFactory',
            'listings-table'        => 'Market\Factory\ListingsTableFactory'
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
