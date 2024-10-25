import 'package:appnew/user/blocs/safePlace/safe_place_event.dart';
import 'package:appnew/user/blocs/safePlace/safe_place_state.dart';
import 'package:flutter_bloc/flutter_bloc.dart';

import '../../repositories/safe_place_repository.dart';

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
