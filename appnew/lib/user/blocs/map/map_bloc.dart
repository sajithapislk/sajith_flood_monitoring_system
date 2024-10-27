import 'dart:async';
import 'dart:developer' as dev;
import 'package:bloc/bloc.dart';
import 'package:flutter_polyline_points/flutter_polyline_points.dart';
import 'package:google_maps_flutter/google_maps_flutter.dart';
import 'package:location/location.dart';
import 'package:meta/meta.dart';
import 'map_event.dart';
import 'map_state.dart';

class MapBloc extends Bloc<MapEvent, MapState> {
  final Location _location = Location();
  StreamSubscription<LocationData>? _locationSubscription;

  MapBloc()
      : super(MapState(
    currentLocationIcon: BitmapDescriptor.defaultMarker,
  )) {
    on<LoadMap>(_onLoadMap);
    on<UpdateCurrentLocation>(_onUpdateCurrentLocation);
    on<UpdatePolyline>(_onUpdatePolyline);
  }

  Future<void> _onLoadMap(LoadMap event, Emitter<MapState> emit) async {
    dev.log("Initializing Map Bloc");

    // Set destination to the user-provided lat/lon
    LatLng destination = LatLng(event.lat, event.lon);

    try {
      // Get the current location
      LocationData locationData = await _location.getLocation();
      LatLng sourceLocation = LatLng(locationData.latitude!, locationData.longitude!);
      emit(state.copyWith(
        currentLocation: sourceLocation,
        sourceLocation: sourceLocation,
        destination: destination,
      ));

      // Start location updates
      _locationSubscription =
          _location.onLocationChanged.listen((newLocation) {
            add(UpdateCurrentLocation(newLocation));
          });

      add(const UpdatePolyline());
    } catch (e) {
      dev.log("Error in _onLoadMap: $e");
    }
  }

  void _onUpdateCurrentLocation(
      UpdateCurrentLocation event, Emitter<MapState> emit) {
    dev.log("Updating current location");
    emit(state.copyWith(currentLocation: LatLng(event.locationData.latitude!, event.locationData.longitude!)));
  }

  Future<void> _onUpdatePolyline(UpdatePolyline event, Emitter<MapState> emit) async {
    dev.log("Fetching polyline coordinates");

    if (state.sourceLocation == null || state.destination == null) return;

    try {
      PolylinePoints polylinePoints = PolylinePoints();
      PolylineResult result = await polylinePoints.getRouteBetweenCoordinates(
        googleApiKey: "AIzaSyCP6SvRsh7Ba3lOFKEjRxX6dZqkwH6U7H0",
        request: PolylineRequest(
          origin: PointLatLng(state.sourceLocation!.latitude, state.sourceLocation!.longitude),
          destination: PointLatLng(state.destination!.latitude, state.destination!.longitude),
          mode: TravelMode.driving,
        ),
      );

      if (result.points.isNotEmpty) {
        List<LatLng> polylineCoordinates = result.points
            .map((point) => LatLng(point.latitude, point.longitude))
            .toList();

        emit(state.copyWith(polylineCoordinates: polylineCoordinates));
      }
    } catch (e) {
      dev.log("Error in _onUpdatePolyline: $e");
    }
  }

  @override
  Future<void> close() {
    _locationSubscription?.cancel();
    return super.close();
  }
}