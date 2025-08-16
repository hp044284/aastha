class ExtraInputsManager 
{
    constructor(options) 
    {
        this.maxInputs = options.maxInputs || 10;
        this.addBtn = document.getElementById(options.addBtnId);
        this.warning = document.getElementById(options.warningId);
        this.list = document.getElementById(options.listId);

        this.init();
    }

    init() 
    {
        if (!this.addBtn || !this.warning || !this.list) {
            // Required elements not found, do not initialize
            return;
        }

        this.addBtn.addEventListener('click', this.handleAddInput.bind(this));
        this.list.addEventListener('click', this.handleRemoveInput.bind(this));
    }

    handleAddInput(e) {
        const currentInputs = this.getAllInputCols();
        if (currentInputs.length >= this.maxInputs) {
            this.showWarning();
            return;
        }
        this.hideWarning();
        this.list.appendChild(this.createInputCol());
        if (this.getAllInputCols().length < this.maxInputs) {
            this.hideWarning();
        }
    }

    handleRemoveInput(e) {
        if (e.target && e.target.classList.contains('remove-extra-input')) {
            const allRows = this.getAllInputCols();
            const parentCol = e.target.closest('.extra-input-col');
            // Prevent removing the first input
            if (allRows.length > 1 && parentCol !== allRows[0]) {
                parentCol.remove();
                if (this.getAllInputCols().length < this.maxInputs) {
                    this.hideWarning();
                }
            }
        }
    }

    getAllInputCols() {
        return this.list.querySelectorAll('.extra-input-col');
    }

    showWarning() {
        this.warning.style.display = 'block';
    }

    hideWarning() {
        this.warning.style.display = 'none';
    }

    createInputCol() {
        const div = document.createElement('div');
        div.className = 'col-md-6 extra-input-col';
        div.innerHTML = `
            <div class="input-group mb-2 extra-input-row">
                <input type="text" name="extra_inputs[]" class="form-control" placeholder="Enter value">
                <button type="button" class="btn btn-danger btn-sm ms-2 delete-extra-input" title="Remove">
                    <i class="bx bx-trash"></i>
                </button>
            </div>
        `;
        return div;
    }
}