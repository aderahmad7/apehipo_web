console.log("Hello World")
function editProduk(kode) {
	let tampilProduk = document.getElementById('tampil-produk');
	let editProduk = document.getElementById(`edit-produk${kode}`);

	tampilProduk.style.display = 'none';
	editProduk.style.display = 'block';
}

function kembaliTampilProduk(kode) {
	let tampilProduk = document.getElementById('tampil-produk');
	let editProduk = document.getElementById(`edit-produk${kode}`);

	tampilProduk.style.display = 'block';
	editProduk.style.display = 'none';
}

// Fungsi untuk menampilkan pratinjau gambar saat gambar dipilih
function showPreview(event, foto) {
    const input = event.target;
    const preview = document.getElementById('preview');
    const fotoShow = document.getElementById(`${foto}`);
    const modalPreview = document.getElementById('previewModal');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
            fotoShow.src = e.target.result;
            preview.style.display = 'block';
            modalPreview.src = e.target.result; // Ubah gambar di dalam modal juga
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Ambil gambar yang diklik untuk menampilkan di modal
const previewImages = document.querySelectorAll('.image-preview img');
previewImages.forEach(img => {
    img.addEventListener('click', function() {
        const src = this.getAttribute('src');
        const modalPreview = document.getElementById('previewModal');
        modalPreview.setAttribute('src', src);
    });
});


function editUser(kode, user) {
    let user2 = '';
    if(user == 'petani') {
        user2 = 'konsumen';
    }else {
        user2 = 'petani';
    }
	let tampilUser = document.getElementById(`tampil-${user}`);
	let tampilUser2 = document.getElementById(`tampil-${user2}`);
	let editUserID = document.getElementById(`edit-${user}${kode}`);
	tampilUser.style.display = 'none';
	tampilUser2.style.display = 'none';
	editUserID.style.display = 'block';

}

function kembaliTampilUser(kode, user) {
    let user2 = '';
    if(user == 'petani') {
        user2 = 'konsumen';
    }else {
        user2 = 'petani';
    }
	let tampilUser = document.getElementById(`tampil-${user}`);
	let tampilUser2 = document.getElementById(`tampil-${user2}`);
	let editUserID = document.getElementById(`edit-${user}${kode}`);

	tampilUser.style.display = 'block';
	tampilUser2.style.display = 'block';
	editUserID.style.display = 'none';
}

// Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
    'use strict'
  
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')
  
    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }
  
        form.classList.add('was-validated')
      }, false)
    })
  })()







