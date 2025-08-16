class FileInputManager {
    constructor(config = {}) {
        this.selector = config.selector || '.file-upload-wrapper';
        this.placeholder = config.placeholder || '';
        this.isMultiple = config.multiple || false;
        this.init();
    }

    init() {
        const wrappers = document.querySelectorAll(this.selector);

        wrappers.forEach((wrapper) => {
            const fileInput = wrapper.querySelector('input[type="file"]');
            const previewImage = wrapper.querySelector('.img-preview');
            const changeBtn = wrapper.querySelector('.change-btn');
            const removeBtn = wrapper.querySelector('.remove-btn');
            const buttons = wrapper.querySelector('.action-buttons');

            if (!fileInput || !previewImage) return;

            fileInput.addEventListener('change', () => {
                const file = fileInput.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        previewImage.src = e.target.result;
                        if (buttons) buttons.style.display = 'flex';
                    };
                    reader.readAsDataURL(file);
                }
            });

            if (changeBtn) {
                changeBtn.addEventListener('click', () => fileInput.click());
            }

            if (removeBtn) {
                removeBtn.addEventListener('click', () => {
                    previewImage.src = this.placeholder;
                    fileInput.value = '';
                    if (buttons) buttons.style.display = 'none';
                });
            }

            if (buttons && !fileInput.value) {
                buttons.style.display = 'none';
            }
        });
    }
}

// Make globally available
window.FileInputManager = FileInputManager;
