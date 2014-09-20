<?php
/**
 * @author KonstantinKuklin <konstantin.kuklin@gmail.com>
 */

namespace Analyzer\HandlerSocketLibrary;

use Analyzer\AbstractHandlerSocketLibraryJob;

class TextSelectBench extends AbstractHandlerSocketLibraryJob
{
    public function run()
    {
        $rows = $this->getRows();
        $indexId = $this->getIndexId();

        for ($i = 0; $i < $rows; $i++) {
            $this->getClient()->text(sprintf("%d    =   1   1", $indexId), 'HS\Query\SelectQuery');
        }
        $this->getClient()->getResultList();
    }

    /**
     * @return boolean
     */
    public function isWriter()
    {
        return false;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return 'Text select with getting result';
    }
}