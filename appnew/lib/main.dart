import 'package:appnew/auth/auth_bloc.dart';
import 'package:appnew/user/screens/dashboard_screen.dart';
import 'package:appnew/user/screens/login_screen.dart';
import 'package:appnew/user/screens/map_screen.dart';
import 'package:appnew/user/screens/monitor_place_screen.dart';
import 'package:appnew/user/screens/safe_place_screen.dart';
import 'package:firebase_core/firebase_core.dart';
import 'package:firebase_messaging/firebase_messaging.dart';
import 'package:flutter/material.dart';
import 'package:flutter_bloc/flutter_bloc.dart';

import 'auth/auth_event.dart';
import 'auth/auth_state.dart';

Future<void> main() async {
  WidgetsFlutterBinding.ensureInitialized();
  await Firebase.initializeApp();

  FirebaseMessaging messaging = FirebaseMessaging.instance;

  NotificationSettings settings = await messaging.requestPermission(
    alert: true,
    badge: true,
    sound: true,
  );

  if (settings.authorizationStatus == AuthorizationStatus.authorized) {
    print('User granted permission');
  } else if (settings.authorizationStatus == AuthorizationStatus.provisional) {
    print('User granted provisional permission');
  } else {
    print('User declined or has not accepted permission');
  }

  FirebaseMessaging.onMessage.listen((RemoteMessage message) {
    if (message.notification != null) {
      print('Message title: ${message.notification?.title}');
      print('Message body: ${message.notification?.body}');
    }
  });
  runApp(
    BlocProvider(
      create: (context) =>
      AuthBloc()
        ..add(AppStarted()),
      child: MyApp(),
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
                context, MaterialPageRoute(builder: (context) => MapScreen(
              lat: 7.4037962,
              lon: 80.6170354,
            )));
          }else if (state is Unauthenticated) {
            // Navigate to DashboardScreen when authenticated
            Navigator.pushReplacement(
                context, MaterialPageRoute(builder: (context) => UserLoginScreen()));
          }
        },
        child: Center(child: CircularProgressIndicator()),
      ),
    );
  }
}