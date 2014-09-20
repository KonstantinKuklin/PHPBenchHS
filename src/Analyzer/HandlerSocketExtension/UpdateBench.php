<?php
/**
 * @author KonstantinKuklin <konstantin.kuklin@gmail.com>
 */

namespace Analyzer\HandlerSocketExtension;

use Analyzer\AbstractHandlerSocketExtensionJob;

class UpdateBench extends AbstractHandlerSocketExtensionJob
{
    public function run()
    {
        $rows = $this->getRows();
        $indexId = $this->getIndexId();

        for ($i = 0; $i < $rows; $i++) {
            $this->getClient()->executeUpdate($indexId, '=', array(1), array(1, 8), 1, 0);
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
        return 'Update by index with getting result';
    }
}