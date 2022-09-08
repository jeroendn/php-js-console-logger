<?php

namespace jeroendn\PhpJsConsoleLogger;

class PhpJsConsoleLoggerBase
{
    protected const PACKAGE_NAME             = 'PhpJsConsoleLogger';
    private const   DEFAULT_LOG              = '';
    private const   DEFAULT_LOGS             = [];
    private const   DEFAULT_TIMEOUT          = 100;
    private const   DEFAULT_INTERVAL         = 2000;
    private const   DEFAULT_ITERATIONS       = 1;
    private const   DEFAULT_ITERATION_SPACER = '';

    /**
     * @var string $log
     */
    protected string $log = self::DEFAULT_LOG;

    /**
     * @var array $logs
     */
    protected array $logs = self::DEFAULT_LOGS;

    /**
     * @var int $timeout
     */
    protected int $timeout = self::DEFAULT_TIMEOUT;

    /**
     * @var int $interval
     */
    protected int $interval = self::DEFAULT_INTERVAL;

    /**
     * @var int $iterations
     */
    protected int $iterations = self::DEFAULT_ITERATIONS;

    /**
     * @var string $iterationSpacer
     */
    protected string $iterationSpacer = self::DEFAULT_ITERATION_SPACER;

//  protected DateTime|null $dateTimeStart = null;

//  protected DateTime|null $dateTimeEnd = null;

//  protected bool $isServerSideJsLoading = true; // Future feature: Always load js and check in js if the logs should be shown

    /**
     * @return string
     */
    public function getLog(): string
    {
        return $this->log;
    }

    /**
     * Set a single for the logger to display
     * @param string $log
     * @return $this
     */
    public function setLog(string $log = self::DEFAULT_LOG): self
    {
        $this->log  = $log;
        $this->logs = [];

        return $this;
    }

    /**
     * @return array
     */
    public function getLogs(): array
    {
        return $this->logs;
    }

    /**
     * Set multiple lines for the logger to display
     * @param array $logs
     * @return $this
     */
    public function setLogs(array $logs = self::DEFAULT_LOGS): self
    {
        $this->logs = $logs;
        $this->log  = '';

        return $this;
    }

    /**
     * @return int
     */
    public function getTimeout(): int
    {
        return $this->timeout;
    }

    /**
     * Set the time to wait before displaying the first log and time between following iterations
     * @param int $timeout
     * Milliseconds
     * @return $this
     */
    public function setTimeout(int $timeout = self::DEFAULT_TIMEOUT): self
    {
        $this->timeout = $timeout;

        return $this;
    }

    /**
     * @return int
     */
    public function getInterval(): int
    {
        return $this->interval;
    }

    /**
     * Set the time to wait between each log
     * @param int $interval
     * Milliseconds
     * @return $this
     */
    public function setInterval(int $interval = self::DEFAULT_INTERVAL): self
    {
        $this->interval = $interval;

        return $this;
    }

    /**
     * @return int
     */
    public function getIterations(): int
    {
        return $this->iterations;
    }

    /**
     * Set how many times the logger should repeat displaying your log(s)
     * @param int $iterations
     * Set to -1 (any negative number) for infinite iterations
     * @return $this
     */
    public function setIterations(int $iterations = self::DEFAULT_ITERATIONS): self
    {
        $this->iterations = $iterations;

        return $this;
    }

    /**
     * @return string
     */
    public function getIterationSpacer(): string
    {
        return $this->iterationSpacer;
    }

    /**
     * Display a spacer in between iterations
     * @param string $iterationSpacer
     * Use '' to display no spacer
     * @return $this
     */
    public function setIterationSpacer(string $iterationSpacer = self::DEFAULT_ITERATION_SPACER): self
    {
        $this->iterationSpacer = htmlspecialchars($iterationSpacer);

        return $this;
    }
}
