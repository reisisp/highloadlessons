<?php
require_once('vendor/autoload.php');

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$time_start = time();
$log = new Logger('main');
$log->pushHandler(new StreamHandler('log/my.log', Logger::DEBUG));

function makeSomething($num1, $str2, $bool3, $arr4, $log)
{
    $log->notice("Start making smth");

    $log->info("Start ST1");
    checkNum($num1, $log);
    $log->info("Finish ST1");

    $log->info("Start ST2");
    checkStr($str2, $log);
    $log->info("Finish ST2");

    $log->info("Start ST3");
    checkBool($bool3, $log);
    $log->info("Finish ST3");

    $log->info("Start ST4");
    checkArr($arr4, $log);
    $log->info("Finish ST4");

    $log->notice("Finish making smth");
    $log->debug(memory_get_usage());
    $log->debug(memory_get_peak_usage());
}

function checkNum($num, $log)
{
    $log->debug("Start checking $num");
    $randNum = mt_rand(0, 5000);
    $log->debug("Start checking $num type");
    if (gettype($num) === "integer") {
        $log->debug("Type OK");

        $log->debug("Start somy functionality");
        if ($randNum > $num) {
            $log->debug("Num is small");
            while ($randNum > $num){
                $log->debug("$num is upping");
                $num++;
            }
            $log->debug("Num OK");
            return $num;

        } elseif ($randNum < $num) {
            $log->debug("Num is big");
            while ($randNum < $num){
                $log->debug("$num is downing");
                $num--;
            }
            $log->debug("Num OK");
            return $num;

        } else {
            $log->debug("Num OK");
            return $num;
        }

    } else {
        $log->debug("Wrong type");
        return 'err';
    }
    $log->debug("done");
}

function checkStr($str, $log)
{
    $log->debug("Start checking $str");

    $log->debug("done");
}

function checkBool($bool, $log)
{
    $log->debug("Start checking $bool");

    $log->debug("done");
}

function checkArr($arr, $log)
{
    $log->debug("Start checking $arr");

    $log->debug("done");
}
$time_start = time();
makeSomething(2, 'sdf', true, [0, 1, 2, 3, 33, 3], $log);
$time_end = time();

echo ($time_end - $time_start);
