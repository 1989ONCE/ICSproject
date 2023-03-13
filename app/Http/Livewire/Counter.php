<?php

namespace App\Http\Livewire;
use Livewire\Component;

class Counter extends Component
{
    public $count = 0;
    public $title;

    public function increment()
    {
        $this->count++;
    }

    public function decrement()
    {
        $this->count--;
    }
 
    public function printsubmit(){
        dump($this->title. ", you submit number " .$this->count);
    }

    public function render()
    {
        return view('livewire.counter');
    }
}