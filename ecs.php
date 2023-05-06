<?php

declare(strict_types=1);

use PhpCsFixer\Fixer\Import\NoUnusedImportsFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use PhpCsFixer\Fixer\ArrayNotation\ArraySyntaxFixer;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return function (ECSConfig $ecsConfig): void {
    $ecsConfig->sets([SetList::PSR_12, SetList::SYMPLIFY, SetList::COMMON, SetList::CLEAN_CODE]);

    $ecsConfig->paths([
        __DIR__ . '/bin',
        __DIR__ . '/src',
        __DIR__ . '/packages',
        __DIR__ . '/packages-tests',
        __DIR__ . '/rules',
        __DIR__ . '/rules-tests',
        __DIR__ . '/tests',
        __DIR__ . '/utils',
        __DIR__ . '/utils-tests',
        __DIR__ . '/config',
        __DIR__ . '/ecs.php',
        __DIR__ . '/easy-ci.php',
        __DIR__ . '/rector.php',
        __DIR__ . '/scoper.php',
        __DIR__ . '/build/build-preload.php',
    ]);

    $ecsConfig->ruleWithConfiguration(NoSuperfluousPhpdocTagsFixer::class, [
        'allow_mixed' => true,
    ]);

    $ecsConfig->ruleWithConfiguration(GeneralPhpdocAnnotationRemoveFixer::class, [
        'annotations' => [
            'throw',
            'throws',
            'author',
            'authors',
            'package',
            'group',
            'required',
            'phpstan-ignore-line',
            'phpstan-ignore-next-line',
        ],
    ]);

    $ecsConfig->rule(StaticLambdaFixer::class);

    $ecsConfig->skip([
        '*/Source/*',
        '*/Fixture/*',
        '*/Expected/*',

        // buggy - @todo fix on Symplify master
        DocBlockLineLengthFixer::class,

        PhpdocTypesFixer::class => [
            // double to Double false positive
            __DIR__ . '/rules/Php74/Rector/Double/RealToFloatTypeCastRector.php',
            // skip for enum types
            __DIR__ . '/rules/Php70/Rector/MethodCall/ThisCallOnStaticMethodToStaticCallRector.php',
        ],

        // breaking and handled better by Rector PHPUnit code quality set, removed in symplify dev-main
        PhpUnitStrictFixer::class,

        // skip add space on &$variable
        FunctionTypehintSpaceFixer::class => [
            __DIR__ . '/src/PhpParser/Printer/BetterStandardPrinter.php',
            __DIR__ . '/rules/Php70/EregToPcreTransformer.php',
        ],

        AssignmentInConditionSniff::class . '.FoundInWhileCondition',

        // null on purpose as no change
        PhpdocNoEmptyReturnFixer::class => [
            __DIR__ . '/rules/DeadCode/Rector/ConstFetch/RemovePhpVersionIdCheckRector.php',
        ],
    ]);
    $ecsConfig->paths([
        __DIR__ . '/app',
        __DIR__ . '/bootstrap',
        __DIR__ . '/config',
        __DIR__ . '/lang',
        __DIR__ . '/public',
        __DIR__ . '/resources',
        __DIR__ . '/routes',
        __DIR__ . '/tests',
    ]);

    // this way you add a single rule
    $ecsConfig->rules([
        NoUnusedImportsFixer::class,
    ]);

    // this way you can add sets - group of rules
    $ecsConfig->sets([
        // run and fix, one by one
        // SetList::SPACES,
        // SetList::ARRAY,
        // SetList::DOCBLOCK,
        // SetList::NAMESPACES,
        // SetList::COMMENTS,
        // SetList::PSR_12,
    ]);

    // A. full sets
    $ecsConfig->sets([SetList::PSR_12]);

    // B. standalone rule
    $ecsConfig->ruleWithConfiguration(ArraySyntaxFixer::class, [
        'syntax' => 'short',
    ]);
};