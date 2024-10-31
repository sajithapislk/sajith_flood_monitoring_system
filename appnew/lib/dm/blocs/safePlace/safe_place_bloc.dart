import 'package:flutter_bloc/flutter_bloc.dart';

import '../../repositories/safe_place_repository.dart';
import 'safe_place_event.dart';
import 'safe_place_state.dart';

class SafePlaceBloc extends Bloc<SafePlaceEvent, SafePlaceState> {
  final safePlaceRepository = SafePlaceRepository();


  SafePlaceBloc() : super(SafePlaceInitial()) {
    on<FetchListEvent>(_onFetchList);
  }

  Future<void> _onFetchList(FetchListEvent event,Emitter<SafePlaceState> emit)async {
    final list = await safePlaceRepository.All();

    emit(SafePlaceLoaded(list));
  }
}
