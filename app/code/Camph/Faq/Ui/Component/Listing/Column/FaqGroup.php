<?php
/**
 * Created by PhpStorm.
 * User: camph
 * Date: 08/08/2018
 * Time: 11:01
 */
namespace Camph\Faq\Ui\Component\Listing\Column;

class FaqGroup implements \Magento\Framework\Option\ArrayInterface
{
    private $groupCollection;
    private $faqCollection;
    public function __construct(
        \Camph\Faq\Model\ResourceModel\FaqGroup\CollectionFactory $groupCollection,
        \Camph\Faq\Model\ResourceModel\Faq\CollectionFactory $faqCollection
    ) {
        $this->groupCollection = $groupCollection;
        $this->faqCollection = $faqCollection;
    }

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        $groupArr = [];
        $groups = $this->groupCollection->create();

        foreach ($groups as $group) {
            $groupArr[] = ['value' => $group->getGroupname(), 'label' => __($group->getGroupname())];
        }
        return $groupArr;
    }

    /**
     * @return \Camph\Faq\Model\ResourceModel\FaqGroup\CollectionFactory
     */
    /**
     * @param \Camph\Faq\Model\ResourceModel\FaqGroup\CollectionFactory $groupCollection
     */
    /**
     * @return \Camph\Faq\Model\ResourceModel\FaqGroup\CollectionFactory
     */
}