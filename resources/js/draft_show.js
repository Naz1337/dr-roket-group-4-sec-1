import { DateTime } from 'luxon';

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


