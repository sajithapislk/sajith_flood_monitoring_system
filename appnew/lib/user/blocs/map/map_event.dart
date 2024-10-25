import 'package:equatable/equatable.dart';
import 'package:google_maps_flutter/google_maps_flutter.dart';
import 'package:location/location.dart';

abstract class MapEvent extends Equatable {
  const MapEvent();

  @override
  List<Object> get props => [];
}

class LoadMap extends MapEvent {
  final double lat;
  final double lon;

  const LoadMap(this.lat, this.lon);

  @override
  List<Object> get props => [lat, lon];
}

class UpdateCurrentLocation extends MapEvent {
  final LocationData locationData;

  const UpdateCurrentLocation(this.locationData);

  @override
  List<Object> get props => [locationData];
}

class UpdatePolyline extends MapEvent {
  const UpdatePolyline();
}