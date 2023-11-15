<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Kamu Yakin',
            text: "Kamu akan menghapus data ini",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Iya',
            cancelButtonText: 'Tidak',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to the delete route with the item's ID
                window.location.href = "/pembimbing/" + id;
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire(
                    'Cancelled',
                    'Aksi dibatalkan',
                    'error'
                )
            }
        });
    }
</script>

<script>
    function confirmDeletePeserta(id) {
        Swal.fire({
            title: 'Apakah Kamu Yakin',
            text: "Kamu akan menghapus data ini",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Iya',
            cancelButtonText: 'Tidak',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to the delete route with the item's ID
                window.location.href = "/peserta/" + id;
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire(
                    'Cancelled',
                    'Aksi dibatalkan',
                    'error'
                )
            }
        });
    }
</script>