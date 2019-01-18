<?php

namespace Goral\ContactUs\Controller\Adminhtml\Contact;

use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Goral\ContactUs\Model\ResourceModel\Contact\CollectionFactory;
use Goral\ContactUs\Api\ContactRepositoryInterface as ContactRepository;

/**
 * MassDelete
 */
class MassDelete extends AbstractAction
{
    /**
     * @var Filter
     */
    private $filter;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var ContactRepository
     */
    private $contactRepository;

    /**
     * @param Context           $context
     * @param Filter            $filter
     * @param CollectionFactory $collectionFactory
     * @param ContactRepository $contactRepository
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        ContactRepository $contactRepository
    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->contactRepository = $contactRepository;
        parent::__construct($context);
    }

    /**
     * Execute action
     *
     * @return Redirect
     * @throws \Magento\Framework\Exception\LocalizedException|\Exception
     */
    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $collectionSize = $collection->getSize();

        try {
            foreach ($collection as $item) {
                $this->contactRepository->delete($item);
            }

            $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been deleted.', $collectionSize));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('Something went wrong while deleting contact.'));
        }
        /**
         * @var Redirect $resultRedirect
         */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        return $resultRedirect->setPath('*/*/');
    }
}
