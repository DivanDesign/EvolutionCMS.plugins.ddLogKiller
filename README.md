# (MODX)EvolutionCMS.plugins.ddLogKiller

Clears the Event Log, preserve needed minimum number of items. Will be working once per session of each user.

## Installation

Elements → Plugins: Create a new plugin with the following data:

1. General:
	1. Plugin name: `ddLogKiller`.
	1. Description: `<b>1.1.1</b> Clears the Event Log, preserve needed minimum number of items.`.
	1. Category: `Core → Manager`.
	1. Parse DocBlock: `no`.
	1. Plugin code (php): Insert content of the `ddLogKiller_plugin.php` file from the archive.
1. System Events:
	1. Set `OnWebPageInit`.
1. Properties:
	1. Insert `{"rowsNumberToSave": [{"label": "Log items number to save", "desc": "", "type": "string", "default": "", "value": 50}]}`.
1. Configuration:
	1. Change number of log items to save if you need.