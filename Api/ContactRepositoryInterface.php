<?php

namespace Goral\ContactUs\Api;

/**
 * Interface for managing contacts from 'contact us' form
 *
 * @api
 */
interface ContactRepositoryInterface
{
    /**
     * @param \Goral\ContactUs\Api\Data\ContactInterface $contact
     *
     * @return \Goral\ContactUs\Api\Data\ContactInterface $contact
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(\Goral\ContactUs\Api\Data\ContactInterface $contact);

    /**
     * Get info about contact by contact id
     *
     * @param int $id
     *
     * @return \Goral\ContactUs\Api\Data\ContactInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($id);

    /**
     * Delete contact
     *
     * @param \Goral\ContactUs\Api\Data\ContactInterface $contact
     *
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(\Goral\ContactUs\Api\Data\ContactInterface $contact);

    /**
     * Delete contact by Id
     *
     * @param int $id
     *
     * @return bool
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Exception If something went wrong while performing the delete.
     */
    public function deleteById($id);

    /**
     * Search contact list by search criteria
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     *
     * @return \Goral\ContactUs\Api\Data\ContactSearchResultInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
}
