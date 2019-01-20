<?php

namespace Goral\ContactUs\Controller\Adminhtml\Contact;

use Goral\ContactUs\Api\Data\ContactInterface as Contact;
use Goral\ContactUs\Api\ContactRepositoryInterface as ContactRepository;
use Goral\ContactUs\Api\Data\ContactInterfaceFactory as ContactFactory;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Backend\App\Action\Context;

/**
 * Contact Save
 */
class Save extends AbstractAction
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
     * Save action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            /** @var Contact $model */
            $model = $this->contactFactory->create();

            $id = $this->getRequest()->getParam('entity_id');
            if ($id) {
                $model = $this->contactRepository->getById($id);
            }

            $model->setData($data);

            try {
                $this->contactRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the contact.'));
                $this->dataPersistor->clear('goral_contactus');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the contact.'));
            }
            $this->dataPersistor->set('goral_contactus', $data);

            return $resultRedirect->setPath(
                '*/*/edit',
                ['entity_id' => $id]
            );
        }

        return $resultRedirect->setPath('*/*/');
    }

}
