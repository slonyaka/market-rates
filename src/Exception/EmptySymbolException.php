<?php


namespace Slonyaka\Market\Exception;


class EmptySymbolException extends \Exception {

	protected $message = 'Symbol can not be empty';

}