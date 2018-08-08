<?php

namespace Camph\Faq\Model\ResourceModel\FaqGroup;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * Initialize resource collection
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('Camph\Faq\Model\FaqGroup', 'Camph\Faq\Model\ResourceModel\FaqGroup');
    }
    public function toOptionArray()
    {
        return parent::_toOptionArray('faqgroup_id', 'groupname');
    }
}
