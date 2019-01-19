<?php

namespace Goral\ContactUs\Block\Adminhtml\Contact\Edit;

/**
 * Contact BackButton
 */
class BackButton extends AbstractButton
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label'      => __('Back'),
            'on_click'   => sprintf("location.href = '%s';", $this->getUrl('*/*/')),
            'class'      => 'back',
            'sort_order' => 10
        ];
    }
}
