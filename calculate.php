<?php

    require_once __DIR__ . '/vendor/autoload.php';

    use MathParser\StdMathParser;
    use MathParser\Interpreting\Evaluator;    

    $parser = new StdMathParser();
    
    $AST = $parser->parse('( A + B ) - ( A * 2 )');
    
    $evaluator = new Evaluator();
    $evaluator->setVariables([ 'A' => 2, 'B' => 3 ]);

    $value = $AST->accept($evaluator);
    echo $value;

?>