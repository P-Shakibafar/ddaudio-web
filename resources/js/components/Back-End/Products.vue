<template>
	<div class="card card-outline card-success collapsed-card">
		<cButton></cButton>
		<div class="card-body">
			<!-- /.row -->
			<table class="table table-hover" v-if="productName==='Subwoofers'||productName==='Enclosures'">
				<tbody>
				<tr>
					<th>Model</th>
					<th>Driver Size</th>
					<th>Registered At</th>
					<th>Modify</th>
				</tr>
				<tr v-for="product in products" :key="product.Model">
					<td>{{product.Model}}</td>
					<td>{{product.Driver_Size}}</td>
					<td>{{product.created_at | myDate}}</td>
					
					<td>
						<a id="Edit" @click="getEditModel(product)">
							<i class="fa fa-edit blue"></i></a>
						|
						<a @click="deleteProduct(product.Model)">
							<i class="fa fa-trash red"></i></a>
					</td>
				</tr>
				</tbody>
			</table>
			<ul class="users-list clearfix" v-else>
				<li v-for="product in products" :key="product.Name">
					<span v-for="image in product.images.slice(0,1)">
					<img :src="getProductPhoto(image)" alt="Product Icon"
					     style="width: 100px !important;">
					</span>
					<a class="users-list-name" dideo-checked="true">{{product.Name}}</a>
					<span class="users-list-date">{{product.Title | upText}}</span>
					<span class="users-list-date">{{product.created_at | myDate}}</span>
					<span class="users-list-date">
						<a @click="getEditModel(product)">
							<i class="fa fa-edit blue"></i></a>
						&nbsp;|&nbsp;
						<a @click="deleteProduct(product.Name)">
							<i class="fa fa-trash red"></i></a>
						&nbsp;|&nbsp;
						<a @click="uploadPhotoModal(product.Name)">
							<i class="fa fa-upload green"></i></a>
					</span>
				</li>
			</ul>
		</div>
		<!-- /.card-body -->
		<!-- Amplifire Modal -->
		<div class="modal fade" v-if="productName==='Amplifiers'" id="addNewAmplifires" tabindex="-1" role="dialog"
		     aria-labelledby="addNewLabel"
		     aria-hidden="true">
			<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="AmplifireTitle"></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form @submit.prevent="$parent.productEditMode?updateProduct():createProduct()">
						<div class="modal-body">
							<div class="row">
								<div class="form-group pl-3">
									<input v-model="form.Name" type="text" name="Name"
									       placeholder="Name"
									       class="form-control" :class="{ 'is-invalid': form.errors.has('Name') }">
									<has-error :form="form" field="Name"></has-error>
								</div>
								<div class="form-group pl-5 pr-5">
									<input v-model="form.Title" type="text" name="Title"
									       placeholder="Title"
									       class="form-control" :class="{ 'is-invalid': form.errors.has('Title') }">
									<has-error :form="form" field="Title"></has-error>
								</div>
								<div class="form-group pl-1">
									<input v-model="form.Test_Voltage" type="text" name="Test_Voltage"
									       placeholder="Test Voltage"
									       class="form-control" :class="{ 'is-invalid': form.errors.has('Test_Voltage') }">
									<has-error :form="form" field="Test_Voltage"></has-error>
								</div>
							</div>
							<div class="form-group">
							<textarea v-model="form.Description" name="Description"
							          placeholder="Short Description for product (Optional)"
							          class="form-control"
							          :class="{ 'is-invalid': form.errors.has('Description') }"></textarea>
								<has-error :form="form" field="Description"></has-error>
							</div>
							<div class="row">
								<div class="form-group pl-3">
									<input v-model="form.Channels" type="text" name="Channels"
									       placeholder="Channels"
									       class="form-control" :class="{ 'is-invalid': form.errors.has('Channels') }">
									<has-error :form="form" field="Channels"></has-error>
								</div>
								<div class="form-group pl-5 pr-5">
									<input v-model="form.Cont_Wattage_4ohm" type="text" name="Cont_Wattage_4ohm"
									       placeholder="Cont Wattage @ 4ohm"
									       class="form-control" :class="{ 'is-invalid': form.errors.has('Cont_Wattage_4ohm') }">
									<has-error :form="form" field="Cont_Wattage_4ohm"></has-error>
								</div>
								<div class="form-group pl-1">
									<input v-model="form.Cont_Wattage_2ohm" type="text" name="Cont_Wattage_2ohm"
									       placeholder="Cont Wattage @ 2ohm"
									       class="form-control" :class="{ 'is-invalid': form.errors.has('Cont_Wattage_2ohm') }">
									<has-error :form="form" field="Cont_Wattage_2ohm"></has-error>
								</div>
							</div>
							<div class="row">
								<div class="form-group pl-3">
									<input v-model="form.Cont_Wattage_1ohm" type="text" name="Cont_Wattage_1ohm"
									       placeholder="Cont Wattage @ 1ohm"
									       class="form-control" :class="{ 'is-invalid': form.errors.has('Cont_Wattage_1ohm') }">
									<has-error :form="form" field="Cont_Wattage_1ohm"></has-error>
								</div>
								<div class="form-group pl-5 pr-5">
									<input v-model="form.Dynamic_Wattage" type="text" name="Dynamic_Wattage"
									       placeholder="Dynamic Wattage"
									       class="form-control" :class="{ 'is-invalid': form.errors.has('Dynamic_Wattage') }">
									<has-error :form="form" field="Dynamic_Wattage"></has-error>
								</div>
								<div class="form-group pl-1">
									<input v-model="form.Max_Current_Draw_Amperage" type="text" name="Max_Current_Draw_Amperage"
									       placeholder="Max Current Draw - Amperage"
									       class="form-control"
									       :class="{ 'is-invalid': form.errors.has('Max_Current_Draw_Amperage') }">
									<has-error :form="form" field="Max_Current_Draw_Amperage"></has-error>
								</div>
							</div>
							<div class="row">
								<div class="form-group pl-3">
									<input v-model="form.S_N_Ratio" type="text" name="S_N_Ratio"
									       placeholder="S/N Ratio"
									       class="form-control" :class="{ 'is-invalid': form.errors.has('S_N_Ratio') }">
									<has-error :form="form" field="S_N_Ratio"></has-error>
								</div>
								<div class="form-group pl-5 pr-5">
									<input v-model="form.THD" type="text" name="THD"
									       placeholder="THD"
									       class="form-control" :class="{ 'is-invalid': form.errors.has('THD') }">
									<has-error :form="form" field="THD"></has-error>
								</div>
								<div class="form-group pl-1">
									<input v-model="form.Input_Voltage_Sensitivity" type="text" name="Input_Voltage_Sensitivity"
									       placeholder="Input Voltage Sensitivity"
									       class="form-control"
									       :class="{ 'is-invalid': form.errors.has('Input_Voltage_Sensitivity') }">
									<has-error :form="form" field="Input_Voltage_Sensitivity"></has-error>
								</div>
							</div>
							<div class="row">
								<div class="form-group pl-3">
									<input v-model="form.Pass_Through_Output" type="text" name="Pass_Through_Output"
									       placeholder="Pass-Through Output"
									       class="form-control"
									       :class="{ 'is-invalid': form.errors.has('Pass_Through_Output') }">
									<has-error :form="form" field="Pass_Through_Output"></has-error>
								</div>
								<div class="form-group pl-5 pr-5">
									<input v-model="form.Remote_Subwoofer_Control" type="text" name="Remote_Subwoofer_Control"
									       placeholder="Remote Subwoofer Control"
									       class="form-control"
									       :class="{ 'is-invalid': form.errors.has('Remote_Subwoofer_Control') }">
									<has-error :form="form" field="Remote_Subwoofer_Control"></has-error>
								</div>
								<div class="form-group pl-1">
									<input v-model="form.Power_Wire_Guage_In" type="text" name="Power_Wire_Guage_In"
									       placeholder="Power Wire Guage In"
									       class="form-control"
									       :class="{ 'is-invalid': form.errors.has('Power_Wire_Guage_In') }">
									<has-error :form="form" field="Power_Wire_Guage_In"></has-error>
								</div>
							</div>
							<div class="row">
								<div class="form-group pl-3">
									<input v-model="form.Speaker_Wire_Gauge_Out" type="text" name="Speaker_Wire_Gauge_Out"
									       placeholder="Speaker Wire Gauge Out"
									       class="form-control"
									       :class="{ 'is-invalid': form.errors.has('Speaker_Wire_Gauge_Out') }">
									<has-error :form="form" field="Speaker_Wire_Gauge_Out"></has-error>
								</div>
								<div class="form-group pl-5 pr-5">
									<input v-model="form.Dimensions_in" type="text" name="Dimensions_in"
									       placeholder="Dimensions: in"
									       class="form-control" :class="{ 'is-invalid': form.errors.has('Dimensions_in') }">
									<has-error :form="form" field="Dimensions_in"></has-error>
								</div>
								<div class="form-group pl-1">
									<input v-model="form.Dimensions_mm" type="text" name="Dimensions_mm"
									       placeholder="Dimensions: mm"
									       class="form-control" :class="{ 'is-invalid': form.errors.has('Dimensions_mm') }">
									<has-error :form="form" field="Dimensions_mm"></has-error>
								</div>
							</div>
							<div class="form-group">
								<input v-model="form.Shipping_Weight_lbs" type="text" name="Shipping_Weight_lbs"
								       placeholder="Shipping Weight - lbs"
								       class="form-control"
								       :class="{ 'is-invalid': form.errors.has('Shipping_Weight_lbs') }">
								<has-error :form="form" field="Shipping_Weight_lbs"></has-error>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
							<button v-show="!$parent.productEditMode" type="submit" class="btn btn-primary">Create</button>
							<button v-show="$parent.productEditMode" type="submit" class="btn btn-success">Update</button>
						</div>
					</form>
				
				</div>
			</div>
		</div>
		<!-- Enclosures Modal -->
		<div class="modal fade" v-if="productName==='Enclosures'" id="addNewEnclosures" tabindex="-1" role="dialog"
		     aria-labelledby="addNewLabel"
		     aria-hidden="true">
			<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="EnclosureTitle"></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form @submit.prevent="$parent.productEditMode?updateProduct():createProduct()">
						<div class="modal-body">
							<div class="row">
								<div class="form-group pl-3">
									<input v-model="form.Model" type="text" name="Model"
									       placeholder="Model"
									       class="form-control" :class="{ 'is-invalid': form.errors.has('Model') }">
									<has-error :form="form" field="Model"></has-error>
								</div>
								<div class="form-group pl-5 pr-5">
									<input v-model="form.Driver_Size" type="text" name="Driver_Size"
									       placeholder="Driver Size"
									       class="form-control" :class="{ 'is-invalid': form.errors.has('Driver_Size') }">
									<has-error :form="form" field="Driver_Size"></has-error>
								</div>
								<div class="form-group pl-1">
									<input v-model="form.Watts_RMS" type="text" name="Watts_RMS"
									       placeholder="Watts RMS"
									       class="form-control" :class="{ 'is-invalid': form.errors.has('Watts_RMS') }">
									<has-error :form="form" field="Watts_RMS"></has-error>
								</div>
							</div>
							<div class="row">
								<div class="form-group pl-3">
									<input v-model="form.VCD" type="text" name="VCD"
									       placeholder="VCD"
									       class="form-control" :class="{ 'is-invalid': form.errors.has('VCD') }">
									<has-error :form="form" field="VCD"></has-error>
								</div>
								<div class="form-group pl-5 pr-5">
									<input v-model="form.Impedance" type="text" name="Impedance"
									       placeholder="Impedance"
									       class="form-control" :class="{ 'is-invalid': form.errors.has('Impedance') }">
									<has-error :form="form" field="Impedance"></has-error>
								</div>
								<div class="form-group pl-1">
									<input v-model="form.Dimensions_in" type="text" name="Dimensions_in"
									       placeholder="Dimensions: in"
									       class="form-control" :class="{ 'is-invalid': form.errors.has('Dimensions_in') }">
									<has-error :form="form" field="Dimensions_in"></has-error>
								</div>
							</div>
							<div class="row">
								<div class="form-group pr-lg-5" style="padding-left: 8rem !important;">
									<input v-model="form.Dimensions_mm" type="text" name="Dimensions_mm"
									       placeholder="Dimensions: mm"
									       class="form-control" :class="{ 'is-invalid': form.errors.has('Dimensions_mm') }">
									<has-error :form="form" field="Dimensions_mm"></has-error>
								</div>
								<div class="form-group pl-5 pr-5">
									<input v-model="form.Shipping_Weight_lbs" type="text" name="Shipping_Weight_lbs"
									       placeholder="Shipping Weight - lbs"
									       class="form-control"
									       :class="{ 'is-invalid': form.errors.has('Shipping_Weight_lbs') }">
									<has-error :form="form" field="Shipping_Weight_lbs"></has-error>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
							<button v-show="!$parent.productEditMode" type="submit" class="btn btn-primary">Create</button>
							<button v-show="$parent.productEditMode" type="submit" class="btn btn-success">Update</button>
						</div>
					</form>
				
				</div>
			</div>
		</div>
		<!-- Signal Processors Modal -->
		<div class="modal fade" v-if="productName==='Signal_Processors'" id="addNewSignal_Processors" tabindex="-1"
		     role="dialog"
		     aria-labelledby="addNewLabel"
		     aria-hidden="true">
			<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="SignalProcessoreTitle"></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form @submit.prevent="$parent.productEditMode?updateProduct():createProduct()">
						<div class="modal-body">
							<div class="row">
								<div class="form-group pl-3">
									<input v-model="form.Name" type="text" name="Name"
									       placeholder="Name"
									       class="form-control" :class="{ 'is-invalid': form.errors.has('Name') }">
									<has-error :form="form" field="Name"></has-error>
								</div>
								<div class="form-group pl-5 pr-5">
									<input v-model="form.Title" type="text" name="Title"
									       placeholder="Title"
									       class="form-control" :class="{ 'is-invalid': form.errors.has('Title') }">
									<has-error :form="form" field="Title"></has-error>
								</div>
								<div class="form-group pl-1">
									<input v-model="form.Channels" type="text" name="Channels"
									       placeholder="Channels"
									       class="form-control" :class="{ 'is-invalid': form.errors.has('Channels') }">
									<has-error :form="form" field="Channels"></has-error>
								</div>
							</div>
							<div class="form-group">
							<textarea v-model="form.Description" name="Description"
							          placeholder="Short Description for product (Optional)"
							          class="form-control"
							          :class="{ 'is-invalid': form.errors.has('Description') }"></textarea>
								<has-error :form="form" field="Description"></has-error>
							</div>
							<div class="row">
								<div class="form-group pl-3">
									<input v-model="form.Input_Voltage_Sensitivity" type="text" name="Input_Voltage_Sensitivity"
									       placeholder="Input Voltage Sensitivity"
									       class="form-control" :class="{ 'is-invalid': form.errors.has('Input_Voltage_Sensitivity') }">
									<has-error :form="form" field="Input_Voltage_Sensitivity"></has-error>
								</div>
								<div class="form-group pl-5 pr-5">
									<input v-model="form.Input_Channels" type="text" name="Input_Channels"
									       placeholder="Input Channels"
									       class="form-control" :class="{ 'is-invalid': form.errors.has('Input_Channels') }">
									<has-error :form="form" field="Input_Channels"></has-error>
								</div>
								<div class="form-group pl-1">
									<input v-model="form.Output_Channels" type="text" name="Output_Channels"
									       placeholder="Output Channels"
									       class="form-control"
									       :class="{ 'is-invalid': form.errors.has('Output_Channels') }">
									<has-error :form="form" field="Output_Channels"></has-error>
								</div>
							</div>
							<div class="row">
								<div class="form-group pl-3">
									<input v-model="form.Output_Voltage" type="text" name="Output_Voltage"
									       placeholder="Output Voltage"
									       class="form-control" :class="{ 'is-invalid': form.errors.has('Output_Voltage') }">
									<has-error :form="form" field="Output_Voltage"></has-error>
								</div>
								<div class="form-group pl-5 pr-5">
									<input v-model="form.Dimensions_in" type="text" name="Dimensions_in"
									       placeholder="Dimensions: in"
									       class="form-control" :class="{ 'is-invalid': form.errors.has('Dimensions_in') }">
									<has-error :form="form" field="Dimensions_in"></has-error>
								</div>
								<div class="form-group pl-1">
									<input v-model="form.Dimensions_mm" type="text" name="Dimensions_mm"
									       placeholder="Dimensions: mm"
									       class="form-control"
									       :class="{ 'is-invalid': form.errors.has('Dimensions_mm') }">
									<has-error :form="form" field="Dimensions_mm"></has-error>
								</div>
							</div>
							<div class="form-group">
								<input v-model="form.Shipping_Weight_lbs" type="text" name="Shipping_Weight_lbs"
								       placeholder="Shipping Weight - lbs"
								       class="form-control"
								       :class="{ 'is-invalid': form.errors.has('Shipping_Weight_lbs') }">
								<has-error :form="form" field="Shipping_Weight_lbs"></has-error>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
							<button v-show="!$parent.productEditMode" type="submit" class="btn btn-primary">Create</button>
							<button v-show="$parent.productEditMode" type="submit" class="btn btn-success">Update</button>
						</div>
					</form>
				
				</div>
			</div>
		</div>
		<!-- Subwoofers Modal -->
		<div class="modal fade" v-if="productName==='Subwoofers'" id="addNewSubwoofers" tabindex="-1" role="dialog"
		     aria-labelledby="addNewLabel"
		     aria-hidden="true">
			<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="SubwooferTitle"></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form @submit.prevent="$parent.productEditMode?updateProduct():createProduct()">
						<div class="modal-body">
							<div class="row">
								<div class="form-group pl-3">
									<input v-model="form.Model" type="text" name="Model"
									       placeholder="Model"
									       class="form-control" :class="{ 'is-invalid': form.errors.has('Model') }">
									<has-error :form="form" field="Model"></has-error>
								</div>
								<div class="form-group pl-5 pr-5">
									<input v-model="form.Driver_Size" type="text" name="Driver_Size"
									       placeholder="Driver Size"
									       class="form-control" :class="{ 'is-invalid': form.errors.has('Driver_Size') }">
									<has-error :form="form" field="Driver_Size"></has-error>
								</div>
								<div class="form-group pl-1">
									<input v-model="form.Watts_RMS" type="text" name="Watts_RMS"
									       placeholder="Watts RMS"
									       class="form-control" :class="{ 'is-invalid': form.errors.has('Watts_RMS') }">
									<has-error :form="form" field="Watts_RMS"></has-error>
								</div>
							</div>
							<div class="row">
								<div class="form-group pl-3">
									<input v-model="form.Peak_Power" type="text" name="Peak_Power"
									       placeholder="Peak Power"
									       class="form-control" :class="{ 'is-invalid': form.errors.has('Peak_Power') }">
									<has-error :form="form" field="Peak_Power"></has-error>
								</div>
								<div class="form-group pl-5 pr-5">
									<input v-model="form.VCD" type="text" name="VCD"
									       placeholder="VCD"
									       class="form-control" :class="{ 'is-invalid': form.errors.has('VCD') }">
									<has-error :form="form" field="VCD"></has-error>
								</div>
								<div class="form-group pl-1">
									<input v-model="form.Impedance" type="text" name="Impedance"
									       placeholder="Impedance"
									       class="form-control" :class="{ 'is-invalid': form.errors.has('Impedance') }">
									<has-error :form="form" field="Impedance"></has-error>
								</div>
							</div>
							<div class="row">
								<div class="form-group pl-3">
									<input v-model="form.Piston_Dia_in" type="text" name="Piston_Dia_in"
									       placeholder="Piston Dia - in"
									       class="form-control" :class="{ 'is-invalid': form.errors.has('Piston_Dia_in') }">
									<has-error :form="form" field="Piston_Dia_in"></has-error>
								</div>
								<div class="form-group pl-5 pr-5">
									<input v-model="form.Fs_Hz" type="text" name="Fs_Hz"
									       placeholder="Fs - Hz"
									       class="form-control" :class="{ 'is-invalid': form.errors.has('Fs_Hz') }">
									<has-error :form="form" field="Fs_Hz"></has-error>
								</div>
								<div class="form-group pl-1">
									<input v-model="form.Qms" type="text" name="Qms"
									       placeholder="Qms"
									       class="form-control"
									       :class="{ 'is-invalid': form.errors.has('Qms') }">
									<has-error :form="form" field="Qms"></has-error>
								</div>
							</div>
							<div class="row">
								<div class="form-group pl-3">
									<input v-model="form.Qes" type="text" name="Qes"
									       placeholder="Qes"
									       class="form-control" :class="{ 'is-invalid': form.errors.has('Qes') }">
									<has-error :form="form" field="Qes"></has-error>
								</div>
								<div class="form-group pl-5 pr-5">
									<input v-model="form.Qts" type="text" name="Qts"
									       placeholder="Qts"
									       class="form-control" :class="{ 'is-invalid': form.errors.has('Qts') }">
									<has-error :form="form" field="Qts"></has-error>
								</div>
								<div class="form-group pl-1">
									<input v-model="form.Vas_liters" type="text" name="Vas_liters"
									       placeholder="Vas - liters"
									       class="form-control"
									       :class="{ 'is-invalid': form.errors.has('Vas_liters') }">
									<has-error :form="form" field="Vas_liters"></has-error>
								</div>
							</div>
							<div class="row">
								<div class="form-group pl-3">
									<input v-model="form.Xmech_mm" type="text" name="Xmech_mm"
									       placeholder="Xmech - mm"
									       class="form-control"
									       :class="{ 'is-invalid': form.errors.has('Xmech_mm') }">
									<has-error :form="form" field="Xmech_mm"></has-error>
								</div>
								<div class="form-group pl-5 pr-5">
									<input v-model="form.Xmax_mm" type="text" name="Xmax_mm"
									       placeholder="Xmax - mm"
									       class="form-control"
									       :class="{ 'is-invalid': form.errors.has('Xmax_mm') }">
									<has-error :form="form" field="Xmax_mm"></has-error>
								</div>
								<div class="form-group pl-1">
									<input v-model="form.Frame_OD_in" type="text" name="Frame_OD_in"
									       placeholder="Frame OD - in"
									       class="form-control"
									       :class="{ 'is-invalid': form.errors.has('Frame_OD_in') }">
									<has-error :form="form" field="Frame_OD_in"></has-error>
								</div>
							</div>
							<div class="row">
								<div class="form-group pl-3">
									<input v-model="form.Frame_OD_w_Gasket_in" type="text" name="Frame_OD_w_Gasket_in"
									       placeholder="Frame OD w/Gasket - in"
									       class="form-control"
									       :class="{ 'is-invalid': form.errors.has('Frame_OD_w_Gasket_in') }">
									<has-error :form="form" field="Frame_OD_w_Gasket_in"></has-error>
								</div>
								<div class="form-group pl-5 pr-5">
									<input v-model="form.Mounting_Diameter_in" type="text" name="Mounting_Diameter_in"
									       placeholder="Mounting Diameter - in"
									       class="form-control"
									       :class="{ 'is-invalid': form.errors.has('Mounting_Diameter_in') }">
									<has-error :form="form" field="Mounting_Diameter_in"></has-error>
								</div>
								<div class="form-group pl-1">
									<input v-model="form.Mounting_Depth_in" type="text" name="Mounting_Depth_in"
									       placeholder="Mounting Depth - in"
									       class="form-control" :class="{ 'is-invalid': form.errors.has('Mounting_Depth_in') }">
									<has-error :form="form" field="Mounting_Depth_in"></has-error>
								</div>
							</div>
							<div class="row">
								<div class="form-group pl-3">
									<input v-model="form.Motor_Diameter_in" type="text" name="Motor_Diameter_in"
									       placeholder="Motor Diameter - in"
									       class="form-control"
									       :class="{ 'is-invalid': form.errors.has('Motor_Diameter_in') }">
									<has-error :form="form" field="Motor_Diameter_in"></has-error>
								</div>
								<div class="form-group pl-5 pr-5">
									<input v-model="form.Motor_Depth_in" type="text" name="Motor_Depth_in"
									       placeholder="Motor Depth - in"
									       class="form-control"
									       :class="{ 'is-invalid': form.errors.has('Motor_Depth_in') }">
									<has-error :form="form" field="Motor_Depth_in"></has-error>
								</div>
								<div class="form-group pl-1">
									<input v-model="form.Woofer_Displacement_cu_ft" type="text" name="Woofer_Displacement_cu_ft"
									       placeholder="Woofer Displacement - cu ft"
									       class="form-control" :class="{ 'is-invalid': form.errors.has('Woofer_Displacement_cu_ft') }">
									<has-error :form="form" field="Woofer_Displacement_cu_ft"></has-error>
								</div>
							</div>
							<div class="row">
								<div class="form-group pl-3">
									<input v-model="form.Shipping_Weight_lbs" type="text" name="Shipping_Weight_lbs"
									       placeholder="Shipping Weight - lbs"
									       class="form-control" :class="{ 'is-invalid': form.errors.has('Shipping_Weight_lbs') }">
									<has-error :form="form" field="Shipping_Weight_lbs"></has-error>
								</div>
								<div class="form-group pl-5 pr-5">
									<input v-model="form.Sealed_Enclosure_cu_ft" type="text" name="Sealed_Enclosure_cu_ft"
									       placeholder="Sealed Enclosure - cu ft"
									       class="form-control"
									       :class="{ 'is-invalid': form.errors.has('Sealed_Enclosure_cu_ft') }">
									<has-error :form="form" field="Sealed_Enclosure_cu_ft"></has-error>
								</div>
								<div class="form-group pl-1">
									<input v-model="form.Ported_Enclosure_cu_ft" type="text" name="Ported_Enclosure_cu_ft"
									       placeholder="Ported Enclosure - cu ft"
									       class="form-control"
									       :class="{ 'is-invalid': form.errors.has('Ported_Enclosure_cu_ft') }">
									<has-error :form="form" field="Ported_Enclosure_cu_ft"></has-error>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
							<button v-show="!$parent.productEditMode" type="submit" class="btn btn-primary">Create</button>
							<button v-show="$parent.productEditMode" type="submit" class="btn btn-success">Update</button>
						</div>
					</form>
				
				</div>
			</div>
		</div>
		<!-- Speakers Modal -->
		<div class="modal fade" v-if="productName==='Speakers'" id="addNewSpeakers" tabindex="-1" role="dialog"
		     aria-labelledby="addNewLabel"
		     aria-hidden="true">
			<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="SpeakerTitle"></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form @submit.prevent="$parent.productEditMode?updateProduct():createProduct()">
						<div class="modal-body">
							<div class="row">
								<div class="form-group pl-3">
									<input v-model="form.Name" type="text" name="Name"
									       placeholder="Name"
									       class="form-control" :class="{ 'is-invalid': form.errors.has('Name') }">
									<has-error :form="form" field="Name"></has-error>
								</div>
								<div class="form-group pl-4 pr-5">
									<input v-model="form.Title" type="text" name="Title"
									       placeholder="Title"
									       class="form-control" :class="{ 'is-invalid': form.errors.has('Title') }">
									<has-error :form="form" field="Title"></has-error>
								</div>
								<div class="form-group pl-1">
									<input v-model="form.Watts_RMS" type="text" name="Watts_RMS"
									       placeholder="Watts RMS"
									       class="form-control" :class="{ 'is-invalid': form.errors.has('Watts_RMS') }">
									<has-error :form="form" field="Watts_RMS"></has-error>
								</div>
							</div>
							<div class="form-group">
							<textarea v-model="form.Description" name="Description"
							          placeholder="Short Description for product (Optional)"
							          class="form-control"
							          :class="{ 'is-invalid': form.errors.has('Description') }"></textarea>
								<has-error :form="form" field="Description"></has-error>
							</div>
							<div class="row">
								<div class="form-group pl-3">
									<input v-model="form.VCD" type="text" name="VCD"
									       placeholder="VCD"
									       class="form-control" :class="{ 'is-invalid': form.errors.has('VCD') }">
									<has-error :form="form" field="VCD"></has-error>
								</div>
								<div class="form-group pl-4 pr-5">
									<input v-model="form.Impedance" type="text" name="Impedance"
									       placeholder="Impedance"
									       class="form-control" :class="{ 'is-invalid': form.errors.has('Impedance') }">
									<has-error :form="form" field="Impedance"></has-error>
								</div>
								<div class="form-group pl-1">
									<input v-model="form.Frequency_Response_Hz" type="text" name="Frequency_Response_Hz"
									       placeholder="Frequency Response - Hz"
									       class="form-control" :class="{ 'is-invalid': form.errors.has('Frequency_Response_Hz') }">
									<has-error :form="form" field="Frequency_Response_Hz"></has-error>
								</div>
							</div>
							<div class="row">
								<div class="form-group pl-3">
									<input v-model="form.dBSPL" type="text" name="dBSPL"
									       placeholder="dBSPL"
									       class="form-control" :class="{ 'is-invalid': form.errors.has('dBSPL') }">
									<has-error :form="form" field="dBSPL"></has-error>
								</div>
								<div class="form-group pl-4 pr-5">
									<input v-model="form.Mounting_Diameter_in" type="text" name="Mounting_Diameter_in"
									       placeholder="Mounting Diameter - in"
									       class="form-control" :class="{ 'is-invalid': form.errors.has('Mounting_Diameter_in') }">
									<has-error :form="form" field="Mounting_Diameter_in"></has-error>
								</div>
								<div class="form-group pl-1">
									<input v-model="form.Mounting_Depth_in" type="text" name="Mounting_Depth_in"
									       placeholder="Mounting Depth - in"
									       class="form-control"
									       :class="{ 'is-invalid': form.errors.has('Mounting_Depth_in') }">
									<has-error :form="form" field="Mounting_Depth_in"></has-error>
								</div>
							</div>
							<div class="form-group">
								<input v-model="form.Shipping_Weight_lbs" type="text" name="Shipping_Weight_lbs"
								       placeholder="Shipping Weight - lbs"
								       class="form-control" :class="{ 'is-invalid': form.errors.has('Shipping_Weight_lbs') }">
								<has-error :form="form" field="Shipping_Weight_lbs"></has-error>
							</div>
							<div class="card card-outline card-secondary collapsed-card" v-if="(form.sub_speaker)!==null">
								<button type="button" class="btn btn-tool" v-on:click="ButtonTitle=!ButtonTitle" data-widget="collapse">
									<span v-show="!ButtonTitle">Hide Options <i class="fa fa-angle-up "></i></span>
									<span v-show="ButtonTitle">Show Options <i class="fa fa-angle-down "></i></span>
								</button>
								<div class="card-body">
									<!-- /.row -->
									<div class="row">
										<div class="form-group pl-2">
											<input v-model="$parent.productEditMode?form.sub_speaker.Driver_Size:form.Driver_Size"
											       type="text"
											       name="Driver Size"
											       placeholder="Driver Size"
											       class="form-control">
										</div>
										<div class="form-group pl-4 pr-4">
											<input v-model="$parent.productEditMode?form.sub_speaker.Fs_Hz:form.Fs_Hz" type="text"
											       name="Fs_Hz"
											       placeholder="Fs - Hz"
											       class="form-control">
										</div>
										<div class="form-group pl-0">
											<input v-model="$parent.productEditMode?form.sub_speaker.Qms:form.Qms" type="text" name="Qms"
											       placeholder="Qms"
											       class="form-control">
										</div>
									</div>
									<div class="row">
										<div class="form-group pl-2">
											<input v-model="$parent.productEditMode?form.sub_speaker.Qms:form.Qms" type="text" name="Qes"
											       placeholder="Qes"
											       class="form-control">
										</div>
										<div class="form-group pl-4 pr-4">
											<input v-model="$parent.productEditMode?form.sub_speaker.Qts:form.Qts" type="text" name="Qts"
											       placeholder="Qts"
											       class="form-control">
										</div>
										<div class="form-group pl-0">
											<input v-model="$parent.productEditMode?form.sub_speaker.Vas_liters:form.Vas_liters"
											       type="text"
											       name="Vas - liters"
											       placeholder="Vas liters"
											       class="form-control">
										</div>
									</div>
									<div class="row">
										<div class="form-group" style="padding: 0 5rem !important;">
											<input v-model="$parent.productEditMode?form.sub_speaker.Dimensions_in:form.Dimensions_in"
											       type="text" name="Dimensions in"
											       placeholder="Dimensions: in"
											       class="form-control">
										</div>
										<div class="form-group pl-5 pr-5">
											<input v-model="$parent.productEditMode?form.sub_speaker.Dimensions_mm:form.Dimensions_mm"
											       type="text" name="Dimensions_mm"
											       placeholder="Dimensions: mm"
											       class="form-control">
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
							<button v-show="!$parent.productEditMode" type="submit" class="btn btn-primary">Create</button>
							<button v-show="$parent.productEditMode" type="submit" class="btn btn-success">Update</button>
						</div>
					</form>
				
				</div>
			</div>
		</div>
		<!-- Upload Photos Modal-->
		<dropzoneModal :productName=productName></dropzoneModal>
	</div>
