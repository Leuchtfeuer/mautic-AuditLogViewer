# Extended Auditing

Introduce menu item which gives access to the Audit Log

## Requirements for this release
> [!TIP]
> Other releases of this plugin may cover different Mautic versions!
- Mautic 5.x
- PHP 8.x

## Installation
### Composer
This plugin can be installed through composer.
### Manual Installation
Alternatively, it can be installed manually, following the usual steps:
- Download the plugin
- Unzip to the Mautic `plugins` directory
- Rename folder to `LeuchtfeuerAuditLogViewerBundle`
- In the Mautic backend, go to the `Plugins` page as an administrator
- Click on the `Install/Upgrade Plugins` button to install the Plugin.
OR
- If you have shell access, execute `php bin\console cache:clear` and `php bin\console mautic:plugins:reload` to install the plugins.
Don't forget to activate the plugin in the plugin settings.

## Usage

The Audit Log Viewer lets you access and filter the audit log sytemwide
![image](https://github.com/Leuchtfeuer/mautic-AuditLogViewer/assets/55587275/9c538e21-7fae-427e-b166-3a515e6516ac)

## Known Issues

## Troubleshooting
Make sure you have not only installed but also enabled the Plugin.
If things are still funny, please try
`php bin/console cache:clear`
and
`php bin/console mautic:assets:generate`
## Change log
- https://github.com/Leuchtfeuer/mautic-AuditLogViewer/releases
## Future Ideas

## Sponsoring & Commercial Support
We are continuously improving our plugins. If you are requiring priority support or custom features, please contact us at mautic-plugins@leuchtfeuer.com.
## Get Involved
Feel free to open issues or submit pull requests on [GitHub](#). Follow the contribution guidelines in `CONTRIBUTING.md`.”
## Credits

## Author
Leuchtfeuer Digital Marketing GmbH
Please raise any issues in GitHub.
For all other things, please email mautic-plugins@Leuchtfeuer.com
## License
“This plugin is licensed under the MIT License. See the `LICENSE` file for more details.”
## Resources / Further Readings
