<?php

namespace Goral\ContactUs\Model\ResourceModel\Contact;

/**
 * Class Collection
 *
 * @package Goral\ContactUs\Model\ResourceModel\Contact
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'entity_id';

    protected function _construct()
    {
        $this->_init(
            \Goral\ContactUs\Model\Contact::class,
            \Goral\ContactUs\Model\ResourceModel\Contact::class
        );
    }

}