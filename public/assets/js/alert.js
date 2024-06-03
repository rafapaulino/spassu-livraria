document.addEventListener('DOMContentLoaded', (event) => {
    const forms = document.querySelectorAll('.form-destroy');

    forms.forEach(form => {
        form.addEventListener('submit', (event) => {
            event.preventDefault();
            const formObj = event.target;

            
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
                    formObj.submit();
                }
                return false;
            });
        });
    });
});