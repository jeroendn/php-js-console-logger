// Make sure the editor understands the variables defined in php
if(iterations === undefined) iterations = undefined;
if(iterationSpacer === undefined) iterationSpacer = undefined;
if(logsOriginal === undefined) logsOriginal = undefined;
if(logs === undefined) logs = undefined;
if(timeout === undefined) timeout = undefined;
if(interval === undefined) interval = undefined;


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
