<?php

namespace Goral\ContactUs\Controller\Adminhtml\Contact;

use Goral\ContactUs\Api\ContactRepositoryInterface as ContactRepository;
use Goral\ContactUs\Api\Data\ContactInterfaceFactory as ContactFactory;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Backend\App\Action\Context;

/**
 * Contact Save
 */
class Send extends AbstractAction
{
    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @var ContactRepository
     */
    private $contactRepository;

    /**
     * @var ContactFactory
     */
    private $contactFactory;

    /**
     * Save constructor.
     *
     * @param Context                $context
     * @param DataPersistorInterface $dataPersistor
     * @param ContactRepository      $contactRepository
     * @param ContactFactory         $contactFactory
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor,
        ContactRepository $contactRepository,
        ContactFactory $contactFactory
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->contactRepository = $contactRepository;
        $this->contactFactory = $contactFactory;
        parent::__construct($context);
    }

    /**
     * Send email action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('entity_id');

        if ($id) {
            /** @todo Send email */
            $this->messageManager->addSuccessMessage(__('You sent answer for contact ' . $id));
        }

        return $resultRedirect->setPath('*/*/');
    }

}
