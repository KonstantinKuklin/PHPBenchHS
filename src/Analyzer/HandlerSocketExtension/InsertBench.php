<?php
/**
 * @author KonstantinKuklin <konstantin.kuklin@gmail.com>
 */

namespace Analyzer\HandlerSocketExtension;

use Analyzer\AbstractHandlerSocketExtensionJob;

class InsertBench extends AbstractHandlerSocketExtensionJob
{
    public function run()
    {
        $rows = $this->getRows();
        $indexId = $this->getIndexId();

        for ($i = 1000, $to = $rows + 1000; $i < $to; $i++) {
            $this->getClient()->executeInsert($indexId, array($to, rand(0, 9)));
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
        return 'Insert by index';
    }
}