<?php

namespace Prettus\RequestLogger\Helpers;

use Illuminate\Http\Request;
use Prettus\RequestLogger\Contracts\Interpolable;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class BaseInterpolation.
 *
 * @author Anderson Andrade <contato@andersonandra.de>
 */
abstract class BaseInterpolation implements Interpolable
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Response
     */
    protected $response;

    /**
     * @param Request $request
     */
    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    /**
     * @param Response $response
     */
    public function setResponse(Response $response): void
    {
        $this->response = $response;
    }

    /**
     * @param string|null $raw
     *
     * @return string
     */
    protected function escape(?string $raw): string
    {
        if (null === $raw) {
            return '';
        }

        $result = preg_replace('/\s/', '\\s', $raw);
        if (null === $result) {
            return '';
        }

        return $result;
    }
}