</template>

<script>
    export default {
        props: {
            seriesName: String,
            productName: String,
            productForm: Object,
        },
        data() {
            return {
                products: [],
                form: this.productForm,
                ButtonTitle: true,
            }
        },
        watch: {
            cProduct: function () {
                $(window).on('hidden.bs.modal', () => {
                    this.$parent.cProduct = '';
                    Fire.$emit('AfterAction');
                });
            },
        },
        methods: {
            getProductPhoto(image) {
                return image.Path;
            },
            //  :: Edit Mode ::
            getEditModel(product) {
                switch (this.productName) {
                    case 'Amplifiers':
                        return this.amplifiresEModal(product);
                    case 'Enclosures':
                        return this.enclosuresEModal(product);
                    case 'Signal Processors':
                        return this.signalProcessoresEModal(product);
                    case 'Speakers':
                        return this.speakersEModal(product);
                    case 'Subwoofers':
                        return this.subwoofersEModal(product);
                }
            },
            amplifiresEModal(product) {
                this.$parent.productEditMode = true;
                this.form.reset();
                $('#AmplifireTitle').text('Update ' + product.Name + ' Info');
                $('#addNewAmplifires').modal('show');
                this.$parent.cProduct = product.Name;
                this.form.series_name = this.seriesName;
                this.form.fill(product);
            },
            enclosuresEModal(product) {
                this.$parent.productEditMode = true;
                this.form.reset();
                $('#EnclosureTitle').text('Update ' + product.Model + ' Info');
                $('#addNewEnclosures').modal('show');
                this.$parent.cProduct = product.Model;
                this.form.sub_series_name = this.seriesName;
                this.form.fill(product);
            },
            signalProcessoresEModal(product) {
                this.$parent.productEditMode = true;
                this.form.reset();
                $('#SignalProcessoreTitle').text('Update ' + product.Name + ' Info');
                $('#addNewSignal_Processors').modal('show');
                this.$parent.cProduct = product.Name;
                this.form.series_name = this.seriesName;
                this.form.fill(product);
            },
            speakersEModal(product) {
                this.$parent.productEditMode = true;
                this.form.reset();
                $('#SpeakerTitle').text('Update ' + product.Name + ' Info');
                $('#addNewSpeakers').modal('show');
                this.$parent.cProduct = product.Name;
                this.form.series_name = this.seriesName;
                this.form.fill(product);
            },
            subwoofersEModal(product) {
                this.$parent.productEditMode = true;
                this.form.reset();
                $('#SubwooferTitle').text('Update ' + product.Model + ' Info');
                $('#addNewSubwoofers').modal('show');
                this.$parent.cProduct = product.Model;
                console.log(this.seriesName);
                this.form.sub_series_name = this.seriesName;
                this.form.fill(product);
            },
            //  :: Add New Mode ::
            amplifiresModal(seriesName) {
                this.$parent.productEditMode = false;
                this.form.reset();
                $('#AmplifireTitle').text('Add New' + ' ' + seriesName);
                this.form.series_name = seriesName;
                $('#addNewAmplifires').modal('show');
            },
            enclosuresModal(seriesName) {
                this.$parent.productEditMode = false;
                this.form.reset();
                $('#EnclosureTitle').text('Add New' + ' ' + seriesName);
                this.form.sub_series_name = seriesName;
                $('#addNewEnclosures').modal('show');
            },
            signalProcessoresModal(seriesName) {
                this.$parent.productEditMode = false;
                this.form.reset();
                $('#SignalProcessoreTitle').text('Add New' + ' ' + seriesName);
                this.form.series_name = seriesName;
                $('#addNewSignal_Processors').modal('show');
            },
            speakersModal(seriesName) {
                this.$parent.productEditMode = false;
                this.form.reset();
                $('#SpeakerTitle').text('Add New' + ' ' + seriesName);
                this.form.series_name = seriesName;
                $('#addNewSpeakers').modal('show');
            },
            subwoofersModal(seriesName) {
                this.$parent.productEditMode = false;
                this.form.reset();
                $('#SubwooferTitle').text('Add New' + ' ' + seriesName);
                this.form.sub_series_name = seriesName;
                $('#addNewSubwoofers').modal('show');
            },
            // :: Product Methods ::
            loadProducts() {
                axios.get('api/v1/indexOf' + this.productName + '/' + this.seriesName)
                    .then(
                        ({data}) => (this.products = data)
                    );
            },
            createProduct() {
                this.$Progress.start();
                this.form.post('api/v1/' + this.productName)
                    .then(() => {
                        Fire.$emit('AfterAction');
                        $('#addNew' + this.productName).modal('hide');
                        toast({
                            type: 'success',
                            title: this.productName + ' Created in successfully'
                        })
                    })
                    .catch(() => {
                        this.$Progress.fail();

                    });
                this.$Progress.finish();
            },
            updateProduct() {
                this.$Progress.start();
                console.log(this.$parent.cProduct);
                this.form.put('api/v1/' + this.productName + '/' + this.$parent.cProduct)
                    .then(() => {
                        $('#addNew' + this.productName).modal('hide');
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
            deleteProduct(Name) {
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
                        this.form.delete('api/v1/' + this.productName + '/' + Name)
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
            // :: Upload Photo By Product ::
            uploadPhotoModal(productName) {
                this.$parent.cProduct = productName;
                $('#uploadPhotos').modal('show');
            },
        },

        created() {
            this.loadProducts();
            Fire.$on('AfterAction', () => {
                this.loadProducts();
            });
            Fire.$on('CreateProduct', (seriesName) => {
                switch (this.productName) {
                    case 'Amplifiers':
                        return this.amplifiresModal(seriesName);
                    case 'Enclosures':
                        return this.enclosuresModal(seriesName);
                    case 'Signal_Processors':
                        return this.signalProcessoresModal(seriesName);
                    case 'Speakers':
                        return this.speakersModal(seriesName);
                    case 'Subwoofers':
                        return this.subwoofersModal(seriesName);
                }
            });
            Fire.$on('UploadPhoto', (seriesName) => {
                this.uploadPhotoModal(seriesName);
            });
        }
    }
</script>