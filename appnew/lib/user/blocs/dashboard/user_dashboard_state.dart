part of 'user_dashboard_bloc.dart';

sealed class UserDashboardState extends Equatable {
  const UserDashboardState();
}

final class UserDashboardInitial extends UserDashboardState {
  @override
  List<Object> get props => [];
}
