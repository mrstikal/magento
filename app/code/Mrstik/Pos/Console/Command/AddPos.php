<?php

namespace Mrstik\Pos\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Framework\Console\Cli;
use Magento\Framework\App\Area;
use Magento\Framework\App\State;
use Mrstik\Pos\Api\Data\PosInterfaceFactory;

class AddPos extends Command
{
    const INPUT_KEY_NAME = 'name';
    const INPUT_KEY_ADDRESS = 'address';
    const INPUT_KEY_IS_AVAILABLE = 'is_available';

    private $posFactory;
    private $appState;

    public function __construct(PosInterfaceFactory $posFactory, State $state)
    {
        $this->posFactory = $posFactory;
        $this->appState = $state;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('mrstik:pos:add')
            ->addArgument(
                self::INPUT_KEY_NAME,
                InputArgument::REQUIRED,
                'Point of Sale Name'
            )->addArgument(
                self::INPUT_KEY_ADDRESS,
                InputArgument::REQUIRED,
                'Point of Sale Address'
            )->addArgument(
                self::INPUT_KEY_IS_AVAILABLE,
                InputArgument::OPTIONAL,
                'Point of Sale Address',
                1
            );

        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->appState->setAreaCode(Area::AREA_GLOBAL);

        $item = $this->posFactory->create();
        $item->setName($input->getArgument(self::INPUT_KEY_NAME));
        $item->setAddress($input->getArgument(self::INPUT_KEY_ADDRESS));
        $item->setIsAvailable($input->getArgument(self::INPUT_KEY_IS_AVAILABLE));
        $item->setIsObjectNew(true);
        $item->save();

        $output->writeln(json_encode("'" . $item->getName() . "' has been successfully created."));

        return Cli::RETURN_SUCCESS;
    }
}
