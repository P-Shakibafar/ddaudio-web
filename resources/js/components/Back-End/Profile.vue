<style>
    .widget-user-header {
        background : url("../../../../public/img/profile-back.png") center center;
    }
    
    .widget-user .widget-user-header {
        height : 230px;
    }
</style>

<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-3">
                
                <div class="card card-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header text-white">
                        <h3 class="widget-user-username">{{form.name|upText}}</h3>
                        <h5 class="widget-user-desc">{{form.bio}}</h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle" :src="getProfilePhoto()" alt="User Avatar">
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">3,200</h5>
                                    <span class="description-text">SALES</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">13,000</h5>
                                    <span class="description-text">FOLLOWERS</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">35</h5>
                                    <span class="description-text">PRODUCTS</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div><!-- Widget: user widget style 1 -->
                
                <!-- /.widget-user -->
                
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab"
                                                    dideo-checked="true">Activity</a>
                            </li>
                            <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab"
                                                    dideo-checked="true">Settings</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane" id="activity">
                            </div>
                            
                            <div class="active tab-pane" id="settings">
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">Name</label>
                                        
                                        <div class="col-sm-10">
                                            <input type="email" v-model="form.name" class="form-control" id="inputName" placeholder="Name"
                                                   :class="{ 'is-invalid': form.errors.has('name') }">
                                            <has-error :form="form" field="name"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                                        
                                        <div class="col-sm-10">
                                            <input type="email" v-model="form.email" class="form-control" id="inputEmail" placeholder="Email"
                                                   :class="{ 'is-invalid': form.errors.has('email') }">
                                            <has-error :form="form" field="email"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputExperience" class="col-sm-2 control-label">Experience</label>
                                        
                                        <div class="col-sm-10">
											<textarea class="form-control" v-model="form.bio" id="inputExperience"
                                placeholder="Experience" :class="{ 'is-invalid': form.errors.has('bio') }"></textarea>
                                            <has-error :form="form" field="bio"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="photo" class="col-sm-2 control-label">Profile Photo</label>
                                        <div class="col-sm-10">
                                            <input type="file" @change="updateProfile" class="form-input" name="photo">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassport" class="col-sm-6 control-label">Passport (level empty if not
                                            changing)</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" v-model="form.password" id="inputPassport"
                                                   placeholder="Passport" :class="{ 'is-invalid': form.errors.has('password') }">
                                            <has-error :form="form" field="password"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" @click.prevent="updateInfo" class="btn btn-success">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
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
            getProfilePhoto() {
                return (this.form.photo.length > 200) ? this.form.photo : "images/profile/" + this.form.photo;
            },
            updateInfo() {
                this.$Progress.start();
                if (this.form.password === '') {
                    this.form.password = undefined;
                }
                this.form.put('api/v1/profile')
                    .then(() => {
                        Fire.$emit('AfterAction');
                        this.$Progress.finish();

                    })
                    .catch(() => {
                        this.$Progress.fail();

                    })

            },
            updateProfile(e) {
                // console.log('uploading profile');
                let file = e.target.files[0];
                let reader = new FileReader();
                if (file['size'] < 2111775) {

                    reader.onloadend = (file) => {
                        // console.log('RESULT', reader.result)
                        this.form.photo = reader.result;
                    };
                    reader.readAsDataURL(file);
                } else {
                    swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'You are uploading a large file.',
                    })
                }
            }
        },
        created() {
            axios.get("api/v1/profile")
                .then(({data}) => (this.form.fill(data)));
        }
    }
</script>
