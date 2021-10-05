<?php

namespace jeroendn\phpJsConsoleLoggerBase;

class phpJsConsoleLoggerBase
{
  private const DEFAULT_LOG = '';
  private const DEFAULT_LOGS = [];
  private const DEFAULT_TIMEOUT = 100;
  private const DEFAULT_INTERVAL = 2000;
  private const DEFAULT_MAX_ITERATIONS = -1;
  private const DEFAULT_ITERATION_SPACER = '';

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
   * @var int $maxIterations
   */
  protected int $maxIterations = self::DEFAULT_MAX_ITERATIONS;

  /**
   * @var string $iterationSpacer
   */
  protected string $iterationSpacer = self::DEFAULT_ITERATION_SPACER;

//  protected DateTime|null $dateTimeStart = null;

//  protected DateTime|null $dateTimeEnd = null;

//  protected bool $isServerSideJsLoading = true; // Future feature: Always load js and check in js if the logs should be shown

  /**
   * Sets a single for the logger
   * @param string $log
   * @return $this
   */
  public function setLog(string $log = self::DEFAULT_LOG): self
  {
    $this->log = $log;
    $this->logs = [];

    return $this;
  }

  /**
   * Sets multiple lines for the logger
   * @param array $logs
   * @return $this
   */
  public function setLogs(array $logs = self::DEFAULT_LOGS): self
  {
    $this->logs = $logs;
    $this->log = '';

    return $this;
  }

  /**
   * @param int $timeout
   * @return $this
   */
  public function setTimeout(int $timeout = self::DEFAULT_TIMEOUT): self
  {
    $this->timeout = $timeout;

    return $this;
  }

  /**
   * @param int $interval
   * @return $this
   */
  public function setInterval(int $interval = self::DEFAULT_INTERVAL): self
  {
    $this->interval = $interval;

    return $this;
  }

  /**
   * Set to -1 (any negative number) for infinite iterations
   * @param int $maxIterations
   * @return $this
   */
  public function setMaxIterations(int $maxIterations = self::DEFAULT_MAX_ITERATIONS): self
  {
    $this->maxIterations = $maxIterations;

    return $this;
  }

  /**
   * Use default value '' for no spacer
   * @param string $iterationSpacer
   * @return $this
   */
  public function setIterationSpacer(string $iterationSpacer = self::DEFAULT_ITERATION_SPACER): self
  {
    $this->iterationSpacer = $iterationSpacer;

    return $this;
  }
}