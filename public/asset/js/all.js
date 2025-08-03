 // File input enhancement
        const fileInput = document.getElementById('file');
        const fileLabel = document.querySelector('.file-input-label');
        
        fileInput.addEventListener('change', function(e) {
            const files = e.target.files;
            if (files.length > 0) {
                const fileText = files.length === 1 ? 
                    `Selected: ${files[0].name}` : 
                    `Selected: ${files.length} files`;
                fileLabel.innerHTML = `
                    <span class="file-icon">✅</span>
                    <span>${fileText}</span>
                `;
            }
        });

        // Drag and drop functionality
        const dropZone = fileLabel;
        
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, preventDefaults, false);
            document.body.addEventListener(eventName, preventDefaults, false);
        });

        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, unhighlight, false);
        });

        dropZone.addEventListener('drop', handleDrop, false);

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        function highlight(e) {
            dropZone.style.background = 'rgba(102, 126, 234, 0.2)';
            dropZone.style.borderColor = '#5a6fd8';
        }

        function unhighlight(e) {
            dropZone.style.background = 'rgba(102, 126, 234, 0.05)';
            dropZone.style.borderColor = '#667eea';
        }

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            fileInput.files = files;
            
            if (files.length > 0) {
                const fileText = files.length === 1 ? 
                    `Selected: ${files[0].name}` : 
                    `Selected: ${files.length} files`;
                fileLabel.innerHTML = `
                    <span class="file-icon">✅</span>
                    <span>${fileText}</span>
                `;
            }
        }

        // Form submission enhancement
        const form = document.querySelector('form');
        const submitBtn = document.querySelector('.submit-btn');
        
        form.addEventListener('submit', function(e) {
            submitBtn.innerHTML = 'Uploading...';
            submitBtn.classList.add('loading');
            submitBtn.disabled = true;
        });

        // Auto-format price input
        const priceInput = document.getElementById('price');
        priceInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^\d.]/g, '');
            if (value) {
                e.target.value = parseFloat(value).toLocaleString('en-US', {
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 2
                });
            }
        });