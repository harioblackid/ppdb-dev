<?php require "fungsi.php"; ?>
<div class="row">
    <div class="col-12 col-sm-8 col-lg-8">
        <div class="card author-box card-primary">
            <div class="card-header">
                <h4>Data Calon Siswa Baru </h4>
                
            </div>
            <div class="card-body">
                <form id="form-datadiri" class="valid-form-datadiri">
                  <div class="form-group row mb-2">
                      <label class="col-form-label text-md-right col-12 col-md-4 col-lg-4">No Pendaftaran</label>
                      <div class="col-sm-12 col-md-7">
                          <input type="text" name="no" class="form-control" value="<?= $siswa['no_daftar'] ?>" disabled>
                      </div>
                  </div>

                  <div class="form-group row mb-2">
                      <label class="col-form-label text-md-right col-12 col-md-4 col-lg-4">Nama Lengkap</label>
                      <div class="col-sm-12 col-md-7">
                          <input type="text" name="fullname" id="fullname" class="form-control">
                      </div>
                  </div>

                  <div class="form-group row mb-2">
                      <label class="col-form-label text-md-right col-12 col-md-4 col-lg-4">Buat Password Baru</label>
                      <div class="col-sm-12 col-md-7">
                          <input type="password" name="password1" id="password1" class="form-control">
                      </div>
                  </div>

                  <div class="form-group row mb-2">
                      <label class="col-form-label text-md-right col-12 col-md-4 col-lg-4">Ulangi Password</label>
                      <div class="col-sm-12 col-md-7">
                          <input type="password" name="password2" id="password2" class="form-control">
                      </div>
                  </div>

                  <div class="form-group row mb-2">
                      <label class="col-form-label text-md-right col-12 col-md-4 col-lg-4">Pilihan Jurusan Pertama</label>
                      <div class="col-sm-12 col-md-7">
                          <select name="jurusan1" id="jurusan1" class="form-control">
                            <option value="" selected> -- Pilih Salah Satu -- </option>
                            <?php $getJurusan = mysqli_query($koneksi, "SELECT * FROM jurusan WHERE status = 1"); ?> 
                            <?php while($row = mysqli_fetch_assoc($getJurusan)) : ?>
                                <option value="<?= $row['id_jurusan'] ?>"> <?= $row['nama_jurusan'] ?></option>
                            <?php endwhile ?>
                          </select>
                      </div>
                  </div>

                  <div class="form-group row mb-2">
                      <label class="col-form-label text-md-right col-12 col-md-4 col-lg-4">Pilihan Jurusan Kedua</label>
                      <div class="col-sm-12 col-md-7">
                          <select name="jurusan2" id="jurusan2" class="form-control">
                            <option value="" selected> -- Pilih Salah Satu -- </option>
                            <?php $getJurusan = mysqli_query($koneksi, "SELECT * FROM jurusan WHERE status = 1"); ?> 
                            <?php while($row = mysqli_fetch_assoc($getJurusan)) : ?>
                                <option value="<?= $row['id_jurusan'] ?>"> <?= $row['nama_jurusan'] ?></option>
                            <?php endwhile ?>
                          </select>
                      </div>
                  </div>
                  
                  <div class="form-group row">
                    <div class="offset-sm-4 col-sm-8">
                      <button id="btnsimpan" type="submit" class="btn btn-primary btn-lg mt-2">
                        <i class="fas fa-save"></i> Simpan Data Diri
                         
                      </button>
                    </div>
                  </div>
                      
                      
                  </div>
              </form>
            </div>
                           
        </div>
    </div>
    
</div>
<script>
    $('.form-control').keyup(function(event) {

        $(this).val($(this).val().toUpperCase());
    });

    jQuery.validator.setDefaults({
      debug: true,
      success: "valid"
    });
    
    $(document).ready(function() {
      $(".valid-form-datadiri").validate({
        rules: {
          
          fullname: { 
            required: true,
            letterswithbasicpunc: true 
          },

          password1: {
            required: true,
            minlength: 6
          },

          password2: {
            required: true,
            minlength: 6,
            equalTo: password1
          },

          jurusan1: {
            required: true
          },

          jurusan2: {
            required: true,
            notEqualTo: jurusan1
          }
        },

        
      });

      $('#form-datadiri').submit(function(e) {
          e.preventDefault();
          $.ajax({
              type: 'POST',
              url: 'mod_formulir/crud_formulir.php?pg=simpansetup',
              data: $(this).serialize(),
              beforeSend: function() {
                  $('#btnsimpan').prop('disabled', true);
              },
              success: function(data) {
                  var json = data;
                  $('#btnsimpan').prop('disabled', false);
                  if (json == 'ok') {
                      iziToast.success({
                          title: 'Terima Kasih!',
                          message: 'Data berhasil disimpan', 
                          position: 'topRight',
                          timeout: 2000,
                          displayMode: 'once'
                          
                      });

                      window.location.href = "http://localhost/ppdb/user/"

                      // iziToast.question({
                      //     timeout: 5000,
                      //     close: false,
                      //     overlay: true,
                      //     displayMode: 'once',
                      //     id: 'question',
                      //     zindex: 999,
                      //     title: 'Konfirmasi',
                      //     message: 'Apakah anda ingin mencetak kartu peserta?',
                      //     position: 'center',
                      //     buttons: [
                      //         ['<button><b>YES</b></button>', function (instance, toast) {
                      
                      //             instance.hide({ transitionOut: 'fadeOut' }, toast, 'YES');
                      
                      //         }, true],
                      //         ['<button>NO</button>', function (instance, toast) {
                      
                      //             instance.hide({ transitionOut: 'fadeOut' }, toast, 'NO');
                      
                      //         }],
                      //     ],
                      //     onClosing: function(instance, toast, result){
                              
                      //           window.location.href = "http://localhost/ppdb/user/"
                            
                      //     }
                          
                      // });

                  } else {
                      iziToast.error({
                          title: 'Maaf!',
                          message: json,
                          position: 'topCenter'
                      });
                  }
                  //$('#bodyreset').load(location.href + ' #bodyreset');
              }
          });
          return false;
      });

    });
</script>