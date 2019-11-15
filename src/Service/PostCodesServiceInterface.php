<?php

namespace App\Service;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

interface PostCodesServiceInterface
{

    /**
     * Lookup for a valid postcode. Return NULL if not found.
     * 
     * @param string $postcode
     * @return array|null
     * @throws NotFoundHttpException
     */
    public function lookup(string $postcode): ?array;
    
    /**
     * Validate a postcode.
     * 
     * @param string $postcode
     * @return bool
     */
    public function validate(string $postcode): bool;
}
