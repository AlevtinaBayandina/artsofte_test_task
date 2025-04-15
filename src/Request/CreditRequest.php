<?php

namespace App\Request;

use App\Request\BaseRequest;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class CreditRequest extends BaseRequest
{
    #[Type('integer')]
    #[NotBlank()]
    public $price;

    #[Type('integer')]
    #[NotBlank([])]
    public $initialPayment;

    #[Type('integer')]
    #[NotBlank([])]
    public $loanTerm;
}
