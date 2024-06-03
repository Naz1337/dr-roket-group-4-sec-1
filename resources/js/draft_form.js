import '../scss/draft_create.scss'

/**
 * Counts the number of Sundays between two dates.
 *
 * @param {number} date_one - The first date (higher date) in milliseconds.
 * @param {number} date_two - The second date (lower date) in milliseconds.
 * @returns {number} The number of Sundays between the two dates.
 */
function countSundays(date_one, date_two) {
    const prePlusOne = new Date(date_one)
    // prePlusOne.setDate(prePlusOne.getDate() + 1)
    const date_one_value = prePlusOne.valueOf()
    const date_two_value = date_two

    let counter=  0
    const period_in_day = getDays(date_one_value - date_two_value);
    for (let i = 0; i <= period_in_day; i++) {
        const originDate = new Date(date_two_value);
        originDate.setDate(originDate.getDate() + i);
        if (originDate.getDay() === 0) {
            counter++
        }
    }
    return counter;
}

function getDate(date) {
    if (!date) {
        date = new Date()
    }
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0'); // Months are zero-based
    const day = String(date.getDate()).padStart(2, '0');
    return `${year}-${month}-${day}`;
}

const draft_date = document.querySelector('#draftCompletionDate');
let currentDate = getDate();

const currentDateObj = new Date(currentDate);
if (currentDateObj.getDay() === 0) {
    // if current day is sunday
    currentDateObj.setDate(currentDateObj.getDate() - 1);
    currentDate = getDate(currentDateObj);
}

draft_date.value = currentDate;
draft_date.max = currentDate;

let previousDate;
if (draft_date.dataset['previousCompletionDate'].length !== 0) {
    previousDate = new Date(draft_date.dataset['previousCompletionDate'])
}
else {
    previousDate = new Date(0);
}

draft_date.min = getDate(previousDate);

function getDays(milliseconds) {
    const seconds = milliseconds / 1000;
    const minutes = seconds / 60
    const hours = minutes / 60;
    return Math.floor(hours / 24)
}

draft_date.addEventListener('change', function(event) {
    const inputDate = new Date(event.target.value);
    if (inputDate.getDay() === 0) {
        // it is sunday
        inputDate.setDate(inputDate.getDate() - 1);
        event.target.value = getDate(inputDate);
    }

    if (previousDate.valueOf() === 0) {
        return
    }

    document.getElementById('daysTaken').value =
        getDays(inputDate.valueOf() - previousDate.valueOf())
        - countSundays(inputDate.valueOf(), previousDate.valueOf());
})

draft_date.dispatchEvent(new Event('change'));

const completionDayEl = document.getElementById('daysTaken');
completionDayEl.addEventListener('change', function(event) {
    if (previousDate.valueOf() === 0) {
        return
    }

    const current_value = parseInt(event.target.value)
    const copyPreviousDate = new Date(previousDate.valueOf());
    for (let i = 0; i < current_value; i++) {
        copyPreviousDate.setDate(copyPreviousDate.getDate() + 1);
        if (copyPreviousDate.getDay() === 0) {
            copyPreviousDate.setDate(copyPreviousDate.getDate() + 1);
        }
    }

    draft_date.value = getDate(copyPreviousDate);
})

completionDayEl.max = getDays((new Date(currentDate)).valueOf() - previousDate.valueOf())
    - countSundays(currentDateObj.valueOf(), previousDate.valueOf());

window.countSundays = countSundays

// START: code for drag and drop
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

// END

const form = document.forms[0];
form.addEventListener('submit', function(event) {
    event.preventDefault();

    const draftFileInputEl = document.getElementById('draftFile');
    const dropAreaEl = document.getElementById('dropArea')
    if (draftFileInputEl.files.length === 0 ||
        dropAreaEl.classList.contains('drag-drop-area-invalid') ||
        dropAreaEl.innerText.includes('Drag and drop')
        ) {
        document.getElementById('dropArea').classList.add('drag-drop-area-invalid');
        return;
    }

    this.submit();
})
