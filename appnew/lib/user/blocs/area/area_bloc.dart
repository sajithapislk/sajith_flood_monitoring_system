import 'package:appnew/user/repositories/area_repository.dart';
import 'package:flutter_bloc/flutter_bloc.dart';

import 'area_event.dart';
import 'area_state.dart';

class AreaBloc extends Bloc<AreaEvent, AreaState> {
  final areaRepository = AreaRepository();
  AreaBloc() : super(AreaInitial()) {
    on<LoadAreas>(_onFetchList);
  }

  Future<void> _onFetchList(LoadAreas event,Emitter<AreaState> emit)async {
    final list = await areaRepository.all();

    emit(AreaLoaded(areas: list));
  }
}
