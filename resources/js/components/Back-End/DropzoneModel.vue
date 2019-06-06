<template>
	<div class="modal fade" id="uploadPhotos" tabindex="-1" role="dialog"
	     aria-labelledby="addNewLabel"
	     aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Upload Photos</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="p-3">
					<vue-dropzone ref="vueDropzone" id="dropzone" :options="dropzoneOptions"
					              @vdropzone-processing="dropzoneChangeUrl"></vue-dropzone>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
    export default {
        props: {
            productName: String,
        },
        data() {
            return {
                dropzoneOptions: {
                    url: 'url',
                    thumbnailWidth: 200, // px
                    thumbnailHeight: 200,
                    addRemoveLinks: true,
                    maxFilesize: 2, // MB
                    acceptedFiles: '.jpgm,.jpeg,.png,.bmp',
                    // maxFiles: 5, // count file upload
                },
            }
        },
        methods: {
            dropzoneChangeUrl() {
                this.$refs.vueDropzone.setOption('url', `http://localhost:8000/api/v1/addPhotos${this.productName}/${this.$parent.$parent.cProduct}`);
            },
        },
        watch: {
            cProduct: function () {
                $(window).on('hidden.bs.modal', () => {
                    this.$parent.$parent.cProduct = '';
                });
            },
        },
    }
</script>

<style scoped>

</style>