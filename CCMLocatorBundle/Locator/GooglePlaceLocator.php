<?php
/**
 * Created by PhpStorm.
 * User: jdebray
 * Date: 04/02/2015
 * Time: 10:38
 */

namespace CCMLocatorBundle\Locator;


class GooglePlaceLocator implements LocatorInterface
{

    public $key = null;

    /**
     * @param string $key the google api key
     */
    public function __construct($key)
    {
        $this->key = $key;
    }
    /**
     * @param string $query
     * @return array()
     */
    public function searchByKeyword($query)
    {
        $encodedUrlQuery = urlencode($query);

        $url = sprintf('https://maps.googleapis.com/maps/api/place/textsearch/json?query=%s&key=%s', $encodedUrlQuery, $this->key);

        $result = json_decode(file_get_contents($url), true);

        return array_map(function($result){
            return [
                'name' => $result['name'],
                'address' => $result['formatted_address'],
                'source' => 'Google',
            ];
        }, $result['results']);

    }
}

