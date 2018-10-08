<?php

namespace User\Exceptions;

use Symfony\Component\Translation\Exception\ExceptionInterface;
use Symfony\Component\Translation\Exception\LogicException;

class CreateUserErrorException extends \LogicException implements ExceptionInterface
{
}
