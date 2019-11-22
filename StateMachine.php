<?php
require_once "State.php";
require_once "Transition.php";


class StateMachine {

    private $transitions;
    private $states;
    private $initialStateName;
    private $isStateFinal = false;
    private $outputValue;

    public function __construct() {

    }

    /**
     * Create a transition table of all the states
     * @param string $input
     * @param string $currentState
     * @param string $resultState
     */
    public function setTransition($input, $currentState = null, $resultState = null) {
        $this->transitions[$input][$this->states[$currentState]->getName()] = new Transition($input, $this->states[$currentState], $this->states[$resultState]);
    }

    /**
     * Add all the available states
     * @param string $name
     * @param array $types
     * @param string $outputValue
     */
    public function addState($name, $types, $outputValue) {
        $state = new State($name, $types, $outputValue);
        $this->states[$state->getName()] = $state;

        if (in_array('initial', $types)) {
            $this->initialStateName = $state->getName();
        }
    }

    /**
     * Process the transition from one state to anoter
     * @param string $inputs
     */
    public function processTransition($transitionInput) {
        $inputArray = str_split($transitionInput);
        $transition = $this->transitions[array_shift($inputArray)][$this->initialStateName];
        $resultState = $transition->getResultState();
        echo "\nInitial state = ".$transition->getCurrentState()->getName().", Input = ".$transition->getInput().", Result State = ".$resultState->getName();

        foreach ($inputArray as $input) {

            $transition = $this->transitions[$input][$resultState->getName()];
            $resultState = $transition->getResultState();
            echo "\nCurrent state = ".$transition->getCurrentState()->getName().", Input = ".$transition->getInput().", Result State = ".$resultState->getName();
        }
        $this->isStateFinal = $resultState->isFinal();
        $this->outputValue = $resultState->getOutputValue();
        echo "\nNo more input";
        echo "\nIs current state final? ".($resultState->isFinal() ? 'Yes (Output Value = '.$resultState->getOutputValue().')' : 'No ('.$transition->getInput().')');

        return $resultState->getName();

    }

    /**
     * Returns a boolean value of the state
     * @return boolean final status of the state
     */
    public function isStateFinal() {
        return $this->isStateFinal;
    }

    /**
     * Returns the output value of the state
     * @return string output value
     */
    public function getOutputValue() {
        return $this->outputValue;
    }
}


?>