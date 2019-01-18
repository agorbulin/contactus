<?php

namespace Goral\ContactUs\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\NoSuchEntityException;
use Goral\ContactUs\Api\ContactRepositoryInterface;
use Goral\ContactUs\Api\Data\ContactInterface;
use Goral\ContactUs\Api\Data\ContactSearchResultInterfaceFactory;
use Goral\ContactUs\Model\ResourceModel\Contact\CollectionFactory as ContactCollectionFactory;
use Goral\ContactUs\Model\ResourceModel\Contact\Collection;

/**
 * Class ContactRepository
 *
 * @package Goral\ContactUs\Model
 */
class ContactRepository implements ContactRepositoryInterface
{
    /**
     * @var ContactFactory
     */
    private $contactFactory;

    /**
     * @var ContactCollectionFactory
     */
    private $contactCollectionFactory;

    /**
     * @var ContactSearchResultInterfaceFactory
     */
    private $searchResultFactory;

    /**
     * ContactRepository constructor.
     *
     * @param \Goral\ContactUs\Model\ContactFactory                          $contactFactory
     * @param \Goral\ContactUs\Model\ResourceModel\Contact\CollectionFactory $contactCollectionFactory
     * @param \Goral\ContactUs\Api\Data\ContactSearchResultInterfaceFactory  $contactSearchResultInterfaceFactory
     */
    public function __construct(
        ContactFactory $contactFactory,
        ContactCollectionFactory $contactCollectionFactory,
        ContactSearchResultInterfaceFactory $contactSearchResultInterfaceFactory
    ) {
        $this->contactFactory = $contactFactory;
        $this->contactCollectionFactory = $contactCollectionFactory;
        $this->searchResultFactory = $contactSearchResultInterfaceFactory;
    }

    /**
     * @param int $id
     *
     * @return \Goral\ContactUs\Api\Data\ContactInterface
     * @throws NoSuchEntityException
     */
    public function getById($id)
    {
        $contact = $this->contactFactory->create();
        $contact->load($id);
        if (!$contact->getId()) {
            throw new NoSuchEntityException(__('Unable to find contact with ID %1', $id));
        }

        return $contact;
    }

    /**
     * @param \Goral\ContactUs\Api\Data\ContactInterface $contact
     *
     * @return \Goral\ContactUs\Api\Data\ContactInterface|\Goral\ContactUs\Model\Contact
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(ContactInterface $contact)
    {

        try {
            /** @var \Goral\ContactUs\Model\Contact $contact */
            $contact->save();
        } catch (\Exception $e) {
            throw new \Magento\Framework\Exception\CouldNotSaveException(__($e->getMessage()));
        }

        return $contact;
    }

    /**
     * @param \Goral\ContactUs\Api\Data\ContactInterface $contact
     *
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(ContactInterface $contact)
    {
        try {
            /** @var \Goral\ContactUs\Model\Contact $contact */
            $contact->delete();
        } catch (\Exception $e) {
            throw new \Magento\Framework\Exception\CouldNotDeleteException(__($e->getMessage()));
        }

        return true;
    }

    /**
     * Delete contact by Id
     *
     * @param int $id
     *
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function deleteById($id)
    {
        /** @var \Goral\ContactUs\Model\Contact $contact */
        $contact = $this->getById($id);

        return $this->delete($contact);
    }

    /**
     * Search contact list by search criteria
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     *
     * @return \Goral\ContactUs\Api\Data\ContactSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->contactCollectionFactory->create();

        $this->addFiltersToCollection($searchCriteria, $collection);
        $this->addSortOrdersToCollection($searchCriteria, $collection);
        $this->addPagingToCollection($searchCriteria, $collection);

        $collection->load();

        return $this->buildSearchResult($searchCriteria, $collection);
    }

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface          $searchCriteria
     * @param \Goral\ContactUs\Model\ResourceModel\Contact\Collection $collection
     */
    private function addFiltersToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            $fields = $conditions = [];
            foreach ($filterGroup->getFilters() as $filter) {
                $fields[] = $filter->getField();
                $conditions[] = [$filter->getConditionType() => $filter->getValue()];
            }
            $collection->addFieldToFilter($fields, $conditions);
        }
    }

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface          $searchCriteria
     * @param \Goral\ContactUs\Model\ResourceModel\Contact\Collection $collection
     */
    private function addSortOrdersToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        foreach ((array)$searchCriteria->getSortOrders() as $sortOrder) {
            $direction = $sortOrder->getDirection() == SortOrder::SORT_ASC ? 'asc' : 'desc';
            $collection->addOrder($sortOrder->getField(), $direction);
        }
    }

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface          $searchCriteria
     * @param \Goral\ContactUs\Model\ResourceModel\Contact\Collection $collection
     */
    private function addPagingToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        $collection->setPageSize($searchCriteria->getPageSize());
        $collection->setCurPage($searchCriteria->getCurrentPage());
    }

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface          $searchCriteria
     * @param \Goral\ContactUs\Model\ResourceModel\Contact\Collection $collection
     *
     * @return mixed
     */
    private function buildSearchResult(SearchCriteriaInterface $searchCriteria, Collection $collection)
    {
        $searchResults = $this->searchResultFactory->create();

        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

}
