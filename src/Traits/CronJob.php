<?php

namespace WebXID\BasicClasses\Traits;

use Symfony\Component\Console\Helper\ProgressBar;

/**
 *  HOW TO USE
 * ============
 *
 *  $rates_log = ExchangeRateLog::query()
 *      ->with('exchanger')
 *      ->whereNull('sale_percents')
 *      ->get();
 *
 * $this->info('Found ' . $rates_log->count() . ' invalid rates');
 *
 * if (!$rates_log->count()) {
 *      $this->info('Completed');
 *
 *      return self::SUCCESS;
 * }
 *
 * $bar = $this->startProgressBar($rates_log->count());
 *
 * foreach ($rates_log as $rate) {
 *      CalculateRateChangePercentsJob::dispatch($rate->exchanger, collect([$rate]));
 *
 *      $bar->advance();
 * }
 *
 * $bar->finish();
 * parent::info("\n");
 *
 * $this->info('Completed');
 *
 */
trait CronJob
{
    /**
     * @param string $string
     * @param null $verbosity
     * @param ProgressBar|null $bar
     */
    public function info($string, $verbosity = null, ProgressBar $bar = null)
    {
        $bar && $bar->clear();

        parent::info(date('[Y-m-d H:i:s] ') . $string, $verbosity);

        $bar && $bar->display();
    }

    /**
     * @param string $string
     * @param null $verbosity
     * @param ProgressBar|null $bar
     */
    public function warn($string, $verbosity = null, ProgressBar $bar = null)
    {
        $bar && $bar->clear();

        parent::warn(date('[Y-m-d H:i:s] ') . $string, $verbosity);

        $bar && $bar->display();
    }

    /**
     * @param int $count
     *
     * @return ProgressBar
     */
    protected function getProgressBar(int $count = 0)
    {
        $bar = $this->output->createProgressBar($count);
        $bar->setFormat('debug');

        return $bar;
    }

    /**
     * @param int $count
     *
     * @return ProgressBar
     */
    protected function startProgressBar(int $count = 0)
    {
        $bar = $this->getProgressBar($count);
        $bar->start();

        return $bar;
    }
}
