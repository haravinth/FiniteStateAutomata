<?php
require_once "StateInterface.php";

class State implements StateInterface {
    private $type;
    private $name;
    private $outputValue;
    
    /**
     * @param string $name
     * @param array $type
     * @param string $outputValue
     */
    public function __construct($name, $type = array(self::TYPE_CURRENT), $outputValue) {
        $this->name = $name;
        $this->type = $type;
        $this->outputValue = $outputValue;
    }

    /**
     * @inheritdoc
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @inheritdoc
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function isFinal() {
        return in_array(self::TYPE_FINAL, $this->type);
    }

    /**
     * @inheritdoc
     */
    public function isInitial() {
        return in_array(self::TYPE_INITIAL, $this->type);
    }

    /**
     * @inheritdoc
     */
    public function isCurrent() {
        return in_array(self::TYPE_CURRENT, $this->type);
    }

    /**
     * @inheritdoc
     */
    public function getOutputValue() {
        return $this->outputValue;
    }
}
