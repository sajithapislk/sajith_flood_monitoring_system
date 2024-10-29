import 'dart:developer';

import 'package:appnew/dm/screens/safe_place_screen.dart';
import 'package:flutter/material.dart';
import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:geolocator/geolocator.dart';
import 'package:fl_chart/fl_chart.dart';

import '../blocs/dashboard/user_dashboard_bloc.dart';
import '../blocs/dashboard/user_dashboard_event.dart';
import '../blocs/dashboard/user_dashboard_state.dart';

class UserDashboardScreen extends StatelessWidget {
  const UserDashboardScreen({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      home: BlocProvider(
        create: (_) => UserDashboardBloc(), // Initial event to load data
        child: UserDashboardWrap(),
      ),
    );
  }
}

class UserDashboardWrap extends StatefulWidget {
  const UserDashboardWrap({super.key});

  @override
  State<UserDashboardWrap> createState() => _UserDashboardWrapState();
}

class _UserDashboardWrapState extends State<UserDashboardWrap> {
  Future<void> fetchNearestRainGauge(BuildContext context) async {
    bool serviceEnabled;
    LocationPermission permission;

    // Check if location services are enabled.
    serviceEnabled = await Geolocator.isLocationServiceEnabled();
    if (!serviceEnabled) {
      // Location services are not enabled, don't continue.
      return Future.error('Location services are disabled.');
    }

    permission = await Geolocator.checkPermission();
    if (permission == LocationPermission.denied) {
      permission = await Geolocator.requestPermission();
      if (permission == LocationPermission.denied) {
        // Permissions are denied, don't continue.
        return Future.error('Location permissions are denied');
      }
    }

    if (permission == LocationPermission.deniedForever) {
      // Permissions are denied forever, don't continue.
      return Future.error('Location permissions are permanently denied, we cannot request permissions.');
    }

    // Get the current position
    Position position = await Geolocator.getCurrentPosition(desiredAccuracy: LocationAccuracy.high);
    context.read<UserDashboardBloc>().add(FetchDataEvent(
          latitude: position.latitude,
          longitude: position.longitude,
        ));
  }

  @override
  Widget build(BuildContext context) {
    fetchNearestRainGauge(context);
    return Scaffold(
        appBar: AppBar(
          title: const Text('Flood Prediction System'),
          backgroundColor: Colors.blue,
          elevation: 0,
          actions: [
            IconButton(
              icon: const Icon(Icons.exit_to_app),
              onPressed: () {

              },
            ),
          ],
        ),
        body: SingleChildScrollView(
          child: Padding(
            padding: const EdgeInsets.all(16.0),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Card(
                  elevation: 4,
                  color: Colors.orange[100],
                  child: Padding(
                    padding: const EdgeInsets.all(16.0),
                    child: Row(
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                      children: [
                        Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            Row(
                              children: const [
                                Icon(Icons.warning_amber_rounded, color: Colors.orange),
                                SizedBox(width: 8),
                                Text(
                                  'Current Risk Level',
                                  style: TextStyle(
                                    fontSize: 18,
                                    fontWeight: FontWeight.bold,
                                  ),
                                ),
                              ],
                            ),
                            const SizedBox(height: 8),
                            const Text(
                              'High',
                              style: TextStyle(
                                fontSize: 24,
                                fontWeight: FontWeight.bold,
                                color: Colors.orange,
                              ),
                            ),
                          ],
                        ),
                        ElevatedButton(
                            onPressed: (){
                              Navigator.pushReplacement(
                                  context,
                                  MaterialPageRoute(
                                      builder: (context) => SafePlaceScreen(areaId: 1)));
                            }, child: Text("Safe Places")
                        )
                      ],
                    ),
                  ),
                ),
                const SizedBox(height: 16),

                // Weather Metrics Grid
                SizedBox(
                  width: double.infinity,
                  child: Card(
                    child: Padding(
                      padding: const EdgeInsets.all(8.0),
                      child: Row(
                        crossAxisAlignment: CrossAxisAlignment.center,
                        mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                        children: [
                          Column(
                            mainAxisAlignment: MainAxisAlignment.center,
                            children: [
                              Icon(Icons.water_drop, color: Colors.blue, size: 32),
                              const SizedBox(height: 8),
                              Text(
                                'Water Level (rain gauge)',
                                style: const TextStyle(
                                  fontSize: 14,
                                  fontWeight: FontWeight.w500,
                                ),
                              ),
                            ],
                          ),
                          BlocBuilder<UserDashboardBloc, UserDashboardState>(
                            builder: (context, state) {
                              if (state is UserDashboardLoaded) {
                                return Text(
                                  '${(state.data.nearestPlace.waterLevel! * 10).toString()}mm',
                                  style: TextStyle(
                                    fontSize: 20,
                                    fontWeight: FontWeight.bold,
                                    color: Colors.blue,
                                  ),
                                );
                              }
                              return CircularProgressIndicator();
                            },
                          ),
                        ],
                      ),
                    ),
                  ),
                ),
                SizedBox(height: 16),
                Card(
                  child: Padding(
                    padding: const EdgeInsets.all(16.0),
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        const Text(
                          'Recent Alerts',
                          style: TextStyle(
                            fontSize: 18,
                            fontWeight: FontWeight.bold,
                          ),
                        ),
                        const SizedBox(height: 8),
                        BlocBuilder<UserDashboardBloc, UserDashboardState>(
                          builder: (context, state) {
                            if (state is UserDashboardLoaded) {
                              final notifications = state.data.notifications;
                              log(notifications.length.toString());
                              return SizedBox(
                                height: 180,
                                child: ListView.builder(
                                  itemCount: notifications.length,
                                  itemBuilder: (context, index) {
                                    final item = notifications[index];
                                    return _buildAlertItem(
                                      item.message, // Adjust to your data
                                      item.createdAt.toString(), // Adjust to your data
                                      Colors.orange,
                                    );
                                  },
                                ),
                              );
                            }
                            return Center(child: CircularProgressIndicator());
                          },
                        )
                      ],
                    ),
                  ),
                ),
              ],
            ),
          ),
        ));
  }

  Widget _buildAlertItem(String message, String time, Color color) {
    return Padding(
      padding: const EdgeInsets.symmetric(vertical: 8.0),
      child: Row(
        children: [
          Icon(Icons.info, color: color),
          const SizedBox(width: 8),
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  message,
                  style: const TextStyle(fontWeight: FontWeight.w500),
                ),
                Text(
                  time,
                  style: const TextStyle(
                    color: Colors.grey,
                    fontSize: 12,
                  ),
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }
}
