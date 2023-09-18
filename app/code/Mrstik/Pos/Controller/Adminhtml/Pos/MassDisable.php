<?php
namespace Mrstik\Pos\Controller\Adminhtml\Pos;

use Mrstik\Pos\Model\Pos;

class MassDisable extends MassAction
{
    protected $isAvailable = false;

    protected function massAction(Pos $pos)
    {
        $pos->setIsAvailable($this->isAvailable);
        $this->posRepository->save($pos);
        return $this;
    }
}
