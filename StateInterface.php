<?php

interface StateInterface {
    const TYPE_INITIAL = 'initial';
    const TYPE_CURRENT = 'current';
    const TYPE_FINAL = 'final';

    /**
     * Get the types of the state
     * @return array state type
     */
    public function getType();

    /**
     * Get the name of the state
     * @return string state name
     */
    public function getName();

    /**
     * Return boolean if state is final or not
     * @return boolean is state final?
     */
    public function isFinal();

    /**
     * Return boolean if state is initial or not
     * @return boolean is state initial?
     */
    public function isInitial();

    /**
     * Return boolean if state is current or not
     * @return boolean is state current?
     */
    public function isCurrent();
    
    /**
     * Get the output value of the state
     * @return string output value
     */
    public function getOutputValue();
}
?>