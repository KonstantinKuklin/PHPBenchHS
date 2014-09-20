<?php
/**
 * @author KonstantinKuklin <konstantin.kuklin@gmail.com>
 */

namespace Analyzer\HandlerSocketLibrary;

use Analyzer\AbstractHandlerSocketLibraryJob;

class InsertBatchBench extends AbstractHandlerSocketLibraryJob
{
    public function run()
    {
        $rows = $this->getRows();
        $indexId = $this->getIndexId();

        $list = array();

        for ($i = 1000, $to = $rows + 1000; $i < $to; $i++) {
            $list[] = array($to, rand(0, 9));
        }
        $this->getClient()->insertByIndex($indexId, $list);
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