<?php
/**
 * @author KonstantinKuklin <konstantin.kuklin@gmail.com>
 */

namespace Analyzer\HSPHP;

use Analyzer\AbstractHandlerSocketLibraryJob;
use Analyzer\AbstractHSPHPJob;
use HS\Component\Comparison;

class UpdateBench extends AbstractHSPHPJob
{
    public function run()
    {
        $rows = $this->getRows();
        $indexId = $this->getIndexId();

        for ($i = 0; $i < $rows; $i++) {
            $this->getClient()->update($indexId, '=', array(1), array(1, 8));
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
        return 'Update by index with getting result';
    }
}