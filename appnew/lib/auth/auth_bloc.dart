import 'package:appnew/user/models/user_model.dart';
import 'package:appnew/user/repositories/auth_repository.dart';
import 'package:flutter_bloc/flutter_bloc.dart';
import 'package:shared_preferences/shared_preferences.dart';

import 'auth_event.dart';
import 'auth_state.dart';

class AuthBloc extends Bloc<AuthEvent, AuthState> {
  AuthRepository authRepository = AuthRepository();

  AuthBloc() : super(AuthInitial()) {
    on<AppStarted>(_checkAuthStatus);
    on<LoginRequested>(_onLoginRequested);
    // on<RegisterRequested>(_onRegisterRequested);
  }

  Future<void>  _checkAuthStatus(AppStarted event, Emitter<AuthState> emit) async {
    final isLoggedIn = await _isUserLoggedIn(); // Replace with your logic

    if (isLoggedIn) {
      emit(Authenticated());
    } else {
      emit(Unauthenticated());
    }
  }

  Future<void> _onLoginRequested(LoginRequested event, Emitter<AuthState> emit) async {
    emit(AuthLoading());

    try {

      UserLoginModel response = await authRepository.login(email: event.email, password: event.password);
      SharedPreferences localStorage = await SharedPreferences.getInstance();
      await localStorage.setString('token', response.accessToken);
      emit(Authenticated());

    } on Exception catch (e) {
      emit(AuthFailure(error: e.toString()));
    }
  }

  Future<bool> _isUserLoggedIn() async {
    SharedPreferences localStorage = await SharedPreferences.getInstance();
    final token = await localStorage.get('token');
    return token != null ? true : false;
  }
}
