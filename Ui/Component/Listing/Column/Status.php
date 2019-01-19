<?php

namespace Goral\ContactUs\Ui\Component\Listing\Column;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class Status
 *
 * @package Goral\ContactUs\Ui\Component\Listing\Column
 */
class Status implements OptionSourceInterface
{
    /**
     * Contact status NOT processed, default
     */
    const STATUS_NOT_PROCESSED = 0;
    /**
     * Contact status processed
     */
    const STATUS_PROCESSED = 1;

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => self::STATUS_NOT_PROCESSED, 'label' => __('Not Processed')],
            ['value' => self::STATUS_PROCESSED, 'label' => __('Processed')]
        ];
    }
}
