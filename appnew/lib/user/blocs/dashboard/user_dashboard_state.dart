import 'package:appnew/user/models/user_dashboard_model.dart';
import 'package:equatable/equatable.dart';

abstract class UserDashboardState extends Equatable {
  @override
  List<Object> get props => [];
}

class UserDashboardInitial extends UserDashboardState {}

class UserDashboardLoaded extends UserDashboardState {
  final UserDashboardModel data;

  UserDashboardLoaded(
      this.data,
      );

  @override
  List<Object> get props => [data];
}