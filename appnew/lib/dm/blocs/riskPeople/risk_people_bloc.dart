import 'package:appnew/dm/models/risk_people_model.dart';
import 'package:bloc/bloc.dart';
import 'package:equatable/equatable.dart';

import '../../repositories/risk_people_repository.dart';

part 'risk_people_event.dart';
part 'risk_people_state.dart';

class RiskPeopleBloc extends Bloc<RiskPeopleEvent, RiskPeopleState> {
  final riskPeopleRepository = RiskPeopleRepository();
  RiskPeopleBloc() : super(RiskPeopleInitial()) {
    on<FetchListEvent>(_onFetchList);
  }

  Future<void> _onFetchList(FetchListEvent event,Emitter<RiskPeopleState> emit)async {
    final list = await riskPeopleRepository.All();

    emit(MonitorPlaceLoaded(list));
  }
}
