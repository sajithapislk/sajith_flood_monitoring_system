import 'package:equatable/equatable.dart';

import '../../models/risk_people_model.dart';

abstract class RiskPeopleState extends Equatable {
  @override
  List<Object> get props => [];
  }

  class RiskPeopleInitial extends RiskPeopleState {}

  class RiskPeopleLoaded extends RiskPeopleState {
  final List<RiskPeopleModel> list;

  RiskPeopleLoaded(
  this.list,
  );

  @override
  List<Object> get props => [list];
  }