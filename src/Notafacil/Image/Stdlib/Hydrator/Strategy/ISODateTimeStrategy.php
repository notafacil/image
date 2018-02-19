<?php

namespace Notafacil\Image\Stdlib\Hydrator\Strategy;

use Zend\Stdlib\Hydrator\Strategy\StrategyInterface;

/**
 * Class ISODateTimeStrategy
 *
 * @package Notafacil\Image\Stdlib\Hydrator\Strategy
 */
class ISODateTimeStrategy implements StrategyInterface
{
    /**
     * Converte o valor dado para que ele possa ser hidratado pelo hydrator.
     *
     * @param  mixed $value The original value.
     * @param  object $object (optional) The original object for context.
     * @return mixed Returns the value that should be extracted.
     * @throws \RuntimeException If object os not a User
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function extract($value, $object = null)
    {
        if ($value instanceof \DateTime) {
            return $value->format(\DateTime::ISO8601);
            // return $value->format(\DateTime::ATOM);
        }

        return null;
    }

    /**
     * Converte o valor dado para que ele possa ser hidratado pelo hydrator.
     *
     * @param  mixed $value The original value.
     * @param  array $data (optional) The original data for context.
     * @return mixed Returns the value that should be hydrated.
     * @throws \InvalidArgumentException
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function hydrate($value, array $data = null)
    {
        if (null !== $value) {
            if (!$value instanceof \DateTime) {
                throw new \InvalidArgumentException('Objeto DateTime Esperado');
            }
            // alterar fuso horário para o fuso horário do servidor
            $timezone = new \DateTimeZone(date_default_timezone_get());
            $value->setTimezone($timezone);
        }

        return $value;
    }
}
