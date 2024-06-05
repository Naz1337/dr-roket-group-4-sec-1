document.getElementById('dropArea').addEventListener('click', function() {
    document.getElementById('draftFile').click();  // Simulate click on the hidden file input
});

document.getElementById('dropArea').addEventListener('dragover', function(event) {
    event.preventDefault();  // Prevent default behavior (Prevent file from being opened)
    this.classList.add('hover');
});

document.getElementById('dropArea').addEventListener('dragleave', function(event) {
    this.classList.remove('hover');
});

function verifyFileExt(file) {
    const validFileExtensions = ['pdf', 'txt']
    const fileExtension = file.name.split('.').pop().toLowerCase();

    return validFileExtensions.includes(fileExtension);
}

document.getElementById('dropArea').addEventListener('drop', function(event) {
    event.preventDefault();  // Prevent default behavior (Prevent file from being opened)
    this.classList.remove('hover');
    if (event.dataTransfer.files.length) {
        document.getElementById('draftFile').files = event.dataTransfer.files;
        // this.textContent = `File chosen: ${event.dataTransfer.files[0].name}`;
        document.getElementById('draftFile').dispatchEvent(new Event('change'));
    }
});

document.getElementById('draftFile').addEventListener('change', function() {
    if (this.files.length) {
        document.getElementById('dropArea').textContent = `File chosen: ${this.files[0].name}`;
        if (!verifyFileExt(this.files[0])) {
            document.getElementById('dropArea').classList.add('drag-drop-area-invalid');
            return
        }
        document.getElementById('dropArea').classList.remove('drag-drop-area-invalid');
        document.getElementById('dropArea').classList.add('drag-drop-area-valid');
    }
});
