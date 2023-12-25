$('.delete').on('click', function(e) {
  e.preventDefault();
  var href = $(this).attr('href');

  Swal.fire({
    title: "Hapus Data",
    text: "Data akan dihapus?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#6A68DE",
    cancelButtonColor: "#d33",
    confirmButtonText: "Hapus"
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = href;
    }
  });
});
