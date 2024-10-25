import 'package:equatable/equatable.dart';

abstract class AuthState extends Equatable {
  @override
  List<Object> get props => [];
}

class AuthInitial extends AuthState {}

class AuthLoading extends AuthState {}

class Authenticated extends AuthState {
  final String type;
  Authenticated({required this.type});

  @override
  List<Object> get props => [type];
}

class Unauthenticated extends AuthState {}

class AuthRegisterSuccess extends AuthState {
  final String message;

  AuthRegisterSuccess({required this.message});

  @override
  List<Object> get props => [message];
}

class AuthFailure extends AuthState {
  final String error;

  AuthFailure({required this.error});

  @override
  List<Object> get props => [error];
}