<?php

namespace Goral\ContactUs\Block\Adminhtml\Contact\Edit;

/**
 * Contact DeleteButton
 */
class DeleteButton extends AbstractButton
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
                'label'      => __('Delete'),
                'class'      => 'delete',
                'on_click'   => sprintf(
                    "deleteConfirm('%s', '%s')",
                    __('Are you sure you want to remove this contact?'),
                    $this->getUrl('*/*/delete', ['entity_id' => $contactId])
                ),
                'sort_order' => 50,
            ];
        }

        return $data;
    }

}
