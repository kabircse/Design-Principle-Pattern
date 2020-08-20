<?php
/* An example without using State Pattern. */
class Worker {
    private $working = 1;
    private $meeting = 2;
    private $sick = 3;
    private $lunch = 4;    
    private $general = 5;
    private $leave = 6;
    private $state = $this->working;
    public function __construct() {}
    public function showState() {
        if ($this->state == $this->working) {
            echo 'The worker is working';
        } else if ($this->state == $this->meeting) {
            echo 'The worker is having a meeting';
        } else if ($this->state == $this->sick) {
            echo 'The worker is sick';
        }
    }
}

/* An example of state pattern. */
abstract class State {  
    public function handleRequest() {
        echo 'this needed to be overriden by sub classes'
    }
}
class WorkingState extends State {  
    private $worker;

    public function __construct(Worker $woker) {
        $this->worker = $woker;
    }

    public function handleRequest() {
        echo 'Changing state to working';
        $this->worker->setState($this->worker->getWorkingState());
    }
}
class Worker {
    private $working;
    private $meeting;
    private $sick;

    public function __construct() {
        $this->working = new WorkerState($this);
        $this->meeting = new MeetingState($this);
        $this->sick    = new SickState($this);
    }

    public function showState() {
        $this->state->handleRequest();
    }

    public function setState(State $state) {
        $this->state = $state;
    }

    public function getWorkingState() {
        return $this->working
    }
}
