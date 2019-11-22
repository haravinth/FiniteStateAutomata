<?php

use PHPUnit\Framework\TestCase;
require_once "StateMachine.php";

class StateMachineTest extends TestCase {
    /**
     * This test will check for the valid return state at the end of the run
     */
    public function testMultiFinalStates() {

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

        $this->assertEquals('S1',$stateMachine->processTransition('1010'));
    }

    /**
     * This test will use S2 as the only final state
     */
    public function testOneFinalState() {

        $stateMachine = new StateMachine();
        $stateMachine->addState('S0',array('initial'), 0);
        $stateMachine->addState('S1',array('current'), 1);
        $stateMachine->addState('S2',array('current', 'final'), 2);

        $stateMachine->setTransition(0, 'S0', 'S0');
        $stateMachine->setTransition(1, 'S0', 'S1');
        $stateMachine->setTransition(0, 'S1', 'S2');
        $stateMachine->setTransition(1, 'S1', 'S0');
        $stateMachine->setTransition(0, 'S2', 'S1');
        $stateMachine->setTransition(1, 'S2', 'S2');

        $this->assertEquals('S0',$stateMachine->processTransition('10101'));
    }

    /**
     * This test will use S2 as the only final state and check if the state is final at the end of the run
     */
    public function testIsStateFinal() {

        $stateMachine = new StateMachine();
        $stateMachine->addState('S0',array('initial'), 0);
        $stateMachine->addState('S1',array('current'), 1);
        $stateMachine->addState('S2',array('current', 'final'), 2);

        $stateMachine->setTransition(0, 'S0', 'S0');
        $stateMachine->setTransition(1, 'S0', 'S1');
        $stateMachine->setTransition(0, 'S1', 'S2');
        $stateMachine->setTransition(1, 'S1', 'S0');
        $stateMachine->setTransition(0, 'S2', 'S1');
        $stateMachine->setTransition(1, 'S2', 'S2');
        $stateMachine->processTransition('10101');
        $this->assertEquals(False,$stateMachine->isStateFinal());
    }

    /**
     * This test will check if the output value is valid
     */
    public function testOutputValue() {
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
        $stateMachine->processTransition('10111');
        $this->assertEquals(2,$stateMachine->getOutputValue());
    }

}

?>