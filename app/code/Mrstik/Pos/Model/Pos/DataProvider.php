<?php

namespace Mrstik\Pos\Model\Pos;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Ui\DataProvider\Modifier\PoolInterface;
use Mrstik\Pos\Model\ResourceModel\Pos\CollectionFactory;

class DataProvider extends AbstractDataProvider
{
    protected $loadedData;

    protected $pool;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $posCollectionFactory,
        PoolInterface $pool,
        array $meta = [],
        array $data = []
    ) {

        $this->collection = $posCollectionFactory->create();
        $this->pool = $pool;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();
        $this->loadedData = [];
        foreach ($items as $pos) {
            $this->loadedData[$pos->getId()] = $pos->getData();
        }

        return $this->loadedData;
    }
}
