<?php
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*	Route ::middleware('auth:api') -> get('/user', function(Request $request) {
/		return $request -> user();
	});*/
// :: Back End and Front End API ::
Route ::group(['prefix' => 'v1'], function() {
	//  :: User route ::
	Route ::apiResource('user', 'API\UserController');
	Route ::get('profile', 'API\UserController@profile');
	Route ::put('profile', 'API\UserController@updateProfile');
	Route ::get('findUser', 'API\UserController@search');
	//  :: Category route ::
	Route ::apiResource('category', 'API\ProductController');
	//  :: Series route ::
	Route ::apiResource('series', 'API\SeriesController');
	Route ::get('indexOfSeries/{productName}', 'API\SeriesController@indexOf');
	//  :: Sub Series route ::
	Route ::apiResource('SubSeries', 'API\SubSeriesController');
	Route ::get('indexOfSubSeries/{productName}', 'API\SubSeriesController@indexOf');
	Route ::get('find/{productName}', 'API\SubSeriesController@search');
	//  :: Amplifiers route ::
	Route ::apiResource('Amplifiers', 'API\AmplifireController');
	Route ::get('indexOfAmplifiers/{seriesName}', 'API\AmplifireController@indexOf');
	Route ::post('addPhotosAmplifiers/{Amplifier}', 'API\AmplifireController@addPhotos');
	Route ::get('findAmplifiers', 'API\AmplifireController@search');
	//  :: Signal Processors route ::
	Route ::apiResource('Signal_Processors', 'API\SignalProcessorController');
	Route ::get('indexOfSignal_Processors/{seriesName}', 'API\SignalProcessorController@indexOf');
	Route ::post('addPhotosSignal_Processors/{SignalProcessor}', 'API\SignalProcessorController@addPhotos');
	Route ::get('findSignal_Processors', 'API\SignalProcessorController@search');
	//  :: Speakers route ::
	Route ::apiResource('Speakers', 'API\SpeakerController');
	Route ::get('indexOfSpeakers/{seriesName}', 'API\SpeakerController@indexOf');
	Route ::post('addPhotosSpeakers/{Speaker}', 'API\SpeakerController@addPhotos');
	Route ::get('findSpeakers', 'API\SpeakerController@search');
	//  :: Subwoofers route ::
	Route ::apiResource('Subwoofers', 'API\SubwooferController');
	Route ::get('indexOfSubwoofers/{subSeriesName}', 'API\SubwooferController@indexOfSubwoofers');
	Route ::post('addPhotosSubwoofers/{Subwoofer}', 'API\SubSeriesController@SubwooferAddPhotos');
	//  :: Enclosures route ::
	Route ::apiResource('Enclosures', 'API\EnclosureController');
	Route ::get('indexOfEnclosures/{subSeriesName}', 'API\EnclosureController@indexOfEnclosures');
	Route ::post('addPhotosEnclosures/{Enclosure}', 'API\SubSeriesController@EnclosureAddPhotos');
	//  :: Images route ::
	Route ::apiResource('Images', 'API\ImageController');
	Route ::get('AllImages', 'API\ImageController@allImages');
});
// :: Mobile App API ::
Route ::group(['prefix' => 'v2'], function() {
	Route ::apiResource('products', 'ProductController', ['only' => ['index', 'show']]);
	Route ::apiResource('products.series', 'SeriesController', ['only' => ['index']]);
	Route ::apiResource('products.series.amplifires', 'AmplifireController', ['only' => ['index', 'show']]);
	Route ::apiResource('products.series.signal_processors', 'SignalProcessorController', ['only' => ['index', 'show']]);
	Route ::apiResource('products.series.speakers', 'SpeakerController', ['only' => ['index', 'show']]);
	Route ::apiResource('products.series.sub_series', 'SubSeriesController', ['only' => ['index', 'show']]);
	Route ::apiResource('images', 'ImageController', ['only' => ['index', 'show']]);
	Route ::get('lastImage', 'ImageController@lastImage');
});

