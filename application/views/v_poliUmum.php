<div class="page-content">
    <div class="modal modal-add fade" id="addModal" tabindex="-1" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-m">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Add Data</h4>
                    <button type="button" class="close btn-closed" data-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="34" height="24" viewBox="0 0 34 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-x">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                <form action="#">
                    <div class="modal-body">
                        <div class="row">
                            <!-- <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="nik-column">NIK</label>
                                    <input type="text" class="form-control" id="nik" name="nik">
                                </div>
                            </div> -->
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="poli-column">Nama Poli</label>
                                    <fieldset class="form-group">
                                        <select class="form-select" id="poli" name="poli"></select>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="nama-pasien">Nama Pasien</label>
                                    <!-- <input type="text" class="form-control" id="pasien" name="pasien" readonly> -->
                                    <fieldset class="form-group">
                                        <select class="form-select" id="pasien" name="pasien"></select>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="btn-closed d-none d-sm-block ">Close</span>
                                </button>
                                <button type="button" onclick="simpan_data()" class="btn btn-primary btn-submit ms-1">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Simpan</span>
                                </button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="card card-dta">
    <div class="card-header">
        <h5 class="card-title">
            Form Antrian
        </h5>
        <button class="btn btn-success btn-add" data-toggle="modal" data-target="#addModal"><i class="bi bi-plus-lg">
            </i>Add</button>
    </div>
    <div class="card-body">
        <div class="table-responsive datatable-minimal">
            <table class="table" id="table2">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Poli</th>
                        <th>Nama Pasien</th>
                        <th>No. Antrian</th>
                        <th>Waktu Pendaftaran</th>
                        <th>Info</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
</section>
</div>
</div>
</section>
</div>
</section>
</div>
</div>


</body>

</html>