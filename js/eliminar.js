let eliminaModal = document.getElementById('eliminaModal')
eliminaModal.addEventListener('show.bs.modal', function (event) {
    let button = event.relatedTarget
    let id = button.getAttribute('data-bs-id')
    let buttonElimina = eliminaModal.querySelector('.modal-footer #btn-elimina')
    buttonElimina.value = id
})

function actualizaCantidad(cantidad, id) {
    let url = 'clases/actualizar_carrito.php';
    let formData = new FormData();
    formData.append('id', id);
    formData.append('action', 'agregar');
    formData.append('cantidad', cantidad);

    fetch(url, {
        method: 'POST',
        body: formData,
        mode: 'cors'
    }).then(response => response.json())
        .then(data => {
            if (data.ok) {
                let divsubtotal = document.getElementById('subtotal_' + id);
                divsubtotal.innerHTML = data.sub;

                let total = 0.00;
                let list = document.getElementsByName('subtotal[]'); // Corregir getElementByName por getElementsByName

                for (let i = 0; i < list.length; i++) { // Corregir length escrito como lenght
                    total += parseFloat(list[i].innerHTML.replace(/[$,]/g, ''));
                }
                total = new Intl.NumberFormat('en-US', {
                    minimumFractionDigits: 2
                }).format(total);
                document.getElementById('total').innerHTML = '<?php echo MONEDA; ?>' + total;
            }
        });
}

// Eliminar

function eliminar() {

    let botonElimina = document.getElementById('btn-elimina')
    let id = botonElimina.value

    let url = 'clases/actualizar_carrito.php';
    let formData = new FormData();
    formData.append('id', id);
    formData.append('action', 'eliminar');

    fetch(url, {
        method: 'POST',
        body: formData,
        mode: 'cors'
    }).then(response => response.json())
        .then(data => {
            if (data.ok) {
                location.reload()
            }
        });
}