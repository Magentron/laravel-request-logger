<?php

namespace Prettus\RequestLogger\Contracts;

/**
 * Interface Interpolable.
 *
 * @author Anderson Andrade <contato@andersonandra.de>
 */
interface Interpolable
{
    /**
     * @param string $text
     *
     * @return string
     */
    public function interpolate($text);
}
