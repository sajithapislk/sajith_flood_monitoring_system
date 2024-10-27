
import 'package:equatable/equatable.dart';

abstract class SafePlaceEvent extends Equatable {
  @override
  List<Object?> get props => [];
}

class FetchListEvent extends SafePlaceEvent {}