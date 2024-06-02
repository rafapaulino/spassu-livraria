document.addEventListener('DOMContentLoaded', (event) => {
    const links = document.querySelectorAll('.btn-danger');

    links.forEach(link => {
        link.addEventListener('click', (event) => {
            event.preventDefault();
            const href = link.getAttribute('href');
            
            Swal.fire({
                title: "Você tem certeza?",
                text: "Este item será deletado!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "Cancelar",
                confirmButtonText: "Sim, delete este item!"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = href;
                }
                return false;
            });
        });
    });
});