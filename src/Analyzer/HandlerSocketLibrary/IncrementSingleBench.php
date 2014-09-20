<?php
/**
 * @author KonstantinKuklin <konstantin.kuklin@gmail.com>
 */

namespace Analyzer\HandlerSocketLibrary;

use Analyzer\AbstractHandlerSocketLibraryJob;
use HS\Component\Comparison;

class IncrementsSingleBench extends AbstractHandlerSocketLibraryJob
{
    public function run()
    {
        $rows = $this->getRows();
        $indexId = $this->getIndexId();

        for ($i = 0; $i < $rows; $i++) {
            $this->getClient()->incrementByIndex($indexId, Comparison::EQUAL, array(1), array(0, 1))->execute();
        }
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
        return 'Increment single by index with getting result';
    }
}