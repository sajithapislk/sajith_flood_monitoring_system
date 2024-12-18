import 'package:equatable/equatable.dart';
import 'package:flutter_bloc/flutter_bloc.dart';

import '../../repositories/fcm_repository.dart';
import '../../repositories/user_dashboard_repository.dart';
import '../safePlace/safe_place_event.dart';
import 'user_dashboard_event.dart';
import 'user_dashboard_state.dart';

class UserDashboardBloc extends Bloc<UserDashboardEvent, UserDashboardState> {
  final monitorPlaceRepository = UserDashboardRepository();
  final fcmRepository = FCMRepository();
  UserDashboardBloc() : super(UserDashboardInitial()) {
    on<FetchDataEvent>(_onFetchList);
  }

  Future<void> _onFetchList(FetchDataEvent event,Emitter<UserDashboardState> emit)async {
    final data = await monitorPlaceRepository.All(
      latitude: event.latitude,
      longitude: event.longitude
    );
    await fcmRepository.save(event.fcm);

    emit(UserDashboardLoaded(data));
  }
}
