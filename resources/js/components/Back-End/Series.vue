<template>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-12 mt-4">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">{{productName}} Series Table</h3>
						<div class="card-tools">
							<span class="badge badge-danger">{{Object.keys(this.series).length}}&nbsp;All&nbsp;{{productName}}&nbsp;Series</span>
							<button type="submit" class="btn btn-sm btn-success" @click="newModal">
								Add New Series&nbsp;<i class="fa fa-plus"></i></button>
						</div>
					</div>
					<!-- /.card-header -->
					<div class="card-body table-responsive p-2" v-if="(productName==='Subwoofers'||productName==='Enclosures')">
						<div class="card card-primary card-outline" v-for="s in series" :key="s.Name">
							<div class="card-header">
								<h4 class="card-title">{{s.Name}}
									<a class="btn btn-sm" @click="editModel(s)">
										<i class="fa fa-edit blue"></i></a>
									|
									<a class="btn btn-sm" @click="deleteSeries(s.Name)">
										<i class="fa fa-trash red"></i></a>
								</h4>
								<div class="card-tools">
									<button type="submit" class="btn btn-sm btn-success"
									        @click="newSubModal(s)">
										Add New Sub&nbsp;<i class="fa fa-plus"></i></button>
								</div>
							</div>
							<div class="card-body">
								<p class="card-text">
									{{s.Description}}
								</p>
								<div class="card-body table-responsive p-2">
									<div class="card card-primary card-outline" v-for="sub in subSeries" :key="sub.Name"
									     v-if="sub.series_name===s.Name">
										<div class="card-header">
											<span v-for="image in sub.images.slice(0,1)">
												<img :src="getProductPhoto(image)" alt="Product Icon" style="width: 50px !important;">
											</span>
											<h4 class="card-title list-inline-item">{{sub.Name}}
												<a class="btn btn-sm" @click="editSubModal(sub)">
													<i class="fa fa-edit blue"></i></a>
												|
												<a class="btn btn-sm" @click="deleteSubSeries(sub.Name)">
													<i class="fa fa-trash red"></i></a>
												&nbsp;|&nbsp;
												<a class="btn btn-sm" @click="uploadPhotoModal(sub.Name)">
													<i class="fa fa-upload green"></i></a>
											</h4>
											<div class="card-tools">
												<button type="submit" class="btn btn-sm btn-success"
												        @click="getNewProduct(sub.Name)">
													Add New Product&nbsp;<i class="fa fa-plus"></i></button>
											</div>
										</div>
										<div class="card-body">
											<p class="card-text">
												{{sub.Description}}
											</p>
											<products :seriesName=sub.Name :productName=productName :productForm=getProductForm()></products>
										</div>
									</div><!-- /.card -->
								</div>
							</div>
						</div><!-- /.card -->
					</div>
					<div class="card-body table-responsive p-2" v-else>
						<div class="card card-primary card-outline" v-for="s in series" :key="s.Name">
							<div class="card-header">
								<h4 class="card-title">{{s.Name}}
									<a class="btn btn-sm" @click="editModel(s)">
										<i class="fa fa-edit blue"></i></a>
									|
									<a class="btn btn-sm" @click="deleteSeries(s.Name)">
										<i class="fa fa-trash red"></i></a>
								</h4>
								<div class="card-tools">
									<button type="submit" class="btn btn-sm btn-success"
									        @click="getNewProduct(s.Name)">
										Add New Product&nbsp;<i class="fa fa-plus"></i></button>
								</div>
							</div>
							<div class="card-body">
								<p class="card-text">
									{{s.Description}}
								</p>
								<products :seriesName=s.Name :productName=productName :productForm=getProductForm()></products>
							</div>
						</div><!-- /.card -->
					</div>
				</div>
				<!-- /.card -->
			</div>
		</div>
		<!-- Series Modal -->
		<div class="modal fade" id="addNewSeries" tabindex="-1" role="dialog" aria-labelledby="addNewLabel"
		     aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" v-show="!editmode">Add New</h5>
						<h5 class="modal-title" v-show="editmode">Update Series's Info</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form @submit.prevent="editmode? updateSeries() : createSeries()">
						<div class="modal-body">
							<div class="form-group">
								<input v-model="form.Name" type="text" name="Name"
								       placeholder="Name"
								       class="form-control" :class="{ 'is-invalid': form.errors.has('Name') }">
								<has-error :form="form" field="Name"></has-error>
							</div>
							<div class="form-group">
							<textarea v-model="form.Description" name="Description"
							          placeholder="Short Description for series (Optional)"
							          class="form-control" :class="{ 'is-invalid': form.errors.has('Description') }"></textarea>
								<has-error :form="form" field="Description"></has-error>
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
		<!-- Sub Series Modal -->
		<div class="modal fade" id="addNewSub" tabindex="-1" role="dialog" aria-labelledby="addNewLabel"
		     aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" v-show="!editmode">Add New</h5>
						<h5 class="modal-title" v-show="editmode">Update Sub Series's Info</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form @submit.prevent="editmode? updateSubSeries() : createSubSeries()">
						<div class="modal-body">
							<div class="form-group">
								<input v-model="subForm.Name" type="text" name="Name"
								       placeholder="Name"
								       class="form-control" :class="{ 'is-invalid': subForm.errors.has('Name') }">
								<has-error :form="subForm" field="Name"></has-error>
							</div>
							<div class="form-group">
								<input v-model="subForm.Title" type="text" name="Title"
								       placeholder="Title"
								       class="form-control" :class="{ 'is-invalid': subForm.errors.has('Title') }">
								<has-error :form="subForm" field="Title"></has-error>
							</div>
							<div class="form-group">
							<textarea v-model="subForm.Description" name="Description"
							          placeholder="Short Description for series (Optional)"
							          class="form-control" :class="{ 'is-invalid': subForm.errors.has('Description') }"></textarea>
								<has-error :form="subForm" field="Description"></has-error>
							</div>
							<div class="form-group">
							<textarea v-model="subForm.Features" name="Features"
							          placeholder="Short Features for series (Optional)"
							          class="form-control" :class="{ 'is-invalid': subForm.errors.has('Features') }"></textarea>
								<has-error :form="subForm" field="Features"></has-error>
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
	import Products from './Products';
    export default {
        components:{
          products:Products
        },
        props: {productName: String},
        data() {
            return {
                editmode: false,
                series: [],
                subSeries: [],
                currentSeries: '',
                currentSub: '',
                seriesName: '',
                form: new Form({
                    Name: '',
                    Description: '',
                    product_name: this.productName,
                }),
                subForm: new Form({
                    Name: '',
                    Title: '',
                    Description: '',
                    Features: '',
                    series_name: '',
                }),
                amplifires: new Form({
                    Name: '',
                    Title: '',
                    Description: '',
                    Test_Voltage: '',
                    Channels: '',
                    Cont_Wattage_4ohm: '',
                    Cont_Wattage_2ohm: '',
                    Cont_Wattage_1ohm: '',
                    Dynamic_Wattage: '',
                    Max_Current_Draw_Amperage: '',
                    S_N_Ratio: '',
                    THD: '',
                    Input_Voltage_Sensitivity: '',
                    Pass_Through_Output: '',
                    Remote_Subwoofer_Control: '',
                    Power_Wire_Guage_In: '',
                    Speaker_Wire_Gauge_Out: '',
                    Dimensions_in: '',
                    Dimensions_mm: '',
                    Shipping_Weight_lbs: '',
                    series_name: '',
                }),
                enclosures: new Form({
                    Model: '',
                    Driver_Size: '',
                    Watts_RMS: '',
                    VCD: '',
                    Impedance: '',
                    Dimensions_in: '',
                    Dimensions_mm: '',
                    Shipping_Weight_lbs: '',
                    sub_series_name: '',
                }),
                signalProcessores: new Form({
                    Name: '',
                    Title: '',
                    Description: '',
                    Channels: '',
                    Input_Voltage_Sensitivity: '',
                    Input_Channels: '',
                    Output_Channels: '',
                    Output_Voltage: '',
                    Dimensions_in: '',
                    Dimensions_mm: '',
                    Shipping_Weight_lbs: '',
                    series_name: '',
                }),
                speakers: new Form({
                    Name: '',
                    Title: '',
                    Description: '',
                    Watts_RMS: '',
                    VCD: '',
                    Impedance: '',
                    Frequency_Response_Hz: '',
                    dBSPL: '',
                    Mounting_Diameter_in: '',
                    Mounting_Depth_in: '',
                    Shipping_Weight_lbs: '',
                    Driver_Size: '',
                    Fs_Hz: '',
                    Qms: '',
                    Qes: '',
                    Qts: '',
                    Vas_liters: '',
                    Dimensions_in: '',
                    Dimensions_mm: '',
                    series_name: '',
                    sub_speaker: Object,
                }),
                subwoofers: new Form({
                    Model: '',
                    Driver_Size: '',
                    Watts_RMS: '',
                    Peak_Power: '',
                    VCD: '',
                    Impedance: '',
                    Piston_Dia_in: '',
                    Fs_Hz: '',
                    Qms: '',
                    Qes: '',
                    Qts: '',
                    Vas_liters: '',
                    Xmech_mm: '',
                    Xmax_mm: '',
                    Frame_OD_in: '',
                    Frame_OD_w_Gasket_in: '',
                    Mounting_Diameter_in: '',
                    Mounting_Depth_in: '',
                    Motor_Diameter_in: '',
                    Motor_Depth_in: '',
                    Woofer_Displacement_cu_ft: '',
                    Shipping_Weight_lbs: '',
                    Sealed_Enclosure_cu_ft: '',
                    Ported_Enclosure_cu_ft: '',
                    sub_series_name: '',
                }),
            }
        },
        watch: {
            seriesName: function () {
                this.subForm.series_name = this.seriesName;
            },
        },
        methods: {
            getProductPhoto(image) {
                return image.Path;
            },
            // :: Series Methods ::
            loadSeries() {
                axios.get("api/v1/indexOfSeries/" + this.productName)
                    .then(({data}) => (this.series = data));
            },
            newModal() {
                this.editmode = false;
                this.form.reset();
                $('#addNewSeries').modal('show');
            },
            editModel(series) {
                this.editmode = true;
                this.form.reset();
                $('#addNewSeries').modal('show');
                this.currentSeries = series.Name;
                this.form.fill(series);

            },
            createSeries() {
                this.$Progress.start();
                this.form.post('api/v1/series')
                    .then(() => {
                        Fire.$emit('AfterAction');
                        $('#addNewSeries').modal('hide');
                        toast({
                            type: 'success',
                            title: 'Series Created in successfully'
                        })
                    })
                    .catch(() => {
                        this.$Progress.fail();

                    });
                this.$Progress.finish();
            },
            updateSeries() {
                this.$Progress.start();
                this.form.put('api/v1/series/' + this.currentSeries)
                    .then(() => {
                        $('#addNewSeries').modal('hide');
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
            deleteSeries(Name) {
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
                        this.form.delete('api/v1/series/' + Name)
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
            // :: Sub Series Methods ::
            loadsubSeries() {
                axios.get("api/v1/SubSeries")
                    .then(({data}) => (this.subSeries = data));
            },
            newSubModal(series) {
                this.editmode = false;
                this.subForm.reset();
                this.seriesName = series.Name;
                $('#addNewSub').modal('show');
            },
            editSubModal(sub) {
                this.editmode = true;
                this.subForm.reset();
                $('#addNewSub').modal('show');
                this.currentSub = sub.Name;
                this.subForm.fill(sub);
            },
            createSubSeries() {
                this.$Progress.start();
                this.subForm.post('api/v1/SubSeries')
                    .then(() => {
                        Fire.$emit('AfterAction');
                        $('#addNewSub').modal('hide');
                        toast({
                            type: 'success',
                            title: 'Sub Series Created in successfully'
                        })
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    });
                this.$Progress.finish();
            },
            updateSubSeries() {
                this.$Progress.start();
                this.subForm.put('api/v1/SubSeries/' + this.currentSub)
                    .then(() => {
                        $('#addNewSub').modal('hide');
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
            deleteSubSeries(subName) {
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
                        this.subForm.delete('api/v1/SubSeries/' + subName)
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
            // :: Products Methods ::
            getNewProduct(seriesName) {
                Fire.$emit('CreateProduct', seriesName);
            },
            getProductForm() {
                switch (this.productName) {
                    case 'Amplifiers':
                        return this.amplifires;
                    case 'Enclosures':
                        return this.enclosures;
                    case 'Signal_Processors':
                        return this.signalProcessores;
                    case 'Speakers':
                        return this.speakers;
                    case 'Subwoofers':
                        return this.subwoofers;
                }
            },
            // :: Upload Photo By Product ::
            uploadPhotoModal(seriesName) {
                Fire.$emit('UploadPhoto', seriesName);
            }
        },
        created() {
            this.loadSeries();
            this.loadsubSeries();
            Fire.$on('AfterAction', () => {
                this.loadSeries();
                this.loadsubSeries();
            })
        }
    }
</script>
