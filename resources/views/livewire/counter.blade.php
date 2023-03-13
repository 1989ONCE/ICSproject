<center>
</br>
<div>
    <form wire:submit.prevent="printsubmit">
        <input type="text" wire:model="title" placeholder="type in your name">
        </br>
        <button type="button" wire:click="decrement" class="minus">-</button>
        <input type="text" wire:model="count" value="{{ $count }}" class="prod_qty">
        <button type="button" wire:click="increment" class="plus">+</button>
        </br>
        <button type="submit" class="btn btn-dark btn-block">send</button>
    </form>
</div>
</center>

