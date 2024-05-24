<div class="page-wrapper">

    <div class="flex justify-between">
        <input type="search" class="input input-bordered w-full max-w-xs" wire:model="search" placeholder="Search" wire:model.live="search">

        <button class="btn btn-primary" wire:click="$dispatch('createCustomer')">
            <x-tabler-plus class="size-5"/>
            <span>customer</span>
        </button>
    </div>

    <div class="table-wrapper">
        <table class="table">
            <thead>
                <th>No</th>
                <th>Nama Customer</th>
                <th>Kontak</th>
                <th>Keterangan</th>
                <th class="text-center">Actions</th>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->contact }}</td>
                        <td>{{ $customer->description }}</td>
                        <td>
                            <div class="flex justify-center gap-1">
                                <button class="btn btn-xs btn-square" wire:click="$dispatch('editCustomer', {customer: {{ $customer->id }}})">
                                    <x-tabler-edit class="size-4"/>
                                </button>
                                <button class="btn btn-xs btn-square" wire:click="$dispatch('deleteCustomer', {customer: {{ $customer->id }}})">
                                    <x-tabler-trash class="size-4"/>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @livewire('customer.actions')
</div>
