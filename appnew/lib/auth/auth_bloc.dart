import 'package:appnew/user/models/user_model.dart';
import 'package:appnew/user/repositories/auth_repository.dart' as userRep;
import 'package:appnew/dm/repositories/auth_repository.dart' as dmRep;
import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:shared_preferences/shared_preferences.dart';

import '../dm/models/dm_model.dart';
import 'auth_event.dart';
import 'auth_state.dart';

class AuthBloc extends Bloc<AuthEvent, AuthState> {
  userRep.AuthRepository userAuthRepository = userRep.AuthRepository();
  dmRep.AuthRepository dmAuthRepository = dmRep.AuthRepository();

  AuthBloc() : super(AuthInitial()) {
    on<AppStarted>(_checkAuthStatus);
    on<UserLoginRequested>(_onUserLoginRequested);
    on<DmLoginRequested>(_onDmLoginRequested);
    // on<RegisterRequested>(_onRegisterRequested);
  }

  Future<void>  _checkAuthStatus(AppStarted event, Emitter<AuthState> emit) async {
    final type = await _isUserLoggedIn(); // Replace with your logic

    if (type != '') {
      emit(Authenticated(type: type));
    } else {
      emit(Unauthenticated());
    }
  }

  Future<void> _onUserLoginRequested(UserLoginRequested event, Emitter<AuthState> emit) async {
    emit(AuthLoading());

    try {

      UserLoginModel response = await userAuthRepository.login(email: event.email, password: event.password);
      SharedPreferences localStorage = await SharedPreferences.getInstance();
      await localStorage.setString('token', response.accessToken);
      await localStorage.setString('type', 'user');
      emit(Authenticated(type: 'user'));

    } on Exception catch (e) {
      emit(AuthFailure(error: e.toString()));
    }
  }
  Future<void> _onDmLoginRequested(DmLoginRequested event, Emitter<AuthState> emit) async {
    emit(AuthLoading());

    try {

      DmLoginModel response = await dmAuthRepository.login(email: event.email, password: event.password);
      SharedPreferences localStorage = await SharedPreferences.getInstance();
      await localStorage.setString('token', response.token);
      await localStorage.setString('type', 'dm');
      emit(Authenticated(type: 'dm'));

    } on Exception catch (e) {
      emit(AuthFailure(error: e.toString()));
    }
  }
  Future<String> _isUserLoggedIn() async {
    SharedPreferences localStorage = await SharedPreferences.getInstance();
    final type = localStorage.getString('type');
    return type ?? '';
  }
}
