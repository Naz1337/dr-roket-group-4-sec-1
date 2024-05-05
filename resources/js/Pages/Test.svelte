<script>
	import Popup from '../Popup.svelte'
	import { popitup } from "../popup_store";

    export let test;
	export let test2;

	setTimeout(() => {
		popitup('success', 'lol')
	}, 4000)

	function ya() {
		popitup('success', 'ya yeet')
	}
</script>

<main>
	<Popup />
    <div>{test.toUpperCase()} {test2.toLowerCase()}</div>
    <p>This is a paragraph.</p>

	<button on:click={ya}>give noty</button>
</main>



<style>
	p {
		color: goldenrod;
		font-family: 'Comic Sans MS', cursive;
		font-size: 2em;
	}
</style>
