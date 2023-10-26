<x-modal size="modal" data-backdrop="static" data-keyboard="false">
    <x-slot name="title">
        
    </x-slot>

    @method('post')

    <div class="form-group">
        <label>Name</label> 
        <input type="text" name="nama" placeholder="Nama kategori" id="nama" class="form-control">
    </div>

    <x-slot name="footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" onclick="submitForm(this.form)">Simpan</button>
    </x-slot>
</x-modal>

{{-- @method('post')
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <i class="fa fa-clipboard modal-icon"></i>
    <h4 class="modal-title">Tambah Kategori</h4>
</div>

<div class="modal-body">
    <div class="form-group">
        <label>Name</label> 
        <input type="text" name="nama" placeholder="Nama kategori" id="nama" class="form-control">
    </div>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary" onclick="submitForm(this.form)">Simpan</button>
</div> --}}