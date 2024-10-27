import 'package:appnew/user/models/safe_place_model.dart';
import '../../services/my_api.dart';

class SafePlaceRepository {
  final _apiService = ApiService();

  Future<List<SafePlaceModel>> All() async {
    final res = await _apiService.getData('user/safety-place/1');
    print(res.body);
    return safePlaceModelFromJson(res.body);
  }

}
