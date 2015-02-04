<?php
/**
 * Created by PhpStorm.
 * User: jdebray
 * Date: 04/02/2015
 * Time: 10:29
 */

namespace CCMLocatorBundle\Locator;


interface LocatorInterface
{
    /**
     * @param $query
     * @return array()
     */
    public function searchByKeyword($query);
}