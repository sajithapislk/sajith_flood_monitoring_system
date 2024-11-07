
import 'dart:convert';

import 'package:appnew/user/models/user_model.dart';
import 'package:http/src/response.dart';

import '../../services/my_api.dart';

class AuthRepository {
  final _apiService = ApiService();

  Future<UserLoginModel> login({required String email, required String password}) async {
    var data = {"email": email, "password": password};
    final res = await _apiService.postData(data: data ,url: 'user/login');
    if (res.statusCode != 200) {
      final Map<String, dynamic> body = jsonDecode(res.body);
      throw Exception(body["message"].toString());
    }
    return userLoginModelFromJson(res.body);
  }

}
