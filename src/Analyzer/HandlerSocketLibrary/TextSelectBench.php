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
            $this->getClient()->text(sprintf("%d\t=\t1\t105\t1\t0", $indexId), 'HS\Query\SelectQuery');
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