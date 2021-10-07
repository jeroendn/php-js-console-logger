// Make sure the editor understands the variables defined in php
if(maxIterations === undefined) maxIterations = undefined;
if(iterationSpacer === undefined) iterationSpacer = undefined;
if(logsOriginal === undefined) logsOriginal = undefined;
if(logs === undefined) logs = undefined;
if(timeout === undefined) timeout = undefined;
if(interval === undefined) interval = undefined;


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
