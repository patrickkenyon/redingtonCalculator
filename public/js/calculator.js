document.querySelector('form').addEventListener('submit', function (e) {
    e.preventDefault()

    document.querySelector('#statusMessage').textContent = ''
    document.querySelector('#showResult').textContent = ''

    document.querySelectorAll('.error').forEach(function (error) {
        error.remove()
    })

    document.querySelectorAll('.formField').forEach(function (formField) {
        let field = formField.querySelector('.field')

        let error = document.createElement('span')
        error.classList.add('error')

        if (field.dataset.required) {
            if (!validateField(field.value)) {
                error.innerText += 'Please enter a number between 0 and 1.'
                formField.appendChild(error)
            }
        }
    })

    if (!document.querySelector('.error')) {
        const formData = getFormData()
        sendRequest(formData)
    }
})

/**
 * Checks if an input is given and whether it is a number between 0 and 1.
 *
 * @param input value of field to be checked.
 * @returns {boolean} false unless input is a number between 0 and 1.
 */
function validateField(input) {
    return (input !== '' && input >= 0 && input <= 1 && !isNaN(input))
}


/**
 * Retrieves values from form fields and the calculation type performed.
 *
 * @returns {object} with keys as field names and value as the field value,
 * object also contains a key value pair for calculation type.
 */
function getFormData() {
    let formData = {}
    const fieldWrappers = document.querySelectorAll(".formField")
    let combinedWithChecked = document.querySelector("#combinedWith").checked

    fieldWrappers.forEach(function (fieldWrapper) {
        let field = fieldWrapper.querySelector('.field')
        formData[field.name] = field.value
    })
    combinedWithChecked ? formData['calcType'] = 'combinedWith' : formData['calcType'] = 'either'
    return formData
}

/**
 * Makes ajax request sending form data
 *
 * @param formData {object} values from form
 * @returns {Promise<any>} ajax response
 */
async function fetchData(formData) {
    let response = await fetch('/newCalculation', {
        method: 'post',
        body: JSON.stringify(formData),
        headers: {
            "Content-Type": "application/json; charset=utf-8",
        }
    })
    return await response.json()
}

/**
 * Calls the ajax request and displays response/error message
 *
 * @param formData {object} values from form
 */
function sendRequest(formData) {
    fetchData(formData).then(function (data) {
        if (data.success) {
            let result = data.result
            document.querySelector('#statusMessage').textContent = 'Successfully logged!'
            document.querySelector('#showResult').textContent = 'The result of your chosen calculation is: ' + result
        } else {
            document.querySelector('#statusMessage').textContent = 'Logging error'
        }
    }).catch(function (err) {
        document.querySelector('#statusMessage').textContent = 'Ajax error: ' + err
    })
}
