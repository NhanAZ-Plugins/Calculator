# Calculator

Calculator is an Axolotl-PM plugin that evaluates mathematical expressions from the server console or the `/calculator` command. It uses the [arithmexp parser](https://github.com/Muqsit/arithmexp), which supports arithmetic, comparisons, constants, functions, and variables.

![Calculator command example](https://user-images.githubusercontent.com/60387689/199899361-3511-a439-e121-42e6-bb65-0d96f7d63196.png)

## Requirements and compatibility

- Axolotl-PM with plugin API 5.0.0 or later in the 5.x API series.
- PHP 8.1 or later with the extensions supplied by Axolotl-PM.

The manifest declares API 5.0.0. Static analysis has passed against Axolotl-PM source 5.0.0 and the pinned source in [the build workflow](.github/workflows/build.yml). The current branch is still undergoing dependency validation. It has no stable release or claim of compatibility with every intermediate Axolotl-PM 5.x version.

## Usage

Run `/calculator <expression>` or `/calc <expression>`. The permission is `calculator.command`, granted by default. Console commands work without a player. Examples follow.

```text
/calculator 1 + (2 - 3) * 4 / 5
/calc 3 ** 2 * pi
/calculator x + y --x=2 --y=3
```

When a player leaves a variable unspecified, the plugin asks for its value in chat. Type `cancel` to end that session. Console callers must supply every variable with `--name=value`. A supplied value can reference another variable if it can be resolved, as in `--x=2 --y=x*4`.

See the [arithmexp documentation](https://github.com/Muqsit/arithmexp/wiki) for the supported operators, functions, constants, and expression syntax. The parser evaluates expressions without PHP `eval`.

## Configuration

The [`resources/config.yml`](resources/config.yml) file defines message templates, whether results show their data type, whether players hear success or error sounds, and how long an unanswered variable prompt remains active. The console receives messages without player-only sound packets. No stored user data is migrated by this update.

## Build and maintenance

The [build workflow](.github/workflows/build.yml) tests expressions, runs PHPStan at maximum level for Calculator, and uses [DevTools](https://github.com/NhanAZ/DevTools) to build and validate a standalone PHAR. A pinned submodule supplies the [NhanAZ-Libraries arithmexp fork](https://github.com/NhanAZ-Libraries/arithmexp), which retains its upstream GPL license and contains fixes for safe virion shading and arithmetic evaluation. The fork's PHPStan maximum-level run uses two documented, exact-line exceptions for recursive token arrays, backed by a deep-tree regression. A stable Calculator release requires its own verified PHAR and runtime result.

Clone with submodules to reproduce the build locally. Workflow and submodule revisions are pinned in source control. GitHub's default workflow run titles identify push runs by commit message.

## License and support

Calculator and the bundled arithmexp fork use [GPL-3.0](LICENSE). The [upstream project](https://github.com/Muqsit/arithmexp) remains credited. Report bugs through [GitHub issues](https://github.com/NhanAZ-Plugins/Calculator/issues) or join [NhanAZ Discord](https://discord.gg/j2X83ujT6c).
