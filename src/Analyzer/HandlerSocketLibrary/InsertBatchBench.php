<?php
/**
 * @author KonstantinKuklin <konstantin.kuklin@gmail.com>
 */

namespace Analyzer\HandlerSocketLibrary;

use Analyzer\AbstractHandlerSocketLibraryJob;
use HS\Component\Comparison;

class InsertBatchBench extends AbstractHandlerSocketLibraryJob
{
    /**
     * @param bool $isWriter
     */
    public function preJob($isWriter)
    {
        parent::preJob($isWriter);
        // remove all data
        $this->getClient()->deleteByIndex($this->getIndexId(), Comparison::MORE, array(0), 90000, 0);
        $this->getClient()->getResultList();
    }

    public function run()
    {
        $rows = $this->getRows();
        $indexId = $this->getIndexId();

        for ($i = 1000, $to = $rows + 1000; $i < $to; $i++) {
            $this->getClient()->insertByIndex($indexId, array($to + $i, rand(0, 9)));
        }
        $this->getClient()->getResultList();
    }

    /**
     * @return boolean
     */
    public function isWriter()
    {
        return true;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return 'Insert by index batch by index';
    }
}