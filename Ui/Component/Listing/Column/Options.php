<?php

namespace Goral\ContactUs\Ui\Component\Listing\Column;

use Magento\Store\Ui\Component\Listing\Column\Store\Options as StoreOptions;

class Options extends StoreOptions
{
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

        $this->generateCurrentOptions();
        $this->options = array_values($this->currentOptions);

        return $this->options;
    }
}
