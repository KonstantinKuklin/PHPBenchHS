<?php
namespace Analyzer;

/**
 * @author KonstantinKuklin <konstantin.kuklin@gmail.com>
 */
abstract class AbstractHandlerSocketExtensionJob extends AbstractJob
{
    protected $client = null;

    /**
     * {@inheritdoc}
     */
    public function getIndexId()
    {
        $this->getClient()->openIndex(1, "hs", 'hs_test', 'PRIMARY', 'key,num');

        return 1;
    }

    /**
     * {@inheritdoc}
     */
    public function preJob($isWriter)
    {
        if ($isWriter) {
            $this->client = new \HandlerSocket('127.0.0.1', 9999);
        } else {
            $this->client = new \HandlerSocket('127.0.0.1', 9998);
        }
    }

    public function postJob()
    {
    }

    protected function getClient()
    {
        return $this->client;
    }
}