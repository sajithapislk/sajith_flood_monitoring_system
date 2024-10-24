
import 'package:appnew/user/blocs/monitorPlace/monitor_place_state.dart';
import 'package:appnew/user/repositories/monitor_place_repository.dart';
import 'package:flutter_bloc/flutter_bloc.dart';

import 'monitor_place_event.dart';
import 'monitor_place_state.dart';

class MonitorPlaceBloc extends Bloc<MonitorPlaceEvent, MonitorPlaceState> {
  final monitorPlaceRepository = MonitorPlaceRepository();
  MonitorPlaceBloc() : super(MonitorPlaceInitial()) {
    on<FetchListEvent>(_onFetchList);
  }

  Future<void> _onFetchList(FetchListEvent event,Emitter<MonitorPlaceState> emit)async {
    final list = await monitorPlaceRepository.All();

    emit(MonitorPlaceLoaded(list));
  }
}
