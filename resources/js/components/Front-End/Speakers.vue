<template>
	<products :productName="'Speakers'"></products>
</template>

<script>
    import Products from './Products'

    export default {
        components: {
            products: Products,
        },
    }
</script>

<style scoped>

</style>
