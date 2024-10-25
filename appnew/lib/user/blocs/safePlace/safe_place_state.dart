import 'package:appnew/user/models/monitor_place_model.dart';
import 'package:equatable/equatable.dart';

import '../../models/safe_place_model.dart';

abstract class SafePlaceState extends Equatable {
  @override
  List<Object> get props => [];
}

class SafePlaceInitial extends SafePlaceState {}

class SafePlaceLoaded extends SafePlaceState {
  final List<SafePlaceModel> list;

  SafePlaceLoaded(
      this.list,
      );

  @override
  List<Object> get props => [list];
}