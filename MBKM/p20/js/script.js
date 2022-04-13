$(document).ready(function(){
    // Hilangkan Cari
    $('#tombol-cari').hide();

    // event ketika keyword ditulis
    $('#keyword').on('keyup',function(){
        $('.loader').show();
        // $('#container').load('ajax/mahasiswa.php?keyword=' + $('#keyword').val());
   
    //.get
    $.get('ajax/mahasiswa.php?keyword=' + $('#keyword').val(),function(data){
        $('#container').html(data);
        $('.loader').hide();
    });
    });
});