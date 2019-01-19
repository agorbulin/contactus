<?php

namespace Goral\ContactUs\Controller\Adminhtml\Contact;

use Goral\ContactUs\Api\Data\ContactInterface as Contact;
use Goral\ContactUs\Api\ContactRepositoryInterface;
use Goral\ContactUs\Api\Data\ContactInterfaceFactory as ContactFactory;
use \Magento\Backend\Model\View\Result\Redirect;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\Model\View\Result\Page;

/**
 * Contact Edit
 */
class Edit extends AbstractAction
{
    /**
     * @var ContactRepositoryInterface
     */
    private $contactRepository;

    /**
     * @var ContactFactory
     */
    private $contactFactory;

    /**
     * @var PageFactory
     */
    private $resultPageFactory;

    /**
     * @param Context                    $context
     * @param ContactRepositoryInterface $contactRepository
     * @param ContactFactory             $contactFactory
     * @param PageFactory                $resultPageFactory
     */
    public function __construct(
        Context $context,
        ContactRepositoryInterface $contactRepository,
        ContactFactory $contactFactory,
        PageFactory $resultPageFactory
    ) {
        $this->contactRepository = $contactRepository;
        $this->contactFactory = $contactFactory;
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * Init actions
     *
     * @return Page
     */
    private function initAction()
    {
        /** @var Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Goral_ContactUs::contact')
                   ->addBreadcrumb(__('ContactUs Contacts'), __('ContactUs Contacts'))
                   ->addBreadcrumb(__('Manage Contacts'), __('Manage Contacts'));

        return $resultPage;
    }

    /**
     * Edit Contact page
     *
     * @return Redirect|Page
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('entity_id');
        if ($id) {
            /** @var Contact $model */
            $model = $this->contactRepository->getById($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This item no longer exists.'));
                /** @var Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();

                return $resultRedirect->setPath('*/*/');
            }
        }

        /** @var Page $resultPage */
        $resultPage = $this->initAction();
        $resultPage->addBreadcrumb(__('Edit Contact'), __('Edit Contact'));
        $resultPage->getConfig()->getTitle()->prepend(__('Contact'));

        return $resultPage;
    }
}
