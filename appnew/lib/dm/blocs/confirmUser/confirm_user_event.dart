import 'package:equatable/equatable.dart';

abstract class ConfirmUserEvent extends Equatable {
  @override
  List<Object?> get props => [];
}

class FetchListEvent extends ConfirmUserEvent {}