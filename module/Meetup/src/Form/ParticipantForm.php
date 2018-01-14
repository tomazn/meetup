<?php

declare(strict_types=1);

namespace Meetup\Form;

use Zend\Form\Element;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator\StringLength;
use Zend\Validator\Digits;

class ParticipantForm extends Form implements InputFilterProviderInterface
{
    public function __construct()
    {
        parent::__construct('meetup');

        $this->add([
            'type' => Element\Text::class,
            'name' => 'name',
            'options' => [
                'label' => 'Nom',
            ],
            'attributes' => [
                'class' => 'form-control'
            ]
        ]);

        $this->add([
            'type' => Element\Text::class,
            'name' => 'job',
            'options' => [
                'label' => 'job'
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
            'name' => [
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
        ];
    }
}
