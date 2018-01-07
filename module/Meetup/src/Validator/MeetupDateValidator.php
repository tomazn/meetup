<?php

namespace Meetup\Validator;

use Zend\Validator\AbstractValidator;

class MeetupDateValidator extends AbstractValidator
{

    CONST DATE = "DATE";

    protected $messageTemplates = array(
        self::DATE => 'La date de début doit être inférieur à la date de fin.'
    );

    public function isValid($value, $context = null)
    {
        if(is_array($context)) {
            $start = $value;
            $end = $context['end'];

            if($start > $end){
                $this->error(self::DATE);
                return false;
            }
        }


        return true;
    }


}