<?php

namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Counter as ctm;


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
        ctm::create([
            'name' => $this->title,
            'counter' => $this->count
        ]);
        session()->flash('success','Post Created Successfully!!');

        // DB::table('counter')
        // ->updateOrInsert(
        //     ['name' => $this->title],
        //     ['counter' => $this->count]
        // );        
        dump($this->title. ", you submit number " .$this->count);
    }

    public function render()
    {
        return view('livewire.counter');
    }
}