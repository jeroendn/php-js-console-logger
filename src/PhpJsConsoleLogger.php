<?php

namespace jeroendn\PhpJsConsoleLogger;

use jeroendn\PhpJsConsoleLoggerBase\PhpJsConsoleLoggerBase;

class PhpJsConsoleLogger extends PhpJsConsoleLoggerBase
{
    /**
     * Generates the JS in an HTML script tag
     * @deprecated Use getHtml() or getJs() instead
     *
     * @return string
     * HTML
     */
    public function generateJs(): string
    {
        return "
            <script type=\"text/javascript\">
                let maxIterations = " . $this->maxIterations . ";
                let iterationSpacer = '" . $this->iterationSpacer . "';
                let logsOriginal = " . (!empty($this->log) ? json_encode([$this->log]) : json_encode($this->logs)) . ";
                let logs = ('" . $this->iterationSpacer . "' !== '' && maxIterations !== 1) ? [].concat(logsOriginal, ['" . $this->iterationSpacer . "']) : [].concat(logsOriginal); // TODO perhaps write a function for this
                let timeout = " . $this->timeout . ";
                let interval = " . $this->interval . ";

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

    /**
     * Generates the JS in an HTML script tag
     * @return string
     * HTML
     */
    public function getHtml(): string
    {
        // TODO Check if all required parameters are set

        return "<script type=\"text/javascript\">" . $this->getJs() . "</script>";
    }

    /**
     * Generates the JS
     * @return string
     * Javascript
     */
    public function getJs(): string
    {
        // TODO Check if all required parameters are set

        return "
            let maxIterations = " . json_encode($this->maxIterations) . ";
            let iterationSpacer = '" . json_encode($this->iterationSpacer) . "';
            let logsOriginal = " . (!empty($this->log) ? json_encode([$this->log]) : json_encode($this->logs)) . ";
            let logs = ('" . json_encode($this->iterationSpacer) . "' !== '' && maxIterations !== 1) ? [].concat(logsOriginal, ['" . json_encode($this->iterationSpacer) . "']) : [].concat(logsOriginal);
            let timeout = " . json_encode($this->timeout) . ";
            let interval = " . json_encode($this->interval) . ";
        " . file_get_contents(__DIR__ . '/logger.js');
    }

// TODO
//
//  private function validateDateTime()
//  {
//
//  }
//
//  private function validateRequiredParameters()
//  {
//
//  }
}
