<?php

namespace Camph\Faq\Model\ResourceModel;

use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class FaqGroup extends AbstractDb
{


    /**
     * Initialize resource
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('camph_faqgroup', 'faqgroup_id');
    }


}

