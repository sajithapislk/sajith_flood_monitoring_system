import 'package:appnew/auth/auth_bloc.dart';
import 'package:appnew/dm/screens/dm_dashboard_screen.dart';
import 'package:appnew/dm/screens/risk_people_screen.dart';
import 'package:appnew/user/screens/user_dashboard_screen.dart';
import 'package:appnew/user/screens/login_screen.dart';
import 'package:appnew/user/screens/map_screen.dart';
import 'package:appnew/dm/screens/monitor_place_screen.dart';
import 'package:appnew/user/screens/safe_place_screen.dart';
import 'package:firebase_core/firebase_core.dart';
import 'package:firebase_messaging/firebase_messaging.dart';
import 'package:flutter/material.dart';
import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:flutter_local_notifications/flutter_local_notifications.dart';

import 'auth/auth_event.dart';
import 'auth/auth_state.dart';

final FlutterLocalNotificationsPlugin flutterLocalNotificationsPlugin = FlutterLocalNotificationsPlugin();
Future<void> main() async {
  WidgetsFlutterBinding.ensureInitialized();
  await Firebase.initializeApp().then((_) {
    print("Firebase initialized successfully");
  }).catchError((error) {
    print("Firebase initialization failed: $error");
  });
  const AndroidInitializationSettings initializationSettingsAndroid =
  AndroidInitializationSettings('@mipmap/ic_launcher');

  final InitializationSettings initializationSettings = InitializationSettings(
    android: initializationSettingsAndroid,
  );

  await flutterLocalNotificationsPlugin.initialize(initializationSettings);

  runApp(
    BlocProvider(
      create: (context) => AuthBloc()..add(AppStarted()),
      child: const MyApp(),
    ),
  );
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  // This widget is the root of your application.
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      home: BlocListener<AuthBloc, AuthState>(
        listener: (context, state) {
          if (state is Authenticated) {
            // Navigate to DashboardScreen when authenticated
            Navigator.pushReplacement(
                context,
                MaterialPageRoute(
                    builder: (context) =>
                        state.type == 'dm' ? const DmDashboardScreen() : const UserDashboardScreen()));
          } else if (state is Unauthenticated) {
            // Navigate to DashboardScreen when authenticated
            Navigator.pushReplacement(context, MaterialPageRoute(builder: (context) => const UserLoginScreen()));
          }
        },
        child: const Center(child: CircularProgressIndicator()),
      ),
    );
  }
}
