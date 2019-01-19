<?php

namespace Goral\ContactUs\Block\Adminhtml\Contact\Edit;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Backend\Block\Widget\Context;
use Goral\ContactUs\Api\ContactRepositoryInterface;

/**
 * Contact AbstractButton
 */
abstract class AbstractButton implements ButtonProviderInterface
{
    /**
     * @var Context
     */
    private $context;

    /**
     * @var ContactRepositoryInterface
     */
    private $contactRepository;

    /**
     * DeleteButton constructor.
     *
     * @param \Magento\Backend\Block\Widget\Context           $context
     * @param \Goral\ContactUs\Api\ContactRepositoryInterface $contactRepository
     */
    public function __construct(
        Context $context,
        ContactRepositoryInterface $contactRepository
    ) {
        $this->context = $context;
        $this->contactRepository = $contactRepository;
    }

    /**
     * @return array
     */
    abstract public function getButtonData();

    /**
     * Return contact ID
     *
     * @return int|null
     */
    public function getContactId()
    {
        try {
            return $this->contactRepository
                ->getById($this->context->getRequest()->getParam('entity_id'))
                ->getId();
        } catch (NoSuchEntityException $e) {
        }

        return null;
    }

    /**
     * Get URL
     *
     * @param null $path
     * @param null $params
     *
     * @return string
     */
    public function getUrl($path = null, $params = null)
    {
        return $this->context->getUrlBuilder()->getUrl($path, $params);
    }
}