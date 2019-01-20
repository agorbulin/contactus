<?php

namespace Goral\ContactUs\Helper;

use Magento\Store\Model\ScopeInterface;

/**
 * Class Helper Data
 *
 * @package Goral\ContactUs\Helper
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    const XML_PATH_ENABLED  = 'contactus/general/enabled';
    const XML_PATH_TEMPLATE = 'contactus/general/template';

    /**
     * @param string $scope
     * @param null   $scopeCode
     *
     * @return mixed
     */
    public function isEnabled($scope = ScopeInterface::SCOPE_STORE, $scopeCode = null)
    {
        return $this->scopeConfig->getValue(self::XML_PATH_ENABLED, $scope, $scopeCode);
    }

    /**
     * @param string $scope
     * @param null   $scopeCode
     *
     * @return mixed
     */
    public function getTemplate($scope = ScopeInterface::SCOPE_STORE, $scopeCode = null)
    {
        return $this->scopeConfig->getValue(self::XML_PATH_TEMPLATE, $scope, $scopeCode);
    }
}