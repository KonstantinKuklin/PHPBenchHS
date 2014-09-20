<?php

namespace Analyzer;

/**
 * @author KonstantinKuklin <konstantin.kuklin@gmail.com>
 */
abstract class AbstractJob
{
    private $memory = 0;
    private $time = 0;
    private $maxMemory = 0;
    private $done = false;
    private $rows = 0;

    /**
     * @param int $rows
     *
     * @throws \Exception
     */
    public function __construct($rows)
    {
        if (!is_numeric($rows) || $rows < 1) {
            throw new \Exception("Rows must be a number  and > 0.");
        }
        $this->rows = $rows;
    }

    /**
     * @return string
     */
    abstract public function getDescription();

    /**
     * @param boolean $isWriter
     *
     * @return void
     */
    abstract public function preJob($isWriter);

    /**
     * @return int
     */
    abstract public function getIndexId();

    abstract public function run();

    abstract public function postJob();

    /**
     * @return boolean
     */
    abstract public function isWriter();

    public function start()
    {
        \PHP_Timer::start();
    }

    public function stop()
    {
        $this->time = \PHP_Timer::stop();
        $this->memory = memory_get_usage();
        $this->maxMemory = memory_get_peak_usage();
        $this->done = true;
    }

    /**
     * @return int
     */
    public function getMemory()
    {
        return $this->memory;
    }

    /**
     * @return int
     */
    public function getMaxMemory()
    {
        return $this->maxMemory;
    }

    /**
     * @return int
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @return float
     */
    public function getRPS()
    {

        return  (1 / $this->getTime()) * $this->rows;
    }

    /**
     * @return int
     */
    public function getRows()
    {
        return $this->rows;
    }
} 