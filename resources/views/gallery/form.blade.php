<x-modal size="modal-xl" data-backdrop="static" data-keyboard="false">
    <x-slot name="title">
        Tambah
    </x-slot>

    @method('post')

    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label for="path_image">Gambar</label>
                <div class="custom-file">
                    <input type="file" name="path_image" class="custom-file-input" id="path_image"
                        onchange="preview('.preview-path_image', this.files[0])">
                    <label class="custom-file-label" for="path_image">Choose file</label>
                </div>
            </div>           
            <img src="" class="img-thumbnail preview-path_image" style="display: none;" width="500">
        </div>      
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="title">Judul</label>
                <input type="text" name="title" class="form-control">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea name="description" id="description" rows="3" class="form-control"></textarea>
            </div>
        </div>
    </div>

    <x-slot name="footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" onclick="submitForm(this.form)">Simpan</button>
    </x-slot>
</x-modal>