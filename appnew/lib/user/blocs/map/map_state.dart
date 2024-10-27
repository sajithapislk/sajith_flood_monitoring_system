import 'package:equatable/equatable.dart';
import 'package:google_maps_flutter/google_maps_flutter.dart';
import 'package:location/location.dart';

class MapState extends Equatable {
  final LatLng? currentLocation;
  final LatLng? sourceLocation;
  final LatLng? destination;
  final List<LatLng> polylineCoordinates;
  final BitmapDescriptor currentLocationIcon;

  const MapState({
    this.currentLocation,
    this.sourceLocation,
    this.destination,
    this.polylineCoordinates = const [],
    required this.currentLocationIcon,
  });

  MapState copyWith({
    LatLng? currentLocation,
    LatLng? sourceLocation,
    LatLng? destination,
    List<LatLng>? polylineCoordinates,
    BitmapDescriptor? currentLocationIcon,
  }) {
    return MapState(
      currentLocation: currentLocation ?? this.currentLocation,
      sourceLocation: sourceLocation ?? this.sourceLocation,
      destination: destination ?? this.destination,
      polylineCoordinates: polylineCoordinates ?? this.polylineCoordinates,
      currentLocationIcon: currentLocationIcon ?? this.currentLocationIcon,
    );
  }

  @override
  List<Object?> get props => [
    currentLocation,
    sourceLocation,
    destination,
    polylineCoordinates,
    currentLocationIcon,
  ];
}