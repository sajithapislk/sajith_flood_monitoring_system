import 'dart:convert';

import 'package:appnew/user/models/user_model.dart';
import 'package:appnew/user/models/user_register_response_model.dart';
import 'package:http/src/response.dart';

import '../../services/my_api.dart';

class AuthRepository {
  final _apiService = ApiService();

  Future<UserLoginModel> login({required String email, required String password}) async {
    var data = {"email": email, "password": password};
    final res = await _apiService.postData(data: data, url: 'user/login');
    if (res.statusCode != 200) {
      final Map<String, dynamic> body = jsonDecode(res.body);
      throw Exception(body["message"].toString());
    }
    return userLoginModelFromJson(res.body);
  }

  Future<UserRegisterResponseModel> register(
      {required String fullName,
      required String email,
      required String password,
      required String phoneNumber,
      required String guardianName,
      required String guardianTp,
      required int areaId}) async {
    var data = {
      "name": fullName,
      "email": email,
      "password": password,
      "tp": phoneNumber,
      "guardian_name": guardianName,
      "guardian_tp": guardianTp,
      "area_id": areaId
    };
    final res = await _apiService.postData(data: data, url: 'user/store');
    if (res.statusCode != 201) {
      final Map<String, dynamic> body = jsonDecode(res.body);
      throw Exception(body["message"].toString());
    }
    return userRegisterResponseModelFromJson(res.body);
  }
}
