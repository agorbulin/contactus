<?php

namespace Goral\ContactUs\Model;

use Goral\ContactUs\Api\Data\ContactInterface;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\Area;
use Goral\ContactUs\Helper\Data;
use Magento\Contact\Model\ConfigInterface;
use Magento\Framework\DataObject;

/**
 * Class Mail
 *
 * @package Goral\ContactUs\Model
 */
class Mail
{
    /**
     * @var ConfigInterface
     */
    private $contactsConfig;

    /**
     * @var TransportBuilder
     */
    private $transportBuilder;

    /**
     * @var StateInterface
     */
    private $inlineTranslation;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var Data
     */
    private $helper;

    /**
     * Mail constructor.
     *
     * @param ConfigInterface       $contactsConfig
     * @param TransportBuilder      $transportBuilder
     * @param StateInterface        $inlineTranslation
     * @param StoreManagerInterface $storeManager
     * @param Data                  $helper
     */
    public function __construct(
        ConfigInterface $contactsConfig,
        TransportBuilder $transportBuilder,
        StateInterface $inlineTranslation,
        StoreManagerInterface $storeManager,
        Data $helper
    ) {
        $this->contactsConfig = $contactsConfig;
        $this->transportBuilder = $transportBuilder;
        $this->inlineTranslation = $inlineTranslation;
        $this->storeManager = $storeManager;
        $this->helper = $helper;
    }

    /**
     *  Send email to contact
     *
     * @param ContactInterface $contact
     *
     * @throws \Magento\Framework\Exception\MailException
     */
    public function send($contact)
    {
        $this->inlineTranslation->suspend();
        try {
            $transport = $this->transportBuilder
                ->setTemplateIdentifier($this->helper->getTemplate())
                ->setTemplateOptions(
                    [
                        'area'  => Area::AREA_FRONTEND,
                        'store' => $contact->getStoreId()
                    ]
                )
                ->setTemplateVars(['data' => new DataObject($contact->getData())])
                ->setFrom($this->contactsConfig->emailSender())
                ->addTo($contact->getEmail())
                ->setReplyTo($this->contactsConfig->emailRecipient(), $this->contactsConfig->emailSender())
                ->getTransport();

            $transport->sendMessage();
        } finally {
            $this->inlineTranslation->resume();
        }
    }
}
