<?php
namespace Mrstik\Pos\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Mrstik\Pos\Api\Data\PosInterface;

/**
 * @api
 */
interface PosRepositoryInterface
{
    public function save(PosInterface $pos);

    public function getById($posId);

    public function getList(SearchCriteriaInterface $searchCriteria);

    public function delete(PosInterface $pos);

    public function deleteById($posId);
}
