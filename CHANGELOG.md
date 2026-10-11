# Changelog

## 0.0.23

- Pin the [NhanAZ-Libraries arithmexp fork v1.1.1](https://github.com/NhanAZ-Libraries/arithmexp/releases/tag/v1.1.1) as the parser virion.
- Build a standalone PHAR with pinned DevTools and include the plugin and parser GPL notices.
- Keep console and player expression commands, variable prompts and configuration behavior.

The expression fixture, PHPStan maximum level on two pinned Axolotl-PM source revisions, hosted PHAR validation and isolated runtime checks passed. Connected clients received arithmetic, boolean and variable-chat results from an exact hosted PHAR on one Axolotl-PM 5.x release. Other 5.x runtime revisions and the full expression space remain unverified.

No plugin data migration is required. To roll back, stop the server, restore the previously verified Calculator PHAR and restart. Keep the previous PHAR until the replacement has passed a runtime check in the target environment.
