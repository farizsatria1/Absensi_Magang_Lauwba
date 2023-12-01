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
    function logout() {
        var logoutUrl = '{{ route("logout") }}'; // Assign the route to a JavaScript variable
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Anda akan keluar dari sesi.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Logout!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = logoutUrl; // Use the JavaScript variable for the route
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

<script>
    function confirmDeletePiket(id) {
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
                window.location.href = "/piket/" + id;
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
    function confirmDeleteCarousel(id) {
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
                window.location.href = "/carousel/" + id;
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
