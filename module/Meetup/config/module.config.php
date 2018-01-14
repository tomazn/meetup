<?php

declare(strict_types=1);

namespace Meetup;

use Meetup\Form\MeetupForm;
use Meetup\Form\ParticipantForm;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Meetup\Controller;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'meetup' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/meetup',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'add' => [
                        'type' => Literal::class,
                        'options' => [
                            'route'    => '/new',
                            'defaults' => [
                                'action'     => 'add',
                            ],
                        ],
                    ],
                    'get' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/get/[:id]',
                            'defaults' => [
                                'action'     => 'get',
                            ],
                        ],
                    ],
                    'edit' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/edit/[:id]',
                            'defaults' => [
                                'action'     => 'edit',
                            ],
                        ],
                    ],
                    'delete' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/delete/[:id]',
                            'defaults' => [
                                'action'     => 'delete',
                            ],
                        ],
                    ],
                ],
            ],
            'participant' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/participant',
                    'defaults' => [
                        'controller' => Controller\ParticipantController::class,
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'add' => [
                        'type' => Literal::class,
                        'options' => [
                            'route'    => '/new',
                            'defaults' => [
                                'action'     => 'add',
                            ],
                        ],
                    ],
                    'get' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/get/[:id]',
                            'defaults' => [
                                'action'     => 'get',
                            ],
                        ],
                    ],
                    'edit' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/edit/[:id]',
                            'defaults' => [
                                'action'     => 'edit',
                            ],
                        ],
                    ],
                    'delete' => [
                        'type' => Segment::class,
                        'options' => [
                            'route'    => '/delete/[:id]',
                            'defaults' => [
                                'action'     => 'delete',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => Controller\IndexControllerFactory::class,
            Controller\ParticipantController::class => Controller\ParticipantControllerFactory::class,
        ],
    ],
    'validators' => array(
        'factories' => array(
            Validator\MeetupDateValidator::class => InvokableFactory::class,
        ),
    ),
    'service_manager' => [
        'factories' => [
            MeetupForm::class => InvokableFactory::class,
            ParticipantForm::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'template_map' => [
            'meetup/index/index' => __DIR__ . '/../view/meetup/index/index.phtml',
            'meetup/index/add' => __DIR__ . '/../view/meetup/index/add.phtml',
            'meetup/index/get' => __DIR__ . '/../view/meetup/index/get.phtml',
            'meetup/index/edit' => __DIR__ . '/../view/meetup/index/edit.phtml',
            'meetup/participant/index' => __DIR__ . '/../view/meetup/participant/index.phtml',
            'meetup/participant/add' => __DIR__ . '/../view/meetup/participant/add.phtml',
            'meetup/participant/get' => __DIR__ . '/../view/meetup/participant/get.phtml',
            'meetup/participant/edit' => __DIR__ . '/../view/meetup/participant/edit.phtml',
        ],
    ],
    'doctrine' => [
        'driver' => [
            // defines an annotation driver with two paths, and names it `my_annotation_driver`
            'meetup_driver' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [
                    __DIR__.'/../src/Entity/',
                ],
            ],

            // default metadata driver, aggregates all other drivers into a single one.
            // Override `orm_default` only if you know what you're doing
            'orm_default' => [
                'drivers' => [
                    // register `application_driver` for any entity under namespace `Application\Entity`
                    'Meetup\Entity' => 'meetup_driver',
                ],
            ],
        ],
    ],
];
