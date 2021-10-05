<?php

namespace jeroendn\phpJsConsoleLogger;

use DateTime;

class phpJsConsoleLogger
{
  private string $log = '';
  private array $logs = [];
//  private int $timeout = 0;
//  private int $interval = 1000;
//  private int $maxIterations = -1; // Set to -1 (any negative number) for infinite iterations
//  private DateTime|null $dateTimeStart = null;
//  private DateTime|null $dateTimeEnd = null;
//  private bool $isServerSideJsLoading = true; // Future feature: Always load js and check in js if the logs should be shown

  public function setLog(string $log): phpJsConsoleLogger
  {
    $this->log = $log;
    $this->logs = [];

    return $this;
  }

  public function setLogs(array $logs): phpJsConsoleLogger
  {
    $this->logs = $logs;
    $this->log = '';

    return $this;
  }

  public function generateJs(): string
  {
    // TODO Check if all required parameters are set

    $stringToReturn = "
      <script type=\"text/javascript\"> 
        let logs = " . (!empty($this->log) ? json_encode([$this->log]) : json_encode($this->logs)) . ";
        let timeout = 1000;
        let interval = 2000;
//        let maxIterations = 0;
        
        setTimeout(function() {
          function processLog() {
            if (logs.length > 0) {
              setTimeout(function () {
                console.log(logs[0]);
                logs.shift();
                processLog();
              }, interval);
            }
          }
          processLog();
        }, timeout);
      </script>
    ";

    return $stringToReturn;
  }

  private function validateDateTime()
  {

  }

  private function validateRequiredParameters()
  {

  }
}