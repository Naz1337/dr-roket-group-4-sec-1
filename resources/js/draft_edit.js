import '../scss/drop_area.scss';

import './drop_area.js'
import {DateTime} from 'luxon';

const formEl = document.getElementById('formReset');
const originalMessage = document.getElementById('dropArea').textContent;
formEl.addEventListener('click', function() {
    document.getElementById('dropArea').textContent = originalMessage;
    document.getElementById('dropArea').classList.remove('drag-drop-area-valid');
    document.getElementById('dropArea').classList.remove('drag-drop-area-invalid');
    document.getElementById('draftFile').reset();
})

const draftDateEl = document.getElementById('draftDate');
const daysTakenEl = document.getElementById('daysTaken');
draftDateEl.addEventListener('change', function(event) {
    // get the value of the current element
    const draftDate = draftDateEl.value;
    let currentDate = DateTime.fromISO(draftDate);

    // if the currentDate is sunday, then minus it by one and set the current
    // value of the draftDateEl and the currentDate to the new date.
    if (currentDate.weekday === 7) {
        const newDate = currentDate.minus({days: 1})
        draftDateEl.value = newDate.toISODate();
        currentDate = newDate;
    }

    // get the min from the element
    const min = draftDateEl.min;
    if (min === '') {
        return;
    }

    // using luxon, convert the min and the current date to DateTime object
    // and use for loop to count the amount of days between the two dates
    // but do not count for when the current day is sunday.
    const minDate = DateTime.fromISO(min);

    let days = 0;
    for (let i = minDate; i < currentDate; i = i.plus({days: 1})) {
        if (i.weekday !== 7) {
            days++;
        }
    }

    daysTakenEl.value = days;

})

// now, we need to do it to daysTakenEl. When the value of that element changed
// the draftDateEl value should change to reflect it. we also need to remember
// that we skip the date that is sunday. when date of sunday is found, we increment
// that date by 1.
daysTakenEl.addEventListener('change', function(event) {
    // get the value of the current element
    const daysTaken = daysTakenEl.value;
    // get the date of the min from the draftDateEl in the form of DateTime
    const min = draftDateEl.min;
    if (min === '') {
        return;
    }

    // using for loop, loop for the amount of daysTaken and increment the date
    // by 1. if the date is sunday, increment it by 1 again.
    let currentDate = DateTime.fromISO(min);
    for (let i = 0; i < daysTaken; i++) {
        currentDate = currentDate.plus({days: 1});
        if (currentDate.weekday === 7) {
            currentDate = currentDate.plus({days: 1});
        }
    }

    // set the value of the draftDateEl to the currentDate
    draftDateEl.value = currentDate.toISODate();

})

