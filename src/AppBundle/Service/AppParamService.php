<?php
namespace AppBundle\Service;

use AppBundle\Entity\AppParam;

/**
 *
 * @author Vincent
 *        
 */
interface AppParamService
{
    
    /**
     * trouve un AppParam par le nom du paramétre
     * @param string $paramName
     * @return AppParam
     */
    public function getParam($name);
    
    /**
     * @param AppParam $param
     * @return AppParam
     */
    public function create(AppParam $param);
    /**
     * @param AppParam $param
     * @return AppParam
     */
    public function update(AppParam $param);
    /**
     * @param AppParam $param
     * @return AppParam
     */
    public function delete(AppParam $param);
}

