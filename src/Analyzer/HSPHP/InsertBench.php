<?php
/**
 * @author KonstantinKuklin <konstantin.kuklin@gmail.com>
 */

namespace Analyzer\HSPHP;

use Analyzer\AbstractHSPHPJob;

class InsertBench extends AbstractHSPHPJob
{
    public function run()
    {
        $rows = $this->getRows();
        $indexId = $this->getIndexId();

        for ($i = 1000, $to = $rows + 1000; $i < $to; $i++) {
            $this->getClient()->insert($indexId, array($to, rand(0, 9)));
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
        return 'Insert by index';
    }
}