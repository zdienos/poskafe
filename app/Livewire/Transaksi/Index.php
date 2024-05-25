<?php

namespace App\Livewire\Transaksi;

use App\Models\Transaksi;
use Livewire\Component;

class Index extends Component
{

    public $no = 1;
    public $date;

    public function render()
    {
        return view('livewire.transaksi.index', [
            'transaksis' => Transaksi::when($this->date, function($transaksi){
                $transaksi->whereDate('created_at', $this->date);
            })->get()
        ]);
    }

    public function toggleDone(Transaksi $transaksi) {
        $transaksi->done = !$transaksi->done;
        $transaksi->save();
    }

    public function mount() {
        $this->date = now()->format('Y-m-d');
    }

    public function deleteTransaksi(Transaksi $transaksi) {
        $transaksi->delete();
        // $this->dispatch('reload');
    }
}
