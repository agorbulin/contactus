<?php

namespace Goral\ContactUs\Model;

use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Goral\ContactUs\Model\ResourceModel\Contact\CollectionFactory;
use Goral\ContactUs\Model\ResourceModel\Contact\Collection;
use Goral\ContactUs\Api\Data\ContactInterface;

/**
 * Contact DataProvider
 */
class DataProvider extends AbstractDataProvider
{
    /**
     * @var Collection
     */
    protected $collection;

    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @var array
     */
    private $loadedData;

    /**
     * DataProvider constructor.
     *
     * @param                        $name
     * @param                        $primaryFieldName
     * @param                        $requestFieldName
     * @param CollectionFactory      $collectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array                  $meta
     * @param array                  $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();

        /**
         * @var ContactInterface $contact
         */
        foreach ($items as $contact) {
            $loadedData = $contact->getData();
            $this->loadedData[$contact->getId()] = $loadedData;
        }

        $data = $this->dataPersistor->get('goral_contactus');
        if (!empty($data)) {
            $contact = $this->collection->getNewEmptyItem();
            $contact->setData($data);
            $this->loadedData[$contact->getId()] = $contact->getData();
            $this->dataPersistor->clear('goral_contactus');
        }

        return $this->loadedData;
    }
}
