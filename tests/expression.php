<?php

declare(strict_types=1);

spl_autoload_register(static function (string $class): void {
	$prefixes = [
		'muqsit\\arithmexp\\' => __DIR__ . '/../virions/arithmexp/src/muqsit/arithmexp/',
		'NhanAZ\\Calculator\\' => __DIR__ . '/../src/NhanAZ/Calculator/',
	];
	foreach ($prefixes as $prefix => $directory) {
		if (str_starts_with($class, $prefix)) {
			$path = $directory . str_replace('\\', '/', substr($class, strlen($prefix))) . '.php';
			if (is_file($path)) {
				require $path;
			}
			return;
		}
	}
});

use NhanAZ\Calculator\ExpressionCalculator;

function check(bool $condition, string $message): void {
	if (!$condition) {
		throw new RuntimeException($message);
	}
}

$calculator = new ExpressionCalculator();
$request = $calculator->createRequest(['x', '+', 'y', '--x=2', '--y=x*4']);
check($request->expression === 'x + y', 'Command expression changed');
$values = $calculator->resolveProvidedValues($request->rawValues);
check($values === ['x' => 2, 'y' => 8], 'Dependent variables were not resolved');
check($calculator->extractVariables($request->expression) === ['x', 'y'], 'Variable names were not found');
check($calculator->evaluate($calculator->parse($request->expression), $values) === 10, 'Expression result changed');
check($calculator->evaluate($calculator->parse('2 > 3')) === false, 'Boolean false result changed');
check($calculator->extractVariables('sqrt(9) + pi + x') === ['x'], 'Functions and constants became variables');

try {
	$calculator->createRequest(['x', '--x=1', '--x=2']);
	throw new RuntimeException('Duplicate variable was accepted');
} catch (InvalidArgumentException) {}

echo "Expression, variable, boolean, and duplicate-option checks passed\n";
