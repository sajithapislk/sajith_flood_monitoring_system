
import 'dart:convert';

import 'package:appnew/user/models/user_model.dart';
import 'package:http/src/response.dart';

import '../../services/my_api.dart';

class FCMRepository {
  final _apiService = ApiService();

  Future<void> save(String token) async {
    var data = {"fcm_token": token};
    await _apiService.postData(data: data ,url: 'user/fcm-token');
  }

}
