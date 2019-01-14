<?php

namespace Goral\ContactUs\Model\ResourceModel;

/**
 * Class Contact
 *
 * @package Goral\ContactUs\Model\ResourceModel
 */
class Contact extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('goral_contactus', 'entity_id');
    }
}