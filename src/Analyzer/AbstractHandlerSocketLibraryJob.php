<?php
namespace Analyzer;

use HS\Reader;
use HS\Writer;

/**
 * @author KonstantinKuklin <konstantin.kuklin@gmail.com>
 */
abstract class AbstractHandlerSocketLibraryJob extends AbstractJob
{
    /** @var \HS\Reader|\HS\Writer $client */
    protected $client = null;

    /**
     * {@inheritdoc}
     */
    public function getIndexId()
    {
        return $this->getClient()->getIndexId("hs", 'hs_test', 'PRIMARY', array('key', 'num'));
    }

    /**
     * {@inheritdoc}
     */
    public function preJob($isWriter)
    {
        if ($isWriter) {
            $this->client = new Writer('127.0.0.1', 9999);
        } else {
            $this->client = new Reader('127.0.0.1', 9998);
        }
    }

    public function postJob()
    {
    }

    /**
     * @return Reader|Writer
     */
    protected function getClient()
    {
        return $this->client;
    }
}