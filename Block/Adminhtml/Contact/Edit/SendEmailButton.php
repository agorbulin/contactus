<?php

namespace Goral\ContactUs\Block\Adminhtml\Contact\Edit;

/**
 * Contact SendEmailButton
 */
class SendEmailButton extends AbstractButton
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        $data = [];
        $contactId = $this->getContactId();
        if ($contactId !== null) {
            $data = [
                'label'      => __('Send Email'),
                'class'      => 'send',
                'on_click'   => sprintf(
                    "deleteConfirm('%s', '%s')",
                    __('Are you sure you want to send answer?'),
                    $this->getUrl('*/*/send', ['entity_id' => $contactId])
                ),
                'sort_order' => 50,
            ];
        }

        return $data;
    }

}
