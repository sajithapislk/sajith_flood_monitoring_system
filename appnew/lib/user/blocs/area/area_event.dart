import 'package:equatable/equatable.dart';

abstract class AreaEvent extends Equatable {
  const AreaEvent();

  @override
  List<Object> get props => [];
}

class LoadAreas extends AreaEvent {}
