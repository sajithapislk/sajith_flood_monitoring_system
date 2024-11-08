import 'package:appnew/dm/models/monitor_place_model.dart';
import 'package:appnew/user/models/area_model.dart';

import '../../services/my_api.dart';

class AreaRepository {
  final _apiService = ApiService();

  Future<List<AreaModel>> all() async {
    final res = await _apiService.getData('area');
    return areaModelFromJson(res.body);
  }

}
