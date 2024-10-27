import '../../services/my_api.dart';
import '../models/safe_place_model.dart';

class SafePlaceRepository {
  final _apiService = ApiService();

  Future<List<SafePlaceModel>> All() async {
    final res = await _apiService.getData('dm/safety-place/1');
    print(res.body);
    return safePlaceModelFromJson(res.body);
  }

}
