<?php

namespace Goral\ContactUs\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * ContactUs search results interface
 *
 * @api
 */
interface ContactSearchResultInterface extends SearchResultsInterface
{
    /**
     * Get items
     *
     * @return \Goral\ContactUs\Api\Data\ContactInterface[]
     */
    public function getItems();

    /**
     * Set items
     *
     * @param \Goral\ContactUs\Api\Data\ContactInterface[] $items
     *
     * @return $this
     */
    public function setItems(array $items);
}