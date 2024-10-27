import 'package:flutter/material.dart';
import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:google_maps_flutter/google_maps_flutter.dart';

import '../blocs/map/map_bloc.dart';
import '../blocs/map/map_event.dart';
import '../blocs/map/map_state.dart';

class MapScreen extends StatelessWidget {
  final double lat;
  final double lon;

  const MapScreen({
    super.key,
    required this.lat,
    required this.lon,
  });

  @override
  Widget build(BuildContext context) {
    return BlocProvider(
      create: (context) => MapBloc()..add(LoadMap(lat, lon)),
      child: Scaffold(
        body: BlocBuilder<MapBloc, MapState>(
          builder: (context, state) {
            if (state.currentLocation == null) {
              return const Center(child: Text("Loading..."));
            }

            return GoogleMap(
              initialCameraPosition: CameraPosition(
                target: state.currentLocation!,
                zoom: 13.5,
              ),
              markers: {
                if (state.currentLocation != null)
                  Marker(
                    markerId: const MarkerId("currentLocation"),
                    icon: state.currentLocationIcon,
                    position: state.currentLocation!,
                  ),
                if (state.sourceLocation != null)
                  Marker(
                    markerId: const MarkerId("source"),
                    position: state.sourceLocation!,
                  ),
                if (state.destination != null)
                  Marker(
                    markerId: const MarkerId("destination"),
                    position: state.destination!,
                  ),
              },
              polylines: {
                if (state.polylineCoordinates.isNotEmpty)
                  Polyline(
                    polylineId: const PolylineId("route"),
                    points: state.polylineCoordinates,
                    color: const Color(0xFF7B61FF),
                    width: 6,
                  ),
              },
              onMapCreated: (GoogleMapController controller) {
                // Map is created, you could add additional callbacks here
              },
            );
          },
        ),
      ),
    );
  }
}