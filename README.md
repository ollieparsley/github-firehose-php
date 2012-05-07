# Github firehose

Convert the Github public events API into a firehose and push to a variety of adapters

## Usage

* Copy the example-config.php file and rename to config.php
* Get as many access tokens as you like, one will randomly be chosen (The more access tokens the more "real-time" the results can get
* simple run `php firehose.php`

## Adapters

In your config you can specify an adapter, that must be the class name of the adapter within the Adapter directory, without the `Adapter_` prefix.
For instance the Stdout adapter is in the Adapter/Stdout.php file and has the class name Adapter_Stdout and is specified in the config as `$adapterClass = 'Stdout';`