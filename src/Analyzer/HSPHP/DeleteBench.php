<?php
/**
 * @author KonstantinKuklin <konstantin.kuklin@gmail.com>
 */

namespace Analyzer\HSPHP;

use Analyzer\AbstractHSPHPJob;

class DeleteBench extends AbstractHSPHPJob
{
    public function run()
    {
        $rows = $this->getRows();
        $indexId = $this->getIndexId();

        for ($i = 0; $i < $rows; $i++) {
            $this->getClient()->delete($indexId, '=', array(1));
        }

        $this->getClient()->readResponse();
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
        return 'Delete by index with getting result';
    }
}