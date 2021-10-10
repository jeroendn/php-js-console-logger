<?php

namespace jeroendn\PhpJsConsoleLogger;

use jeroendn\PhpJsConsoleLogger\Exceptions\MissingRequiredParametersException;
use jeroendn\PhpJsConsoleLogger\Exceptions\PhpJsConsoleLoggerException;

class PhpJsConsoleLogger extends PhpJsConsoleLoggerBase
{
    /**
     * Generates the JS in an HTML script tag
     * @return string
     * HTML
     * @deprecated Use getHtml() or getJs() instead
     */
    public function generateJs(): string
    {
        return "
            <script type=\"text/javascript\">
                let iterations = " . $this->iterations . ";
                let iterationSpacer = '" . $this->iterationSpacer . "';
                let logsOriginal = " . (!empty($this->log) ? json_encode([$this->log]) : json_encode($this->logs)) . ";
                let logs = ('" . $this->iterationSpacer . "' !== '' && iterations !== 1) ? [].concat(logsOriginal, ['" . $this->iterationSpacer . "']) : [].concat(logsOriginal); // TODO perhaps write a function for this
                let timeout = " . $this->timeout . ";
                let interval = " . $this->interval . ";

                // If iterations is 0, don't run the code at all
                if (iterations !== 0) {

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
                            } else if(iterations !== 1) {
                                setTimeout(function () {
                                    logs = (iterationSpacer !== '' && iterations !== 2) // Add spacer when set and not last iteration
                                            ? logs.concat(logsOriginal, [iterationSpacer])
                                            : logs.concat(logsOriginal);
                                    if(iterations > 0) iterations--;
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
        return "<script type=\"text/javascript\">" . $this->getJs() . "</script>";
    }

    /**
     * Generates the JS
     * @return string
     * Javascript
     */
    public function getJs(): string
    {
        try {
            $this->validateRequiredParameters();
        }
        catch (MissingRequiredParametersException $e) {
            return $this->getExceptionMessage($e);
        }

        return "
            let iterations = " . json_encode($this->iterations) . ";
            let iterationSpacer = '" . json_encode($this->iterationSpacer) . "';
            let logsOriginal = " . (!empty($this->log) ? json_encode([$this->log]) : json_encode($this->logs)) . ";
            let logs = ('" . json_encode($this->iterationSpacer) . "' !== '' && iterations !== 1) ? [].concat(logsOriginal, ['" . json_encode($this->iterationSpacer) . "']) : [].concat(logsOriginal);
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

    /**
     * @return bool
     * Returns success status
     * @throws MissingRequiredParametersException
     */
    private function validateRequiredParameters(): bool
    {
        if (
            !(empty($this->log) && !empty($this->logs))
            &&
            !(empty($this->logs) && !empty($this->log))
        ) {
            $error = 'log or logs';
        }

        if (!empty($error)) throw new MissingRequiredParametersException("Parameter $error not set");

        return true;
    }

    /**
     * Return JS console log if an exception was thrown, so that errors are thrown silently
     * @param PhpJsConsoleLoggerException $e
     * @return string
     */
    private function getExceptionMessage(PhpJsConsoleLoggerException $e): string
    {
        return "console.error('" . self::PACKAGE_NAME . " - " . $e->getMessage() . "')";
    }
}
