@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mx-3 mt-3 shadow" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show mx-3 mt-3 shadow" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<script>
    // Auto-close alert setelah 3 detik (3000 ms)
    setTimeout(() => {
        const alertNode = document.querySelector('.alert');
        if (alertNode) {
            // Bootstrap 5: remove 'show' to trigger fade out
            alertNode.classList.remove('show');
            
            // Hapus dari DOM setelah animasi fade selesai (500ms sesuai Bootstrap)
            setTimeout(() => alertNode.remove(), 500);
        }
    }, 3000);
</script>
