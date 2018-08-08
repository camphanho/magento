<?php

namespace Camph\Faq\Model\ResourceModel\Faq;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * Initialize resource collection
     *
     * @return void
     */
    public $_idFieldName = 'faq_id';

    public function __construct(
        \Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy,
        \Magento\Framework\Event\ManagerInterface $eventManager,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\DB\Adapter\AdapterInterface $connection = null,
        \Magento\Framework\Model\ResourceModel\Db\AbstractDb $resource = null
    ) {
        $this->_init(
            'Camph\Faq\Model\Faq',
            'Camph\Faq\Model\ResourceModel\Faq'
        );
        parent::__construct(
            $entityFactory, $logger, $fetchStrategy, $eventManager, $connection,
            $resource
        );
        $this->storeManager = $storeManager;
    }
    protected function _initSelect()
    {
        parent::_initSelect(); // TODO: Change the autogenerated stub
        /*$this->getSelect()
            ->joinLeft(
                ['camph_faq_faqgroup' => $this->getTable('camph_faq_faqgroup')],
                'main_table.faq_id = camph_faq_faqgroup.id_faq',
                ['id_faqgroup' => "GROUP_CONCAT(id_faqgroup ORDER BY id_faqgroup SEPARATOR ', ') as group"]
            )->distinct(true)->group(['faq_id', 'question', 'answer', 'sortorder']);
        */
        $this->getSelect()
            ->join(
                ['bo' => $this->getTable('camph_faq_faqgroup')],
                'bo.id_faq = main_table.faq_id',
                ['id_faqgroup']
            )
            ->join(
                ['bs' => $this->getTable('camph_faqgroup')],
                'bo.id_faqgroup = bs.faqgroup_id',
                ['groupname' => "GROUP_CONCAT(groupname ORDER BY groupname SEPARATOR ', ') as group"]
            )->distinct(true)->group(['faq_id', 'question', 'answer']);
    }

    /*public function addGroupFilter($condition = null)
    {

        var_dump($condition);
        die();
    }*/
    public function addFieldToFilter($field, $condition=null)
    {
        if ($field === 'group') {
            var_dump($condition);die;
            return $this->addGroupFilter($condition, false);
        }
        return parent::addFieldToFilter($field, $condition);
    }


    public function addGroupFilter($condition = null)
    {
        if (!$this->getFlag('group_filter_added')) {
            $this->performAddGroupFilter($condition);
        }
        return $this;
    }

    protected function performAddGroupFilter($condition)
    {
//        echo ("<pre>");
//        print_r($group);die;
//        if ($group instanceof Store) {
//            $group = [$group->getId()];
//        }

        if (!is_array($condition)) {
            $condition = [$condition];
        }

        $this->addFilter('main_table.group',  $this->getConnection()->quoteInto('main_table.group LIKE %?%', 2), 'public');

    }

//    protected function _renderFiltersBefore()
//    {
//        //$entityMetadata = $this->metadataPool->getMetadata(StoreInterface::class);
//        $this->joinGroupRelationTable('camph_faqgroup', 'group');
//    }

//    protected function joinGroupRelationTable($tableName, $linkField)
//    {
//        if ($this->getFilter('group')) {
//            $this->getSelect()->join(
//                ['group_table' => $this->getTable($tableName)],
//                'main_table.group = group_table.faqgroup_id',
//                []
//            )->group(
//                'main_table.' . $linkField
//            );
//        }
//        parent::_renderFiltersBefore();
//    }
}
