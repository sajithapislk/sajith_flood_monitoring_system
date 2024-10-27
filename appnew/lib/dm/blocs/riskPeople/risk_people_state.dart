part of 'risk_people_bloc.dart';

abstract class RiskPeopleState extends Equatable {
  @override
  List<Object> get props => [];
  }

  class RiskPeopleInitial extends RiskPeopleState {}

  class MonitorPlaceLoaded extends RiskPeopleState {
  final List<RiskPeopleModel> list;

  MonitorPlaceLoaded(
  this.list,
  );

  @override
  List<Object> get props => [list];
  }