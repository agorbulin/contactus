<?php

namespace Goral\ContactUs\Model;

use Magento\Framework\Model\AbstractExtensibleModel;
use Goral\ContactUs\Api\Data\ContactInterface;
use Goral\ContactUs\Api\Data\ContactExtensionInterface;

/**
 * ContactUs contact model
 *
 * @api
 */
class Contact extends AbstractExtensibleModel implements ContactInterface
{
    /**
     * Initialize resources
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Goral\ContactUs\Model\ResourceModel\Contact::class);
    }

    /**
     * Contact id
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->_getData(self::ENTITY_ID);
    }

    /**
     * Set entity Id
     *
     * @param int $value
     *
     * @return $this
     */
    public function setId($value)
    {
        return $this->setData(self::ENTITY_ID, $value);
    }

    /**
     * Contact Name
     *
     * @return string
     */
    public function getName()
    {
        return $this->_getData(self::NAME);
    }

    /**
     * Set contact name
     *
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Contact email
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->_getData(self::EMAIL);
    }

    /**
     * Set contact email
     *
     * @param string $email
     *
     * @return $this
     */
    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * Contact telephone
     *
     * @return string|null
     */
    public function getTelephone()
    {
        return $this->_getData(self::TELEPHONE);
    }

    /**
     * Set contact telephone
     *
     * @param string $telephone
     *
     * @return $this
     */
    public function setTelephone($telephone)
    {
        return $this->setData(self::TELEPHONE, $telephone);
    }

    /**
     * Contact comment
     *
     * @return string|null
     */
    public function getComment()
    {
        return $this->_getData(self::COMMENT);
    }

    /**
     * Set contact comment
     *
     * @param string $comment
     *
     * @return $this
     */
    public function setComment($comment)
    {
        return $this->setData(self::COMMENT, $comment);
    }

    /**
     * Contact answer
     *
     * @return string|null
     */
    public function getAnswer()
    {
        return $this->_getData(self::ANSWER);
    }

    /**
     * Set contact answer
     *
     * @param string $answer
     *
     * @return $this
     */
    public function setAnswer($answer)
    {
        return $this->setData(self::ANSWER, $answer);
    }

    /**
     * Contact status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->_getData(self::STATUS);
    }

    /**
     * Set contact status
     *
     * @param int $status
     *
     * @return $this
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * Get created at
     *
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->_getData(self::CREATED_AT);
    }

    /**
     * Set created at
     *
     * @param string $createdAt
     *
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * Get updated at
     *
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->_getData(self::UPDATED_AT);
    }

    /**
     * Set created at
     *
     * @param string $updatedAt
     *
     * @return $this
     */
    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }

    /**
     * Contact store ID
     *
     * @return int
     */
    public function getStoreId()
    {
        return $this->getData(self::STORE_ID);
    }

    /**
     * Set contact store ID
     *
     * @param int $storeId
     *
     * @return $this
     */
    public function setStoreId($storeId)
    {
        return $this->setData(self::STORE_ID, $storeId);
    }

    /**
     * Retrieve existing extension attributes object or create a new one
     *
     * @return ContactExtensionInterface|\Magento\Framework\Api\ExtensionAttributesInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object
     *
     * @param \Goral\ContactUs\Api\Data\ContactExtensionInterface $extensionAttributes
     *
     * @return \Goral\ContactUs\Api\Data\ContactInterface|\Goral\ContactUs\Model\Contact
     */
    public function setExtensionAttributes(ContactExtensionInterface $extensionAttributes)
    {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

}
