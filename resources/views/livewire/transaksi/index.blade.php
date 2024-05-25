<div class="page-wrapper">
    <div class="flex justify-between">
        <input type="date" class="input input-bordered w-full max-w-xs" wire:model.live="date">
        <a href="{{ route('transaksi.create') }}" class="btn btn-primary">
            <x-tabler-plus class="size-5" />
            <span>Transaksi</span>
        </a>
    </div>
    <div class="table-wraper">
        <table class="table">
            <thead>
                <th>No</th>
                <th>Waktu Transaksi</th>
                <th>Keterangan</th>
                <th>Customer</th>
                <th>Total Price</th>
                <th>Status</th>
                <th class="text-center">Actions</th>
            </thead>
            <tbody>
                @foreach ($transaksis as $transaksi)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $transaksi->created_at->diffForHumans() }}</td>
                        <td>{{ $transaksi->customer->description }}</td>
                        <td>{{ $transaksi->customer->name }}</td>
                        <td>{{ Number::format($transaksi->price) }}</td>
                        <td>
                            <input type="checkbox" class="toggle toggle-accent toggle-sm" @checked($transaksi->done) wire:change="toggleDone({{ $transaksi->id }})">
                        </td>
                        <td>
                            <div class="flex justify-center gap-1">
                                <a href="{{ route('transaksi.edit', $transaksi) }}" class="btn btn-xs btn-square">
                                    <x-tabler-edit class="size-4" />
                                </a>
                                <button class="btn btn-xs btn-square" wire:click="deleteTransaksi({{ $transaksi->id }})">
                                    <x-tabler-trash class="size-4" />
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
