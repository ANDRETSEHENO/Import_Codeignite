const fileInput = document.getElementById('fileInput');
        const dropZone = document.getElementById('dropZone');
        const fileNameDisplay = document.getElementById('fileName');

        // Mettre à jour le texte quand un fichier est sélectionné
        fileInput.addEventListener('change', (e) => {
            if (fileInput.files.length > 0) {
                fileNameDisplay.textContent = `Fichier sélectionné : ${fileInput.files[0].name}`;
                fileNameDisplay.style.display = 'block';
            }
        });

        // Effets visuels lors du Drag & Drop
        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, () => dropZone.classList.add('drag-over'), false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, () => dropZone.classList.remove('drag-over'), false);
        });