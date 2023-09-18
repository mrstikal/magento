<?php
namespace Mrstik\Pos\Model;

use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\Search\FilterGroup;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\StateException;
use Magento\Framework\Exception\ValidatorException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\StoreManagerInterface;
use Mrstik\Pos\Api\PosRepositoryInterface;
use Mrstik\Pos\Api\Data;
use Mrstik\Pos\Api\Data\PosInterface;
use Mrstik\Pos\Api\Data\PosInterfaceFactory;
use Mrstik\Pos\Api\Data\PosSearchResultsInterfaceFactory;
use Mrstik\Pos\Model\ResourceModel\Pos as ResourcePos;
use Mrstik\Pos\Model\ResourceModel\Pos\Collection;
use Mrstik\Pos\Model\ResourceModel\Pos\CollectionFactory as PosCollectionFactory;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class PosRepository implements PosRepositoryInterface
{
    protected $instances = [];

    protected $resource;

    protected $storeManager;

    protected $posCollectionFactory;

    protected $searchResultsFactory;

    protected $posInterfaceFactory;

    protected $dataObjectHelper;

    public function __construct(
        ResourcePos $resource,
        StoreManagerInterface $storeManager,
        PosCollectionFactory $posCollectionFactory,
        PosSearchResultsInterfaceFactory $posSearchResultsInterfaceFactory,
        PosInterfaceFactory $posInterfaceFactory,
        DataObjectHelper $dataObjectHelper
    ) {
        $this->resource = $resource;
        $this->storeManager = $storeManager;
        $this->posCollectionFactory = $posCollectionFactory;
        $this->searchResultsFactory = $posSearchResultsInterfaceFactory;
        $this->posInterfaceFactory = $posInterfaceFactory;
        $this->dataObjectHelper = $dataObjectHelper;
    }

    public function save(PosInterface $pos)
    {
        /** @var PosInterface|\Magento\Framework\Model\AbstractModel $pos */
        if (empty($pos->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $pos->setStoreId($storeId);
        }
        try {
            $this->resource->save($pos);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the Point of Sale: %1',
                $exception->getMessage()
            ));
        }
        return $pos;
    }

    public function getById($posId)
    {
        if (!isset($this->instances[$posId])) {
            $pos = $this->posInterfaceFactory->create();
            $this->resource->load($pos, $posId);
            if (!$pos->getId()) {
                throw new NoSuchEntityException(__('Requested Point of Sale doesn\'t exist'));
            }
            $this->instances[$posId] = $pos;
        }
        return $this->instances[$posId];
    }

    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);

        $collection = $this->posCollectionFactory->create();

        foreach ($searchCriteria->getFilterGroups() as $group) {
            $this->addFilterGroupToCollection($group, $collection);
        }
        $sortOrders = $searchCriteria->getSortOrders();
        if ($sortOrders) {
            foreach ($searchCriteria->getSortOrders() as $sortOrder) {
                $field = $sortOrder->getField();
                $collection->addOrder(
                    $field,
                    ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        } else {
            $field = 'pos_id';
            $collection->addOrder($field, 'ASC');
        }
        $collection->setCurPage($searchCriteria->getCurrentPage());
        $collection->setPageSize($searchCriteria->getPageSize());

        $poss = [];

        foreach ($collection as $pos) {
            $posDataObject = $this->posInterfaceFactory->create();
            $this->dataObjectHelper->populateWithArray($posDataObject, $pos->getData(), PosInterface::class);
            $poss[] = $posDataObject;
        }
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults->setItems($poss);
    }

    public function delete(PosInterface $pos)
    {
        $id = $pos->getId();
        try {
            unset($this->instances[$id]);
            $this->resource->delete($pos);
        } catch (ValidatorException $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        } catch (\Exception $e) {
            throw new StateException(
                __('Unable to remove Point of Sale %1', $id)
            );
        }
        unset($this->instances[$id]);
        return true;
    }

    public function deleteById($posId)
    {
        $pos = $this->getById($posId);
        return $this->delete($pos);
    }

    protected function addFilterGroupToCollection(FilterGroup $filterGroup, Collection $collection)
    {
        $fields = [];
        $conditions = [];
        foreach ($filterGroup->getFilters() as $filter) {
            $condition = $filter->getConditionType() ? $filter->getConditionType() : 'eq';
            $fields[] = $filter->getField();
            $conditions[] = [$condition => $filter->getValue()];
        }
        if ($fields) {
            $collection->addFieldToFilter($fields, $conditions);
        }
        return $this;
    }

}
