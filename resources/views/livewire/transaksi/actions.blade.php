<div class="page-wrapper">
    <div class="grid grid-cols-2 gap-6">
        <div class="card card-divider h-fit">
            <div class="card-body">
                <input type="search" class="input input-bordered" placeholder="Search menu" wire:model.live="search">
            </div>

            @foreach ($menus as $type => $menu) {}
                <div class="card-body">
                    <h3 class="text-md font-bold"> {{ $type }}</h3>
                    <div class="grid grid-cols-4 gap-2">
                        @foreach ($menu as $item)
                            <button class="avatar" wire:click="addItem({{ $item->id }})">
                                <div class="w-24 rounded-lg">
                                    <img src="{{ $item->gambar }}" alt="">
                                </div>
                            </button>
                        @endforeach
                    </div>

                </div>
            @endforeach
        </div>

        <div class="card h-fit">
            <form class="card-body space-y-4" wire:submit="simpan">
                <h3 class="card-title">Detail Transaksi</h3>
                <div @class(['table-wrapper', 'bordered-error' => $errors->first('items')])>
                    <table class="table">
                        <thead>
                            <th>Nama Menu</th>
                            <th>Qty</th>
                            <th>Harga</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($items as $key => $value)
                                <tr>
                                    <td>{{ $key }}</td>
                                    <td>{{ $value['qty'] }}</td>
                                    <td>{{ Number::format($value['price']) }}</td>
                                    <td>
                                        <button class="btn btn-xs btn-square" wire:click="removeItem('{{ $key }}')">
                                            <x-tabler-minus class="size-4" />
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <select class="select select-bordered" wire:model="form.customer_id">
                    <option value="">Pilih Customer</option>
                    @foreach ($customers as $id=>$name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
                <textarea rows="3" class="textarea textarea-bordered resize-none" placeholder="Keterangan transaksi, bisa diisi dengan no meja, takeway atau lainnya" wire:model="form.description"></textarea>

                <div class="card-actions justify-between">
                    <div class="flex flex-col">
                        <div class="text-xs">Total Harga</div>
                        <div @class(['card-title', 'text-error' => $errors->first('items')])>Rp {{ Number::format($this->getTotalHarga()) }}</div>
                    </div>
                    <button class="btn btn-primary">
                        <x-tabler-check class="size-5" />
                        <span>Simpan</span>
                    </button>
                </div>
            </form>
        </div>


    </div>
</div>
