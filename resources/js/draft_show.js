import { DateTime } from 'luxon';
import { Tooltip } from "bootstrap";

const createdAtEl = document.querySelector('#createdAt');
const createdAt = DateTime.fromMillis(
    parseInt(
        createdAtEl.dataset['time']
    ), {
        zone: 'utc'
    });

const localCreatedAt = createdAt.setZone(DateTime.local().zoneName);
const formattedDate = localCreatedAt.toFormat('cccc, d LLLL yyyy, hh:mm a')

createdAtEl.value = formattedDate;

document.querySelector('#removeBtn').addEventListener('click', (e) => {
    document.querySelector('#deleteForm').submit();
})

const tooltipTriggerList = document.querySelectorAll('[data-bs-toggler="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new Tooltip(tooltipTriggerEl))
window.tooltipList = tooltipList
