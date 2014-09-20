<?php
/**
 * @author KonstantinKuklin <konstantin.kuklin@gmail.com>
 */

if (!file_exists("vendor/autoload.php")) {
    exit('The project won\'t initialized with composer.');
}
/** @var \Composer\Autoload\ClassLoader $composer */
$composer = require_once("vendor/autoload.php");

// run 1 bench
if ($argc > 2) {
    $rows = $argv[1];
    $benchClassPath = $argv[2];

    try {
        /** @var \Analyzer\AbstractJob $benchClass */
        $benchClass = new $benchClassPath($rows);

        $benchClass->preJob($benchClass->isWriter());
        $benchClass->start();
        $benchClass->run();
        $benchClass->stop();
        $benchClass->postJob();

        file_put_contents(
            './result/' . substr(strtr($benchClassPath, array("\\" => '_')), 9) . '.txt',
            sprintf(
                "Description: %s\nTime:%s\nMemory:%s\nMaxMemory:%s\nRows:%d\nRPS:%s\n",
                $benchClass->getDescription(),
                $benchClass->getTime(),
                $benchClass->getMemory(),
                $benchClass->getMaxMemory(),
                $benchClass->getRows(),
                $benchClass->getRPS()
            )
        );
    } catch (\Exception $e) {
        echo sprintf("Got error with message: %s.%s", $e->getMessage(), PHP_EOL);
        exit(1);
    }

    echo "OK." . PHP_EOL;
    exit(0);
}

$rows = 100;
if (isset($argv[1])) {
    $rows = (int)$argv[1];
}


// run benches
echo sprintf("Working with bench list(%s):\n", $rows);

$benchList = array_filter(
    array_keys($composer->getClassMap()),
    function ($path) {
        if (substr($path, 0, 9) === "Analyzer\\" && substr($path, -5) === "Bench") {
            return true;
        }

        return false;
    }
);

$totalBench = count($benchList);
$i = 1;
foreach ($benchList as $bench) {
    echo sprintf("[%d/%d] Bench - %s. ", $i, $totalBench, $bench);
    system(sprintf('php ./start.php %d "%s" %s', $rows, $bench, PHP_EOL));
    $i++;
}