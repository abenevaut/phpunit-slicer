<?php

namespace abenevaut\Infrastructure\Console;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

abstract class ProcessPoolCommandAbstract extends Command
{
    private array $queue = [];

    private int $queueLength = 0;

    private array $computingQueue = [];

    private int $computingQueueLength = 0;

    abstract protected function defaultConcurrency(): int;

    abstract protected function boot(): self;

    public function getQueueLength(): int
    {
        return $this->queueLength;
    }

    public function handle(): bool
    {
        return $this
            ->boot()
            ->compute();
    }

    public function title(): string
    {
        return "{$this->getQueueLength()} process to compute";
    }

    /**
     * @param array<Process> $process
     */
    public function push(array $process): self
    {
        $this->queue = $process;
        $this->queueLength = count($process);

        return $this;
    }

    public function compute(): int
    {
        $this->output->title($this->title());

        $processPreparationBar = $this->output->createProgressBar($this->queueLength);
        $processPreparationBar->setFormat('debug');

        do {
            /*
             * While concurrency is available, start process.
             * Pop process from queue then push to computingQueue.
             */
            if (
                $this->queueLength > 0
                && $this->computingQueueLength < $this->defaultConcurrency()
            ) {
                /** @var Process $process */
                $process = array_shift($this->queue);
                $this->queueLength--;

                $process->start();

                $this->computingQueue[] = $process;
                $this->computingQueueLength++;
            }

            /*
             * Check execution status of computing process, if not running stop and report status.
             */
            if ($this->computingQueueLength > 0) {
                foreach ($this->computingQueue as $key => $process) {
                    if ($process->isRunning() === false) {
                        unset($this->computingQueue[$key]);
                        $this->computingQueueLength--;

                        $processPreparationBar->advance();
                    }
                }
            }

            usleep(10000);
        } while ($this->queueLength > 0 || $this->computingQueueLength > 0);

        $processPreparationBar->finish();

        return static::SUCCESS;
    }
}
