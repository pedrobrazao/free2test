<?php

namespace App\Service;

use Exception;
use GuzzleHttp\Client;

class PostCodesService implements PostCodesServiceInterface
{

    const PLACEHOLDER = '{postcode}';
    const BASE_URI = 'https://api.postcodes.io';
    const LOOKUP_ENDPOINT = '/postcodes/{postcode}';
    const VALIDATE_ENDPOINT = '/postcodes/{postcode}/validate';

    private static $client;

    /**
     * Get client.
     * 
     * @return Client
     */
    public static function getClient(): Client
    {
        if (null === static::$client) {
            static::$client = new Client(['base_uri' => self::BASE_URI]);
        }

        return static::$client;
    }

    /**
     * Lookup for a valid postcode. Return NULL if not found.
     * 
     * @param string $postcode
     * @return array|null
     * @throws NotFoundHttpException
     */
    public function lookup(string $postcode): ?array
    {
        $endpoint = str_replace(self::PLACEHOLDER, $postcode, self::LOOKUP_ENDPOINT);

        try {
            $response = static::getClient()->get($endpoint);
        } catch (Exception $ex) {
            return null;
        }

        $data = json_decode($response->getBody()->getContents(), true)['result'];
        
        return [
            'postcode' => $data['postcode'],
            'city' => $data['admin_ward'] ?? null,
            'county' => $data['admin_county'] ?? null,
        ];
    }

    /**
     * Validate a postcode.
     * 
     * @param string $postcode
     * @return bool
     */
    public function validate(string $postcode): bool
    {
        $endpoint = str_replace(self::PLACEHOLDER, $postcode, self::VALIDATE_ENDPOINT);

        try {
            $response = static::getClient()->get($endpoint);
        } catch (Exception $ex) {
            return false;
        }

        $data = json_decode($response->getBody()->getContents(), true);
        
        return (bool) $data['result'] ?? false;
    }
}
