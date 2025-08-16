class ImageUploader {
    constructor(selector) {
        this.wrappers = document.querySelectorAll(selector);
        this.init();
    }

    init() {
        this.wrappers.forEach(wrapper => {
            const input = wrapper.querySelector(".image-input");
            const selectBtn = wrapper.querySelector(".select-btn");
            const container = wrapper.querySelector(".image-preview-container");
            const multiple = wrapper.dataset.multiple === "true";

            // Select Button Click
            selectBtn.addEventListener("click", () => input.click());

            // File Change
            input.addEventListener("change", () => {
                if (!multiple) container.innerHTML = ""; // clear if single
                [...input.files].forEach(file => this.previewImage(file, container, input, multiple));
            });

            // Existing Remove buttons (for edit mode images)
            container.querySelectorAll(".remove-btn").forEach(btn => {
                btn.addEventListener("click", e => {
                    e.target.closest(".image-item").remove();
                    if (!multiple) input.value = "";
                });
            });
        });
    }

    previewImage(file, container, input, multiple) {
        const reader = new FileReader();
        reader.onload = e => {
            const div = document.createElement("div");
            div.classList.add("image-item");
            div.innerHTML = `
                <img src="${e.target.result}" alt="preview">
                <button type="button" class="remove-btn">&times;</button>
            `;
            container.appendChild(div);

            // Remove btn
            div.querySelector(".remove-btn").addEventListener("click", () => {
                if (!multiple) {
                    // If single, reset to default image instead of deleting
                    div.querySelector("img").src = "/Uploads/image_placeholder.jpg";
                    input.value = "";
                } else {
                    div.remove();
                }
            });
        };
        reader.readAsDataURL(file);
    }
}
