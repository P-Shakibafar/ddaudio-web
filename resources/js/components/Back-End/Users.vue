<template>
	<div class="container">
		<div class="row mt-5">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Users Table</h3>
						
						<div class="card-tools" style="right:-5rem">
							<div class="input-group input-group-sm" style="width: 150px;">
							</div>
							<button type="submit" class="btn btn-success" @click="newModel">
								<i class="fa fa-user-plus"></i></button>
						</div>
					</div>
					<!-- /.card-header -->
					<div class="card-body table-responsive p-0">
						<table class="table table-hover">
							<tbody>
							<tr>
								<th>Photo</th>
								<th>Name</th>
								<th>Email</th>
								<th>Type</th>
								<th>Registered At</th>
								<th>Modify</th>
							</tr>
							<tr v-for="user in users.data" :key="user.id">
								<td>
									<img :src="getProfilePhoto(user)" alt="User Profile" class="direct-chat-img">
								</td>
								<td>{{user.name}}</td>
								<td>{{user.email}}</td>
								<td>{{user.type | upText}}</td>
								<td>{{user.created_at | myDate}}</td>
								
								<td>
									<a @click="editModel(user)">
										<i class="fa fa-edit blue"></i></a>
									/
									<a @click="deleteUser(user.id)">
										<i class="fa fa-trash red"></i></a>
								</td>
							</tr>
							</tbody>
						</table>
					</div>
					<!-- /.card-body -->
					
				</div>
				<!-- /.card -->
			</div>
		</div>
		<!-- Modal -->
		<div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" v-show="!editmode">Add New</h5>
						<h5 class="modal-title" v-show="editmode">Update User's Info</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form @submit.prevent="editmode? updateUser() : createUser()">
						<div class="modal-body">
							<div class="form-group">
								<input v-model="form.name" type="text" name="name"
								       placeholder="Name"
								       class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
								<has-error :form="form" field="name"></has-error>
							</div>
							<div class="form-group">
								<input v-model="form.email" type="email" name="email"
								       placeholder="Email"
								       class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
								<has-error :form="form" field="email"></has-error>
							</div>
							<div class="form-group">
							<textarea v-model="form.bio" name="bio" id="bio"
							          placeholder="Short bio for user (Optional)"
							          class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }"></textarea>
								<has-error :form="form" field="bio"></has-error>
							</div>
							<div class="form-group">
								<select v-model="form.type" name="type" id="type" class="form-control"
								        :class="{ 'is-invalid': form.errors.has('type') }">
									<option value="">Select User Role</option>
									<option value="admin">Admin</option>
									<option value="user">Standard User</option>
									<option value="author">Author</option>
								</select>
								<has-error :form="form" field="bio"></has-error>
							</div>
							<div class="form-group">
								<input v-model="form.password" type="password" name="password" id="password"
								       placeholder="Password"
								       class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
								<has-error :form="form" field="password"></has-error>
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
                editmode: false,
                users: [],
                form: new Form({
                    id: '',
                    name: '',
                    email: '',
                    password: '',
                    type: '',
                    bio: '',
                    photo: ''
                })
            }
        },
        methods: {
            getProfilePhoto(user) {
                return "images/profile/" + user.photo;
            },
            getResults(page = 1) {
                axios.get('api/v1/user?page=' + page)
                    .then(response => {
                        this.users = response.data;
                    });
            },
            editModel(user) {
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(user);
            },
            newModel() {
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');

            },
            loadUsers() {
                axios.get("api/v1/user").then(({data}) => (this.users = data));
            },
            createUser() {
                this.$Progress.start();
                this.form.post('api/v1/user')
                    .then(() => {
                        Fire.$emit('AfterAction');
                        $('#addNew').modal('hide');
                        toast({
                            type: 'success',
                            title: 'User Created in successfully'
                        });
                    })
                    .catch(() => {

                    });
                this.$Progress.finish();

            },
            updateUser() {
                this.$Progress.start();
                this.form.put('api/v1/user/' + this.form.id)
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
            },
            deleteUser(id) {
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
                        this.form.delete('api/v1/user/' + id)
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

        },
        created() {
            Fire.$on('searching', () => {
                let query = this.$parent.search;
                axios.get('api/v1/findUser?q=' + query)
                    .then((data) => {
                        this.users = data.data
                    })
                    .catch(() => {

                    })
            });
            this.loadUsers();
            Fire.$on('AfterAction', () => {
                this.loadUsers();
            })
        }
    }
</script>
