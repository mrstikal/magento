<?php

namespace Mrstik\Pos\Model\ResourceModel\Pos\Grid;

use Magento\Framework\Api\AbstractServiceCollection;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SimpleDataObjectConverter;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\Data\Collection\EntityFactory;
use Magento\Framework\DataObject;
use Mrstik\Pos\Api\PosRepositoryInterface;
use Mrstik\Pos\Api\Data\PosInterface;


class ServiceCollection extends AbstractServiceCollection
{
    protected $posRepository;

    protected $simpleDataObjectConverter;

    public function __construct(
        EntityFactory $entityFactory,
        FilterBuilder $filterBuilder,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SortOrderBuilder $sortOrderBuilder,
        PosRepositoryInterface $posRepository,
        SimpleDataObjectConverter $simpleDataObjectConverter
    ) {
        $this->posRepository          = $posRepository;
        $this->simpleDataObjectConverter = $simpleDataObjectConverter;
        parent::__construct($entityFactory, $filterBuilder, $searchCriteriaBuilder, $sortOrderBuilder);
    }

    public function loadData($printQuery = false, $logQuery = false)
    {
        if (!$this->isLoaded()) {
            $searchCriteria = $this->getSearchCriteria();
            $searchResults = $this->posRepository->getList($searchCriteria);
            $this->_totalRecords = $searchResults->getTotalCount();
            $poss = $searchResults->getItems();
            foreach ($poss as $pos) {
                $posItem = new DataObject();
                $posItem->addData(
                    $this->simpleDataObjectConverter->toFlatArray($pos, PosInterface::class)
                );
                $this->_addItem($posItem);
            }
            $this->_setIsLoaded();
        }
        return $this;
    }
}
