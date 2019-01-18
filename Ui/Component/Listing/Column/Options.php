<?php

namespace Goral\ContactUs\Ui\Component\Listing\Column;

use Magento\Store\Ui\Component\Listing\Column\Store\Options as StoreOptions;

class Options extends StoreOptions
{
    /**
     * All Store Views value
     */
    const ADMIN_STORE = '0';

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        if ($this->options !== null) {
            return $this->options;
        }

        $this->currentOptions['Admin Store']['label'] = __('Admin Store');
        $this->currentOptions['Admin Store']['value'] = self::ADMIN_STORE;

        $this->generateCurrentOptions();

        $this->options = array_values($this->currentOptions);

        return $this->options;
    }
}
