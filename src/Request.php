<?php

namespace Mangati\Api;

use Exception;

/**
 * Request
 * @author Rogerio Lino <rogeriolino@gmail.com>
 */
class Request
{
    /**
     * @param string $method
     * @param string $url
     * @param array  $data
     * @param array  $headers
     * @return array
     */
    public function do(string $method, string $url, array $data = [], array $headers = []): ?array
    {
        $method    = strtoupper($method);
        $ch        = curl_init($url);
        $headers[] = 'Content-Type: application/json';

        //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        switch ($method) {
            case 'POST':
            case 'PUT':
                $content = json_encode($data);
                if ($method === 'POST') {
                    curl_setopt($ch, CURLOPT_POST, true);
                } else {
                    curl_setopt($ch, CURLOPT_PUT, true);
                }
                curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
                $headers[] = 'Content-Length: ' . strlen($content);
                break;
            case 'DELETE':
            case 'PUT':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
                break;
        }

        $json     = null;
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode === 200) {
            if (!empty($response)) {
                $json = json_decode($response, true);

                if (!is_array($json)) {
                    throw new Exception('Expected a JSON, given: ' . $response);
                }
            }
        } else {
            throw new Exception($response, $httpCode);
        }

        return $json;
    }
}
