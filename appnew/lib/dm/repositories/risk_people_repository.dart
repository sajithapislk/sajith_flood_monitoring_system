import 'package:appnew/user/models/monitor_place_model.dart';
import '../../services/my_api.dart';
import '../models/risk_people_model.dart';

class RiskPeopleRepository {
  final _apiService = ApiService();

  Future<List<RiskPeopleModel>> All() async {
    final res = await _apiService.getData('dm/risk-user');
    return riskPeopleModelFromJson(res.body);
  }

}
