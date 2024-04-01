<script>

    import { popup_message } from "./popup_store";

    let open_popup = false
    let first = true

    function on_change_popupmessage(popup_message) {
        if (first) {
            first = !first
            return
        }
        console.log(popup_message);
        open_popup = true
    }

    $: on_change_popupmessage($popup_message)

    function close_popup() {
        open_popup = false
    }

</script>

<div class="w-screen flex justify-center fixed top-9 transition-all duration-150 ease-in" class:hiding={!open_popup} class:ease-out={open_popup}>
    <div class="text-background w-96 flex items-start rounded-md p-3 justify-between overflow-hidden" class:bg-green-500={$popup_message.status === 'success'} class:bg-red-600={$popup_message.status === 'fail'}>
        <div class="w-72 self-center">
            {$popup_message.message}
        </div>
        <button class="font-mono hover:cursor-pointer p-2" on:click={close_popup}> X </button>
    </div>
</div>

<style>
    .hiding {
        translate: 0px -100px;
    }
</style>