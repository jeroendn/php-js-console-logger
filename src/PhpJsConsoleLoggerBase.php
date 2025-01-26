<?php

namespace jeroendn\PhpJsConsoleLogger;

abstract class PhpJsConsoleLoggerBase
{
    protected const string PACKAGE_NAME = 'PhpJsConsoleLogger';

    private const string   DEFAULT_LOG              = '';
    private const array    DEFAULT_LOGS             = [];
    private const int      DEFAULT_TIMEOUT          = 100;
    private const int      DEFAULT_INTERVAL         = 2000;
    private const int      DEFAULT_ITERATIONS       = 1;
    private const string   DEFAULT_ITERATION_SPACER = '';

    protected string $log             = self::DEFAULT_LOG;
    protected array  $logs            = self::DEFAULT_LOGS;
    protected int    $timeout         = self::DEFAULT_TIMEOUT;
    protected int    $interval        = self::DEFAULT_INTERVAL;
    protected int    $iterations      = self::DEFAULT_ITERATIONS;
    protected string $iterationSpacer = self::DEFAULT_ITERATION_SPACER;

// TODO Only activate logger between specific times.
//  protected DateTime|null $dateTimeStart = null;
//  protected DateTime|null $dateTimeEnd = null;
//  protected bool $isServerSideJsLoading = true; // TODO Do not load php at all or let javascript handle activating the logger

    public function getLog(): string
    {
        return $this->log;
    }

    /**
     * Set a single message for the logger to display
     */
    public function setLog(string $log = self::DEFAULT_LOG): self
    {
        $this->log  = $log;
        $this->logs = [];

        return $this;
    }

    public function getLogs(): array
    {
        return $this->logs;
    }

    /**
     * Set multiple messages for the logger to display
     */
    public function setLogs(array $logs = self::DEFAULT_LOGS): self
    {
        $this->logs = $logs;
        $this->log  = '';

        return $this;
    }

    public function getTimeout(): int
    {
        return $this->timeout;
    }

    /**
     * Set the time to wait before displaying the first log and time between following iterations
     * @param int $timeout In milliseconds
     */
    public function setTimeout(int $timeout = self::DEFAULT_TIMEOUT): self
    {
        $this->timeout = $timeout;

        return $this;
    }

    public function getInterval(): int
    {
        return $this->interval;
    }

    /**
     * Set the time to wait between each log
     * @param int $interval In milliseconds
     */
    public function setInterval(int $interval = self::DEFAULT_INTERVAL): self
    {
        $this->interval = $interval;

        return $this;
    }

    public function getIterations(): int
    {
        return $this->iterations;
    }

    /**
     * Set how many times the logger should repeat displaying your log(s)
     * @param int $iterations Set to -1 (any negative number) for infinite iterations
     */
    public function setIterations(int $iterations = self::DEFAULT_ITERATIONS): self
    {
        $this->iterations = $iterations;

        return $this;
    }

    public function getIterationSpacer(): string
    {
        return $this->iterationSpacer;
    }

    /**
     * Display a spacer in between iterations
     * @param string $iterationSpacer Use '' to display no spacer
     */
    public function setIterationSpacer(string $iterationSpacer = self::DEFAULT_ITERATION_SPACER): self
    {
        $this->iterationSpacer = htmlspecialchars($iterationSpacer);

        return $this;
    }
}
