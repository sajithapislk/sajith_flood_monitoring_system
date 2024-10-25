import 'package:equatable/equatable.dart';

abstract class AuthEvent extends Equatable {
  @override
  List<Object> get props => [];
}
class AppStarted  extends AuthEvent {}

class UserLoginRequested extends AuthEvent {
  final String email;
  final String password;

  UserLoginRequested({required this.email, required this.password});

  @override
  List<Object> get props => [email, password];
}
class DmLoginRequested extends AuthEvent {
  final String email;
  final String password;

  DmLoginRequested({required this.email, required this.password});

  @override
  List<Object> get props => [email, password];
}

class RegisterRequested extends AuthEvent {
  final String fullName;
  final String email;
  final String password;
  final String phoneNumber;
  final String countryIsoCode;

  RegisterRequested(
      {required this.fullName,
        required this.email,
        required this.password,
        required this.phoneNumber,
        required this.countryIsoCode});

  @override
  List<Object> get props => [fullName, email, password, phoneNumber, countryIsoCode];
}

class LogoutRequested extends AuthEvent {}