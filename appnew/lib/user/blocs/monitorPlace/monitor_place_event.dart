
import 'package:equatable/equatable.dart';

abstract class MonitorPlaceEvent extends Equatable {
  @override
  List<Object?> get props => [];
}

class FetchListEvent extends MonitorPlaceEvent {}
