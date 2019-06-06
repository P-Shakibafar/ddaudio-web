<template>
    <a href="shop.html" dideo-checked="true" @mouseover="active=true" @mouseleave="active=false">
        <img :src="data.Path" alt="">
        <div class="hover-content" v-if="active">
            <div v-if="relation(data)!==null" class="line"></div>
            <h4 v-text="relation(data)"></h4>
        </div>
    </a>
</template>

<script>
    export default {
        name: "product-header",
        props: {
            data: Object,
        },
        data() {
            return {active: false,}
        },
        methods: {
            relation(relation) {
                if (relation.amplifire_name) {
                    return relation.amplifire_name;
                } else if (relation.speaker_name) {
                    return relation.speaker_name;
                } else if (relation.signal_processor_name) {
                    return relation.signal_processor_name;
                } else if (relation.sub_series_name) {
                    return relation.sub_series_name;
                } else {
                    return null;
                }
            }
        }
    }
</script>

<style scoped>

</style>
