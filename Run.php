<?php
require_once "StateMachine.php";

/**
 * Get the input value through command line
 */
$input = readline('Enter the input string: ');
/**
 * Throw exception and kill the script if input value contains characters other than 1 and 0.
 */
if (!preg_match('/^[0-1]*$/',$input)) {
    throw new InvalidArgumentException('Input can only contain 1s and 0s');
    die();
}

$stateMachine = new StateMachine();
$stateMachine->addState('S0',array('initial', 'final'), 0);
$stateMachine->addState('S1',array('current', 'final'), 1);
$stateMachine->addState('S2',array('current', 'final'), 2);

$stateMachine->setTransition(0, 'S0', 'S0');
$stateMachine->setTransition(1, 'S0', 'S1');
$stateMachine->setTransition(0, 'S1', 'S2');
$stateMachine->setTransition(1, 'S1', 'S0');
$stateMachine->setTransition(0, 'S2', 'S1');
$stateMachine->setTransition(1, 'S2', 'S2');

$stateMachine->processTransition($input);

?>