import 'package:bloc/bloc.dart';
import 'package:equatable/equatable.dart';

part 'user_dashboard_event.dart';
part 'user_dashboard_state.dart';

class UserDashboardBloc extends Bloc<UserDashboardEvent, UserDashboardState> {
  UserDashboardBloc() : super(UserDashboardInitial()) {
    on<UserDashboardEvent>((event, emit) {
      // TODO: implement event handler
    });
  }
}
