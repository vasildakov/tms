<?php
declare(strict_types = 1);

namespace Application\Ping;

use Psr\Log\LoggerInterface;

/**
 * Class Ping Service
 *
 * @author Vasil Dakov <vasildakov@gmail.com>
 */
final class PingHandler
{
    /**
     * @var Psr\Log\LoggerInterface
     */
    private $logger;


    /**
     * @param Psr\Log\LoggerInterface $logger
     */
    //public function __construct(LoggerInterface $logger)
    public function __construct($em)
    {
        $this->em = $em;

        try {
            $tool = new \Doctrine\ORM\Tools\SchemaTool($em);
            $classes = array(
                $em->getClassMetadata(\Domain\Entity\Customer::class),
            );

            // $tool->dropSchema($classes);

            $tool->createSchema($classes);

        } catch (\Exception $e) {
            var_dump($e->getMessage());
        }

        exit();
        //$this->logger = $logger;
    }


    /**
     * @param  PingCommand $command
     */
    public function __invoke(PingCommand $command)
    {
        $time = $command->time();

        // $this->logger->info(sprintf('Ping time %s', $time));
        // return new PingResponse($time);
    }
}