<?php

namespace Goral\ContactUs\Api\Data;

/**
 * ContactUs interface
 *
 * @api
 */
interface ContactInterface
{
    /**#@+
     * Constants
     *
     * @var string
     */
    const ENTITY_ID  = 'entity_id';
    const NAME       = 'name';
    const EMAIL      = 'email';
    const TELEPHONE  = 'telephone';
    const COMMENT    = 'comment';
    const ANSWER     = 'answer';
    const STATUS     = 'status';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const STORE_ID = 'store_id';
    /**#@-*/

    /**
     * Contact id
     *
     * @return int|null
     */
    public function getId();

    /**
     * Set contact id
     *
     * @param int $id
     *
     * @return $this
     */
    public function setId($id);

    /**
     * Contact Name
     *
     * @return string
     */
    public function getName();

    /**
     * Set contact name
     *
     * @param string $name
     *
     * @return $this
     */
    public function setName($name);

    /**
     * Contact email
     *
     * @return string|null
     */
    public function getEmail();

    /**
     * Set contact email
     *
     * @param string $email
     *
     * @return $this
     */
    public function setEmail($email);

    /**
     * Contact telephone
     *
     * @return string|null
     */
    public function getTelephone();

    /**
     * Set contact telephone
     *
     * @param string $telephone
     *
     * @return $this
     */
    public function setTelephone($telephone);

    /**
     * Contact comment
     *
     * @return string|null
     */
    public function getComment();

    /**
     * Set contact comment
     *
     * @param string $comment
     *
     * @return $this
     */
    public function setComment($comment);

    /**
     * Contact answer
     *
     * @return string|null
     */
    public function getAnswer();

    /**
     * Set contact answer
     *
     * @param string $answer
     *
     * @return $this
     */
    public function setAnswer($answer);

    /**
     * Contact status
     *
     * @return int
     */
    public function getStatus();

    /**
     * Set contact status
     *
     * @param int $status
     *
     * @return $this
     */
    public function setStatus($status);

    /**
     * Get created at
     *
     * @return string
     */
    public function getCreatedAt();

    /**
     * Set created at
     *
     * @param string $createdAt
     *
     * @return $this
     */
    public function setCreatedAt($createdAt);

    /**
     * Get updated at
     *
     * @return string
     */
    public function getUpdatedAt();

    /**
     * Set created at
     *
     * @param string $updatedAt
     *
     * @return $this
     */
    public function setUpdatedAt($updatedAt);

    /**
     * Contact store ID
     *
     * @return int
     */
    public function getStoreId();

    /**
     * Set contact store ID
     *
     * @param int $storeId
     *
     * @return $this
     */
    public function setStoreId($storeId);

}
