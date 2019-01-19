<?php

namespace Goral\ContactUs\Controller\Adminhtml\Contact;

use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Goral\ContactUs\Api\ContactRepositoryInterface as ContactRepository;

/**
 * Contact Delete
 */
class Delete extends AbstractAction
{
    /**
     * @var ContactRepository
     */
    private $contactRepository;

    /**
     * @param ContactRepository $contactRepository
     * @param Context           $context
     */
    public function __construct(
        Context $context,
        ContactRepository $contactRepository
    ) {
        parent::__construct($context);
        $this->contactRepository = $contactRepository;
    }

    /**
     * Delete action
     *
     * @return Redirect
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('entity_id');
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $this->contactRepository->deleteById($id);
                $this->messageManager->addSuccessMessage(__('The contact has been deleted.'));
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('Something went wrong while trying to delete the contact.'));

                return $resultRedirect->setPath('*/*/edit', ['entity_id' => $id]);
            }
        }

        return $resultRedirect->setPath('*/*/');
    }
}
