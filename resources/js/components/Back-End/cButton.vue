<template>
	<div>
		<button type="button" class="btn btn-tool" v-on:click="title=!title" data-widget="collapse">
			<span v-show="!title">Hide Products <i class="fa fa-angle-up "></i></span>
			<span v-show="title">Show Products <i class="fa fa-angle-down "></i></span>
		</button>
	</div>
</template>

<script>
    export default {
        data() {
            return {
                title: true,
            }
        },

    }
</script>
