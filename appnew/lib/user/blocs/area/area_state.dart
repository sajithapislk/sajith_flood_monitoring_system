import 'package:equatable/equatable.dart';

import '../../models/area_model.dart';

abstract class AreaState extends Equatable {
  const AreaState();

  @override
  List<Object> get props => [];
}

class AreaInitial extends AreaState {}

class AreaLoading extends AreaState {}

class AreaLoaded extends AreaState {
  final List<AreaModel> areas;

  const AreaLoaded({required this.areas});

  @override
  List<Object> get props => [areas];
}

class AreaError extends AreaState {
  final String message;

  const AreaError({required this.message});

  @override
  List<Object> get props => [message];
}