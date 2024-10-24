import 'package:appnew/user/models/monitor_place_model.dart';
import '../../services/my_api.dart';

class MonitorPlaceRepository {
  final _apiService = ApiService();

  Future<List<MonitorPlaceModel>> All() async {
    final res = await _apiService.getData('user/monitor-place');
    return monitorPlaceModelFromJson(res.body);
  }

}
