<?php
/**
 * @author KonstantinKuklin <konstantin.kuklin@gmail.com>
 */

namespace Analyzer\HSPHP;

use Analyzer\AbstractHSPHPJob;

class SelectBench extends AbstractHSPHPJob
{
    public function run()
    {
        $rows = $this->getRows();
        $indexId = $this->getIndexId();

        for ($i = 0; $i < $rows; $i++) {
            $this->getClient()->select($indexId, '=', array(1));
        }

        $this->getClient()->readResponse();
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