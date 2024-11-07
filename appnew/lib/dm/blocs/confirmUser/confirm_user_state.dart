import 'package:appnew/dm/models/confirm_user_model.dart';
import 'package:equatable/equatable.dart';

import '../../models/risk_people_model.dart';

abstract class ConfirmUserState extends Equatable {
  @override
  List<Object> get props => [];
}

class ConfirmUserInitial extends ConfirmUserState {}

class ConfirmUserLoaded extends ConfirmUserState {
  final List<ConfirmUserModel> list;

  ConfirmUserLoaded(
      this.list,
      );

  @override
  List<Object> get props => [list];
}