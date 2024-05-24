<?php

namespace App\Livewire\Customer;

use App\Livewire\Forms\CustomerForm;
use App\Models\Customer;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;

class Actions extends Component
{
    use WithFileUploads;

    public $show = false;
    public $photo;
    public CustomerForm $form;

    #[On('createCustomer')] public function createCustomer(){
        $this->show = true;
    }

    #[On('editCustomer')] public function editCustomer(Customer $customer){
        $this->form->setCustomer($customer);
        $this->show = true;
    }

    #[On('deleteCustomer')] public function deleteCustomer(Customer $customer){
        $customer->delete();
        $this->dispatch('reload');
    }

    public function simpan(){
        if($this->photo) {
            $this->form->photo = $this->photo->hashName('menu');
            $this->photo->store('menu');
        }
        if(isset($this->form->customer)) {
            $this->form->update();
        } else {
            $this->form->store();
        }
        $this->closeModal();
        $this->dispatch('reload');
    }
    public function closeModal(){
        $this->show = false;
        $this->form->reset();
    }

    public function render()
    {
        return view('livewire.customer.actions');
    }

}
