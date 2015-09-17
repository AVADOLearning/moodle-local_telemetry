# Telemetry log for Moodle

Keeps track of some basic process state to aid with diagnosis of performance
problems on Moodle sites.

* * *

## Installation

1. Clone this directory into ```/local/telemetry```.
2. Execute the Moodle upgrades.

### Patch the configuration file

Add the following lines to ```/config.php``` to allow the telemetry plugin to
initialise early on in Moodle's setup:

    // Register the telemetry plugin's shutdown function
    require_once __DIR__ . '/local/telemetry/locallib.php';
    local_telemetry_init();

## Debugging tip

It's easier to debug exceptions thrown during database transactions if you place a breakpoint inside
```shutdown_manager::shutdown_handler()```'s ```try {} catch {}``` block.
