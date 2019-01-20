<?php

namespace Goral\ContactUs\Model;

use Magento\Framework\Validator\AbstractValidator;
use Goral\ContactUs\Api\Data\ContactInterface;

/**
 * Contact Validator
 */
class ContactValidator extends AbstractValidator
{

    /**
     * Validate contact data
     *
     * @param ContactInterface $contact
     *
     * @return bool
     * @throws \Zend_Validate_Exception
     */
    public function isValid($contact)
    {
        $errors = [];

        if (!\Zend_Validate::is($contact->getName(), 'NotEmpty')) {
            $errors['name'] = __('Name can\'t be empty.');
        }

        if (!\Zend_Validate::is($contact->getEmail(), 'NotEmpty')) {
            $errors['email'] = __('Email can\'t be empty.');
        }

        if (!\Zend_Validate::is($contact->getComment(), 'NotEmpty')) {
            $errors['comment'] = __('Comment can\'t be empty.');
        }

        if (!\Zend_Validate::is($contact->getAnswer(), 'NotEmpty')) {
            $errors['answer'] = __('Answer can\'t be empty.');
        }

        $this->_addMessages($errors);

        return empty($errors);
    }

}
