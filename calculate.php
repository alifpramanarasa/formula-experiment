<?php

    require_once __DIR__ . '/vendor/autoload.php';

    use MathParser\StdMathParser;
    use MathParser\Interpreting\Evaluator;    

    $parser = new StdMathParser();

    $formula = urldecode($_GET['formula']);
    
    $AST = $parser->parse($formula);
    
    $evaluator = new Evaluator();
    $evaluator->setVariables([ 'A' => 2, 'B' => 3 ]);

    $value = $AST->accept($evaluator);
    echo $value;

?>