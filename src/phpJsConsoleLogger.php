<?php

namespace jeroendn\phpJsConsoleLogger;

use DateTime;

class phpJsConsoleLogger
{
  /**
   * @var string $log
   */
  private string $log = '';

  /**
   * @var array $logs
   */
  private array $logs = [];

//  private int $timeout = 0;

//  private int $interval = 1000;

  /**
   * @var int $maxIterations
   */
  private int $maxIterations = -1;

  /**
   * @var string $iterationSpacer
   */
  private string $iterationSpacer = '';

//  private DateTime|null $dateTimeStart = null;

//  private DateTime|null $dateTimeEnd = null;

//  private bool $isServerSideJsLoading = true; // Future feature: Always load js and check in js if the logs should be shown

  /**
   * Sets a single for the logger
   * @param string $log
   * @return $this
   */
  public function setLog(string $log): phpJsConsoleLogger
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
  public function setLogs(array $logs): phpJsConsoleLogger
  {
    $this->logs = $logs;
    $this->log = '';

    return $this;
  }

  /**
   * Set to -1 (any negative number) for infinite iterations
   * @param int $maxIterations
   * @return $this
   */
  public function setMaxIterations(int $maxIterations): phpJsConsoleLogger
  {
    $this->maxIterations = $maxIterations;

    return $this;
  }

  /**
   * Use default value '' for no spacer
   * @param string $iterationSpacer
   * @return $this
   */
  public function setIterationSpacer(string $iterationSpacer): phpJsConsoleLogger
  {
    $this->iterationSpacer = $iterationSpacer;

    return $this;
  }

  /**
   * @return string
   */
  public function generateJs(): string
  {
    // TODO Check if all required parameters are set

    return "
      <script type=\"text/javascript\"> 
        let maxIterations = " . $this->maxIterations . ";
        let iterationSpacer = '" . $this->iterationSpacer . "';
        let logsOriginal = " . (!empty($this->log) ? json_encode([$this->log]) : json_encode($this->logs)) . ";
        let logs = ('" . $this->iterationSpacer . "' !== '' && maxIterations !== 1) ? [].concat(logsOriginal, ['" . $this->iterationSpacer . "']) : [].concat(logsOriginal); // TODO perhaps write a function for this
        let timeout = 100;
        let interval = 2000;
        
        // If maxIterations is 0, don't run the code at all
        if (maxIterations !== 0) {
        
          // Timeout
          setTimeout(function() {
          
            // Log the given data
            function processLog() {
              if (logs.length > 0) {
                setTimeout(function () {
                  console.log(logs[0]);
                  logs.shift();
                  processLog();
                }, interval);
                
              // Prepare for a new iteration
              } else if(maxIterations !== 1) {
                setTimeout(function () {
                  logs = (iterationSpacer !== '' && maxIterations !== 2) // Add spacer when set and not last iteration
                          ? logs.concat(logsOriginal, [iterationSpacer]) 
                          : logs.concat(logsOriginal);
                  if(maxIterations > 0) maxIterations--;
                  processLog();
                }, timeout)
              }
            }
            
            // Initial start trigger
            processLog();
            
          }, timeout);
        
        }
      </script>
    ";
  }

  private function validateDateTime()
  {

  }

  private function validateRequiredParameters()
  {

  }
}