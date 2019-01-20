<?php

namespace Goral\ContactUs\Plugin;

use Goral\ContactUs\Api\ContactRepositoryInterface;
use Goral\ContactUs\Api\Data\ContactInterfaceFactory;
use Goral\ContactUs\Api\Data\ContactInterface;
use Magento\Store\Model\StoreManagerInterface;
use Psr\Log\LoggerInterface;
use Magento\Contact\Controller\Index\Post;
use Magento\Framework\Controller\Result\Redirect;

/**
 * Class MagentoContactPost
 *
 * @package Goral\ContactUs\Plugin
 */
class MagentoContactPost
{
    /**
     * @var ContactRepositoryInterface
     */
    private $contactRepository;

    /**
     * @var ContactInterfaceFactory
     */
    private $contactFactory;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * MagentoContactPost constructor.
     *
     * @param ContactRepositoryInterface $contactRepository
     * @param ContactInterfaceFactory    $contactFactory
     * @param StoreManagerInterface      $storeManager
     * @param LoggerInterface            $logger
     */
    public function __construct(
        ContactRepositoryInterface $contactRepository,
        ContactInterfaceFactory $contactFactory,
        StoreManagerInterface $storeManager,
        LoggerInterface $logger

    ) {
        $this->contactRepository = $contactRepository;
        $this->contactFactory = $contactFactory;
        $this->storeManager = $storeManager;
        $this->logger = $logger;
    }

    /**
     * @param Post     $subject
     * @param Redirect $result
     *
     * @return Redirect
     */
    public function afterExecute(Post $subject, $result)
    {
        $post = $subject->getRequest()->getParams();
        try {
            $this->createContact($post);
        } catch (\Exception $e) {
            $this->logger->critical($e);
        }

        return $result;
    }

    /**
     * Create contact from Post data
     *
     * @param array $post
     *
     * @return \Goral\ContactUs\Api\Data\ContactInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    private function createContact($post)
    {
        $name = $post['name'] ?? null;
        $email = $post['email'] ?? null;
        $telephone = $post['telephone'] ?? null;
        $comment = $post['comment'] ?? null;
        $storeId = $this->storeManager->getStore()->getId();
        /** @var ContactInterface $contact */
        $contact = $this->contactFactory->create();
        $contact->setName($name);
        $contact->setEmail($email);
        $contact->setTelephone($telephone);
        $contact->setComment($comment);
        $contact->setStoreId($storeId);
        $this->contactRepository->save($contact);

        return $contact;
    }
}