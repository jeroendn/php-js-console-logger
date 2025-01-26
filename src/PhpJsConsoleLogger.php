<?php

namespace jeroendn\PhpJsConsoleLogger;

use jeroendn\PhpJsConsoleLogger\Exceptions\MissingRequiredParametersException;
use jeroendn\PhpJsConsoleLogger\Exceptions\PhpJsConsoleLoggerException;

class PhpJsConsoleLogger extends PhpJsConsoleLoggerBase
{
    /**
     * Generates the JS in an HTML script tag
     * @return string HTML
     */
    public function getHtml(): string
    {
        return "<script type=\"text/javascript\">" . $this->getJs() . "</script>";
    }

    /**
     * Generates the JS
     * @return string Javascript
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
            const iterationSpacer = '" . $this->iterationSpacer . "';
            const logsOriginal = " . (!empty($this->log) ? json_encode([$this->log]) : json_encode($this->logs)) . ";
            let logs = ('" . $this->iterationSpacer . "' !== '' && iterations !== 1) ? [].concat(logsOriginal, ['" . $this->iterationSpacer . "']) : [].concat(logsOriginal);
            const timeout = " . json_encode($this->timeout) . ";
            const interval = " . json_encode($this->interval) . ";
        " . file_get_contents(__DIR__ . '/js/logger.js');
    }

    // TODO
    private function validateDateTime(): bool
    {
        return true;
    }

    /**
     * @throws MissingRequiredParametersException
     */
    private function validateRequiredParameters(): void
    {
        if (
            !(empty($this->log) && !empty($this->logs))
            &&
            !(empty($this->logs) && !empty($this->log))
        ) {
            $error = 'log or logs';
        }

        if (!empty($error)) throw new MissingRequiredParametersException("Parameter $error not set");
    }

    /**
     * Return JS console error log, if an exception was thrown. This way errors are thrown silently and don't break the page
     * @param PhpJsConsoleLoggerException $e
     * @return string Javascript
     */
    private function getExceptionMessage(PhpJsConsoleLoggerException $e): string
    {
        return "console.error('" . self::PACKAGE_NAME . " - " . $e->getMessage() . "')";
    }
}
