import 'package:appnew/dm/blocs/confirmUser/confirm_user_state.dart';
import 'package:flutter_bloc/flutter_bloc.dart';
import '../../repositories/confirm_user_repository.dart';
import 'confirm_user_event.dart';

class ConfirmUserBloc extends Bloc<ConfirmUserEvent, ConfirmUserState> {

  final confirmUserRepository = ConfirmUserRepository();
  ConfirmUserBloc() : super(ConfirmUserInitial()) {
    on<FetchListEvent>(_onFetchList);
  }

  Future<void> _onFetchList(FetchListEvent event,Emitter<ConfirmUserState> emit)async {
    final list = await confirmUserRepository.All();

    emit(ConfirmUserLoaded(list));
  }
}
