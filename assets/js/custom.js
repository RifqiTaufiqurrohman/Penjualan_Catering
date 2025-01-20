$(document).ready(function () {
    $(document).on('click', '.increment-btn', function (e) {
        e.preventDefault();

        var qty = $(this).closest('.product_data').find('.input-qty').val();

        var value = parseInt(qty, 10);
        value = isNaN(value) ? 0 : value;
        if (value) {
            value++;
            var qty = $(this).closest('.product_data').find('.input-qty').val(value);
        }
    });

    $(document).on('click', '.decrement-btn', function (e) {
        e.preventDefault();

        var qty = $(this).closest('.product_data').find('.input-qty').val();

        var value = parseInt(qty, 10);
        value = isNaN(value) ? 0 : value;
        if (value > 1) {
            value--;
            var qty = $(this).closest('.product_data').find('.input-qty').val(value);
        }
    });

    $(document).on('click', '.addToCartBtn', function (e) {
        e.preventDefault();

        var qty = $(this).closest('.product_data').find('.input-qty').val();
        var prod_id = $(this).val();

        $.ajax({
            method: 'POST',
            url: 'controller/handlecart.php',
            data: {
                prod_id: prod_id,
                prod_qty: qty,
                scope: 'add',
            },
            success: function (response) {
                if (response == 201) {
                    alertify.success('Berhasil Ditambahkan Ke Keranjang');
                } else if (response == 'existing') {
                    alertify.success('Produk Sudah Ada Di Keranjang');
                } else if (response == 401) {
                    alertify.success('Login untuk melanjutkan');
                } else if (response == 500) {
                    alertify.success('Ada Yang Salah');
                }
            },
        });
    });

    $(document).on('click', '.updateQty', function () {
        var qty = $(this).closest('.product_data').find('.input-qty').val();
        var prod_id = $(this).closest('.product_data').find('.prodId').val();

        $.ajax({
            method: 'POST',
            url: 'controller/handlecart.php',
            data: {
                prod_id: prod_id,
                prod_qty: qty,
                scope: 'update',
            },
            success: function (response) {
                // alert(response);
            },
        });
    });

    $(document).on('click', '.deleteItem', function () {
        var cart_id = $(this).val();
        var productContainer = $(this).closest('.product_data');
        $.ajax({
            method: 'POST',
            url: 'controller/handlecart.php',
            data: {
                cart_id: cart_id,
                scope: 'delete',
            },
            success: function (response) {
                if (response == 200) {
                    alertify.success('Produk Berhasil Dihapus');
                    $('#keranjangsaya').load(location.href + ' #keranjangsaya');
                    // Hapus elemen HTML produk dari keranjang
                    // productContainer.remove();
                    // Setelah menghapus, memanggil fungsi updateTotal untuk memperbarui total
                    // updateTotal();
                } else {
                    alertify.success(response);
                }
            },
        });
    });

    function updateTotal() {
        var totalQuantity = 0;
        var totalHarga = 0;

        $('.product_data').each(function () {
            var qty = parseInt($(this).find('.input-qty').val());
            var harga = parseFloat($(this).find('.hargajl h6').text().replace('Rp. ', '').replace(',', ''));

            totalQuantity += qty;
            totalHarga += qty * harga;
        });

        // Update tampilan total quantity dan total harga
        $('.float-end h5').text('Total : Rp. ' + totalHarga.toLocaleString());
        $('.float-end h6').text('Total Quantity: ' + totalQuantity);

        // Tambahkan console.log untuk memeriksa nilai total dan total quantity
        console.log('Total Quantity:', totalQuantity);
        console.log('Total Harga:', totalHarga);
    }

    $(document).ready(function () {
        // Fungsi-fungsi existing...

        $(document).on('click', '.increment-btn, .decrement-btn, .updateQty ', function () {
            // Panggil fungsi updateTotal setiap kali ada perubahan pada keranjang
            updateTotal();
        });
    });
});
