<div class="page-wrapper">

    <div class="flex justify-between">
        <input type="search" class="input input-bordered w-full max-w-xs" wire:model="search" placeholder="Search">

        <button class="btn btn-primary" wire:click="dispatch('createMenu')">
            <x-tabler-plus class="size-5"/>
            <span>Menu</span>
        </button>
    </div>

    <div class="table-wrapper">
        <table class="table">
            <thead>
                <th>No</th>
                <th>Menu</th>
                <th>Harga</th>
                <th>Keterangan</th>
                <th>Actions</th>
            </thead>
            <tbody>
                @foreach ($menus as $menu)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>
                            <div class="flex gap-3 items-center">
                                <div class="avatar">
                                    <div class="w-12 rounded-lg">
                                        <img src="{{ $menu->gambar }}" alt="">
                                    </div>
                                </div>
                                <div class="flex flex-col">
                                    <div class="font-bold">{{ $menu->name }}</div>
                                    <div class="font-italic">{{ $menu->type }}</div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $menu->harga }}</td>
                        <td>{{ $menu->description }}</td>
                        <td>
                            <button class="btn btn-xs btn-square">
                                <x-tabler-edit class="size-4"/>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @livewire('menu.actions')
</div>
