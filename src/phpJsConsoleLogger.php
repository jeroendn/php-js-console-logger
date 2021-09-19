<?php

namespace jeroendn\phpJsConsoleLogger;

class phpJsConsoleLogger
{
  private string $log = '';
  private array $logs = [];

  public function __construct()
  {

  }

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

  public function generateJs()
  {
    $stringToReturn = "
      <script type=\"text/javascript\"> 
        let logs = " . (!empty($this->log) ? json_encode([$this->log]) : json_encode($this->logs)) . ";
        let interval = 2000;
        let timeout = 5000;
        
        setTimeout(function() {
          logs.forEach (function(val) {
            setTimeout(function () {
            
              console.log(val);
              
            }, interval);
          });
        }, timeout);
      </script>
    ";

    return $stringToReturn;
  }
}