<?php

namespace Mrstik\Pos\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface PosSearchResultsInterface extends SearchResultsInterface
{
    public function getItems();

    public function setItems(array $items);
}
