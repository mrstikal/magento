<?php
namespace Mrstik\Pos\Model;

use Mrstik\Pos\Model\Routing\RoutableInterface;

interface FactoryInterface
{
    public function create();
}
