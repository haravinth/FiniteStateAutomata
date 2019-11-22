<?php
//require_once "State.php";

class Transition {

    private $currentState;
    private $resultState;
    private $input;

    /**
     * @param string $input
     * @param StateInterface $currentState
     * @param StateInterface $resultState
     */
    public function __construct($input, StateInterface $currentState, StateInterface $resultState) {
        $this->input = $input;
        $this->currentState = $currentState;
        $this->resultState = $resultState;
    }

    /**
     * Gets the input value of the transition
     * @return string input value
     */
    public function getInput() {
        return $this->input;
    }

    /**
     * Get the current state object
     * @return StateInterface current state
     */
    public function getCurrentState() {
        return $this->currentState;
    }

    /**
     * Get the result state object
     * @return StateObject result state
     */
    public function getResultState() {
        return $this->resultState;
    }    

}

?>