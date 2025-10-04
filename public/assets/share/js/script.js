function deleteConfirm(e, message = "آیا اطمنینان با حذف دارید؟") {
    const result = confirm(message)
    if (!result) {
        e.preventDefault()
        return
    }
}
const chooseTypeWarpper = document.getElementById('choose-type-warpper')
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

    chooseTypeWarpper.insertAdjacentHTML('beforeend',
        `
        <div class="my-3">
          <label class="form-label">عنوان گزینه</label>
          <input type="text" name="options[]" class="form-control" >
        </div>
        `
    )

}