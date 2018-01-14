<?php

declare(strict_types=1);

namespace Meetup\Form;

use Zend\Form\Element;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator\StringLength;

use Meetup\Validator;


class MeetupForm extends Form implements InputFilterProviderInterface
{
    public function __construct()
    {
        parent::__construct('meetup');

        $this->add([
            'type' => Element\Text::class,
            'name' => 'title',
            'options' => [
                'label' => 'Titre',
            ],
            'attributes' => [
                'class' => 'form-control'
            ]
        ]);

        $this->add([
            'type' => Element\Text::class,
            'name' => 'description',
            'options' => [
                'label' => 'Description',
            ],
            'attributes' => [
                'class' => 'form-control'
            ]
        ]);

        $this->add([
            'type' => Element\Date::class,
            'name' => 'start',
            'options' => [
                'label' => 'Début'
            ],
            'attributes' => [
                'class' => 'form-control'
            ]
        ]);

        $this->add([
            'type' => Element\Date::class,
            'name' => 'end',
            'options' => [
                'label' => 'Fin'
            ],
            'attributes' => [
                'class' => 'form-control'
            ]
        ]);

        $this->add([
            'type' => Element\Submit::class,
            'name' => 'submit',
            'attributes' => [
                'value' => 'Submit',
                'class' => 'btn btn-primary'
            ],
        ]);

    }

    public function getInputFilterSpecification()
    {
        return [
            'title' => [
                'validators' => [
                    [
                        'name' => StringLength::class,
                        'options' => [
                            'min' => 5,
                            'max' => 30,
                        ],
                    ],
                ],
                'filters' => [
                    [
                        'name' => 'StringTrim',
                    ],
                    [
                        'name' => 'Alnum',
                    ],
                ],
            ],
            'description' => [
                'validators' => [
                    [
                        'name' => StringLength::class,
                        'options' => [
                            'min' => 5,
                            'max' => 300,
                        ],
                    ],
                ],
                'filters' => [
                    [
                        'name' => 'StringTrim'
                    ]
                ]
            ],
            'end' => [
                'validators' => [
                    [
                        'name' => Validator\MeetupDateValidator::class
                    ],
                ],
            ],
            'start' => [
                'validators' => [
                    [
                        'name' => Validator\MeetupDateValidator::class
                    ],
                ],
            ],
        ];
    }
}
