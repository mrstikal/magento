<?php

namespace Mrstik\Pos\Ui\DataProvider\Pos\Form\Modifier;

use Magento\Ui\DataProvider\Modifier\ModifierInterface;
use Mrstik\Pos\Model\ResourceModel\Pos\CollectionFactory;

class PosData implements ModifierInterface
{
    protected $collection;

    public function __construct(
        CollectionFactory $posCollectionFactory
    ) {
        $this->collection = $posCollectionFactory->create();
    }

    public function modifyMeta(array $meta)
    {
        return $meta;
    }

    public function modifyData(array $data)
    {
        $items = $this->collection->getItems();

        foreach ($items as $pos) {
            $_data = $pos->getData();
            $pos->setData($_data);
            $data[$pos->getId()] = $_data;
        }

        return $data;
    }
}
