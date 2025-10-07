function deleteConfirm(e, message = "آیا اطمنینان با حذف دارید؟") {

    const result = confirm(message)
    if (!result) {
        e.preventDefault()
        return
    }

}

if (!chooseTypeWarpper) {
    var chooseTypeWarpper = document.getElementById('choose-type-warpper')
}
function questionTypeHandler(el) {

    if (!chooseTypeWarpper) {
        return
    }

    if (el.value === 'choose') {
        chooseTypeWarpper.classList.remove('d-none')
    } else {
        chooseTypeWarpper.classList.add('d-none')
    }
}

function createFormInputs() {
    if (!chooseTypeWarpper) {
        return
    }

    const optionInputs = document.querySelectorAll('.option-input')
    const index = optionInputs.length;

    chooseTypeWarpper.insertAdjacentHTML('beforeend',
        `
        <div class="my-3 option-input">
          <label class="form-label">عنوان گزینه</label>
          <input type="text" wire:model="options.${index}" class="form-control" >
        </div>
        `
    )

}
