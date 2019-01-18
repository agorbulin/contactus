<?php

namespace Goral\ContactUs\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{

    protected $coreDate = null;

    protected $storeId = 1;

    public function __construct(
        \Magento\Framework\Stdlib\DateTime\DateTime $coreDate,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {

        $this->coreDate = $coreDate;
        $this->storeId = $storeManager->getDefaultStoreView()->getId();
    }

    /**
     * @version 8.0.0
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface   $context
     */
    public function install(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        unset($context);

        $installer = $setup;
        $installer->startSetup();

        $mockupContact = [
            'answer'     => null,
            'status'     => 0,
            'created_at' => $this->coreDate->date('Y-m-d H:i:s'),
            'updated_at' => $this->coreDate->date('Y-m-d H:i:s'),
            'store_id'   => $this->storeId,

        ];
        $contacts =
            [
                0 => array_merge(
                    [
                        'name'      => 'John',
                        'email'     => 'john@gmail.com',
                        'telephone' => '+380501111111',
                        'comment'   => 'Hello. I have got a comment.',
                    ],
                    $mockupContact
                ),
                1 => array_merge(
                    [
                        'name'      => 'Jill',
                        'email'     => 'jill@gmail.com',
                        'telephone' => '+380502222222',
                        'comment'   => 'Hello. I have got a comment.',
                    ],
                    $mockupContact
                ),
                2 => array_merge(
                    [
                        'name'      => 'Dax',
                        'email'     => 'dax@gmail.com',
                        'telephone' => '+380503333333',
                        'comment'   => 'Hello. I have got a comment.',
                    ],
                    $mockupContact
                ),
                3 => array_merge(
                    [
                        'name'      => 'Kelly',
                        'email'     => 'kelly@gmail.com',
                        'telephone' => '+380504444444',
                        'comment'   => 'Hello. I have got a comment.',
                    ],
                    $mockupContact
                ),
                4 => array_merge(
                    [
                        'name'      => 'Ivan',
                        'email'     => 'ivan@gmail.com',
                        'telephone' => '+380505555555',
                        'comment'   => 'Hello. I have got a feedback for you.',
                    ],
                    $mockupContact
                ),
            ];

        $installer->getConnection()->truncateTable($installer->getTable('goral_contactus'));
        foreach ($contacts as $contact) {
            $installer->getConnection()->insert($installer->getTable('goral_contactus'), $contact);
        }
        $installer->endSetup();
    }
}
