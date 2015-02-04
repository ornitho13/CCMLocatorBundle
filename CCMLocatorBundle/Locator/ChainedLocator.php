<?php
/**
 * Created by PhpStorm.
 * User: jdebray
 * Date: 04/02/2015
 * Time: 11:21
 */

namespace CCMLocatorBundle\Locator;


class ChainedLocator implements LocatorInterface
{

    private $locators = null;

    public function addLocator(LocatorInterface $locator)
    {
        $this->locators[] = $locator;
    }

    /**
     * @param $query
     * @return array()
     */
    public function searchByKeyword($query)
    {
        // TODO: Implement searchByKeyword() method.
        $result = [];
        foreach ($this->locators as $locator) {
            $result = array_merge(
                $result,
                $locator->searchByKeyword($query)
            );
        }

        return $result;
    }
}