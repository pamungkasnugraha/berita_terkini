// Contoh interaksi bookmark tanpa reload (AJAX)
document.addEventListener('DOMContentLoaded', function() {
    const bookmarkForms = document.querySelectorAll('form[action*="bookmark"]');
    bookmarkForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            fetch(this.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                // Update tampilan tombol
                const btn = this.querySelector('button');
                if (data.bookmarked) {
                    btn.innerHTML = '<span class="text-red-500">❤️ Disimpan</span>';
                } else {
                    btn.innerHTML = '<span class="text-gray-500">🤍 Simpan Berita</span>';
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});