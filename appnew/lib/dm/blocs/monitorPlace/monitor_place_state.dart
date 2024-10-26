import 'package:appnew/user/models/monitor_place_model.dart';
import 'package:equatable/equatable.dart';

abstract class MonitorPlaceState extends Equatable {
  @override
  List<Object> get props => [];
}

class MonitorPlaceInitial extends MonitorPlaceState {}

class MonitorPlaceLoaded extends MonitorPlaceState {
  final List<MonitorPlaceModel> list;

  MonitorPlaceLoaded(
    this.list,
  );

  @override
  List<Object> get props => [list];
}