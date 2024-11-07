import 'package:appnew/dm/models/confirm_user_model.dart';

import '../../services/my_api.dart';
import '../models/risk_people_model.dart';

class ConfirmUserRepository {
  final _apiService = ApiService();

  Future<List<ConfirmUserModel>> All() async {
    final res = await _apiService.getData('dm/confirm-user');
    return confirmUserModelFromJson(res.body);
  }

}
