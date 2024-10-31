import 'package:appnew/user/models/safe_place_model.dart';
import 'package:appnew/user/models/user_dashboard_model.dart';
import '../../services/my_api.dart';

class UserDashboardRepository {
  final _apiService = ApiService();

  Future<UserDashboardModel> All({required double latitude, required double longitude}) async {
    final res = await _apiService.getData('user/dashboard',data: {'latitude': latitude, 'longitude': longitude});
    return userDashboardModelFromJson(res.body);
  }
}
