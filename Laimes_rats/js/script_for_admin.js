function openPreview(){ document.getElementById('wheelPreview').style.display='block'; }
function closePreview(){ document.getElementById('wheelPreview').style.display='none'; }

function clearForm() {
    const form = document.getElementById('sectorForm');
    form.querySelectorAll('input[type="text"], textarea, input[type="number"]').forEach(input => input.value='');
    document.getElementById('radioTitleText').checked = true;
    document.getElementById('radioTitleImage').checked = false;
    toggleTitleInput();
    form.querySelectorAll("img").forEach(img=>img.src="");
    form.querySelector('input[name="old_image"]').value='';
    form.querySelector('input[name="old_image1"]').value='';
}

function toggleTitleInput() {
    const textInput = document.getElementById('titleText');
    const fileInput = document.getElementById('titleFileInput');
    if(document.getElementById('radioTitleText').checked){
        textInput.style.display='block';
        fileInput.style.display='none';
    } else {
        textInput.style.display='none';
        fileInput.style.display='block';
    }
}

function deleteImage(field, id) {
    fetch(`admin.php?delete_image=${field}&id=${id}`)
        .then(() => {
            if(field === 'image') {
                const preview = document.getElementById('previewImage');
                if(preview) preview.src = '';
                document.querySelector('input[name="old_image"]').value = '';
            } else if(field === 'image1') {
                const preview = document.getElementById('previewImage1');
                if(preview) preview.src = '';
                document.querySelector('input[name="old_image1"]').value = '';
            }
        });
}

// ===== Saglabā spin_count =====
document.addEventListener('DOMContentLoaded', () => {
    const saveBtn = document.getElementById('saveSpins');
    if(saveBtn){
        saveBtn.addEventListener('click', async () => {
            const spins = document.getElementById('wheelSpins').value;
            try {
                const formData = new FormData();
                formData.append('wheelSpins', spins);

                const res = await fetch('admin.php', {
                    method: 'POST',
                    body: formData
                });
                const data = await res.json();
                const msg = document.getElementById('spinMessage');
                if(data.success){
                    msg.textContent = '✅ Saglabāts!';
                    setTimeout(()=>{ msg.textContent=''; },2000);
                } else {
                    msg.textContent = '❌ Kļūda!';
                }
            } catch(err){
                console.error(err);
                document.getElementById('spinMessage').textContent='❌ Kļūda!';
            }
        });
    }
});