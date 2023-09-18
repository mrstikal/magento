<?php

namespace Mrstik\Pos\Block\Pos;

use Magento\Framework\UrlFactory;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Theme\Block\Html\Pager;
use Mrstik\Pos\Model\Pos;
use Mrstik\Pos\Model\ResourceModel\Pos\CollectionFactory as PosCollectionFactory;

class ListPos extends Template
{
    protected $posCollectionFactory;

    protected $urlFactory;

    protected $pointsOfSale;

    public function __construct(
        Context $context,
        posCollectionFactory $posCollectionFactory,
        UrlFactory $urlFactory,
        array $data = []
    ) {
        $this->posCollectionFactory = $posCollectionFactory;
        $this->urlFactory = $urlFactory;
        parent::__construct($context, $data);
    }

    public function getPointsOfSale()
    {
        if (is_null($this->pointsOfSale)) {
            $this->pointsOfSale = $this->posCollectionFactory->create()
                ->addFieldToSelect('*')
                ->addFieldToFilter('is_available', POS::STATUS_AVAILABLE)
                ->setOrder('name', 'ASC');
        }
        return $this->pointsOfSale;
    }

    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $pager = $this->getLayout()->createBlock(Pager::class, 'mrstik_pos.pos.list.pager');
        $pager->setAvailableLimit([10 => 10, 20 => 20, 30 => 30, 50 => 50]);
        $pager->setLimit(20);
        $pager->setCollection($this->getpointsOfSale());
        
        $this->setChild('pager', $pager);
        $this->getpointsOfSale()->load();

        $this->pageConfig->getTitle()->set(__('Points of Sale'));  

        return $this;
    }

    /**
     * @return string
     */
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }
}
