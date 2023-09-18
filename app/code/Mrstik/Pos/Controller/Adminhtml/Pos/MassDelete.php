<?php

namespace Mrstik\Pos\Controller\Adminhtml\Pos;

use Mrstik\Pos\Model\Pos;

class MassDelete extends MassAction
{
    protected function massAction(Pos $pos)
    {
        $this->posRepository->delete($pos);
        return $this;
    }
}
