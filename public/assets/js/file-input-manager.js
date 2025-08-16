class DynamicFileInputManager {
    constructor() {
        this.bindAllEvents();
    }

    bindAllEvents() {
        document.querySelectorAll('.file-input').forEach(input => {
            input.addEventListener('change', () => {
                this.handleFileInputChange(
                    input.id,
                    input.dataset.preview,
                    input.dataset.buttons,
                    input.dataset.placeholder
                );
            });
        });

        document.querySelectorAll('.change-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                this.handleChangeButtonClick(btn.dataset.input);
            });
        });

        document.querySelectorAll('.remove-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                this.handleRemoveButtonClick(
                    btn.dataset.input,
                    btn.dataset.preview,
                    btn.dataset.buttons,
                    btn.dataset.placeholder
                );
            });
        });
    }

    handleFileInputChange(fileInputId, previewImageId, buttonsId, placeholder) {
        const buttons = document.getElementById(buttonsId);
        const fileInput = document.getElementById(fileInputId);
        const previewImage = document.getElementById(previewImageId);

        const file = fileInput.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                previewImage.src = e.target.result;
                buttons.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    }

    handleChangeButtonClick(fileInputId) {
        document.getElementById(fileInputId).click();
    }

    handleRemoveButtonClick(fileInputId, previewImageId, buttonsId, placeholder) {
        const buttons = document.getElementById(buttonsId);
        const fileInput = document.getElementById(fileInputId);
        const previewImage = document.getElementById(previewImageId);

        previewImage.src = placeholder;
        fileInput.value = '';
        buttons.style.display = 'none';
    }
}
