import 'package:equatable/equatable.dart';

abstract class UserDashboardEvent extends Equatable {
  @override
  List<Object?> get props => [];
}

class FetchDataEvent extends UserDashboardEvent {
  final double latitude;
  final double longitude;
  final String fcm;

  FetchDataEvent({required this.latitude, required this.longitude, required this.fcm});
}