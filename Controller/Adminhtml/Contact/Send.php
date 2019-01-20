<?php

namespace Goral\ContactUs\Controller\Adminhtml\Contact;

use Goral\ContactUs\Api\ContactRepositoryInterface as ContactRepository;
use Goral\ContactUs\Api\Data\ContactInterface;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Backend\App\Action\Context;
use Goral\ContactUs\Model\ContactValidator;
use Goral\ContactUs\Model\Mail;
use Goral\ContactUs\Ui\Component\Listing\Column\Status;

/**
 * Contact Save
 */
class Send extends AbstractAction
{
    /**
     * @var ContactRepository
     */
    private $contactRepository;

    private $contactValidator;

    private $mail;

    /**
     * Send constructor.
     *
     * @param Context           $context
     * @param ContactRepository $contactRepository
     * @param ContactValidator  $contactValidator
     * @param Mail              $mail
     */
    public function __construct(
        Context $context,
        ContactRepository $contactRepository,
        ContactValidator $contactValidator,
        Mail $mail
    ) {
        $this->contactRepository = $contactRepository;
        $this->contactValidator = $contactValidator;
        $this->mail = $mail;
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

        if (!$id) {
            return $resultRedirect->setPath('*/*/');
        }

        try {
            /** @var ContactInterface $contact */
            $contact = $this->contactRepository->getById($id);
            if ($this->contactValidator->isValid($contact)) {
                $this->mail->send($contact);
                if ($contact->getStatus() != Status::STATUS_PROCESSED) {
                    $contact->setStatus(Status::STATUS_PROCESSED);
                    $this->contactRepository->save($contact);
                }
                $this->messageManager->addSuccessMessage(__('You sent the answer email.'));
            } else {
                foreach ($this->contactValidator->getMessages() as $message) {
                    throw new \Exception($message);
                }
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('Email was not sent. ' . $e->getMessage()));
        }

        return $resultRedirect->setPath('*/*/edit', ['entity_id' => $id]);
    }

}
