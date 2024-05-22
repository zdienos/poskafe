<div>
    <input type="checkbox" id="my_modal_6" class="modal-toggle" @checked($show) />
    <div class="modal" role="dialog">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Menu Detail</h3>
            <div class="py-4 space-y-2">
                <div class="flex justify-center">
                    <label for="pickphoto" class="avatar">
                        <div class="w-24 rounded-xl">
                            <img src="{{ $photo? $photo->temporaryUrl() : url('/images/noimage.png') }}" />
                        </div>
                    </label>
                </div>
                <input type="file" class="hidden" id="pickphoto" wire:model="photo" >
                <label class="form-control">
                    <div class="label">
                        <span class="label-text">Nama Menu</span>
                    </div>
                    <input type="text" placeholder="Type here" @class([
                        'input input-bordered',
                        'input-error' => $errors->first('form.name'),
                    ]) wire:model="form.name" />
                </label>
                <label class="form-control">
                    <div class="label">
                        <span class="label-text">Harga </span>
                    </div>
                    <input type="number" placeholder="Type here" @class([
                        'input input-bordered',
                        'input-error' => $errors->first('form.price'),
                    ])
                        wire:model="form.price" />
                </label>
                <label class="form-control">
                    <div class="label">
                        <span class="label-text">Tipe </span>
                    </div>
                    <select @class([
                        'select select-bordered',
                        'select-error' => $errors->first('form.type'),
                    ]) wire:model="form.type">
                        @foreach ($types as $type)
                            <option value="{{ $type }}">{{ $type }}</option>
                        @endforeach
                    </select>
                </label>
                <label class="form-control">
                    <div class="label">
                        <span class="label-text">Keterangan </span>
                    </div>
                    <textarea placeholder="Tulis keterangan menu di sini" @class([
                        'input input-bordered',
                        'input-error' => $errors->first('form.'),
                    ]) wire:model="form.desc"></textarea>
                </label>
            </div>
            <div class="modal-action justify-between">
                <button type="button" class="btn btn-ghost">Close</button>
                <button class="btn btn-primary">
                    <x-tabler-check class="size-5" />
                    <span>Simpan</span>
                </button>
            </div>
        </div>
    </div>
</div>
