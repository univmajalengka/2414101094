function hitung() {
    let harga = 0;

    const layanan = document.querySelectorAll("input[name='layanan[]']:checked");

    layanan.forEach(item => {
        if (item.value === "Penginapan") harga += 1000000;
        if (item.value === "Transportasi") harga += 1200000;
        if (item.value === "Makanan")    harga += 500000;
    });

    document.getElementById("harga").value = harga;

    let hari = Number(document.getElementById("hari").value);
    let peserta = Number(document.getElementById("peserta").value);
    
    document.getElementById("total").value = hari * peserta * harga;
}

function validasi() {
    let nama = document.getElementById("nama").value;
    let hp = document.getElementById("hp").value;
    let tgl = document.getElementById("tgl").value;
    let hari = document.getElementById("hari").value;
    let peserta = document.getElementById("peserta").value;

    if (nama === "" || hp === "" || tgl === "" || hari === "" || peserta === "") {
        alert("Semua field wajib diisi!");
        return false;
    }
    return true;
}
