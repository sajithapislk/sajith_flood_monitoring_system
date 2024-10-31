import 'dart:convert';
import 'dart:developer';
import 'dart:io';
import 'package:http/http.dart' as http;
import 'package:shared_preferences/shared_preferences.dart';

class ApiService {
  final String _baseUrl = 'http://192.168.8.141:8000/api/';

  Future<String> _getToken() async {
    SharedPreferences localStorage = await SharedPreferences.getInstance();
    return localStorage.getString('token') ?? "";
  }

  Future<http.Response> postData({
    required String url,
    required Map<String, dynamic> data,
  }) async {
    final fullUrl = '$_baseUrl$url';
    log(fullUrl);
    print(jsonEncode(data));
    final token = await _getToken();

    try {
      final response = await http.post(
        Uri.parse(fullUrl),
        headers: {
          HttpHeaders.contentTypeHeader: 'application/json',
          HttpHeaders.acceptHeader: 'application/json',
          HttpHeaders.authorizationHeader: 'Bearer $token',
        },
        body: jsonEncode(data),
      );
      return response;
    } catch (e) {
      _handleError(e);
      rethrow;
    }
  }

  Future<http.Response> getData(String apiUrl, {Map<String, dynamic>? data}) async {
    final queryParams = data?.map((key, value) => MapEntry(key, value.toString()));

    final uri = Uri.parse('$_baseUrl$apiUrl').replace(queryParameters: queryParams);
    final token = await _getToken();
    log(uri.toString());
    try {
      final response = await http.get(
        uri,
        headers: {
          HttpHeaders.contentTypeHeader: 'application/json',
          HttpHeaders.acceptHeader: 'application/json',
          HttpHeaders.authorizationHeader: 'Bearer $token',
        },
      );
      return response;
    } catch (e) {
      _handleError(e);
      rethrow;
    }
  }

  void _handleError(e) {
    log('An error occurred: $e');
  }
}
