import { writable } from "svelte/store";

// status can be success or fail
export const popup_message = writable({
    status: 'success',
    message: ''
})

/**
     * Open a pop-up window with yer message
     * 
     * @param {'success'|'fail'} status 
     * @param {string} message
     */
export function popitup(status, message) {
    // $popup_message = {
    //     status,
    //     message
    // }

    popup_message.update(() => {
        return {status, message}
    })
}