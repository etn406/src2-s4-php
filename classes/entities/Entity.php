<?php
abstract class Entity {

    protected $id;

    public function __construct($params = array()) {
        $this->hydrate($params);
    }

    public function __get($attribute) {
        return $this->$attribute;
	}

	public function __set($attribute, $value) {
        $this->hydrate(array($attribute => $value));
	}

    protected function hydrate($params = array()) {
        foreach($params as $k => $v) {
            $method = 'set' . ucfirst($k);
            if(method_exists($this, $method)) {
                $this->$method($v);
            } else {
                $this->$k = $v;
            }
        }
	}

}