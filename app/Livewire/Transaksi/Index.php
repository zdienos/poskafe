<?php

namespace App\Livewire\Transaksi;

use App\Models\Transaksi;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.transaksi.index', [
            'transaksis' => Transaksi::get()
        ]);
    }
}
