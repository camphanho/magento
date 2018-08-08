<?php

namespace Camph\Faq\Model;

use \Magento\Framework\Model\AbstractModel;

class Faq extends AbstractModel
{


    /**
     * Initialize resource model
     * @return void
     */
    public function _construct()
    {
        $this->_init('Camph\Faq\Model\ResourceModel\Faq');
    }


}

