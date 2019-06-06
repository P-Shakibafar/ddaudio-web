<template>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12 mt-4">
				
				<!-- USERS LIST -->
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Category List</h3>
						
						<div class="card-tools">
							<span class="badge badge-danger">{{categories.length}} &nbsp; All Categories</span>
							<button type="submit" class="btn btn-success" @click="newModel">
								<i class="fa fa-plus"></i></button>
						</div>
					</div>
					<!-- /.card-header -->
					<div class="card-body p-0">
						<ul class="users-list clearfix">
							<li v-for="category in categories" :key="category.Name">
								<img :src="getCategoryPhoto(category)" alt="Category Icon" style="width: 100px !important;">
								<a class="users-list-name" href="#" dideo-checked="true">{{category.Name}}</a>
								<span class="users-list-date">{{category.created_at | myDate}}</span>
								<span class="users-list-date">
								<a href="#" @click="editModel(category)">
									<i class="fa fa-edit blue"></i></a>
								&nbsp;|&nbsp;
								<a href="#" @click="deleteCategory(category.Name)">
									<i class="fa fa-trash red"></i></a>
									</span>
							</li>
						</ul>
						<!-- /.users-list -->
					</div>
					<!-- /.card-body -->
				</div>
				<!--/.card -->
			
			</div>
		</div>
		<!-- Modal -->
		<div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" v-show="!editmode">Add New</h5>
						<h5 class="modal-title" v-show="editmode">Update Category's Info</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form @submit.prevent="editmode? updateCategory() : createCategory()">
						<div class="modal-body">
							<div class="form-group">
								<input v-model="form.Name" type="text" name="Name"
								       placeholder="Name"
								       class="form-control" :class="{ 'is-invalid': form.errors.has('Name') }">
								<has-error :form="form" field="Name"></has-error>
							</div>
							<div class="form-group">
							<textarea v-model="form.Description" name="Description" id="Description"
							          placeholder="Short Description for category (Optional)"
							          class="form-control" :class="{ 'is-invalid': form.errors.has('Description') }"></textarea>
								<has-error :form="form" field="Description"></has-error>
							</div>
							<div class="form-group">
								<label for="photo" class="col-sm-2 control-label">Icon</label>
								<div class="col-sm-10">
									<input type="file" @change="updateIcon" class="form-input" name="photo">
								</div>
							</div>
							<div class="form-group">
								<label for="photo" class="col-sm-2 control-label">Background</label>
								<div class="col-sm-10">
									<input type="file" @change="updateBack" class="form-input" name="photo">
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
							<button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
							<button v-show="editmode" type="submit" class="btn btn-success">Update</button>
						</div>
					</form>
				
				</div>
			</div>
		</div>
	</div>
</template>

<script>
    export default {
        data() {
            return {
                currentCategory: '',
                editmode: false,
                categories: [],
                form: new Form({
                    Name: '',
                    Description: '',
                    Icon: '',
                    Background: '',
                })
            }
        },
        methods: {
            getCategoryPhoto(category) {
                return "images/category/" + category.Icon;
            },
            loadCategories() {
                axios.get("api/v1/category")
                    .then(({data}) => (this.categories = data.data));
            },
            newModel() {
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');

            },
            editModel(category) {
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.currentCategory = category.Name;
                this.form.fill(category);
            },
            createCategory() {
                this.$Progress.start();
                this.form.post('api/v1/category')
                    .then(() => {
                        Fire.$emit('AfterAction');
                        $('#addNew').modal('hide');
                        toast({
                            type: 'success',
                            title: 'Category Created in successfully'
                        })
                    })
                    .catch(() => {
                        this.$Progress.fail();

                    });
                this.$Progress.finish();
            },
            updateCategory() {
                this.$Progress.start();
                this.form.put('api/v1/category/' + this.currentCategory)
                    .then(() => {
                        $('#addNew').modal('hide');
                        swal(
                            'Updated!',
                            'Information has been updated.',
                            'success'
                        );
                        Fire.$emit('AfterAction');
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    });
                this.$Progress.finish();
            },
            deleteCategory(Name) {
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
                        this.form.delete('api/v1/category/' + Name)
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
            },
            updateIcon(e) {
                let file = e.target.files[0];
                let reader = new FileReader();
                if (file['size'] < 2111775) {
                    reader.onloadend = () => {
                        this.form.Icon = reader.result;
                    };
                    reader.readAsDataURL(file);
                } else {
                    swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'You are uploading a large file.',
                    })
                }
            },
            updateBack(e) {
                let file = e.target.files[0];
                let reader = new FileReader();
                if (file['size'] < 2111775) {
                    reader.onloadend = () => {
                        this.form.Background = reader.result;
                    };
                    reader.readAsDataURL(file);
                } else {
                    swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'You are uploading a large file.',
                    })
                }
            },
        },
        created() {
            this.loadCategories();
            Fire.$on('AfterAction', () => {
                this.loadCategories();
            })
        }
    }
</script>
