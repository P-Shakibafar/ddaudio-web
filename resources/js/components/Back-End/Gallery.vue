<template>
	
	<div class="card mt-4">
		<div class="card-header">
			<h3 class="card-title">Gallery</h3>
			<vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions"></vue-dropzone>
			<div class="card-tools">
				<span class="badge badge-danger">{{images.total}} Photo</span>
				<button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
				</button>
			</div>
		</div>
		<!-- /.card-header -->
		<div class="card-body p-0">
			<ul class="users-list clearfix">
				<li v-for="image in images.data" :key='image.ID'>
					<img id="photo" :src="image.Path" alt="User Image">
					<a class="users-list-name" href="#" dideo-checked="true">{{image.Name}}</a>
					<span class="users-list-date">{{image.created_at|myDate}}</span>
					<span class="users-list-date">
						<a @click="deletePhoto(image.ID)">
							<i class="fa fa-trash red"></i></a>
					</span>
				</li>
			</ul>
			<!-- /.users-list -->
		</div>
		<!-- /.card-body -->
		<div class="card-footer text-center">
			<pagination class="justify-content-center" :data="images" @pagination-change-page="getResults"></pagination>
		</div>
		<!-- /.card-footer -->
	</div>

</template>

<script>
    export default {
        data() {
            return {
                images: [],
                dropzoneOptions: {
                    url: 'http://localhost:8000/api/v1/Images',
                    thumbnailWidth: 200, // px
                    thumbnailHeight: 200,
                    addRemoveLinks: true,
                    maxFilesize: 2, // MB
                    acceptedFiles: '.jpg,.jpeg,.png,.bmp',
                },
                form: new Form(),
            }
        },
        methods: {
            getResults(page = 1) {
                axios.get('api/v1/Images?page=' + page)
                    .then(response => {
                        this.images = response.data;
                    });
            },
            loadImages() {
                axios.get('api/v1/Images')
                    .then(
                        ({data}) => (this.images = data),
                    );
            },
            deletePhoto(photoID) {
                swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    //Send request to the server
                    if (result.value) {
                        this.form.delete('api/v1/Images/' + photoID)
                            .then(() => {
                                swal(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                );
                                Fire.$emit('AfterAction');
                            })
                            .catch(() => {
                                swal("Failed!", "There was something wronge.", "warning");
                            });
                    }
                });
            }

        },
        created() {
            this.loadImages();
            Fire.$on('AfterAction', () => {
                this.loadImages();
            });

        }
    }
</script>
<style>
	#photo {
		border-radius : 5px !important;
		width         : 15rem !important;
		height        : 15rem !important;
	}
</style>