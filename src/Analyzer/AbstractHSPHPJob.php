<?php
namespace Analyzer;

use HSPHP\ReadSocket;
use HSPHP\WriteSocket;

/**
 * @author KonstantinKuklin <konstantin.kuklin@gmail.com>
 */
abstract class AbstractHSPHPJob extends AbstractJob
{
    protected $client = null;

    /**
     * {@inheritdoc}
     */
    public function preJob($isWriter)
    {
        if ($isWriter) {
            $this->client = new WriteSocket();
        } else {
            $this->client = new ReadSocket();
        }
        $this->client->connect('127.0.0.1');
    }

    public function postJob()
    {
    }

    /**
     * @return int
     * @throws \HSPHP\ErrorMessage
     */
    public function getIndexId()
    {
        return $this->getClient()->getIndexId("hs", 'hs_test', '', 'key,num');
    }

    /**
     * @return ReadSocket|WriteSocket
     */
    protected function getClient()
    {
        return $this->client;
    }
}