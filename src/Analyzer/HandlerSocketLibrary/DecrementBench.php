<?php
/**
 * @author KonstantinKuklin <konstantin.kuklin@gmail.com>
 */

namespace Analyzer\HandlerSocketLibrary;

use Analyzer\AbstractHandlerSocketLibraryJob;
use HS\Component\Comparison;

class DecrementBench extends AbstractHandlerSocketLibraryJob
{
    public function run()
    {
        $rows = $this->getRows();
        $indexId = $this->getIndexId();

        for ($i = 0; $i < $rows; $i++) {
            $this->getClient()->decrementByIndex($indexId, Comparison::EQUAL, array(1), array(0, 1));
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
        return 'Decrement by index with getting result';
    }
}