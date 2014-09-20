<?php
/**
 * @author KonstantinKuklin <konstantin.kuklin@gmail.com>
 */

namespace Analyzer\HandlerSocketExtension;

use Analyzer\AbstractHandlerSocketExtensionJob;

class SelectBench extends AbstractHandlerSocketExtensionJob
{
    public function run()
    {
        $rows = $this->getRows();
        $indexId = $this->getIndexId();

        for ($i = 0; $i < $rows; $i++) {
            $this->getClient()->executeSingle($indexId, '=', array(1), 1, 0);
        }
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
        return 'Select by index with getting result';
    }
}